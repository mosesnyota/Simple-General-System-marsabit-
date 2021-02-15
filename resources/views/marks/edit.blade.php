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
                            <h4 class="page-title m-0">EDIT MARKS</h4>
                        </div>
                        <div class="col-md-4">
                        <a href="{{URL::to('/')}}/academics" class="btn btn-primary float-right btn-md"   role="button"><b class="fa fa-undo"> BACK </b></a>  
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
                <form role="form" method="post" action="update" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="box-body"> 
                            
                            <form role="form" method="post" action="marks/{{$marks->marks_id}}/update" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box-body"> 
                                    

                                  <div class="form-group row">
                                      <label for="subject" class="col-sm-2 col-form-label">Student Name:</label>
                                      <div class="col-sm-10">
                                          <input type="text" autocomplete="off" class="form-control" name="student"  value="{{$marks->studentsname}}" disabled>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="subject_id" class="col-sm-2 col-form-label">Subject</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="subject_id" style="width: 100%;" required>
                                            
                                            @foreach($subjects as $subject)

                                            @if($marks->subject_id == $subject->subject_id)
                                              <option selected value="{{$subject ->subject_id}}">{{$subject ->subject_name}}</option>
                                            @else
                                            <option value="{{$subject ->subject_id}}">{{$subject ->subject_name}}</option>
                                            @endif
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                 </div>

                                 




                                  <div class="form-group row">
                                      <label for="marks" class="col-sm-2 col-form-label">Marks:</label>
                                      <div class="col-sm-10">
                                          <input type="number" autocomplete="off" class="form-control" name="marks"  value="{{$marks->marks}}" required>
                                      </div>
                                  </div>


                  
                                 
                
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer center">
                                  
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form> 
                            
    
                        
                       
                        </div>
                        
                       
                       
                    </form>           
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