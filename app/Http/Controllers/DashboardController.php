<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 4000); //3 minutes
use Illuminate\Http\Request;
use DB;
use App\CostCentre;
use App\AccountingCode;

use App\Voucher;
use App\Ledger;
use SweetAlert;

class DashboardController extends Controller
{

    

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        $serverName = "DESKTOP-7C9B786\SQLEXPRESS"; 
        $connectionInfo = array( "Database"=>"EMB", "UID"=>"tutor", "PWD"=>"africa");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        if( $conn ) {
            echo "Connection established.<br />";
        }else{
            echo "Connection could not be established.<br />";
            die( print_r( sqlsrv_errors(), true));
        }

        $start_time = microtime(true);
        echo "Importing Cost Centres <br>";
        
        //COST CENTERS 
        $sql = "SELECT * FROM CostCentre";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            CostCentre::updateOrCreate(
            ['CostCentreID'=>$row['CostCentreID']],
            [
            'CostCentreCode'=>$row['CostCentreCode'],
            'CostCentreName'=>$row['CostCentreName'],
            'Remark'=>$row['Remark'] 
            ]);
        }

        //Importing AccountingCode
        echo "Importing AccountingCode <br>";
        $sql = "SELECT * FROM AccountingCode";
        $stmt1 = sqlsrv_query( $conn, $sql );
        if( $stmt1 === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
            AccountingCode::updateOrCreate(
            ['CodeID'=>$row['CodeID']],
            [
            'Code'=>$row['Code'],
            'CodeName'=>$row['CodeName'],
            'SortOrder'=>$row['SortOrder'], 
            'CodeType'=>$row['CodeType'], 
            'Remark'=>$row['Remark']
            ]);
        }

        $vorchIDS = DB::select("SELECT VoucherID from Voucher ");
        $existingVchrs = array();

        
       
        foreach($vorchIDS as $vch){
            array_push($existingVchrs,$vch->VoucherID);
        }
        //Importing Vourcher
        // echo "Importing Voucher <br>";
        $sql2 = "SELECT  * FROM Voucher "; 
     

        $stmt2 = sqlsrv_query( $conn, $sql2 );
        if( $stmt2 === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        $query = [];
        while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {

            $VoucherID=$row['VoucherID'];
            $VoucherNo=$row['VoucherNo'];
            $VoucherDate= date_format($row['VoucherDate'], 'Y-m-d'); 
            $VoucherType=str_replace('\'', '', $row['VoucherType']); 
            $Counter=$row['Counter']; 
            $YearID=$row['YearID'];
            $Narration = str_replace('\'', '', $row['Narration']) ;
            $CreatedBy=$row['CreatedBy'];
            $CreatedOn=date_format($row['CreatedOn'], 'Y-m-d'); 


            $query[] = "(
                '{$VoucherID}',
                '{$VoucherNo}',
                '{$VoucherDate}',
                '{$VoucherType}',
                '{$Counter}',
                '{$YearID}',
                '{$Narration}',
                '{$CreatedBy}',
                '{$CreatedOn}'
                )";
        }

        DB::statement(" INSERT ignore into voucher (
                                    VoucherID,
                                    VoucherNo,
                                    VoucherDate,
                                    VoucherType, 
                                    Counter, 
                                    YearID,
                                    Narration,
                                    CreatedBy,
                                    CreatedOn) 
                                    values ".implode(', ', $query));
       


        //  //Importing Ledger
         echo "Importing Ledger <br>";
         $sql3 = "SELECT * FROM ledger";
         $stmt3 = sqlsrv_query( $conn, $sql3 );
         if( $stmt3 === false) {
             die( print_r( sqlsrv_errors(), true) );
         }
         $query2 = [];
         while( $row = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
           
    
                $LedgerID = $row['LedgerID'];
                $LedgerCode = $row['LedgerCode'];
                $LedgerHead = $row['LedgerHead'];
                $BsplID = $row['BsplID'];
                $Category = $row['Category'];
                $CurrencyID = $row['CurrencyID'];
                $IsBook = $row['IsBook'];
                $IsBank = $row['IsBank'];
                $IsReceipt = $row['IsReceipt'];
                $IsPayment = $row['IsPayment'];
                $RomeCode = $row['RomeCode'];
                $PLCode = $row['PLCode'];
                $CashFlowCode = $row['CashFlowCode'];
                $Remark = preg_replace('/[^A-Za-z0-9\-]/', '', $row['Remark']) ;
                $Balance_FC = $row['Balance_FC'];
                $Balance_LC = $row['Balance_LC'];
                $Forex = $row['Forex'];


                $query2[] = "(
                    '{$LedgerID}',
                    '{$LedgerCode}',
                    '{$LedgerHead}' ,
                    '{$BsplID}'  ,
                    '{$Category}'  ,
                    '{$CurrencyID}' ,
                    '{$IsBook}' ,
                    '{$IsBank}'  ,
                    '{$IsReceipt}' ,
                    '{$IsPayment }',
                    '{$RomeCode }',
                    '{$PLCode}' ,
                    '{$CashFlowCode }',
                    '{$Remark }',
                    '{$Balance_FC }',
                    '{$Balance_LC}' ,
                    '{$Forex}' 
                    )";


         }//END Fetch Data from MSSQL


         DB::statement(" INSERT ignore INTO ledger
         ( LedgerID,
          LedgerCode,
          LedgerHead,
          BsplID,
          Category,
          CurrencyID,
          IsBook,
          IsBank,
          IsReceipt,
          IsPayment,
          RomeCode,
          PLCode,
          CashFlowCode,
          Remark,
          Balance_FC,
          Balance_LC,
          Forex) values ".implode(', ', $query2));

        
          //Importing voucherdetail
          echo "Importing voucherdetail <br>";
          $sql3 = "SELECT * FROM VoucherDetail ";
          $stmt3 = sqlsrv_query( $conn, $sql3 );
          if( $stmt3 === false) {
              die( print_r( sqlsrv_errors(), true) );
          }
          $query3 = [];
          while( $row = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
             
            $VoucherDetailID=$row['VoucherDetailID'];
            $VoucherID=$row['VoucherID'];
            $SerialNo=$row['SerialNo'];
            $LedgerID=$row['LedgerID'];
            $CostCentreID=$row['CostCentreID'];
            $CurrencyID=$row['CurrencyID'];
            $Amount_LC=$row['Amount_LC'];
            $Amount_FC=$row['Amount_FC'];
            $ExchangeRate=$row['ExchangeRate'];
            $MODE =$row['Mode'];
            $AssetID=$row['AssetID'];
            $ContactID=$row['ContactID'];
            $Forex=$row['Forex'];

            $query3[] = "(
                '{$VoucherID}',
                '{$VoucherDetailID}',
                '{$SerialNo}',
                '{$LedgerID}' ,
                '{$CostCentreID}'  ,
                '{$CurrencyID}'  ,
                '{$Amount_LC}' ,
                '{$Amount_FC}' ,
                '{$ExchangeRate}'  ,
                '{$MODE}'  ,
                '{$AssetID }',
                '{$ContactID }',
                '{$Forex}' 
                )";
          }


          DB::statement(" INSERT  INTO voucherdetail
          ( 
            VoucherID,
            VoucherDetailID,
            SerialNo,
            LedgerID,
            CostCentreID,
            CurrencyID,
            Amount_LC,
            Amount_FC,
            ExchangeRate,
            MODE,
            AssetID,
            ContactID,
            Forex
          ) values ".implode(', ', $query3));

        sqlsrv_free_stmt( $stmt);
        sqlsrv_free_stmt( $stmt1);
        sqlsrv_free_stmt( $stmt2);
        sqlsrv_free_stmt( $stmt3);

        echo " : <br>";
        echo "Data Import Completed Successfully! : <br>";
        

        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time); 
        echo " Execution Time = ".number_format($execution_time,1)." sec"; 

        alert()->success('Success', 'Successfully Imported Data from DBAMS');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
