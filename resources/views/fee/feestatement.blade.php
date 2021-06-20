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
                                    <h4 class="page-title m-0">FEE STATEMENT FOR {{$studentname}}    as at : . {{  date("d-m-Y h:i:sa") }}  </h4>
                                </div>
                                <div class="col-md-6">
                                <a href="printfeestatement" target="_blank" class="btn btn-warning btn-md float-right mr-1"   role="button"><b class="fa fa-print"> Print </b></a>
                                <button type="button"  class="btn btn-primary btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addfeeinv" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus" aria-hidden="true"> Add Fee Invoice </b></button>
                                
                                <a href="../../schoolfees" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back </b></a>
                                
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
                        <th>Type</th>
                      
                        <th>Narration</th>
                        
                        <th width="7%">Paid</th>
                        <th width="7%">Invoiced</th>
                        <th></th>
                       
                                                                              
                            </tr>
                                    </thead>
                                        <tbody>
                                        <?php $counter = 1 ; ?>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td><a>{{$counter}}</a></td>
                                                <td><a>{{$payment->paytype}}</a></td>
                      
                        
                        @if($payment ->paytype == 'Invoice')
                            <td><a>{{"Fee Invoice : ".$payment->term." ".$payment->inv_year}}</a></td>
                        @else
                        <td><a>{{date_format(date_create($payment->payment_date),'d-m-Y')}}</a></td>

                        @endif
                    

                      @if($payment ->paytype == 'Invoice')
                      <td> </td>
                      <td>  <?php if($payment->total > 1000){ ?>
                          <span class="badge badge-success">{{number_format($payment ->total,2)}}</span>
                          <?php }
                             else {?>
                              <span class="badge badge-warning">{{number_format($payment ->total,2)}}</span> 
                              <?php } ?>
                                
                      </td>
                      
                      <td> 
                          <a class="btn btn-primary btn-sm" href="viewinvoices/{{$payment ->inv_year}}/{{$payment->term}}/view"><i class="fas fa-eye"> View Invoice</i></a>
                      
                      </td>  
                      @else
                      
                      <td>  <?php if($payment->total > 1000){ ?>
                          <span class="badge badge-success">{{number_format($payment ->total,2)}}</span>
                          <?php }
                             else {?>
                              <span class="badge badge-warning">{{number_format($payment ->total,2)}}</span> 
                              <?php } ?>
                                
                      </td>
                      <td> </td>

                      @endif
                                                                 

                                                                             
 
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