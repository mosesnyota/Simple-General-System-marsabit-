  <div class="modal fade bs-example-modal-lg" id="modal-addasset" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD NEW ASSET</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="catalogue/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
 
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Barcode:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="barcode" name="barcode">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="asset_name" class="col-sm-2 col-form-label">Asset Name:</label>
                      <div class="col-sm-10">
                          <input type="text" autocomplete="off" class="form-control" id="asset_name" name="asset_name" required>
                      </div>
                  </div>


                  <div class="form-group row">
                  <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                      <select class="form-control select2" name="category_id" style="width: 100%;"  required>
                          <option value="">-------Select Asset Category--------</option>
                          @foreach ($categories as $category)
                            <option value="{{$category ->category_id}}">{{$category ->asset_category}}</option>
                          @endforeach
                          
                      </select>
                  </div>
              </div>
                  

              <div class="form-group row">
                <label for="buying_price" class="col-sm-2 col-form-label">Asset Price:</label>
                <div class="col-sm-10">
                    <input type="number" autocomplete="off" class="form-control" id="price" name="price"  required>
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



  <div class="modal fade bs-example-modal-lg" id="modal-addcopy" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">RECORD ASSET COPY</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="catalogue/storecopy" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
 
 
                <div class="form-group row">
                      <label for="asset_name" class="col-sm-2 col-form-label">Asset Name:</label>
                      <div class="col-sm-10">
                          <input type="text"  class="form-control" id="asset_name2" name="asset_name2" disabled>
                      </div>
                  </div>

 
                   <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Asset Tag:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="serial_no" name="serial_no" required>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="manufacture_date" class="col-sm-2 col-form-label">Purchase Date:</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" id="datepicker-autoclose" name="manufacture_date"  required >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                    </div>

                    <div class="form-group row">
                      <label for="location_id" class="col-sm-2 col-form-label">Location</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" name="location_id" style="width: 100%;"  required>
                              <option value="">----------Select Location of the Asset----------</option>
                              @foreach ($locations as $location)
                                <option value="{{$location ->store_id}}">{{$location ->store_name}}</option>
                              @endforeach
                              
                          </select>
                      </div>
                  </div>

            
                </div>
                <!-- /.card-body -->
                  <div class="text-center">
                  
                    <input type="hidden"  id="asset_id" name="asset_id" >
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
          
            <form role="form" method="post" action="catalogue/receivestock" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                    
                <div class="form-group row">
                <label for="product_id" class="col-sm-2 col-form-label">Asset</label>
                <div class="col-sm-10">
                    <select class="form-control select2" name="product_id" style="width: 100%;">
                        <option value=""></option>
                        @foreach ($assets as $asset)
                          <option value="{{$asset ->asset_id}}">{{$asset ->asset_name}}</option>
                        @endforeach
                        
                    </select>
                </div>
                </div>



                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                    <div class="col-sm-10">
                        <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" >
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



  <div class="modal fade bs-example-modal-lg" id="modal-issue" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ISSUE ASSET TO EMPLOYEE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="catalogue/issueasset" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                       
                <div class="form-group row">
                  <label for="product_id" class="col-sm-2 col-form-label">Asset </label>
                  <div class="col-sm-10">
                      <select class="form-control select2" name="asset_id" style="width: 100%;" required>
                          <option value=""> ------ SELECT ASSET -----</option>
                          @foreach ($assetscopies as $assetscopy)
                          <option value="{{$assetscopy ->asset_copy_id}}">{{$assetscopy ->serial_no." ".$assetscopy ->asset_name}}</option>
                        @endforeach
                      </select>
                  </div>
              </div>

                <div class="form-group row">
                  <label for="product_id" class="col-sm-2 col-form-label">Issued to: </label>
                  <div class="col-sm-10">
                      <select class="form-control select2" name="issued_to" style="width: 100%;" required>
                          <option value=""> ------ SELECT EMPLOYEE -----</option>
                          @foreach ($employees as $employee)
                          <option value="{{$employee ->staffid}}">{{$employee ->firstname." ".$employee ->othernames}}</option>
                        @endforeach
                      </select>
                  </div>
              </div>

               
              <div class="form-group row">
                            <label for="manufacture_date" class="col-sm-2 col-form-label">Date Issued:</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" name="issue_date" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>


                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Comment:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="description" name="description" required>
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