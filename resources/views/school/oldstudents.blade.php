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
                                <div class="col-md-5">
                                    <h4 class="page-title m-0">OLD/ALUMNI STUDENTS</h4>
                                </div>
                                <div class="col-md-7">
                                  
                               
                                   <a href="{{URL::to('/')}}/school" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back</b></a>
                                   
                             
                                    
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
                                                                              <th>Admn</th>
                                                                              <th>Names</th>
                                                                              <th>Course</th>
                                                                              <th>Fee</th>
                                                                              <th>Status</th>
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
                                                                              <td>{{$student->cur_status}}</td>

                                                                              <td>
                                                                                <a class="btn btn-info btn-sm" href="{{$student ->student_id}}/view"><i class="fas fa-eye"></i></a>
                                                                                <a class="btn btn-primary btn-sm" href="../schoolfees/{{$student->student_id}}/viewstatement"><i class="fas fa-eye"> STMT</i></a>
                                                    <button type="button" class="btn btn-warning btn-sm"> <a  data-role="payfee"  data-id="{{$student->student_id}}"> <i class="fa fa-euro-sign" > Pay </i></a>  </button>  
                                                          
                                                                                
                                                                              
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