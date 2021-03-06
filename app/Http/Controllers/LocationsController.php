<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locations;
use DB;

class LocationsController extends Controller
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
        $locations =  DB::table('locations')
                ->leftJoin('products', 'products.store_id', '=', 'locations.store_id')
                ->select(DB::raw(' locations.store_id,store_name,description, COUNT(products.product_id) AS total '))
                ->whereNull('locations.deleted_at')
                ->groupBy('locations.store_id')
                ->orderBy('store_name','DESC')->get();
        return view('locations.index', compact('locations')); 
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
        Locations::create($input);
        return redirect()->action(
            'LocationsController@index'
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
        $location =  Locations::find($id) ;
        return view('locations.edit', compact('location'));
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
        $location = Locations::find($id) ;
        $input = $request->all();
        $location ->store_name = $input['store_name'];
        $location ->description = $input['description'];
        $location->save();
        return redirect()->action(
            'LocationsController@index'
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
      
        Locations::where('store_id',$id)->delete();
        return redirect()->action(
            'LocationsController@index'
        );

    }
}
