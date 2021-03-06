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
                                    <h4 class="page-title m-0">SALES INVOICES</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                    
                                   
                                    <a href="{{URL::to('/')}}/invoice" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-plus-circle"> New Invoice </b></a>
                                   
                             
                                    
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
                  <div class="col-12">
                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body">
                    <!-- .table-responsive -->
            
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                            <thead>
                                                                            <tr>
                                                                              <th>#</th>
                                                                              <th>Inv No</th>
                                                                              <th>Customer</th>
                                                                              <th>Date</th>
                                                                              <th>Amount</th>
                                                                              <th>Status</th>
                                                                              <th></th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($invoices as $invoice)
                                                                         
                                                                            <tr>
                                                                            <td><a>{{$counter}}</a></td>
                                                                              <td><a>INV0{{$invoice->invoice_id}}</a></td>
                                                                              <td>{{$invoice->customer_names}}</td>
                                                                           
                                                                              <td>{{ date('d-m-Y', strtotime($invoice->invoice_date)) }} </td>
                                                                              <td>{{number_format($invoice ->amount,2)}}</td>
                                                                              <td>  <?php if($invoice->cur_status == 'paid'){ ?>
                                                                                    <span class="badge badge-success">Paid</span>
                                                                                    <?php }
                                                                                      else if($invoice->cur_status == 'partial'){?>
                                                                                        <span class="badge badge-warning">Partially Paid</span> 
                                                                                        <?php } else if($invoice->cur_status == 'unpaid'){?>
                                                                                          <span class="badge badge-danger">Unpaid</span> 
                                                                                        <?php } ?>
                                                                                </td>

                                                                              <td>
                                                                                <a class="btn btn-info btn-sm" href="invoice/{{$invoice ->invoice_id}}/open"><i class="fas fa-eye"></i></a>
                                                                                <a class="btn btn-success btn-sm" href="invoice/{{$invoice ->invoice_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="invoice/{{$invoice ->invoice_id}}/destroy/"> <a  data-role="deletedisburse"  > <i class="fa fa-trash" > </i></a>  </button>  
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

    


@endsection