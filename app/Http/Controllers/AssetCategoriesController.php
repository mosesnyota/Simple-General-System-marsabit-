<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AssetCategories;
class AssetCategoriesController extends Controller
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
    public function store(Request $request)
    {
        $input = $request->all();
        AssetCategories::create($input);
      
        return redirect()->action(
            'AssetCategoriesController@index'
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
    public function edit($id)
    {
        $category =  AssetCategories::find($id) ;
        return view('assetcategory.edit', compact('category'));
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
        $category = AssetCategories::find($id) ;
        $input = $request->all();
        $category ->asset_category = $input['asset_category'];
        $category->save();
        return redirect()->action(
            'AssetCategoriesController@index'
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
      
        AssetCategories::where('category_id',$id)->delete();
        return redirect()->action(
            'AssetCategoriesController@index'
        );

    }
}
