@extends('layouts.design')
@section('content')


<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h4 class="page-title m-0">Production in {{date('Y')}} </h4>
                    </div>
                    <div class="col-md-9">
                        <div class="float-right d-none d-md-block">
                        <a href="{{URL::to('/')}}/quotations" class="btn btn-primary btn-md float-right mr-1"   role="button"><b class="fa fa-plus-circle"> Quotations </b></a>
                        
                        <button type="button"  class="btn btn-secondary btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Report </b></button>
                        <button type="button"  class="btn btn-secondary btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-departreport" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Depart Report </b></button>

                        <a href="{{URL::to('/')}}/invoice/payments" class="btn btn-primary btn-md float-right mr-1"   role="button"><b class="fas fa-dollar-sign"> View Payments </b></a>
                        <a href="{{URL::to('/')}}/invoice" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-plus-circle"> New Invoice </b></a>
 
                      
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
    @php
    $lastyear = date('Y') - 1; 
  

  
                        $incoicesThisYear = $invoice_details['total_invoices'];
                        $totalLastYear = $invoice_details['totalLASTYEAR'];
                        $invChange =$incoicesThisYear - $totalLastYear;
                        $sign ="+";
                        $percentInv = 0;
                        if($totalLastYear == 0){
                                $totalLastYear = 1;
                                $change = ($invChange /  $totalLastYear) * 100 ;
                                $percentInv = 100;
                            }else{
                                $change = ($invChange /  $totalLastYear) * 100 ;
                                $percentInv = number_format($change,2);

                                if($percentInv > 0){
                                    $sign ="+";
                                }else{
                                    $sign ="-";
                                }
                               
                            }  @endphp
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> INVOICES {{date('Y')}}</h6>
                        <h4 class="mb-3 mt-0 float-right">{{$invoice_details['total_invoices']}}</h4>
                    </div>
                    <div>
                    @if($percentInv > 0)
                        <span class="badge badge-light text-success"> {{$sign.$percentInv}}% </span> <span class="ml-2">Compared to {{" ".$lastyear}} </span>
                    @else
                       <span class="badge badge-light text-danger"> {{$sign.$percentInv}}% </span> <span class="ml-2">Compared to {{" ".$lastyear}} </span>
                    @endif
                    
                    </div>
                    
                </div>
                
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Income</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($invoice_details['income'],2)}}</h4>
                    </div>
                    <div>
                    @php
                        $incomeThisYear = $invoice_details['income'];
                        $incomeLastYear = $invoice_details['incomeLASTYEAR'];
                        $incomeChange =$incomeThisYear - $incomeLastYear;
                        $sign ="+";
                       
                        if($incomeLastYear == 0){
                                $incomeLastYear = 1;
                                $change = ($incomeChange /  $incomeLastYear) * 100 ;
                                $percent = 100;
                            }else{
                                $change = ($incomeChange /  $incomeLastYear) * 100 ;
                                $percent = number_format($change,2);

                                if($percent > 0){
                                    $sign ="+";
                                }else{
                                    $sign ="-";
                                }
                               
                            }
                       
                        
                    @endphp

                    @if($percentInv > 0)
                        <span class="badge badge-light text-success"> {{ $sign.$percent}} % </span> <span class="ml-2">Compared to {{$lastyear}} </span>
                    @else
                        <span class="badge badge-light text-danger"> {{ $sign.$percent}} % </span> <span class="ml-2">Compared to {{$lastyear}} </span>
                    @endif
                    
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-pink mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> Unpaid Invoices</h6>
                        <h4 class="mb-3 mt-0 float-right">{{$invoice_details['open_invoices']}}</h4>
                    </div>
                    <div>
                    <a href="{{URL::to('/')}}/unpaidinvoices" target = "_target" class="btn btn-warning btn-sm"   role="button"><b class="fas fa-print"> Print Unpaid: {{number_format($invoice_details['unpaid'],2)}} </b>   </a>
                   
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
                        <h4 class="mt-0 header-title mb-4">Invoices to Customers</h4>
                        <div class="datatable-buttons">
                        <table id="mytable"
                                    class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                      <tr>
                      <th>#</th>
                      <th width="13%">Date</th>
                        <th width="30%">Narration</th>
                        <th>Department</th>
                        <th>Amount</th>
                        <th class="d-none">Balance</th>
                        <th>Status</th>
                        <th width="13%"></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $counter = 1 ; ?>
                      @foreach ($invoices as $invoice)
                      <?php $percentused = 0; 
                     
                      $paid = 0 ;
                        if(array_key_exists($invoice->invoice_id, $paidVals)){
                            $paid = $paidVals[$invoice->invoice_id];
                        }

                        $bal = $invoice->amount - $paid;
                     ?>
                      
                      <tr id="{{$invoice ->invoice_id}}">
                        <td><a>{{$counter}}</a></td>
                        <td><a>{{date_format(date_create($invoice->invoice_date),'d-m-Y')}}</a></td>
                        <td data-target="narration2" ><a>{{$invoice->narration}}</a></td>
                        <td data-target="customer_names2"><a>{{$invoice->department}}</a></td>
                        <td data-target="amount2"><a>{{number_format($invoice->amount,2)}}</a></td>
                        <td class="d-none" data-target="balance33"><a>{{number_format( $bal,2)}}</a></td>
                       
                        <td>  <?php if($invoice->cur_status == 'Paid'){ ?>
                          <span class="badge badge-success">Paid</span>
                          <?php }
                             else if($invoice->cur_status == 'Patially Paid'){?>
                              <span class="badge badge-warning">Partially</span> 
                              <?php } else if($invoice->cur_status == 'Unpaid'){?>
                                <span class="badge badge-danger">Unpaid</span> 
                              <?php } ?>
                      </td>
                      <td>
                     
                     <a class="btn btn-info btn-sm" href="invoice/{{$invoice ->invoice_id}}/open"><i class="fas fa-eye"></i></a>

           
                 @if($bal != 0)
                     <button type="button" class="btn btn-secondary btn-sm"> <a  data-role="payinvoice"  data-id="{{$invoice ->invoice_id}}"> <i class="fa fa-euro-sign" > PAY </i></a>  </button>  
                 @endif 


                 @if($invoice->amount == 0)
                  <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="invoice/{{$invoice ->invoice_id}}/destroy/"> <a  data-role="deletedisburse"  > <i class="fa fa-trash" > </i></a>  </button>  
                 @endif

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


@include('invoices.reportmodal')
@endsection