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
                                    <h4 class="page-title m-0">INSTITUTION'S EXPENSES</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Options
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                              <button type="button"  class="btn btn-primary btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Generate Report </b></button>
                                                
                                                
                  
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button"  class="btn btn-warning btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Report </b></button>
                                    <button type="button"  class="btn btn-info btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-recordExpense" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Record Expense </b></button>
                                  
                                    
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

                       

                        <img src="{{asset('images/expense2.png')}}" alt="LOGO"  width="100%" height="230" class="centre">
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
                                <td>This Year</td>
                                
                                <td> <h6> <span class="badge badge-success">{{number_format($expense['thisyear'],2)}}</span></h6></td>
                            </tr>
                            
                            <tr>
                                <td><a>This Month</a></td>
                                <td><h6><span class="badge badge-warning">{{number_format($expense['thismonth'],2)}}</span></h6></td>
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
                                                                              <th>Narration</th>
                                                                              <th>Amount</th>
                                                                              <th>To</th>
                                                                              <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($expenses as $expen)
                                                                         
                                                                            <tr id="{{$expen ->expense_id}}">
                                                                              <td><a>{{$counter}} </a></td>
                                                                              <td>{{$expen->expense_date}}</td>
                                                                              <td>{{$expen->narration}}</td>
                                                                              <td>{{number_format($expen ->expense_amount,2)}}</td>
                                                                              <td>{{$expen->supplier_name}}</td>
                                                                              <td>
                                                                                
                                                                                <a class="btn btn-primary btn-sm" href="expense/{{$expen ->expense_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="expense/{{$expen ->expense_id}}/destroy/"> <a  data-role="deletedisburse"  data-id="{{$expen ->expense_id}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                                                                

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

   @include('expenses.modals')

@endsection