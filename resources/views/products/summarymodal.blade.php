    
<div class="modal fade bs-example-modal-lg" id="modal-breakdown" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header modal-header-info">
              <h4 class="modal-title">INVENTORY SUMMARY BY REASONS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form role="form" method="post" action="report3" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                  <div class="box-body"> 
                      

                      <div class="form-group">
                          <label>SELECT DATE RANGE</label>
                          <div>
                              <div class="input-daterange input-group" id="date-range2">
                                  <input type="text" autocomplete="off" class="form-control" name="start" placeholder="Start Date" />
                                  <input type="text" autocomplete="off" class="form-control" name="end" placeholder="End Date" />
                              </div>
                          </div>
                      </div>

                  
                  

                 
                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">GET REPORT</button>
                  </div>
              </form>           
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>