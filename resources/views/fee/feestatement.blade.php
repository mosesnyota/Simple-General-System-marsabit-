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
                                    <h4 class="page-title m-0">FEE STATEMENT</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                   
                                   
                                    <a href="{{URL::to('/')}}/school" class="btn btn-info btn-lg float-right mr-1"   role="button"><b class="fa fa-undo"> Back to School Dashboard </b></a>
                                   
                             
                                    
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
                        <th>RCP No</th>
                        <th>Student</th>
                        <th>Date</th>
                        <th width="5%">Method</th>
                        <th width="5%">Paid</th>
                        <th width="5%">Invoiced</th>
                       
                                                                              
                            </tr>
                                    </thead>
                                        <tbody>
                                        <?php $counter = 1 ; ?>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td><a>{{$counter}}</a></td>
                                                @if($payment ->paytype == 'Invoice')
                                                    <td><a>{{"INV0".$payment->payment_id}}</a></td>
                                                @else
                                                    <td><a>{{"PY0".$payment->payment_id}}</a></td>
                                                @endif
                        <td><a>{{$payment->studentname}}</a></td>
                        
                        <td><a>{{date_format(date_create($payment->payment_date),'d-m-Y')}}</a></td>
                      
                        
                        <td>  <?php if($payment->payment_method =='Mpesa'){ ?>
                          <span class="badge badge-success">{{$payment ->payment_method}}</span>
                          <?php }
                             else if($payment->payment_method =='Cash'){?>
                              <span class="badge badge-warning">{{$payment ->payment_method}}</span> 
                              <?php } else if($payment->payment_method =='Bank Deposit'){?>
                              <span class="badge badge-info">{{$payment ->payment_method}}</span> 
                              <?php }else {?>
                              <span class="badge badge-secondary">{{$payment ->payment_method}}</span> 
                              <?php }?>
                                
                      </td>

                        

                      @if($payment ->paytype == 'Invoice')
                      <td> </td>
                      <td>  <?php if($payment->amount > 1000){ ?>
                          <span class="badge badge-success">{{number_format($payment ->amount,2)}}</span>
                          <?php }
                             else {?>
                              <span class="badge badge-warning">{{number_format($payment ->amount,2)}}</span> 
                              <?php } ?>
                                
                      </td>
                      
                      @else
                      
                      <td>  <?php if($payment->amount > 1000){ ?>
                          <span class="badge badge-success">{{number_format($payment ->amount,2)}}</span>
                          <?php }
                             else {?>
                              <span class="badge badge-warning">{{number_format($payment ->amount,2)}}</span> 
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

   


@endsection