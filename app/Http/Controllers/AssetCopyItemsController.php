<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AssetItem;
use App\Catalogue;
use App\AssetCopy;

class AssetCopyItemsController extends Controller
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

        $categories =  DB::table('asset_categories')
                ->leftJoin('catalogue', 'catalogue.category_id', '=', 'asset_categories.category_id')
                ->select(DB::raw(' asset_categories.category_id,asset_category, COUNT(catalogue.asset_id) AS total '))
                ->whereNull('asset_categories.deleted_at')
                ->groupBy('asset_categories.category_id')
                ->orderBy('asset_category','DESC')->get();
        return view('assetcategory.index', compact('categories')); 
    }


    
    public function openCopiesItems($asset_id, $copy_id){

        $assetfull = Catalogue::find($asset_id);
        $copies = AssetItem::where('asset_copy_id','=',$copy_id)->get();
        return view('catalogue.viewitems',compact('copies','assetfull'));
 
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $assetid, $assetcopy)
    {
        $input = $request->all();
        $input['asset_copy_id'] = $assetcopy;
        $input['asset_id'] = $assetid;
        AssetItem::create($input);
        return redirect()->action(
            'AssetCopyItemsController@openCopiesItems', [$assetid,$assetcopy]
        );
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
    public function edit($assetid, $assetcopy,$itemid)
    {
        $assetitem = AssetItem::find($itemid);
        return view('catalogue.edititem', compact('assetitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $assetid, $assetcopy,$itemid)
    {
        $assetitem = AssetItem::find($itemid);
        $input = $request->all();
        $assetitem ->name = $input['name'];
        $assetitem ->quantity = $input['quantity'];
        $assetitem->save();
        return redirect()->action(
            'AssetCopyItemsController@openCopiesItems', [$assetid,$assetcopy]
        );
    
    }

    public function saveitems(Request $request, $assetid){
           $input = $request->all();
           $copies = AssetCopy::where('asset_id' ,'=',$assetid)->get();
           foreach($copies as $copy){
                $asset_copy_id = $copy->asset_copy_id;
                $item = [];
                $item['name'] = $input['name'];
                $item['quantity'] = $input['quantity'];;
                $item['asset_id'] = $assetid;
                $item['asset_copy_id'] = $asset_copy_id;
                AssetItem::create($item);

           }


        return redirect()->action(
                    'CatalogueController@show', $assetid
                );
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assetid, $assetcopy,$itemid)
    {
      
        AssetItem::where('asset_item_id',$itemid)->forceDelete();
        return redirect()->action(
            'AssetCopyItemsController@openCopiesItems', [$assetid,$assetcopy]
        );

    }
}
