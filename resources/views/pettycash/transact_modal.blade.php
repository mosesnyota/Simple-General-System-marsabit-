

 <div class="modal fade bs-example-modal-lg" id="modal-completetransaction" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">COMPLETE PETTY CASH TRANSACTION </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="pettycash/complete" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="narration1" class="col-sm-2 col-form-label">Issued To:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="issuedd" name="issuedd" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="customer1" class="col-sm-2 col-form-label">Amount Issued:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="amnt" name="amt" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="balance" class="col-sm-2 col-form-label">Amount Used:</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="amount" name="amount" required >
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <input type="hidden" id="transaction_id" name="transaction_id" >
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


