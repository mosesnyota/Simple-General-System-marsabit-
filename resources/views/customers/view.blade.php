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
                                <h4 class="page-title m-0">{{"CUSTOMER DETAILS: ".$customer->customer_names}}</h4>
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
          
                  <div class="col-4">
                    
                    <div class="card">

                        <img src="{{asset('images/tot3.png')}}" alt="LOGO"  width="200" height="200" class="centre">
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
                                <td>Total Invoices</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['total'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Unpaid</a></td>
                                <td><span class="badge badge-warning">{{number_format($details['unpaid'],2)}}</span></td>
                            </tr>
                            <tr>
                                <td><a>With Us From</a></td>
                                <td><span class="badge badge-primary">{{$customer->created_at}}</span></td>
                            </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-8">

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
                            <td><a>{{$customer->customer_names}}</a></td>
                            
                        </tr>
                        <tr>
                            <td><a>Address</a></td>
                            <td><a>{{$customer->address}}</a></td>
                        </tr>
                       
                        <tr>
                            <td><a>Phone</a></td>
                            <td><a>{{$customer->phone}}</a></td>
                            
                        </tr>
                        <tr>
                            <td><a>Email</a></td>
                            <td><a>{{$customer->email}}</a></td>
                            
                        </tr>
                      
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
                
                <a class="btn btn-primary btn-sm" href="viewinvoices"> <i class="fas fa-file-pdf">  View Invoices    </i></a>

                <a class="btn btn-primary btn-sm" target = "_blank" href="getstatement"> <i class="fas fa-file-pdf">  Get Statement    </i></a>
               

            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection