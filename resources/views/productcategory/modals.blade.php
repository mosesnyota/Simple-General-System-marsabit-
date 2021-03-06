  <div class="modal fade bs-example-modal-lg" id="modal-addlocation" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD PRODUCT CATEGORY</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="productcategory/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="category_name" class="col-sm-2 col-form-label">Category Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="category_name" name="category_name" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>