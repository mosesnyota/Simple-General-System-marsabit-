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
                                    <h4 class="page-title m-0">DEFINED PERMISSIONS</h4>
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
                                                                          <table id="example2" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                            <thead>
                                                                            <tr>

                                                                              <th>#</th>
                                                                              <th>Permission</th>
                                                                              <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($permissions as $permission)
                                                                         
                                                                            <tr id="{{$permission ->id}}">
                                                                              <td><a>{{$counter }}</a></td>
                                                                            <td><a>{{$permission ->name}}</a></td>
                                                                             
                                                                              <td>
                                                                                
                                                                                <a class="btn btn-primary btn-sm" href="roles/{{$permission ->id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="roles/{{$permission ->id}}/destroy/"> <a  data-role="deletedisburse"  > <i class="fa fa-trash" > </i></a>  </button>  
                                                                                

                                                                              </td>  
 
                                                                          </tr>
                                                                        
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
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

    @include('roles.modals')


@endsection