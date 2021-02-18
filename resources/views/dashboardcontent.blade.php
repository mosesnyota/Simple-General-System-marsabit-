
        <div class="page-content-wrapper ">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0">Dashboard</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> RECORD PRODUCTION PAYMENT
                                            </button>
                                           
                                            <div class="dropdown-menu dropdown-menu-animated">
                                                <a class="dropdown-item" href="newpayment"><i class="dripicons-user text-muted"></i> Record Payment</a>
                                                
                                            </div>
                                        </div>
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
                                    <h6 class="text-uppercase mt-0 float-left text-white-50">Income  {{date('Y')}}</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{number_format($totalIncomethisYear,2)}}</h4>
                                </div> 
                                
                                
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-cube-outline h5"></i></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-info mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50">STUDENTS</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{$totalStudents}}</h4>
                                </div>
                                <div>
                                <span class="badge badge-light text-success"> {{"Male: ". $studentDetails['male']}}  </span> <span class="badge badge-light text-success">  {{"Female: ".$studentDetails['female']}} </span>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-buffer h5"></i></a>
                                </div>
                                <p class="font-14 m-0"> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-pink mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50"> EXPENSES</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{number_format($expense['thisyear'],0)}}</h4>
                                </div>
                                <div>
                                    
                                <span class="badge badge-light text-primary"> {{ number_format($pecentChange,1)}} % </span> <span class="ml-2">From Last Year</span>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-tag-text-outline h5"></i></a>
                                </div>
                                <p class="font-14 m-0"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50"> FEES </h6>
                                    <h4 class="mb-3 mt-0 float-right">{{number_format($totalFee,2)}}</h4>
                                </div>
                                <div>
                                    
                                    <span class="badge badge-light text-info"> {{number_format( (100 - $studentDetails['feePercent'] ),1)}}% </span> <span class="ml-2">From {{date('Y') - 1}}</span>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-briefcase-check h5"></i></a>
                                </div>
                                <p class="font-14 m-0"> </p>
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Income/Expenses</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="morris-line-example1" class="morris-chart" style="height: 300px"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Analytics</h4>
                                <div id="morrisdonut1" class="morris-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
               

<div class="row">
    <div class="col-xl-6">
        
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">LATEST STUDENTS RECEIPTS</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
              <thead>
              <tr>
             
                <th>RCP No</th>
                <th>Student</th>
                <th>Date</th>
                <th>Amount</th>
               
              </tr>
              </thead>
              <tbody>
              
              @foreach ($payments as $payment)
              <?php $percentused = 0; ?>
              
              <tr>
              
                <td><a>{{"RC0".$payment->payment_id}}</a></td>
                <td><a>{{$payment->first_name." ".$payment->middle_name." ".$payment->surname}}</a></td>
                
                <td><a>{{date_format(date_create($payment->payment_date),'d-m-Y')}}</a></td>
               

                <td>  <?php if($payment->amount > 1000){ ?>
                  <span class="badge badge-success">{{number_format($payment ->amount,2)}}</span>
                  <?php }
                     else {?>
                      <span class="badge badge-warning">{{number_format($payment ->amount,2)}}</span> 
                      <?php } ?>
                        
              </td>

              </tr>
              
              @endforeach
            
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="{{URL::to('/')}}/schoolfees" class="btn btn-sm btn-info float-left">Fees Page</a>
          <a href="{{URL::to('/')}}/feereceipts" class="btn btn-sm btn-secondary float-right">View All Receipts</a>
        </div>
        <!-- /.card-footer -->
      </div>
</div>
<div class="col-xl-6">
                    
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Latest Production Payments    </h4>
                                <div class="table-responsive">
                                  
                                        <table class="table table-hover">
                                        <thead>
                                       
                                        <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        </tr>
                                      
                                        </thead>
                                        <tbody>
                                        @foreach ($paymentsInvoice as $payment)
                                        <tr>
                                            <td><a>{{"PY0".$payment->payment_id}}</a></td>
                                            <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }} </td>
                                            <td>{{$payment->customer_names}}</td>  

                                            <td>  <?php if($payment->amount > 1000){ ?>
                                                <span class="badge badge-success">{{number_format($payment ->amount,2)}}</span>
                                                <?php }
                                                    else {?>
                                                    <span class="badge badge-warning">{{number_format($payment ->amount,2)}}</span> 
                                                    <?php } ?>
                        
                                             </td>


                                            
                                        </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <a href="{{URL::to('/')}}/invoice" class="btn btn-sm btn-info float-left">Create Invoice</a>
                          <a href="{{URL::to('/')}}/production" class="btn btn-sm btn-secondary float-right"> All Invoices</a>
                        </div>
                        <!-- /.card-footer -->
                      </div>
                </div>





                
</div>


<div class="row">

<div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Cost per student/Year</h4>
                                <div id="morrisdonut7" class="morris-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Cost / Income</h4>
                                <div id="morrisdonut8" class="morris-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Income / Expense</h4>
                                <div id="morrisdonut9" class="morris-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- end row -->

                
               <!-- end row -->

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->
  

      

   


