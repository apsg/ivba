<?php

namespace App\Http\Controllers;

use App\UserCertificate;
use FPDI;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('check');
        $this->middleware('can:view,certificate')->only('download');
    }

    public function download(UserCertificate $certificate)
    {
        $pdf = new FPDI();

        $pdf->addPage();

        $pdf->AddFont("DejaVuSans", '', 'DejaVuSans.php');

        $pdf->SetFont('DejaVuSans', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Image(storage_path('app/tlo.png'), 0, 0, 210, 298);

        $pdf->SetXY(0, 92);
        $pdf->SetFont('DejaVuSans', '', 12);
        $pdf->cell("0", "0", $certificate->id . '/' . $certificate->created_at->format('Y'), 0, 1, "C");

        $pdf->SetXY(0, 110);
        $pdf->SetFont('DejaVuSans', '', 20);
        $pdf->cell("0", "0", $this->convert($certificate->certificate->title), 0, 1, "C");

        $pdf->SetXY(0, 140);
        $pdf->SetFont('DejaVuSans', '', 15);
        $pdf->cell("0", "0", $this->convert($certificate->user->name), 0, 1, "C");

        $pdf->SetXY(95, 189);
        $pdf->SetFont('DejaVuSans', '', 15);
        $pdf->cell("0", "0", $certificate->created_at->format("Y-m-d"), 0, 1, "C");

        return $pdf->Output();
    }

    /**
     * Strona sprawdzania certyfikatu.
     */
    public function check(Request $request)
    {

        if (isset($request->number)) {
            $cert = UserCertificate::find($request->number);

            if (isset($cert)) {
                $status = 'ok';
                $name = explode(' ', $cert->user->name);

                $text = "";
                foreach ($name as $n) {
                    $text .= $n[0] . '*** ';
                }

            } else {
                $status = 'error';
                $text = 'Nie znaleziono certyfikatu o podanym numerze!';
            }
        }

        return view('check_cert')->with(compact('status', 'text'));
    }

    protected function convert(string $string) : string
    {
        return iconv('UTF-8', 'iso-8859-2', $string);
    }
}
