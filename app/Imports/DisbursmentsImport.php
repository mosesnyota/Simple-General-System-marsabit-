<?php

namespace App\Imports;

use App\DisbursmentNew;
use Maatwebsite\Excel\Concerns\ToModel;



class DisbursmentsImport implements ToModel
{
    public $project_id;
  

  function __construct($id) {
    $this->project_id = $id;
  }
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
       
        if(!empty($row) && $row[0] != null) {
       
        $debit = 0.0;
        if($row[5] == 0){
            $debit = 0.0;
        }else{
            $debit = $row[5];
        }


        $credit = 0.0;
       

        return new DisbursmentNew([
           'VoucherNo'      =>  $row[0],
           //this converts date from excel date to unix date format
           'VoucherDate'    => date("Y-m-d", ((intval($row[1]) - 25569) * 86400)),
           'ChequeNo'       =>  $row[2],
           'Narration'      =>  $row[4],
           'Debit'          =>  $debit,
           'Credit'         =>  $credit,
           'votehead_id'=> 0,
           'project_id'=> $this->project_id,

        ]);
    }
}
}
