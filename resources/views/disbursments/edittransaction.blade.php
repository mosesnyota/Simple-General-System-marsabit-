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
                            <h4 class="page-title m-0">Edit Transaction</h4>
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
              <form class="form-horizontal" method="post" action="saveediteddisbursement/{{$disburs ->disbursment_id}}" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                <div class="card-body">


                    <div class="form-group row">
                        <label for="voucherno" class="col-sm-2 col-form-label">Voucher No.</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="voucherno" name="voucherno" value="{{$disburs->voucherno}}">
                        </div>
                    </div>

                  <div class="form-group row">
                    <label for="narration" class="col-sm-2 col-form-label">Narration</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="narration" name="narration" value="{{$disburs->narration}}">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="debit" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="debit" name="debit" value="{{$disburs->debit}}">
                    </div>
                  </div>

                  
                  <div class="form-group row">
                    <label for="voucherno" class="col-sm-2 col-form-label">Paid To</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="paid_to" name="paid_to" value="{{$disburs->paid_to}}">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="voucherno" class="col-sm-2 col-form-label">Cheque No/Ref</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="chequeno" name="chequeno" value="{{$disburs->chequeno}}">
                    </div>
                  </div>
                 
                  
                
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-secondary">Save Transaction</button>
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