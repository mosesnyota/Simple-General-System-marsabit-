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
                            <h4 class="page-title m-0">EDIT PRODUCT/ITEM</h4>
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
                            
                            <form role="form" method="post" action="products/{{$product->product_id}}/update" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box-body"> 
                                    
                                    <div class="form-group row">
                                        <label for="barcode" class="col-sm-2 col-form-label">Barcode/Serial:</label>
                                        <div class="col-sm-10">
                                            <input type="text" autocomplete="off" class="form-control" id="barcode" name="barcode" value={{$product->barcode}}>
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                      <label for="product_name" class="col-sm-2 col-form-label">Item Name:</label>
                                      <div class="col-sm-10">
                                          <input type="text" autocomplete="off" class="form-control" id="product_name" name="product_name" value={{$product->product_name}} required>
                                      </div>
                                  </div>
                
                                  
                
                                <div class="form-group row">
                                  <label for="units_of_measure" class="col-sm-2 col-form-label">Measuring Unit:</label>
                                  <div class="col-sm-10">
                                      <input type="text" autocomplete="off" class="form-control" id="units_of_measure" name="units_of_measure" value={{$product->units_of_measure}}>
                                  </div>
                              </div>
                
                              <div class="form-group row">
                                <label for="buying_price" class="col-sm-2 col-form-label">Purchase Price:</label>
                                <div class="col-sm-10">
                                    <input type="text" autocomplete="off" class="form-control" id="buying_price" name="buying_price" value={{$product->buying_price}}>
                                </div>
                              </div>
                  
                                    <div class="form-group row">
                                      <label for="reoder_level" class="col-sm-2 col-form-label">Reorder Level:</label>
                                      <div class="col-sm-10">
                                          <input type="text" autocomplete="off" class="form-control" id="reoder_level" name="reoder_level" value={{$product->reoder_level}} >
                                      </div>
                                  </div>
                
                                  <div class="form-group row">
                                    <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control" id="quantity" name="quantity"  value={{$product->quantity}}>
                                    </div>
                                </div>
                                  
                                <div class="form-group row">
                                  <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                  <div class="col-sm-10">
                                      <select class="form-control select2" name="category_id" style="width: 100%;">
                                          <option value=""></option>
                                          @foreach ($categories as $category)
                                          @if ($category ->category_id == $product->category_id)
                                          <option selected value="{{$category ->category_id}}">{{$category ->category_name}}</option>
                                          @else
                                          <option value="{{$category ->category_id}}">{{$category ->category_name}}</option> 
                                          @endif
                                           
                                          @endforeach
                                          
                                      </select>
                                  </div>
                              </div>
                
                              <div class="form-group row">
                                <label for="store_id" class="col-sm-2 col-form-label">Store/Location</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="store_id" style="width: 100%;">
                                        <option value=""></option>
                                        @foreach ($locations as $location)
                                        @if ($location ->store_id == $product ->store_id)
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