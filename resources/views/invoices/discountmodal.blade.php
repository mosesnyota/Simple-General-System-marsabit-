<div class="modal fade bs-example-modal-lg" id="modal-adddiscount" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">ADD DISCOUNT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="discount" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        
                    <div class="form-group row">
                        <label for="discount" class="col-sm-2 col-form-label"> Amount:</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                </div>
                                <input type="number" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                            </div>
                        </div>
                    </div>

                    

                      


                   
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="invoice_id" id="invoice_id" value='{{$invoice->invoice_id}}'>
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>