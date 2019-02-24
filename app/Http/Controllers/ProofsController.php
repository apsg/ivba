<?php
namespace App\Http\Controllers;

use App\Proof;
use App\Services\ProofsService;
use App\Transformers\ProofTransformer;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ProofsController extends Controller
{

    /**
     * Zwraca kolejny proof
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function get(Request $request)
    {
        $proof = null;

        if (Auth::check()) {
            $user = Auth::user();

            if ($this->isTimeForProof($user->last_proof_at)) {
                $proof = Proof::getNextForUser($user);
            }

        } else {
            try {
                $date = Carbon::parse($request->input('last_proof_at', '2017-01-01'));
            } catch (Exception $ex) {
                $date = null;
            }
            if ($this->isTimeForProof($date)) {
                $proof = Proof::getNextUnregistered($request->input('last_proof_id', 0));
            }
        }

        if ($proof) {
            return [
                'html'     => view('proofs.render')->with(compact('proof'))->render(),
                'proof_id' => $proof->is_registered ? $request->last_proof_id : $proof->id,
                'proof_at' => $proof->is_registered ? $request->last_proof_at : (string)Carbon::now(),
            ];
        } else {
            return [
                'html'     => '',
                'proof_id' => $request->last_proof_id,
                'proof_at' => $request->last_proof_at,
            ];
        }
    }

    public function axiosGet(Request $request, ProofsService $service)
    {
        if (Auth::check()) {
            $proof = $service->nextForUser(Auth::user());
        } else {
            $proof = $service->nextForUnregistered($request);
        }

        if ($proof === null) {
            return null;
        }

        return fractal()
            ->item($proof, new ProofTransformer())
            ->toArray();
    }


    /**
     * Czy już czas na następny proof?
     * @param  Carbon $date [description]
     * @return boolean              [description]
     */
    protected function isTimeForProof($date)
    {

        if (empty($date)) {
            return true;
        }

        return $date->diffInMinutes() > 1;
    }
}
