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
                              <div class="col-md-4">
                                    

                              
                                </div>
                                <div class="col-md-8">
                                  
                                    
                                   
                                    <a href="{{URL::to('/')}}/production" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> BACK TO INVOICES </b></a>

                                    <a href="{{URL::to('/')}}/invoice/{{$invoice->invoice_id}}/printpdf" class="btn btn-warning btn-md float-right mr-1" target="_blank"  role="button"><b class="fa fa-file-pdf"> Customer's Invoice </b></a>
                                    <a href="{{URL::to('/')}}/invoice/{{$invoice->invoice_id}}/printpdf" class="btn btn-warning btn-md float-right mr-1" target="_blank"  role="button"><b class="fa fa-file-pdf"> Admin's Invoice </b></a>
                             
                                    
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
                                                                            <th>Item Name</th>
                                                                            <th>Unit Price</th>
                                                                            <th>Quantity</th>
                                                                           
                                                                          
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
                        <td><a>{{number_format($invdetail->quantity,2)}}</a></td>
                      <td>
                         <a class="btn btn-success btn-sm" href="invoice/{{$invdetail ->detail_id}}/edit"><i class="fas fa-edit"></i></a>
                         
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