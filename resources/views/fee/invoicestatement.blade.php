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
                                    <h4 class="page-title m-0">FEE INVOICE:  {{$termyear."  For ".$studentname}}</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                   
                                <button type="button"  class="btn btn-primary btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addfee" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus" aria-hidden="true"> Add Fee </b></button>
                                
                                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back </b></a>
                                    <a href="printstatement" target="_blank" class="btn btn-warning btn-md float-right mr-1"   role="button"><b class="fa fa-print"> Print </b></a>
                             
                                    
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
            
                    <table id="mytable" class="table table-striped table-bordered dt-responsive"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Votehead</th>
                       
                        
                        <th>Amount</th>
                     
                        <th></th>
                       
                                                                              
                            </tr>
                                    </thead>
                                        <tbody>
                                        <?php $counter = 1 ; ?>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td><a>{{$counter}}</a></td>
                        <td><a>{{$payment->votehead}}</a></td>
                        
                       
                 
                     
                     
                      <td>  <?php if($payment->amount > 1000){ ?>
                          <span class="badge badge-success">{{number_format($payment ->amount,2)}}</span>
                          <?php }
                             else {?>
                              <span class="badge badge-warning">{{number_format($payment ->amount,2)}}</span> 
                              <?php } ?>
                                
                      </td>
                      
                      
                      <td> 
                          <a class="btn btn-primary btn-sm" href="../../../editfee/{{$payment ->fee_invoice_id }}/edit"><i class="fa fa-edit"> Edit</i></a>
                      
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

   

    @include('fee.addfeemodal')
@endsection