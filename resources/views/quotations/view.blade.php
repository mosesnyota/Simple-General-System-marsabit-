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
                                
                                <div class="col-md-8">
                        <h4 class="page-title m-0">Quotation Details </h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                        <a href="{{URL::to('/')}}/quotations" class="btn btn-success btn-md float-right mr-1"  role="button"><b class="fa fa-undo"> Back </b></a>
                        <a href="{{URL::to('/')}}/quotationestimates/{{$invoice->invoice_id}}" class="btn btn-info btn-md float-right mr-1"  role="button"><b class="fa fa-plus"> Add Items </b></a>
                        
                        <a href="{{URL::to('/')}}/quotations/{{$invoice->invoice_id}}/printpdf" class="btn btn-warning btn-md float-right mr-1" target="_blank"  role="button"><b class="fa fa-file-pdf"> Print PDF </b></a>

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
                  <div class="col-4">
                    <div class="card">
                        <img src="{{asset('images/report1.png')}}" alt="LOGO"  width="200" height="200" class="centre">
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
                                <td>Total Invoice</td>
                                
                                <td><span class="badge badge-success">{{number_format($invoice->amount,2)}}</span></td>
                            </tr>
                            
                            
                            <tr>
                                <td><a>Due Date</a></td>
                                <td><span class="badge badge-primary">{{$invoice->due_date}}</span></td>
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
                            <td><a>Narration</a></td>
                            <td><a>{{$invoice->narration}}</a></td>
                            </tr>
                        <tr>
                            <td><a>Customer</a></td>
                            <td><a>{{$invoice->customer_names}}</a></td>
                        </tr>
                        <tr>
                            <td><a>Invoice Date</a></td>
                            <td><a>{{date('d-m-Y', strtotime($invoice->invoice_date))}}</a></td>
                            
                        </tr>
                       
                        <tr>
                            <td><a>Total Amount</a></td>
                            <td><a>{{number_format($invoice->amount,2)}}</a></td>
                            
                        </tr>
                       
                            
                      
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>

                
                
                    
                <!-- /.card-body -->
                
                <!-- /.card-footer -->
              </div>

            </div>

            <div class="col-12">
            <div class="card">
                 
            <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Quotation Particulars</h4>
                        <div class="datatable-nobuttons">
                        <table id="stafftable"
                                    class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                      <tr>
                      <th>#</th>
                        <th>Item Name</th>
                        <th>Unit Price</th>
                        <th>Qnty</th>
                        <th>Total</th>
                      
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $counter = 1 ; ?>
                      @foreach($invoicedetails as $invdetail)
                     
                  
                      <tr>
                         <td><a>{{$counter}}</a></td>
            
                        <td><a>{{$invdetail->description}}</a></td>
                        <td><a>{{number_format($invdetail->unit_cost,2)}}</a></td>
                        <td><a>{{$invdetail->quantity}}</a></td>
                        <td><a>{{number_format($invdetail->unit_cost * $invdetail->quantity,2)}}</a></td>
                        
                      
                
                        
                      <td>
                         <a class="btn btn-success btn-sm" href="{{$invdetail ->detail_id}}/edit"><i class="fas fa-edit"></i></a>
                         
                         <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="{{$invdetail ->detail_id}}/destroy/"> <a> <i class="fa fa-trash" > </i></a>  </button>  
                                                                
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

                  <!-- /.col -->
         </div>

                

        
         </div>
         

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection