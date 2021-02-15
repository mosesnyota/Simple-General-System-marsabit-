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
                            <h4 class="page-title m-0">EDIT ASSET COPY DETAILS</h4>
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
                <form role="form" method="post" action="update" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="box-body"> 
                            
                            <form role="form" method="post" action="catalogue/{{$product->asset_id}}/update" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box-body"> 
                                    
                                    
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Asset Tag:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$product->serial_no}}" name="serial_no">
                        </div>
                    </div>

                   


                  

              <div class="form-group row">
                <label for="buying_price" class="col-sm-2 col-form-label">Purchase Price:</label>
                <div class="col-sm-10">
                    <input type="number" autocomplete="off" class="form-control" value="{{$product->price}}" name="price">
                </div>
              </div>
  
              <div class="form-group row">
                            <label for="manufacture_date" class="col-sm-2 col-form-label">Manufacture Date:</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" value="{{ date('m/d/Y', strtotime( $product ->manufacture_date)) }}"  id="datepicker-autoclose" name="manufacture_date" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>
                  
        
            
                                  
                               
                
                              <div class="form-group row">
                                <label for="location_id" class="col-sm-2 col-form-label">Store/Location</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="location_id" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach ($locations as $location)
                                        @if ($location ->store_id == $product ->location_id)
                                        <option selected value="{{$location ->store_id}}">{{$location ->store_name}}</option>
                                        @else
                                        <option value="{{$location ->store_id}}">{{$location ->store_name}}</option>
                                        @endif
                                          
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>       
                
                                </div>
                                <!-- /.card-body -->
                                <div class="text-center">
                                  <input type="hidden" name = 'asset_copy_id' value = "{{$product->asset_copy_id}}" >
                                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
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