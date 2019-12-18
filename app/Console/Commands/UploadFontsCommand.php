<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UploadFontsCommand extends Command
{
    protected $signature = 'ivba:fonts';

    protected $description = 'Upload required fonts for FPDF';

    public function handle()
    {
        File::copyDirectory(storage_path('/fonts/'), app_path('../vendor/setasign/fpdf/font'));
    }
}
