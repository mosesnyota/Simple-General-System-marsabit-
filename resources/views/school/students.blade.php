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
                                    <h4 class="page-title m-0">ACTIVE STUDENTS</h4>
                                </div>
                                <div class="col-md-7">
                                  
                                <button type="button"  class="btn btn-warning btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-classlists" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Class List </b></button>
                                     
                                    <a href="{{URL::to('/')}}/students/create" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-plus-circle"> New Student </b></a>
                                    <a href="{{URL::to('/')}}/students/old" class="btn btn-primary btn-md float-right mr-1"   role="button"><b class="fa fa-check"> Old Students </b></a>
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
                                                                              <td>{{$student->cur_status}}</td>

                                                                              <td>
                                                                                <a class="btn btn-info btn-sm" href="students/{{$student ->student_id}}/view"><i class="fas fa-eye"></i></a>
                                                                                <a class="btn btn-success btn-sm" href="students/{{$student ->student_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="students/{{$student ->student_id}}/destroy/"> <a> <i class="fa fa-trash" > </i></a>  </button>  
                                                                                <button type="button" class="btn btn-info btn-sm mr-1 remove-confirm"  href="students/{{$student ->student_id}}/remove/"> <a> <i class="fa fa-window-close" > </i></a>  </button>  
                                                                              
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

    @include('school.studentsmodal')


@endsection