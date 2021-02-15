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
                                    <h4 class="page-title m-0">PAYMENTS FOR PRODUCTION</h4>
                                </div>
                                <div class="col-md-6">
                                <a class="btn btn-info btn-md float-right mr-1" href="{{URL::to('/')}}/production"><i class="fas fa-undo">Back</i></a>
                                <button type="button"  class="btn btn-warning btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-payments" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Payments Report </b></button>
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
                                                                              <th>Date</th>
                                                                              <th>Customer</th>
                                                                              <th>Invoice</th>
                                                                              <th>Amount</th>
                                                                              <th>Method</th>
                                                                              <th>Ref</th>
                                                                              <th></th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($payments as $payment)
                                                                         
                                                                            <tr>
                                                                            <td><a>{{$counter}}</a></td>
                                                                            <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }} </td>
                                                                            <td>{{$payment->customer_names}}</td>
                                                                            <td><a>INV0{{$payment->invoice_id}}</a></td>
                                                                            <td>{{number_format($payment ->amount,2)}}</td>
                                                                            <td>{{$payment->payment_method}}</td>
                                                                            <td>{{$payment->reference}}</td>
                                                                              

                                                                              <td>
                                                                              <a class="btn btn-success btn-sm"   href="payment/{{$payment ->payment_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                 <a class="btn btn-warning btn-sm" target="_blank" href="{{URL::to('/')}}/invoice/production/{{$payment ->payment_id}}/receipt"><i class="fas fa-file-pdf">Reprint</i></a>
                                                                                
                                                                              </td>  
 
                                                                          </tr>
                                                                        
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                    </div>
                </div>
            </div>
         </div>
         
            </div><!-- container fluid -->
        </div> <!-- Page content Wrapper -->
    </div> <!-- content -->

    @include('invoices.modalpayment')
@endsection