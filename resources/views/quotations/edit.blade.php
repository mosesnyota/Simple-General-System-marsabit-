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
                                <div class="col-md-6">
                                    <h4 class="page-title m-0">EDIT QUOTATION</h4>
                                </div>
                                <div class="col-md-6">
                                  
                                    
                                  
                                    <a href="{{URL::to('/')}}/quotations" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back to Quotations </b></a>
                                  
                                    
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
                   

                 <form class="form-horizontal" method="post" action="update" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Narration</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="narration" name="narration" value="{{$quotation->narration}}" required>
                    </div>
                  </div> 
                  
                    
                  <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label">Quotation Date</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" value="{{$quotation->invoice_date}}" name="invoice_date">
                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                    </div><!-- input-group -->
                    </div>
                </div>
                    
                
                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Customer</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="customer_id" style="width: 100%;"  required>
                               
                                @foreach ($customers as $customer)
                                @if($customer ->customer_id == $quotation->customer_id)
                                  <option selected value="{{$customer -> customer_id}}">{{$customer -> customer_names}}</option>
                               @else
                               <option value="{{$customer -> customer_id}}">{{$customer -> customer_names}}</option>
                               @endif
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    
                   

                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="course_id" style="width: 100%;"  required>
                                <option value="">----Select Department-----</option>
                                @foreach ($departments as $department)
                                @if($department->department_id == $quotation->course_id)
                                  <option selected value="{{$department -> course_id}}">{{$department -> course_name}}</option>
                               @else
                               <option selected value="{{$department -> course_id}}">{{$department -> course_name}}</option>
                              
                               @endif
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                  
               
               
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">Save Changes ></button>
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