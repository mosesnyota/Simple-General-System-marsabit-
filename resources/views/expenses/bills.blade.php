@extends('layouts.design')
@section('content')


<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h4 class="page-title m-0">Expenses {{date('Y')}} </h4>
                    </div>
                    <div class="col-md-9">
                        <div class="float-right d-none d-md-block">
                        <button type="button"  class="btn btn-primary btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Generate Report </b></button>
                                                
                        <button type="button"  class="btn btn-warning btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Report </b></button>
                                    <button type="button"  class="btn btn-info btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-recordExpense" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Record Expense </b></button>
                                  
                        </div> 
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
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> Bills {{date('Y')}}</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($expense['thisyear'],2)}}</h4>
                    </div>
                    <div>
                    
                        <span class="badge badge-light text-success"> 0% </span> <span class="ml-2">Compared to {{" ".date('Y') - 1}} </span>
                    
                    
                    </div>
                    
                </div>
                
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Expenses</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($expense['thisyear'],2)}}</h4>
                    </div>
                    <div>
                   

                    
                        <span class="badge badge-light text-success"> 0 % </span> <span class="ml-2">Compared to {{date('Y') - 1}} </span>
                    
                    
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-pink mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> Unpaid Bills</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($expense['unpaidCount'],0)}}</h4>
                    </div>
                    <div>
                        
                    <span class="badge badge-light text-primary"> {{"A/c Payables Ksh. ".number_format($expense['thisyear'],2)}}  </span> <span class="ml-2"></span>
                    </div>
                </div>
                
            </div>
        </div>

        
    </div>  
    <!-- end row -->

   
    <!-- end row -->
  
    <div class="row">
        <div class="col-xl-12">
        
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Accounts Payable / Expenses</h4>
                        <div class="datatable-buttons">
                        <table id="mytable"
                            class="table table-striped table-bordered dt-responsive"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                      <tr>
                      <th>#</th>
                      <th>Date</th>
                                                                              <th>Narration</th>
                                                                             
                                                                              <th>Supplier</th>
                                                                              <th>Amount</th>
                                                                              <th>Status</th>
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
                                                                              <td>{{$expen->supplier_name}}</td>
                                                                              <td>{{number_format($expen ->expense_amount,2)}}</td>
                                                                              <td>  <?php if($expen->cur_status == 'Paid'){ ?>
                          <span class="badge badge-success">Paid</span>
                          <?php }
                             else if($expen->cur_status == 'Partial'){?>
                              <span class="badge badge-warning">Partially</span> 
                              <?php } else if($expen->cur_status == 'unpaid'){?>
                                <span class="badge badge-danger">Unpaid</span> 
                              <?php } ?>
                      </td>
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
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <a href="{{URL::to('/')}}/invoices" class="btn btn-sm btn-info float-left">Create Invoice</a>
                  <a href="{{URL::to('/')}}/invoices" class="btn btn-sm btn-secondary float-right">View All Invoices</a>
                </div>
                <!-- /.card-footer -->
              </div>
        </div>

        
    </div>
    <!-- end row -->

    
   <!-- end row -->

</div><!-- container fluid -->

</div> <!-- Page content Wrapper -->


@include('expenses.modals')
@endsection