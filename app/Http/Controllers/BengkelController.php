<?php
// https://stackoverflow.com/questions/12154190/fpdf-error-this-document-testcopy-pdf-probably-uses-a-compression-technique-w

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Gudangfungsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class BengkelController extends Controller
{
    public function index(){
        echo "<b>Halaman Bengkel</b><br><br>";
        echo "<a href='".url('/bengkel/pdfmerge')."'>PDF Merge</a>";
    }

    public function pdfmerge2(){
        echo "PDF Merger";

        $file1 = public_path('report/file1.pdf');
        $file2 = public_path('report/file2.pdf');

        $fileArray= array($file1, $file2);

        $datadir = public_path('report/laporanku/');
        $outputName = $datadir."merged.pdf";

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
        //Add each pdf file to the end of the command
        foreach($fileArray as $file) {
            $cmd .= $file." ";
        }
        $result = shell_exec($cmd);

        echo $result;

        // echo "Datadir: ".$datadir.", ".$file1;
    }

    public function pdfmerge(){
        echo "PDF Merge";

        $pdf = new \Jurosh\PDFMerge\PDFMerger;

        // $file1 = Storage::disk('report/')->path('file1.pdf');
        // $file1 = Storage::url('public/report/file1.pdf');
        // $file1 = asset('storage/report/file1.pdf');
        $file1 = public_path('report/file1.pdf');
        $file2 = public_path('report/file2.pdf');

        $pdf->addPdf($file1, 'all', 'vertical')
            ->addPdf($file2, 'all', 'vertical');

        // $pdf->addPDF(Storage::url('app/report/file1.pdf'), 'all', 'vertical')
            // ->addPDF(Storage::url('app/report/file2.pdf'), 'all', 'vertical')
            // ->addPDF(Storage::url('app/report/file3.pdf'), 'all', 'vertical');

        // Call merge, output format file
        $pdf->merge('file', public_path('report/laporanku.pdf'));
    }

    public function cekdirektori(){
        // Usulan           --> public/uploads/kegiatan/$kodekegiatan
        // Kwitansi         --> public/uploads/kegiatan/$kodekegiatan
        // Undangan         --> public/uploads/kegiatan/$kodekegiatan
        // Laporan Rapat    --> public/uploads/kegiatan/$kodekegiatan
        // Surat Tugas      --> public/uploads/surattugas
        // NPWP             --> public/uploads/narasumber

        // echo "<h3>Cek Direktori</h3>";

        // $kodekegiatan = 'yZ6HS6xrth';

        // if (File::exists("public/uploads/kegiatan/".$kodekegiatan) == $kodekegiatan){
        //     echo "Direktori tersedia";
        // }else{
        //     echo "Direktori tidak tersedia";
        //     File::makeDirectory("public/uploads/kegiatan/".$kodekegiatan);
        // }

        // Storage::disk('uploads')->put('filename')

        echo "storagepath: ".Storage::disk('local');
    }
}
?>