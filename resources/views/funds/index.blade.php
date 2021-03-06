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
                                    <h4 class="page-title m-0">RECEIVED FUNDS</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Options
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                              <button type="button"  class="btn btn-info btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Generate Report </b></button>
                                                
                                                
                  
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button"  class="btn btn-info btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Report </b></button>
                                    <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addfundings" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Funds </b></button>
                                  
                                    
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
                                <td>Received This Year</td>
                                
                                <td><span class="badge badge-success">{{number_format($funds['thisyear'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>This Month</a></td>
                                <td><span class="badge badge-warning">{{number_format($funds['thismonth'],2)}}</span></td>
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
                                                                              <th>Date</th>
                                                                              <th>Currency</th>
                                                                              <th>Amount</th>
                                                                              <th>Rate</th>
                                                                              <th>Local Cur</th>
                                                                              <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($fundings as $funding)
                                                                         
                                                                            <tr id="{{$funding ->funding_id}}">
                                                                              <td><a>TRX0{{$funding ->funding_id}}</a></td>
                                                                              <td>{{$funding->funding_date}}</td>
                                                                              <td><h6 class="badge badge-success">{{$funding ->currency}}</h6></td>
                                                                              <td>{{number_format($funding ->original_amount,2)}}</td>
                                                                              <td>{{number_format($funding ->exchangerate,2)}}</td>
                                                                              <td>{{number_format($funding ->final_amount,2)}}</td>


                                                                              <td>
                                                                                
                                                                                <a class="btn btn-primary btn-sm" href="funds/{{$funding ->funding_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="funds/{{$funding ->funding_id}}/destroy/"> <a  data-role="deletedisburse"  data-id="{{$funding ->funding_id}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                                                                

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

    @include('funds.modals')


@endsection