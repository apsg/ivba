<?php

namespace App\Http\Controllers;

use FPDI;
use FPDF;
use App\Certificate;
use App\UserCertificate;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth')->except('check');
    }

    /**
     * [download description]
     * @param  Certificate $certificate [description]
     * @return [type]                   [description]
     */
    public function download(UserCertificate $certificate){
    	
    	$pdf = new FPDI();

    	$pdf->addPage();

		$pdf->AddFont("DejaVuSans", '', 'DejaVuSans.php');

		$pdf->SetFont('DejaVuSans','',12);
		$pdf->SetTextColor(0,0,0);

		$pdf->Image( storage_path('app/tlo.png'), 0, 0, 210, 298 );


	    $pdf->SetXY(0, 92);
	    $pdf->SetFont('DejaVuSans', '', 12);
	    $pdf->cell("0", "0", $certificate->id . '/' . $certificate->created_at->format('Y') , 0,1,"C");

	    $pdf->SetXY(0, 110);
	    $pdf->SetFont('DejaVuSans', '', 20);
	    $pdf->cell("0", "0", $certificate->certificate->title , 0,1,"C");

	    $pdf->SetXY(0, 140);
	    $pdf->SetFont('DejaVuSans', '', 15);
	    $pdf->cell("0", "0", $certificate->user->name , 0,1,"C");

	    $pdf->SetXY(95, 189);
	    $pdf->SetFont('DejaVuSans', '', 15);
	    $pdf->cell("0", "0", $certificate->created_at->format("Y-m-d")  , 0,1,"C");

		return $pdf->Output();
    }

    /**
     * Strona sprawdzania certyfikatu.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function check(Request $request){

    	if(isset($request->number)){
    		$cert = \App\UserCertificate::find($request->number);

    		if(isset($cert)){
    			$status = 'ok';
    			$name = explode(' ', $cert->user->name);

    			$text = "";
    			foreach ($name as $n) {
    				$text .= $n[0] . '*** ';
    			}

    		}else{
    			$status = 'error';
    			$text = 'Nie znaleziono certyfikatu o podanym numerze!';
    		}
    	}

    	return view('check_cert')->with(compact('status', 'text'));
    }

}
