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
                                    <h4 class="page-title m-0">CREATE STUDENT RECORD</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                    
                                  
                                    <a href="{{URL::to('/')}}/students" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back to All Students </b></a>
                                  
                                    
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
                   

                 <form class="form-horizontal" method="post" action="store" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                <div class="card-body">

            
               
                
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Admn No: </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="student_no" name="student_no" placeholder="Admission No." required>
                    </div>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="idno" name="idno" placeholder="National ID ">
                    </div>
                  </div> 

                 
                  
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="idno" name="surname" placeholder="surname" >
                    </div>
                  </div> 

                    

                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Dates: </label>
                    <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" placeholder="D. O. B" name="dob">
                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                    </div><!-- input-group -->
                    </div>

                    <div class="col-sm-5">
                    <div class="input-group">
                      <input type="text" class="form-control" autocomplete="off" id="datepicker-deadline"  placeholder="Date Joined this school" name="date_joined" >
                      <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                  </div><!-- input-group -->
                    </div>
                  </div> 



                  

                <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Contact Details: </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone No" required>
                    </div>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="residence" name="residence" placeholder="Home Area or Place of birth">
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Postal Address: </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Address" required>
                    </div>

                   
                  </div>




                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Course: </label>
                    <div class="col-sm-5">
                    <select class="form-control select2" name="course_id" style="width: 100%;"  required>
                                <option value="">----Select Course-----</option>
                                @foreach ($courses as $course)
                                  <option value="{{$course -> course_id}}">{{$course -> course_name}}</option>
                                @endforeach
                                
                            </select>
                    </div>

                    <div class="col-sm-5">
                    <select class="form-control select2" name="cur_year" style="width: 100%;"  required>
                                <option value="">----Select Year of Study-----</option>
                             
                                <option value="1">Year 1</option>
                                <option value="2">Year 2</option>
                                
                                
                            </select>
                    </div>
                  </div> 



                   

                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="gender" style="width: 100%;"  required>
                                <option value="">----Select Gender-----</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-sm-5">
                            <select class="form-control select2" name="denomination" style="width: 100%;"  required>
                                <option value="">----Select Denomination-----</option>
                                  <option value="Christian">Christian</option>
                                  <option value="Muslim">Muslim</option>
                            </select>
                        </div>

                    </div>
                    
                   
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Father's Details</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father Name" >
                    </div>

                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="father_phone" name="father_phone" placeholder="Father Phone" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="father_occupation" name="father_occupation" placeholder="father_occupation" >
                    </div>
                    <div class="col-sm-2">
                    <select class="form-control select2" name="father_status" style="width: 100%;"  required>
                                <option value="">--Status-----</option>
                                  <option value="Alive">Alive</option>
                                  <option value="Dead">Dead</option>
                                  <option value="N/A">N/A</option>
                            </select>
                    </div>
                  </div> 


                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Mother's Details</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="mother Name" >
                    </div>

                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="mother_phone" name="mother_phone" placeholder="mother Phone" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="mother_occupation" name="mother_occupation" placeholder="mother_occupation" >
                    </div>
                    <div class="col-sm-2">
                    <select class="form-control select2" name="mother_status" style="width: 100%;"  required>
                                <option value="">--Status-----</option>
                                  <option value="Alive">Alive</option>
                                  <option value="Dead">Dead</option>
                                  <option value="N/A">N/A</option>
                            </select>
                    </div>
                  </div> 


                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Guardian/Sponsor: </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="guardian_name" name="guardian_name" placeholder="Guardian Name" required>
                    </div>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="guardian_phone" name="guardian_phone" placeholder="Guardian Phone">
                    </div>
                  </div> 

                  
                
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Postal Address: </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Address" required>
                    </div>
                  </div>





                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Student Status: </label>
                    <div class="col-sm-10">
                    <select class="form-control select2" name="cur_status" style="width: 100%;"  required>
                                  <option value="">----Current Status-----</option>
                                  <option value="Active">Active</option>
                                  <option value="Dropout">Dropout</option>
                                  <option value="Completed">Completed</option>
                                  <option value="Suspended">Suspended</option>
                            </select>
                    </div>
                    </div>



                    <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Comment: </label>
                    <div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Comment"></textarea>
                    </div>
                  </div>



               


                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-secondary">Save Student Details</button>
                    </div>
                 </div>
                <!-- /.card-footer -->
              </form>


                </div>
                </div>
                
            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection