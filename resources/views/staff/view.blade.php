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
                                <div class="col-md-12">
                                <h4 class="page-title m-0">{{$staff->firstname}}</h4>
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

                        <img src="{{asset('images/art.png')}}" alt="LOGO"  width="100%" height="240" class="centre">
                        <!-- /.card-header -->
                     <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                        <div class="table-responsive">
                            <table class="table m-0">
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                               
                            <tr>
                                <td>Total Projects</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['total'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Active Projects</a></td>
                                <td><span class="badge badge-warning">{{number_format($details['active'],2)}}</span></td>
                              
                                
                            </tr>
                            <tr>
                                <td><a>Role</a></td>
                               
                                <td><span class="badge badge-primary">{{$staff->name}}</span></td>
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
                        <table class="table m-0">
                          <thead>
                          <tr>
                            <th></th>
                            <th></th>                            
                          </tr>
                          </thead>
                          <tbody>
                           
                        <tr>
                            <td><a>Name</a></td>
                            <td><a>{{$staff->firstname." ".$staff->othernames}}</a></td>
                            
                        </tr>
                        <tr>
                          <td><a>Role</a></td>
                          <td><a>{{$staff->name}}</a></td>
                          
                      </tr>
                       
                        
                        <tr>
                            <td><a>Phone</a></td>
                            <td><a>{{$staff->phone}}</a></td>
                            
                        </tr>
                        <tr>
                            <td><a>Email</a></td>
                            <td><a>{{$staff->email}}</a></td>
                            
                        </tr>
                      
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
               
                <a class="btn btn-primary btn-sm" href="../"> <i class="fas fa-return">  BACK    </i></a>


            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection