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
                    <div class="col-md-6">
                        <h4 class="page-title m-0"> Marks Dashboard </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right d-none d-md-block">
                        <a href="{{URL::to('/')}}/marks" class="btn btn-primary btn-md"   role="button"><b class="fa fa-users"> MARKS </b></a>
                        <a href="{{URL::to('/')}}/courses" class="btn btn-warning btn-md"   role="button"><b class="fa fa-graduation-cap"> COURSES </b></a>
                        <a href="{{URL::to('/')}}/subjects" class="btn btn-info btn-md"   role="button"><b class="fas fa-dollar-sign">  SUBJECTS </b></a>

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
                        <h4 class="mb-3 mt-0 float-right">{{$totalStudents}}</h4>
                    </div>
                    <div>
    
                        <span class="badge badge-light text-success"> {{"Male: ".$studentDetails['male']}}  </span> <span class="badge badge-light text-success">  {{"Female: ".$studentDetails['female']}} </span>
                   
                    
                    </div>
                    
                </div>
                
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50">Income</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format(90,2)}}</h4>
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
    @can('VIEW PROJECTS')
    <div class="row">
        <div class="col-xl-8">
        
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">LATEST MARKS</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                      <thead>
                      <tr>
                     
                        <th>#</th>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Marks</th>
                       
                      </tr>
                      </thead>
                      <tbody>
                      <?php $counter = 1; ?>
                      @foreach($latestMarks as $marks)
                      <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $marks->studentsname   }}</td>
                            <td>{{ $marks->subject_name   }}</td>
                            <td>{{ $marks->exam   }}</td>
                            <td> <?php if ($marks->marks < 50) { ?>
                                <span class="badge badge-danger">{{$marks->marks." %"}}</span>
                                <?php } else if($marks->marks > 49 && $marks->marks < 70){ ?>
                                    <span class="badge badge-warning">{{$marks->marks." %"}}</span>
                                <?php }  else if($marks->marks > 69 && $marks->marks < 80){ ?>
                                    <span class="badge badge-info">{{$marks->marks." %"}}</span>
                                <?php } else if($marks->marks > 79 ){ ?>
                                    <span class="badge badge-success">{{$marks->marks." %"}}</span>
                                <?php } ?>
                            </td>

                           
                             <?php $counter += 1; ?>
                    </tr>


                      @endforeach
                      
                    
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <a href="{{URL::to('/')}}/marks" class="btn btn-sm btn-info float-left">Marks Page</a>
                  <a href="{{URL::to('/')}}/marks" class="btn btn-sm btn-secondary float-right">View All Marks</a>
                </div>
                <!-- /.card-footer -->
              </div>
        </div>

        <div class="col-xl-4">
        
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Exams</h4>
                    <div class="table-responsive">
                      
                            <table class="table table-hover">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Exam </th>
                              <th>Status </th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            
                            
            </tbody>
        </table>
    </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="{{URL::to('/')}}/marks" class="btn btn-sm btn-info float-left">Record Marks</a>
              <a href="{{URL::to('/')}}/marks" class="btn btn-sm btn-secondary float-right"> All Marks</a>
            </div>
            <!-- /.card-footer -->
          </div>
    </div>
    </div>
    <!-- end row -->
@endcan
   <!-- end row -->
</div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
@endsection