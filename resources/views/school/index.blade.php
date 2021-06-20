@extends('layouts.design')
@section('content')

@php
$lastyear = 2020;
@endphp
<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <h4 class="page-title m-0"> Summary Dashboard {{date('Y')}} </h4>
                    </div>
                    <div class="col-md-7">
                        <div class="float-right d-none d-md-block">
                        <a href="{{URL::to('/')}}/students" class="btn btn-primary btn-md"   role="button"><b class="fa fa-users"> CUR STUDENTS </b></a>
                        <a href="{{URL::to('/')}}/students/old" class="btn btn-info btn-md"   role="button"><b class="fa fa-users"> OLD STUDENTS </b></a>
                        <a href="{{URL::to('/')}}/academics" class="btn btn-warning btn-md"   role="button"><b class="fa fa-graduation-cap"> ACADEMICS </b></a>
                        @can('VIEW_SCHOOL_FEES')
                        <a href="{{URL::to('/')}}/schoolfees" class="btn btn-info btn-md"   role="button"><b class="fas fa-dollar-sign">  FEES </b></a>
                        @endcan
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
                        <h6 class="text-uppercase mt-0 float-left text-white-50">TOTAL STUDENTS</h6>
                        <h4 class="mb-3 mt-0 float-right">{{$studentDetails['totalopen']}}</h4>
                    </div>
                    <div>
    
                        <span class="badge badge-light text-success"> {{"Male: ". $studentDetails['male']}}  </span> <span class="badge badge-light text-success">  {{"Female: ".$studentDetails['female']}} </span>
                   
                    
                    </div>
                    
                </div>
                
            </div>
        </div>
 
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Income</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($studentDetails['paid'],2)}}</h4>
                    </div>
                    <div>
                    

                    @if(0 > 0)
                        <span class="badge badge-light text-success"> {{ 0}} % </span> <span class="ml-2">Compared to {{$lastyear}} </span>
                    @else
                        <span class="badge badge-light text-danger"> {{ 0}} % </span> <span class="ml-2">Compared to {{$lastyear}} </span>
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
                        <h4 class="mb-3 mt-0 float-right">{{0}}</h4>
                    </div>
                    <div>
                        
                    <span class="badge badge-light text-primary"> {{"Total Unpaid Ksh. ".number_format(0,2)}}  </span> <span class="ml-2"></span>
                    </div>
                </div>
                
            </div>
        </div>

        
    </div>  
    <!-- end row -->

   
    <!-- end row -->
    
    <div class="row">


    <div class="col-xl-7">
        
              
    <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body">
                    <!-- .table-responsive -->
            
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                            <thead>
                                                                            <tr>
                                                                             
                                                                              <th>Admn</th>
                                                                              <th>Names</th>
                                                                              <th>Course</th>
                                                                              <th>Fee</th>
                                                                              <th></th>
                                                                              
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($students as $student)
                                                                            <tr>
                                                                           
                                                                              <td><a>{{$student->student_no}}</a></td>
                                                                              <td>{{$student->first_name." ".$student->middle_name." ".$student->surname}}</td>
                                                                              <td>{{$student->course_name}}</td>
                                                                              <td data-target="balance" > <?php if ( $student->balance  > 1000) { ?>
                                                                                  <span class="badge badge-warning"><b> {{number_format($student->balance ,2)}}</b></span>
                                                                                  <?php } else { ?>
                                                                                  <span class="badge badge-info">{{number_format($student->balance ,2)}}</span>
                                                                                  <?php } ?>
                                                                              </td>

                                                                              <td>
                                                                                <a class="btn btn-info btn-sm" href="students/{{$student ->student_id}}/view"><i class="fas fa-eye"></i></a>
                                                                              
                                                                                 
                                                                                 
                                                                              
                                                                              </td>  
 
                                                                          </tr>
                                                                        
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                      <!-- /.table-responsive -->
                      <div class="card-footer clearfix">
                  <a href="{{URL::to('/')}}/students" class="btn btn-sm btn-info float-left">View All Students</a>
                  <a href="{{URL::to('/')}}/students" class="btn btn-sm btn-secondary float-right">View All Students</a>
                </div>
                    </div>
               
                   
            

          
   


    </div> <!-- END COL 6 -->

 

        <div class="col-xl-5">
        
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">LATEST RECEIPTS</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                      <thead>
                      <tr>
                     
                        <th>RCP No</th>
                        <th>Student</th>
                       
                        <th>Amount</th>
                       
                      </tr>
                      </thead>
                      <tbody>
                      
                      @foreach ($payments as $payment)
                      <?php $percentused = 0; ?>
                      
                      <tr>
                      
                        <td><a>{{"RC0".$payment->payment_id}}</a></td>
                        <td><a>{{$payment->first_name." ".$payment->middle_name." ".$payment->surname}}</a></td>
                        
                        
                       

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

        
    </div>
    <!-- end row -->

   <!-- end row -->
</div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
@endsection