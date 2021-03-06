@extends('layouts.design')
@section('content')
<!-- Start content -->
<div class="content">



<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">Edit Staff</h4>
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

                    <form role="form" method="post" action="update/{{$staff->staffid}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
            
        
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                <input type="text" autocomplete="off" class="form-control" id="firstname" name="firstname" value = "{{$staff->firstname}}" required>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="othernames" class="col-sm-2 col-form-label">Other Name</label>
                                <div class="col-sm-10">
                                    <input type="text" autocomplete="off" class="form-control" id="othernames" name="othernames" value = "{{$staff->othernames}}"  required>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label for="staffcategory_id" class="col-sm-2 col-form-label">Staff Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="staffcategory_id" style="width: 100%;"  required>
                                        <option value=""></option>
                                        @foreach ($roles as $role)
                                           @if( $staff->staffcategory_id ==  $role->id)
                                           <option value="{{$role->id}}" selected>{{$role ->name}}</option>
                                           @else
                                           <option value="{{$role->id}}">{{$role ->name}}</option>
                                        
                                           @endif
                                         
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
        
        
                            
        
        
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" value = "{{$staff->phone}}" required>
                                      
                                    </div>
                                </div>
                            </div>
        
        
                           
        
        
        
        
        
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="text" name="email" id="email" class="form-control"
                                            autocomplete="off"  value = "{{$staff->email}}" required>
                                      
                                    </div>
                                </div>
                            </div>
                            
        
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <a class="btn btn-primary btn-lg" href="../staff"> <i class="fas fa-return">  BACK    </i></a>
                            <button type="submit" class="btn btn-primary btn-lg">Save</button>
                        </div>
                    </form>
              
                       

                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->            

    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->



<!-- End Right content here -->
@endsection