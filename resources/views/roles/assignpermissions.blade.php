@extends('layouts.design')
@section('content')

    <!-- Start content -->
    <div class="content">

        <!-- Top Bar Start -->
        <div class="topbar">

        </div>
        <!-- Top Bar End -->

        <div class="page-content-wrapper ">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                <h4 class="page-title m-0">ASSIGN PERMISSIONS TO {{$role->name}}</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Options
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                             
                  
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-createpermission" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Role </b></button>
                                  
                                    
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end page-title-box -->
                    </div>
                </div> 
                <!-- end page title -->


                <div class="row">
          
                  <div class="col-3">
                    
                    <div class="card">

                       

                        <img src="{{asset('images/funds3.png')}}" alt="LOGO"  width="100%" height="230" class="centre">
                        <!-- /.card-header -->
                     <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                        <div class="table-responsive">
                            <table class="table m-0" >
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                               
                            <tr>
                                <td>USER PERMISSIONS</td>
                                
                               
                            </tr>
                            
                            <tr>
                                <td><a>ASSIGN PERMISSIONS</a></td>
                                
                            </tr>
                            
                           
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>




                   



                    <!-- /.card -->
                  </div>

                  <div class="col-9">

                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">


                        <form class="form-horizontal " method="post" action="../savepermissions/{{$role->id}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                          <div class="card-body">


                        @foreach ($permissions as $permission)
                         @if(array_key_exists($permission->id, $assignedpermissions))
                         <div class="form-group">
                            <label  class="col-sm-5 control-label">{{$permission->name}}</label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" checked name="{{$permission->id}}" value='allowed'>Allowed
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="{{$permission->id}}" value='notallowed'>Not Allowed
                                </label>
                              </div>
                        </div>
                        @else
                        <div class="form-group">
                            <label  class="col-sm-5 control-label">{{$permission->name}}</label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input"  name="{{$permission->id}}" value='allowed'>Allowed
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" checked name="{{$permission->id}}" value='notallowed'>Not Allowed
                                </label>
                              </div>
                        </div>
                         @endif 
                        @endforeach
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <div class="col text-center">
                                <a class="btn btn-warning btn-sm" href="../"><i class="fas fa-arrow-left">BACK</i></a>
                                  <button type="submit" class="btn btn-secondary">Save Permissions</button>
                              </div>
                          </div>
                          
                          <!-- /.card-footer -->
                        </form>
                        </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
                
            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

   

@endsection