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
                    <div class="col-md-3">
                               
                    </div>
                    <div class="col-md-9">
                        <div class="float-right d-none d-md-block">
                        <button type="button"  class="btn btn-warning btn-md  mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-classlists" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Class List </b></button>
                        
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
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> Unpaid</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($studentDetails['unpaid'],2)}}</h4>
                    </div>
                    <div>
                        
                    <a href="{{URL::to('/')}}/feebalances" target = "_target" class="btn btn-warning btn-sm"   role="button"><b class="fas fa-print"> Print Balances </b></a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-green mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    
                    <div>
                        
                    <a href="{{URL::to('/')}}/students/create" class="btn btn-info btn-md mr-1"   role="button"><b class="fa fa-plus-circle"> Add New Student </b></a>
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
                        <!-- /.card-header -->
                    <div class="card-body">
                        <!-- .table-responsive -->
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                            <thead>
                                                                            <tr>
                                                                              <th>#</th>
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
                                                                            <td><a>{{$counter}}</a></td>
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
                                                                                <a class="btn btn-success btn-sm" href="students/{{$student ->student_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="students/{{$student ->student_id}}/destroy/"> <a> <i class="fa fa-trash" > </i></a>  </button>  
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 remove-confirm"  href="students/{{$student ->student_id}}/remove/"> <a> <i class="fa fa-window-close" > </i></a>  </button>  
                                                                              
                                                                              </td>  
 
                                                                          </tr>
                                                                        
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                        
                    </div>
                        <!-- /.table-responsive -->
                        
        </div>
               
    </div> <!-- END COL 6 -->

 

        

   <!-- end row -->
</div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
@endsection