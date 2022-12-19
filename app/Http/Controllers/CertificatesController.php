<?php
namespace App\Http\Controllers;

use App\UserCertificate;
use Apsg\Certificate\Certificate;
use Apsg\Certificate\Colors\Color;
use Apsg\Certificate\Fields\Field;
use Apsg\Certificate\Formats\A4PortraitFormat;
use Apsg\Multisite\Multisite;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class CertificatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('check');
        $this->middleware('can:view,certificate')->only('download');
    }

    public function download(UserCertificate $certificate)
    {
        if (config('multisite.domain') == 'internetowisprzedawcy') {
            return $this->downloadISCertificate($certificate);
        }

        $pdf = new Fpdi();

        $pdf->addPage();

        $pdf->AddFont('DejaVuSans', '', 'DejaVuSans.php');

        $pdf->SetFont('DejaVuSans', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Image(storage_path('app/tlo.png'), 0, 0, 210, 298);

        $pdf->SetXY(0, 92);
        $pdf->SetFont('DejaVuSans', '', 12);
        $pdf->cell('0', '0', $certificate->id . '/' . $certificate->created_at->format('Y'), 0, 1, 'C');

        $pdf->SetXY(0, 102);
        $pdf->SetFont('DejaVuSans', '', 12);
        $pdf->cell('0', '0', $this->convert("Ukończenia szkolenia"), 0, 1, 'C');

        $pdf->SetXY(0, 110);
        $pdf->SetFont('DejaVuSans', '', 20);
        $pdf->MultiCell('0', '10', $this->convert($certificate->certificate->title), 0, 'C');

        $pdf->SetXY(0, 140);
        $pdf->SetFont('DejaVuSans', '', 15);
        $pdf->cell('0', '0', $this->convert($certificate->user->name), 0, 1, 'C');

        $pdf->SetXY(95, 189);
        $pdf->SetFont('DejaVuSans', '', 15);
        $pdf->cell('0', '0', $certificate->created_at->format('Y-m-d'), 0, 1, 'C');

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

                $text = '';
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

    protected function convert(string $string): string
    {
        return str_replace('\n', PHP_EOL, iconv('UTF-8', 'iso-8859-2', $string));
    }

    protected function downloadISCertificate(UserCertificate $certificate)
    {
        $pdf = new Fpdi();

        $pdf->addPage();

        $pdf->AddFont('SoraRegular', '', 'SoraRegular.php');
        $pdf->AddFont('SoraBold', '', 'SoraBold.php');

        $pdf->SetFont('SoraRegular', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Image(storage_path('app/is_cert.png'), 0, 0, 210, 298);

        $pdf->SetTextColor(238, 42, 64);
        $pdf->SetXY(13, 45);
        $pdf->SetFont('SoraRegular', '', 10);
        $pdf->cell('0', '0', 'NR ' . $certificate->id . '/' . $certificate->created_at->format('Y'), 0, 1, 'L');

        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetXY(13, 88);
        $pdf->SetFont('SoraRegular', '', 18);
        $pdf->MultiCell('0', '10', $this->convert($certificate->certificate->title), 0, 'L');

        $pdf->SetXY(13, 130);
        $pdf->SetFont('SoraBold', '', 18);
        $pdf->cell('0', '0', $this->convert("Zażółć gęślą jaźń"), 0, 1, 'L');

        $pdf->SetXY(120, 189);
        $pdf->SetFont('SoraRegular', '', 12);
        $pdf->cell('0', '0', $certificate->created_at->format('Y-m-d'), 0, 1, 'L');

        return $pdf->Output();
    }
}
