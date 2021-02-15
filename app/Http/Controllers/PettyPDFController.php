<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\PettyCash;
use App\Petty;
use App\PDF_MC_Table;
use DB;

 
class PettyPDFController extends Controller
{
   private $fpdf;
 
    public function __construct()
    {
         
    }
 
    public function createPDF()
    {
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetWidths(array(30,50,30,40));
	    $pdf->Row(array("Moses Nyota Maina Moses Nyota Maina","Moses Nyota Maina Moses Nyota Maina","Moses Nyota Maina Moses Nyota Maina","Moses Nyota Maina Moses Nyota Maina"));
        $pdf->Output();
        exit;
    }
}