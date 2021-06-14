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
                                <div class="col-md-12">
                                <h4 class="page-title m-0">{{$student->first_name}}</h4>
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

                <div class="col-3">
                    <div class="card">
                        <img src="{{asset('images/art.png')}}" alt="LOGO"  width="100%" height="240" class="centre">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                         <div class="table-responsive">
                            <table class="table m-0">
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <td>Total Invoiced</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['bill'],2)}}</span></td>
                            </tr>
                            <tr>
                                <td><a>Total Paid</a></td>
                                <td><span class="badge badge-warning">{{number_format($details['totalpaid'],2)}}</span></td>
                              
                                
                            </tr>
                            <tr>
                                <td>Fee Balance</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['balance'],2)}}</span></td>
                            </tr>
                            
                            
                            <tr>
                                <td><a>Current Year</a></td>
                               
                                <td><span class="badge badge-primary">{{$student->cur_year}}</span></td>
                            </tr>
                           
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                      </div>
                    <!-- /.card -->
                    </div>

                  <div class="col-5">
                  <a class="btn btn-primary btn-sm" href="../"> <i class="fa fa-undo">  BACK    </i></a>
                  <a class="btn btn-primary btn-sm" href="../../schoolfees/{{$student->student_id}}/viewstatement"> <i class="fa fa-file-pdf">  GET FEE STATEMENT    </i></a>

                   <div class="card">
                    <!-- /.card-header -->
                     <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">
                        <table class="table m-0">
                          <thead>
                          <tr>
                            <th></th>
                            <th></th>                            
                          </tr>
                          </thead>
                          <tbody>
                           
                        <tr>
                            <td><a>Name</a></td>
                            <td><a>{{$student->first_name." ".$student->middle_name." ".$student->surname}}</a></td>
                            
                        </tr>
                        <tr>
                          <td><a>Admn</a></td>
                          <td><a>{{$student->student_no}}</a></td>
                          
                      </tr>
                      <tr>
                          <td><a>National ID</a></td>
                          <td><a>{{$student->idno}}</a></td>
                          
                      </tr>
                      <tr>
                          <td><a>DOB:</a></td>
                          <td><a>{{$student->dob}}</a></td>
                          
                      </tr>
                       
                        
                        <tr>
                            <td><a>Phone</a></td>
                            <td><a>{{$student->phone}}</a></td>
                            
                        </tr>
                        <tr>
                            <td><a>Residence</a></td>
                            <td><a>{{$student->residence}}</a></td>
                            
                        </tr>
                        <tr>
                            <td><a>Gender</a></td>
                            <td><a>{{$student->gender}}</a></td>
                            
                        </tr>

                        <tr>
                            <td><a>Education</a></td>
                            <td><a>{{$student->level_of_edu."    (".$student->year_completed.")"}}</a></td>
                            
                        </tr>


                        <tr>
                            <td><a>Father</a></td>
                            <td><a>{{$student->father_name ."        : ".$student->father_phone}}</a></td>
                            
                        </tr>
                        <tr>
                            <td><a>Mother</a></td>
                            <td><a>{{$student->mother_name."  :  ". $student->mother_phone}}</a></td>
                            
                        </tr>
                      
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                   </div>
               

               
                  <a class="btn btn-primary btn-sm" href="../"> <i class="fa fa-undo">  BACK    </i></a>
                  <a class="btn btn-primary btn-sm" href="../../schoolfees/{{$student->student_id}}/viewstatement"> <i class="fa fa-file-pdf">  GET FEE STATEMENT    </i></a>

                </div>

                <div class="col-4">
                    <div class="card">
                        Courses Taken by student
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                         <div class="table-responsive">
                            <table class="table m-0">
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                           
                            <tr>
                                <td><span class="badge badge-success">Course Name</span></td>
                                
                                <td><span class="badge badge-success">{{$student->course_name}}</span></td>
                            </tr>
                            
      
                         
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                      </div>
                    <!-- /.card -->
                    </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection