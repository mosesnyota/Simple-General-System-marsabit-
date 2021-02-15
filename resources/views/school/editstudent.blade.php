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
                        <div class="col-md-8">
                            <h4 class="page-title m-0">EDIT STUDENT RECORD</h4>
                        </div>
                        <div class="col-md-4">
                            
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
                <div class="card m-b-30">
                    <div class="card-body">

                     <!-- form start -->
              
                <div class="modal-body">
                @foreach ($student as $stdent)  
                <form role="form" method="post" action="update" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="box-body"> 
                               
                            
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Identifier: </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="student_no" name="student_no" value="{{$stdent ->student_no}}" >
                    </div>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="idno" name="idno" value="{{$stdent->idno}}">
                    </div>
                  </div> 

                 
                  
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="first_name" name="first_name" value="{{$stdent->first_name}}" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$stdent->middle_name}}" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="surname" name="surname" value="{{$stdent->surname}}" >
                    </div>
                  </div> 

                    
                  <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label">DOB</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" value="{{ date('m/d/Y', strtotime( $stdent ->dob)) }}" id="datepicker-startdate" name="dob">
                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                    </div><!-- input-group -->
                    </div>
                </div>
                    
                <div class="form-group row">
                  <label for="budget" class="col-sm-2 col-form-label"> Date Joined</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="text" class="form-control" autocomplete="off" id="datepicker-deadline" value="{{ date('m/d/Y', strtotime( $stdent ->date_joined)) }}" name="date_joined" >
                      <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                  </div><!-- input-group -->
                  </div>
                </div>

                <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Contact Details: </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="phone" name="phone" value="{{$stdent->phone}}" required>
                    </div>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="residence" name="residence" value="{{$stdent->residence}}">
                    </div>
                  </div> 


                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="course_id" style="width: 100%;"  required>
                                <option value="">----Select Course-----</option>
                                @foreach ($courses as $course)
                                 
                                  @if($stdent->course_id == $course -> course_id)
                                  <option selected value="{{$course -> course_id}}">{{$course -> course_name}}</option>
                                  @else
                                  <option value="{{$course -> course_id}}">{{$course -> course_name}}</option>
                                  @endif
                                 
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="gender" style="width: 100%;"  required>
                                <option value="">----Select Gender-----</option>
                                  
                                  @if($stdent->gender == 'Male')

                                  <option selected value="Male">Male</option>
                                  <option value="Female">Female</option>

                                    @else
                                    <option value="Male">Male</option>
                                    <option selected value="Female">Female</option>
                                  @endif
                                  
                                  
                            </select>
                        </div>
                    </div>
                    
                   
                    <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Parent/Next of Keen</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="parent_names" name="parent_names" value="{{$stdent->parent_names}}" >
                    </div>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="parents_phone" name="parents_phone" value="{{$stdent->parents_phone}}" >
                    </div>
                  </div> 
                 
                    
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="col text-center">
                                
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                          
                        </div>
                       
                    </form>    
                    @endforeach       
                </div>
                <!-- /.card-body -->
                
                
                <!-- /.card-footer -->
              
                       

                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->            

    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->



<!-- End Right content here -->
@endsection