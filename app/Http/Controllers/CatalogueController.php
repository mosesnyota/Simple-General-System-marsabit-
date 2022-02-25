<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Catalogue;
use App\Locations;
use App\AssetCategories;

use App\Staff;
use App\IssueAsset;
use App\AssetCopy;

use SweetAlert;

use App\MyPDF;



class CatalogueController extends Controller {


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
        $assets =  DB::select('SELECT catalogue.asset_id,`asset_name`,barcode, asset_category,
        COUNT(asset_copy.`asset_id`) AS totalassets, COUNT( `issued_id` ) AS issued 
        FROM `asset_categories` JOIN catalogue ON `asset_categories`.`category_id` = catalogue.`category_id`
        LEFT JOIN `asset_copy` ON catalogue.`asset_id`  = asset_copy.`asset_id` 
        LEFT JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` = `issued_assets`.`asset_copy_id`
        WHERE catalogue.`deleted_at` IS NULL AND
        asset_copy.`deleted_at` IS NULL
        GROUP BY `asset_id`');

        $issuedassets = DB::select("SELECT `catalogue`.`asset_id`, COUNT(`issued_assets`.`asset_copy_id`) AS givend
        FROM `catalogue` JOIN `issued_assets` ON `catalogue`.asset_id = 
        `issued_assets`.`asset_id`
        WHERE cur_status = 'issued'
        GROUP BY asset_id");

        foreach($assets as $issuedd){
            $idd = $issuedd->asset_id;
            foreach($issuedassets as $issd){
                $amntissued = $issd->givend;
                $dd = $issd->asset_id;
                if($idd == $dd  ){
                    $issuedd ->issued =  $issuedd->totalassets - $amntissued ;
                }
            }


        }

        $locations = Locations::All();
        $categories = AssetCategories::All();
        $assetvalue =  DB::select('SELECT SUM(price) AS totalvalue FROM `asset_copy` 
            WHERE  asset_copy.`deleted_at` IS NULL');


        $assetscopies =  DB::table('catalogue')
        ->join('asset_copy', 'asset_copy.asset_id', '=', 'catalogue.asset_id')
        ->join('locations', 'asset_copy.location_id', '=', 'locations.store_id')
        ->select(DB::raw('catalogue.*, asset_copy_id, asset_copy.serial_no, store_name'))
        ->whereNull('catalogue.deleted_at')
        ->whereNull('asset_copy.deleted_at')
        ->orderBy('asset_name','DESC')->get();

        $totalAssetsNu =  DB::select('SELECT SUM(total) AS totalvalue FROM (
            SELECT `catalogue`.`asset_id`, COUNT(`asset_copy_id`)  AS total FROM 
            `catalogue` JOIN `asset_copy` ON `catalogue`.`asset_id` = asset_copy.`asset_id`
            WHERE catalogue.`deleted_at` IS NULL AND asset_copy.`deleted_at` IS NULL
            GROUP BY asset_id) AS D ');

        $totalAssets = 0; 
        foreach($totalAssetsNu as $totalAssetsN){
            $totalAssets = $totalAssetsN->totalvalue;
        }

        
        $employees = Staff::orderBy('firstname')->get();
        $stockvalue = 0;
        foreach($assetvalue as $valued){
            $stockvalue = $valued->totalvalue;
        }
        return view('catalogue.index', compact('totalAssets','assets','assetscopies','locations','categories','stockvalue','employees')); 
    }  



    public function viewAll(){

        $assets =  DB::select('SELECT catalogue.asset_id,`asset_name`, asset_category,
        COUNT(asset_copy.`asset_id`) AS totalassets, COUNT( `issued_id` ) AS issued 
        FROM `asset_categories` JOIN catalogue ON `asset_categories`.`category_id` = catalogue.`category_id`
        LEFT JOIN `asset_copy` ON catalogue.`asset_id`  = asset_copy.`asset_id` 
        LEFT JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` = `issued_assets`.`asset_copy_id`
        WHERE catalogue.`deleted_at` IS NULL AND
        asset_copy.`deleted_at` IS NULL
        GROUP BY `asset_id`');
        $issuedassets = DB::select("SELECT `asset_copy`.`asset_id`, COUNT(`issued_assets`.`asset_copy_id`) AS givend
        FROM `asset_copy` JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` =
        `issued_assets`.`asset_copy_id`
        WHERE cur_status = 'issued'
        GROUP BY asset_id");

        foreach($assets as $issuedd){
            $idd = $issuedd->asset_id;
            foreach($issuedassets as $issd){
                $amntissued = $issd->givend;
                $dd = $issd->asset_id;
                if($idd == $dd  ){
                    $issuedd ->issued =  $amntissued ;
                }
            }


        }

        $locations = Locations::All();
        $categories = AssetCategories::All();

        $assetvalue =  DB::select('SELECT SUM(price) AS totalvalue FROM `asset_copy` 
            WHERE  asset_copy.`deleted_at` IS NULL');


        $assetscopies =  DB::table('catalogue')
        ->join('asset_copy', 'asset_copy.asset_id', '=', 'catalogue.asset_id')
        ->join('locations', 'asset_copy.location_id', '=', 'locations.store_id')
        ->select(DB::raw('catalogue.*, asset_copy_id, asset_copy.serial_no, store_name'))
        ->whereNull('catalogue.deleted_at')
        ->whereNull('asset_copy.deleted_at')
        ->orderBy('asset_name','DESC')->get();

        $totalAssetsNu =  DB::select('SELECT SUM(total) AS totalvalue FROM (
            SELECT `catalogue`.`asset_id`, COUNT(`asset_copy_id`)  AS total FROM 
            `catalogue` JOIN `asset_copy` ON `catalogue`.`asset_id` = asset_copy.`asset_id`
            WHERE catalogue.`deleted_at` IS NULL AND asset_copy.`deleted_at` IS NULL
            GROUP BY asset_id) AS D ');

        $totalAssets = 0; 
        foreach($totalAssetsNu as $totalAssetsN){
            $totalAssets = $totalAssetsN->totalvalue;
        }

        
        $employees = Staff::all();
        $stockvalue = 0;
        foreach($assetvalue as $valued){
            $stockvalue = $valued->totalvalue;
        }
        return view('catalogue.viewall', compact('totalAssets','assets','assetscopies','locations','categories','stockvalue','employees')); 
    } 



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function editcopy($assetid, $assetcopyid){
        //catalogue/1/catalogue/4/editcopy
        $product = AssetCopy::find($assetcopyid);
        $locations = Locations::All();
        return view('catalogue.editcopy',compact('product','locations'));
    }

    public function updatecopy(Request $request){
        $input = $request->all();
        $product = AssetCopy::find( $input['asset_copy_id']);
        $product->serial_no = $input['serial_no'];
        $product->price = $input['price'];
        $product->manufacture_date = date('Y-m-d', strtotime($input['manufacture_date'])); 
        $product->location_id = $input['location_id'];  
        
        try {
            $product->save();
        } catch (Exception $e) {
                       
            alert()->error('Error', 'An Error occured'.$e);
           
        }
        

        return redirect()->action(
            'CatalogueController@index'
        );

    }





    public function viewAssetCopies($asset_id)
    {
        return view('catalogue.viewassetcopies',compact('assetcopies'));
    }

    public function issueasset(Request $request){
        
   
        $input = $request->all();
        $input['issue_date']  =  date('Y-m-d', strtotime($input['issue_date'])); 
       // IssueAsset::create($input);
       $assets =   DB::select('SELECT catalogue.asset_id,`asset_name`, barcode,asset_category,
       COUNT(asset_copy.`asset_id`) AS totalassets, COUNT( `issued_id` ) AS issued 
       FROM `asset_categories` JOIN catalogue ON `asset_categories`.`category_id` = catalogue.`category_id`
       LEFT JOIN `asset_copy` ON catalogue.`asset_id`  = asset_copy.`asset_id` 
       LEFT JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` = `issued_assets`.`asset_copy_id`
       WHERE catalogue.`deleted_at` IS NULL AND
       asset_copy.`deleted_at` IS NULL
       GROUP BY `asset_id`');

        $request->session()->put('issue_date', $input['issue_date']);
        $request->session()->put('staffmember', $input['issued_to']);
        $products =collect([]);
        $request->session()->put('products',  $products);
        return view('catalogue.viewall',compact('assets'));
     
       
    }

    public function issueItems2(){

        $assets =   DB::select('SELECT catalogue.asset_id,`asset_name`, barcode,asset_category,
        COUNT(asset_copy.`asset_id`) AS totalassets, COUNT( `issued_id` ) AS issued 
        FROM `asset_categories` JOIN catalogue ON `asset_categories`.`category_id` = catalogue.`category_id`
        LEFT JOIN `asset_copy` ON catalogue.`asset_id`  = asset_copy.`asset_id` 
        LEFT JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` = `issued_assets`.`asset_copy_id`
        WHERE catalogue.`deleted_at` IS NULL AND
        asset_copy.`deleted_at` IS NULL
        GROUP BY `asset_id`');

        return view('catalogue.viewall',compact('assets'));

        
    }


    public function pickitem(Request $request, $id){
        $issue_date = $request->session()->get('issue_date');
        $staffmember = $request->session()->get('staffmember');
        $product = Catalogue::find($id);
        $request->session()->push('products', $product);
        

        return redirect()->action(
            'CatalogueController@issueItems2'
        );

    }


    public function removecart(Request $request,$id){
        $pdt = $request->session()->get('products');
        $arraysize = count($pdt);
        $found  = FALSE;
        for ($x = 0; $x < $arraysize ; $x++){ 
            
        if(isset($pdt[$x])){
            $product = $pdt[$x]->asset_id;
            if($product == $id){
                $found = TRUE;
                //unset($pdt[$x]); 
                array_splice($pdt,$x,1);

                $arraysize = $arraysize - 1;
                break;
            }
         } 

        if($found){
            break;
        }

        }

       

        $request->session()->forget('products');
        $products =collect([]);
        $newarray = array_values($pdt);
        $request->session()->put('products', $newarray );
       
        
       return redirect()->action('CatalogueController@issueItems2');
        
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $id = Catalogue::create($input)->asset_id;
        $quantity = $input['quantity'];
        $locations = Locations::all()->random();
        $locationsID = $locations->store_id;

        for ($x = 1; $x <= $quantity; $x++) {
            $copy = [];
            $copy['serial_no'] = $x;
            $copy['asset_id'] =  $id ;
            $copy['manufacture_date'] = date('Y-m-d'); 
            $copy['location_id'] = $locationsID; 
            $copy['price'] = $input['unit_price'] ;

            //echo $copy['serial_no']." ". $copy['manufacture_date']."   ".$copy['location_id']."  Price ".$copy['price']."<br>";
            AssetCopy::create($copy);
        }
        return redirect()->action(
             'CatalogueController@index'
         );
       
    }


    public function saveissueditems(Request $request){
        $input = $request->all();
        $products =$request->session()->get('products');
        $issue_date = $request->session()->get('issue_date');
        $staffmember = $request->session()->get('staffmember');
       
        foreach ($products as $product ){
            print($product);
            $newissue = [];
            $newissue['staffid'] = $staffmember;
            $newissue['asset_id'] = $product ->asset_id;
            $newissue['asset_copy_id'] = $product ->asset_id;
            $newissue['issue_date'] = $issue_date;
            IssueAsset::create($newissue);
        }
        alert()->success('Success', 'Issued Items Successfully');
        return redirect()->action(
            'CatalogueController@index'
        );
        
    }


    
    public function storecopy(Request $request)
    {
        $input = $request->all();
        $input['manufacture_date']  =  date('Y-m-d', strtotime($input['manufacture_date']));
        $quantity = $input['quantity'];
        unset($input['quantity']);
       

        for ($x = 1; $x <= $quantity; $x++) {
            $input['serial_no'] = $x;
            AssetCopy::create($input);
        }


      
        return redirect()->action(
            'CatalogueController@index'
        );
    }
    
    public function receivestock(Request $request)
    {
        $input = $request->all();
        $product_id = $input['product_id'];
        $product =  Product::find($product_id) ;
        $user = auth()->user()->name;
        $transaction = [] ;
        $transaction['product_id'] = $input['product_id'];
        $transaction['trans_type'] ='Received Stock';
        $transaction['quantity'] = $input['quantity'];
        $transaction['transacted_by'] = $user;
        $transaction['qnty_before'] = $product->quantity;
        $transaction['qnty_after'] = $product->quantity + $input['quantity'];
        $transaction['narration'] ='Issued Items';
        $transaction['issued_to'] ='---';
        $product->quantity = $product->quantity + $input['quantity'];
        $product->save();
        ProductTransaction::create($transaction);
        return redirect()->action(
            'CatalogueController@index'
        );
    }


    public function issueproduct(Request $request){
        $input = $request->all();
        $product_id = $input['product_id'];
        $product =  Product::find($product_id) ;
        
        
        $user = auth()->user()->name;
        $transaction = [] ;
        $transaction['product_id'] = $input['product_id'];
        $transaction['trans_type'] ='Issued Items';

        $transaction['narration'] =$input['description'];
        $transaction['issued_to'] =$input['issued_to'];

        $transaction['quantity'] = $input['quantity'];
        $transaction['transacted_by'] = $user;
        $transaction['qnty_before'] = $product->quantity;
        $transaction['qnty_after'] = $product->quantity - $input['quantity'];


        $product->quantity = $product->quantity - $input['quantity'];
        $product->save();
        ProductTransaction::create($transaction);


        return redirect()->action(
            'CatalogueController@index'
        );
    }


    public function assetreport(){

        $staffs =  DB::select("SELECT staff.* , COUNT(`issued_id`) AS total FROM `issued_assets` 
        JOIN staff ON staff.`staffid` = issued_assets.`staffid`
        WHERE `issued_assets`.`cur_status` = 'issued'
        GROUP BY staff.`staffid`");



        return view('catalogue.staffreport',compact('staffs'));
    }

    public function openReportAssets(){

        $assets =  DB::select('SELECT catalogue.asset_id,`asset_name`, asset_category,
        COUNT(asset_copy.`asset_id`) AS totalassets, COUNT( `issued_id` ) AS issued 
        FROM `asset_categories` JOIN catalogue ON `asset_categories`.`category_id` = catalogue.`category_id`
        LEFT JOIN `asset_copy` ON catalogue.`asset_id`  = asset_copy.`asset_id` 
        LEFT JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` = `issued_assets`.`asset_copy_id`
        WHERE catalogue.`deleted_at` IS NULL AND
        asset_copy.`deleted_at` IS NULL
        GROUP BY `asset_id`');


 

        $issuedassets = DB::select("SELECT `asset_copy`.`asset_id`, COUNT(`issued_assets`.`asset_copy_id`) AS givend
        FROM `asset_copy` JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` =
        `issued_assets`.`asset_copy_id`
        WHERE cur_status = 'issued'
        GROUP BY asset_id");

        foreach($assets as $issuedd){
            $idd = $issuedd->asset_id;
            foreach($issuedassets as $issd){
                $amntissued = $issd->givend;
                $dd = $issd->asset_id;
                if($idd == $dd  ){
                    $issuedd ->issued =  $amntissued ;
                }
            }


        }

        
        $assetvalue =  DB::select('SELECT SUM(price ) AS totalvalue FROM `asset_copy`
            WHERE  asset_copy.`deleted_at` IS NULL');


        $assetscopies =  DB::table('catalogue')
        ->join('asset_copy', 'asset_copy.asset_id', '=', 'catalogue.asset_id')
        ->join('locations', 'asset_copy.location_id', '=', 'locations.store_id')
        ->select(DB::raw('catalogue.*, asset_copy_id, asset_copy.serial_no, store_name'))
        ->whereNull('catalogue.deleted_at')
        ->whereNull('asset_copy.deleted_at')
        ->orderBy('asset_name','DESC')->get();

        $totalAssetsNu =  DB::select('SELECT SUM(total) AS totalvalue FROM (
            SELECT `catalogue`.`asset_id`, COUNT(`asset_copy_id`)  AS total FROM 
            `catalogue` JOIN `asset_copy` ON `catalogue`.`asset_id` = asset_copy.`asset_id`
            WHERE catalogue.`deleted_at` IS NULL AND asset_copy.`deleted_at` IS NULL
            GROUP BY asset_id) AS D ');

        $totalAssets = 0; 
        foreach($totalAssetsNu as $totalAssetsN){
            $totalAssets = $totalAssetsN->totalvalue;
        }

        
        
        $stockvalue = 0;
        foreach($assetvalue as $valued){
            $stockvalue = $valued->totalvalue;
        }

        $asstVal = DB::select("SELECT asset_id, SUM(price) AS total FROM `asset_copy` 
        WHERE asset_copy.`deleted_at` IS NULL GROUP BY asset_id");

        $cumulativeValue = [];
        foreach($asstVal as $vld){  
            $cumulativeValue[$vld->asset_id] = $vld->total;
           
        }
       

        $pdf = new MyPDF();
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "ALL RECORDED ASSETS ".date('d-m-Y'),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',11);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(60, 10, "Category",1, 0, 'C', 1, '');
        $pdf-> Cell(70, 10, "Asset",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "No.Copies",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Assigned",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "In Store",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10, "Purchase Value",1, 0, 'C', 1, '');
       
        $pdf->Ln();
        $pdf->SetFont('Times','',10);
        $counter = 1;
        $pdf->SetWidths(array(10,60,70,30,30,30,40));
        $aligns = array('L','L','L','R','R','R','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        foreach($assets as $assetSS){
            $fill =  !$fill;
            $pdf->Row(array( 
            $counter,
            $assetSS->asset_category,
            $assetSS->asset_name,
            $assetSS->totalassets,
            $assetSS->issued,
            $assetSS->totalassets - $assetSS->issued,
            number_format($cumulativeValue[$assetSS->asset_id],2)
         ), $fill);
            $counter++;
            
        }


       
                                                // <tr id="{{$asset ->asset_id}}">
                                                //     <td style="line-height: 10px;">{{ $counter }}</td>
                                                   
                                                //     <td>{{ $asset->asset_category }}</td>
                                                //     <td data-target="asset_name">{{ $asset->asset_name }}</td>
                                                   
                                                //     <td>{{ $asset->totalassets }}</td>
                                                //     <td>{{  $asset->issued }}</td>



   
        $pdf-> Cell(230, 10, "Asset Value",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10,  number_format($stockvalue,2),1, 0, 'R', 1, '');
        $pdf->Output();
        exit;
    }


    public function productmovements(){
        $transactions =  DB::table('product_transactions')
        ->join('products', 'products.product_id', '=', 'product_transactions.product_id')
        ->select(DB::raw('product_transactions.*, product_name'))
        ->where('product_transactions.deleted_at', '=', NULL)
        ->get();
        return view('products.productmovements',compact('transactions'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assetcopies =  DB::select(" SELECT `catalogue`.`asset_id`,`barcode`,`asset_name`,asset_copy.`asset_copy_id`,`manufacture_date`,`price`,serial_no,
        `store_name`, `issue_date`,`firstname`,`othernames`
        FROM `catalogue` LEFT JOIN `asset_copy` ON `asset_copy`.`asset_id` = CATALOGUE.`asset_id`
        LEFT JOIN `locations` ON `asset_copy`.`location_id` = locations.`store_id`
        LEFT JOIN `issued_assets` ON asset_copy.`asset_copy_id` = issued_assets.`asset_copy_id`
        LEFT JOIN `staff` ON issued_assets.`staffid` = `staff`.`staffid`
        WHERE `catalogue`.`asset_id`  = $id ");

         $assetname = Catalogue::find($id)->asset_name;

         return view('catalogue.viewassetcopies',compact('assetcopies','assetname'));
    }

    public function showIssuedAssets($staffid){
            $id = $staffid;
            $staffd = DB::table('staff')
            ->join('roles', 'staff.staffcategory_id', '=', 'roles.id')
            ->select(DB::raw('staff.*,roles.name'))
            ->where('staffid', '=', $id)
            ->get();
            $staff = $staffd->first();

            $issuedAssets =  DB::select("SELECT catalogue.asset_id,`asset_name`, barcode,`serial_no`,`staffid`,`issue_date`,`cur_status`
            FROM  catalogue 
            LEFT JOIN `asset_copy` ON catalogue.`asset_id`  = asset_copy.`asset_id` 
            LEFT JOIN `issued_assets` ON `asset_copy`.`asset_copy_id` = `issued_assets`.`asset_copy_id`
            WHERE catalogue.`deleted_at` IS NULL AND
            asset_copy.`deleted_at` IS NULL
            AND `staffid` = $staffid ");
            return view('catalogue.viewsissuedassetstostaff', compact('staff','issuedAssets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locations = Locations::All();
        $categories = AssetCategories::All();
        $product =  Catalogue::find($id) ;
        return view('catalogue.edit', compact('product','locations','categories')); 
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
        $product = Catalogue::find($id) ;
        $input = $request->all();
        $product ->barcode = $input['barcode'];
        $product ->asset_name = $input['asset_name'];
        $product ->category_id = $input['category_id'];
        

       try {
          $product->save();
       } catch (\Throwable $th) {
        return redirect()->action(
            'CatalogueController@index'
        );
       }
       
        return redirect()->action(
            'CatalogueController@index'
        );
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Catalogue::where('asset_id',$id)->delete();
        return redirect()->action(
            'CatalogueController@index'
        );

    }
}