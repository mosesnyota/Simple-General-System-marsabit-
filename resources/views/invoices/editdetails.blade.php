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
                            <h4 class="page-title m-0">Edit Invoice Item</h4>
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
                        <form class="form-horizontal" method="post" action="saveediteditem" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                          <div class="card-body">
                            <div class="form-group row">
                              <label for="project_name" class="col-sm-2 col-form-label">Item Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description" value="{{$details ->description}}">
                              </div>
                            </div> 

                            @can('CAN_EDIT__INVOICE_AMOUNT')
                            <div class="form-group row">
                              <label for="location" class="col-sm-2 col-form-label">Unit Price</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="unit_cost" name="unit_cost" value="{{$details ->unit_cost}}">
                              </div>
                            </div>
                           
                          
                          <div class="form-group row">
                              <label for="budget" class="col-sm-2 col-form-label">Quantity</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="quantity" name="quantity" value="{{$details ->quantity}}">
                              </div>
                          </div>
                          @endcan
                              
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <div class="col text-center">
                              <input type="hidden" class="form-control" id="detail_id" name="detail_id" value="{{$details ->detail_id}}">
                                  <button type="submit" class="btn btn-secondary">Save Update</button>
                              </div>
                            
                          </div>
                          
                          <!-- /.card-footer -->
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