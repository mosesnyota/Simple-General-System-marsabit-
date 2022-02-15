<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class StaffsController extends Controller
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
        $staffs= DB::table('staff')
        ->leftJoin('roles', 'staff.staffcategory_id', '=', 'roles.id')
        ->select(DB::raw('staff.*,roles.name'))
        ->orderBy('firstname', 'ASC')
        ->get();

        $roles= DB::table('roles')
        ->select('roles.*')
        ->orderBy('name', 'ASC')
        ->get();
     

        return view('staff.index',compact('staffs','roles'));
    }


    public function leavedays(){
        $staffs= DB::table('staff')
        ->leftJoin('roles', 'staff.staffcategory_id', '=', 'roles.id')
        ->select(DB::raw('staff.*,roles.name'))
        ->orderBy('firstname', 'ASC')
        ->get();

        $roles= DB::table('roles')
        ->select('roles.*')
        ->orderBy('name', 'ASC')
        ->get();
     

        return view('staff.leavedays',compact('staffs','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories= DB::table('staff_categories')
        ->select('staff_categories.*')
        ->orderBy('categoryname', 'ASC')
        ->get();
        return view('newstaff')->with('categories',$categories);
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
        $dy = $input['password'];
        $hashedPassword = Hash::make($dy);
        $input['password'] = $hashedPassword;
        Staff::create($input);

        //for every user created, create login details
        $records = array(
                'name'     => $input['firstname']." ".$input['othernames'],
                'email'    => $input['email'],
                'password' => $hashedPassword );
        User::create($records);
        $user = User::where('email' , '=', $input['email'])->first();
        $newrole = Role::findById($input['staffcategory_id']);
        $user->assignRole($newrole);
       

       return back()->withSuccessMessage('Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = array();
        $allprojects =  DB::table('projects')
        ->select(DB::raw('count(*) AS total'))
        ->where('staff_id', '=', $id)
        ->get();
      
        $total = 0 ;
        foreach ($allprojects as $totald){ 
            $total = $totald->total;
        }
        if( $total ){
            $details['total'] = $total;
        }else{
            $details['total'] = 0.0;
        }
       
        $selectdprojects =  DB::table('projects')
        ->select(DB::raw('count(*) AS projects'))
        ->where('staff_id', '=', $id)
        ->where('cur_status', '=', 'Active')
        ->get();
      
        $activeprojects  = 0;
        foreach ($selectdprojects as $totald){ 
            $activeprojects = $totald->projects;
        }
        $details['active'] = $activeprojects;
       
       
        $staffd = DB::table('staff')
            ->join('roles', 'staff.staffcategory_id', '=', 'roles.id')
            ->select(DB::raw('staff.*,roles.name'))
            ->where('staffid', '=', $id)
            ->get();
            $staff = $staffd->first();
        return view('staff.view', compact('staff','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles= DB::table('roles')
        ->select('roles.*')
        ->orderBy('name', 'ASC')
        ->get();
        $staff =  Staff::find($id) ;
        return view('staff.editstaff', compact('roles','staff'));
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
        $input = $request->all();
        $staff =  Staff::find($id) ;
        $oldrole = Role::findById($staff->staffcategory_id);
        $user = User::where('email' , '=', $staff->email)->first();
        $user->removeRole($oldrole);
        $staff ->firstname = $input['firstname'];
        $staff ->othernames = $input['othernames'];
        $staff ->staffcategory_id = $input['staffcategory_id'];
        $newrole = Role::findById($input['staffcategory_id']);
        $user->assignRole($newrole);
        $staff ->phone = $input['phone'];
        $staff ->email = $input['email'];
        $staff->save();
        return redirect()->action(
            'StaffsController@index'
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
        Staff::where('staffid',$id)->delete();
        return redirect()->action(
            'StaffsController@index'
        );
    }
}
