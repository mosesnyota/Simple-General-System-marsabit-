<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ProductCategory;
class ProductCategoryController extends Controller
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
        $categories =  DB::table('product_category')
                ->leftJoin('products', 'products.category_id', '=', 'product_category.category_id')
                ->select(DB::raw(' product_category.category_id,category_name, COUNT(products.product_id) AS total '))
                ->whereNull('product_category.deleted_at')
                ->groupBy('product_category.category_id')
                ->orderBy('category_name','DESC')->get();
        return view('productcategory.index', compact('categories')); 
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
        ProductCategory::create($input);
      
        return redirect()->action(
            'ProductCategoryController@index'
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
        $category =  ProductCategory::find($id) ;
        return view('productcategory.edit', compact('category'));
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
        $category = ProductCategory::find($id) ;
        $input = $request->all();
        $category ->category_name = $input['category_name'];
        $category->save();
        return redirect()->action(
            'ProductCategoryController@index'
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
      
        ProductCategory::where('category_id',$id)->delete();
        return redirect()->action(
            'ProductCategoryController@index'
        );

    }
}
