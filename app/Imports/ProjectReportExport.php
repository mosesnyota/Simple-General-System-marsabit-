<?php

namespace App\Imports;
use App\DisbursmentNew;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Staff;
use App\Sponsor;
use App\Project;
use App\Activities;
use App\Votehead;
use PDF;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;



class DisbursmentsExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    public $votehead_id;
  

  function __construct($id) {
    $this->votehead_id = $id;
  }

  public function headings(): array
    {
        return [
            'BudgetLine',
            'Ref Code',
            'Date',
            'CheqNo',
            'Narration',
            'Paid To',
            'Amount',
        ];
    }

  public function collection()
    {
      $disbursementvoteheads =  DB::table('disbursment_news')
      ->join('voteheads', 'disbursment_news.votehead_id', '=', 'voteheads.votehead_id')
      ->select(DB::raw('votehead_name,voucherno,voucherdate,chequeno,narration,paid_to,debit'))
      ->where('disbursment_news.votehead_id', '=',  $this->votehead_id)
      ->where('disbursment_news.deleted_at', '=', NULL)
      ->get();
     
        return $disbursementvoteheads;
    }
    
}
