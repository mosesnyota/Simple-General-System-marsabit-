<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

use Auth;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::All();
        $user = Auth::user();
        $myroles = $user->getRoleNames();
        
        return view('roles.index',compact('roles','myroles'));
    }

    public function permissions(){
        $permissions = Permission::All();
        return view('roles.permissions',compact('permissions'));
    }


      
    public function assignpermissions($id){
        $role = Role::findById($id);
        $permissions = Permission::All();

        $assignedPerms =  DB::table('role_has_permissions')
        ->select(DB::raw('role_has_permissions.*'))
        ->where('role_id', '=', $id)
        ->get();

        $assignedpermissions = array();
        foreach ($assignedPerms as $asg){ 
            $assignedpermissions[$asg->permission_id] =  $asg->role_id;
        }

        return view('roles.assignpermissions',compact('permissions','role','assignedpermissions'));

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
        $input = $request->all();
        Role::create($input);
        return back()->withSuccessMessage('Successfully Added');
    }

    public function storepermission(Request $request){
        $input = $request->all();
        Permission::create($input);
        return back()->withSuccessMessage('Successfully Added');
    }



    public function savepermissions(Request $request, $id){
        $input = $request->all();
       
        $role = Role::findById($id);
        $permissions = Permission::All();
        foreach($permissions as $permission){

            if($input[$permission->id] == 'allowed'){
                $role->givePermissionTo($permission);
            }else{
                $role->revokePermissionTo($permission);
            }
        }

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
