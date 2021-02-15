  <div class="modal fade bs-example-modal-lg" id="modal-addlocation" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD NEW ITEM</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="products/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                    

                    <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Barcode/Serial:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" id="barcode" name="barcode">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="product_name" class="col-sm-2 col-form-label">Item Name:</label>
                      <div class="col-sm-10">
                          <input type="text" autocomplete="off" class="form-control" id="product_name" name="product_name" required>
                      </div>
                  </div>

                  

                <div class="form-group row">
                  <label for="units_of_measure" class="col-sm-2 col-form-label">Measuring Unit:</label>
                  <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="units_of_measure" name="units_of_measure" placeholder="e.g KG, Packets, Liters">
                  </div>
              </div>

              <div class="form-group row">
                <label for="buying_price" class="col-sm-2 col-form-label">Purchase Price:</label>
                <div class="col-sm-10">
                    <input type="number" autocomplete="off" class="form-control" id="buying_price" name="buying_price">
                </div>
              </div>
  
                    <div class="form-group row">
                      <label for="reoder_level" class="col-sm-2 col-form-label">Reorder Level:</label>
                      <div class="col-sm-10">
                          <input type="number" autocomplete="off" class="form-control" id="reoder_level" name="reoder_level" >
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="quantity" name="quantity" >
                    </div>
                </div>
                  
                <div class="form-group row">
                  <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                      <select class="form-control select2" name="category_id" style="width: 100%;">
                          <option value=""></option>
                          @foreach ($categories as $category)
                            <option value="{{$category ->category_id}}">{{$category ->category_name}}</option>
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
                          <option value="{{$location ->store_id}}">{{$location ->store_name}}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
  
                  


                </div>

               
                <!-- /.card-body -->
                
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary">SAVE</button>
                  </div>
                
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade bs-example-modal-lg" id="modal-receive" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">RECEIVE GOODS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="products/receivestock" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                


                <div class="form-group row">
                    <label for="product_named" class="col-sm-2 col-form-label">Product Name:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="product_named" name="product_named" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                    <div class="col-sm-10">
                        <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="purchase_price" class="col-sm-2 col-form-label">Purchase Price:</label>
                    <div class="col-sm-10">
                        <input type="number" autocomplete="off" class="form-control" id="purchase_price" name="purchase_price" >
                    </div>
                </div>
                  
                   
                </div>

               
                <!-- /.card-body -->
                
                  <div class="text-center">
                  <input type="hidden" autocomplete="off" class="form-control" id="product_id" name="product_id" >
                    <button type="submit" class="btn btn-lg btn-primary">SAVE</button>
                  </div>
                
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade bs-example-modal-lg" id="modal-issue" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ISSUE ITEM</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="products/issueproduct" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                       
               

                <div class="form-group row">
                    <label for="product_named" class="col-sm-2 col-form-label">Product Name:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="product_named2" name="product_named2" disabled>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                    <div class="col-sm-10">
                        <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" required>
                    </div>
                </div>
               

                <div class="form-group row">
                    <label for="issued_to" class="col-sm-2 col-form-label">Issued to:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="issued_to" name="issued_to" required>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="product_id" class="col-sm-2 col-form-label">Issued For </label>
                  <div class="col-sm-10">
                      <select class="form-control select2" name="product_id" style="width: 100%;" required>
                          <option value=""> ------ Select Option -----</option>
                          @foreach ($reasons as $reason)
                            <option value="{{$reason ->reason_id}}">{{$reason ->description}}</option>
                          @endforeach
                          
                      </select>
                  </div>
              </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Narration:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="description" placeholder = "Optional Description" name="description" >
                    </div>
                </div>
                   </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary">SAVE</button>
                  </div>
                
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>