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
                            <h4 class="page-title m-0">EDIT ASSET DETAILS</h4>
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
                        <label for="barcode" class="col-sm-2 col-form-label">Barcode/Asset Tag:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$product->barcode}}" name="barcode">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="asset_name" class="col-sm-2 col-form-label">Asset Name:</label>
                      <div class="col-sm-10">
                          <input type="text" autocomplete="off" class="form-control" value="{{$product->asset_name}}" name="asset_name" required>
                      </div>
                  </div>


             
  
              
                  
        
            
                                  
                                <div class="form-group row">
                                  <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                  <div class="col-sm-10">
                                      <select class="form-control select2" name="category_id" style="width: 100%;">
                                          <option value=""></option>
                                          @foreach ($categories as $category)
                                          @if ($category ->category_id == $product->category_id)
                                          <option selected value="{{$category ->category_id}}">{{$category ->asset_category}}</option>
                                          @else
                                          <option value="{{$category ->category_id}}">{{$category ->asset_category}}</option> 
                                          @endif
                                           
                                          @endforeach
                                          
                                      </select>
                                  </div>
                              </div>
                
                              
                
                                </div>
                                <!-- /.card-body -->
                                <div class="text-center">
                                  
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