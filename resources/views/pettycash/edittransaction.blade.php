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
                            <h4 class="page-title m-0">EDIT PETTY CASH TRANSACTION</h4>
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
                            
                            <form role="form" method="post" action="pettycash/store" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box-body"> 
                                    
                                    <div class="form-group row">
                                        <label for="transaction_date" class="col-sm-2 col-form-label">Date:</label>
                                        <div class="col-sm-10">
                                          <div class="input-group">
                                            <input type="text" class="form-control"  value="{{$transaction->transaction_date}}" placeholder="Click here to select date" autocomplete="off" id="datepicker-startdate" name="transaction_date">
                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                        </div><!-- input-group -->
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <label for="transactiontype" class="col-sm-2 col-form-label">Transaction Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="transactiontype" style="width: 100%;">
                                                @if($transaction->transactiontype =="Withdraw")
                                                    <option value="Withdraw" selected>Withdraw</option>
                                                    <option value="Deposit" >Deposit</option>
                                                @else
                                                <option value="Deposit" selected >Deposit</option>
                                                <option value="Withdraw"  >Withdraw</option>
                                                @endif
                                                  
                                            </select>
                                        </div>
                                    </div>
                
                                    @if ($transaction->transactiontype =="Withdraw")
                                    <div class="form-group row">
                                        <label for="issuedto" class="col-sm-2 col-form-label">Issued To:</label>
                                        <div class="col-sm-10">
                                            <input type="text" autocomplete="off" class="form-control" value="{{$transaction->issuedto}}" name="issuedto" required>
                                        </div>
                                    </div>
                                        
                                    @else
                                      <input type="hidden"  name="issuedto" value="-" >
                                    @endif
                                    
                  
                                    <div class="form-group row">
                                      <label for="amount" class="col-sm-2 col-form-label">Amount:</label>
                                      <div class="col-sm-10">
                                          <input type="number" autocomplete="off" class="form-control" name="amount"  value="{{$transaction->amount}}" required>
                                      </div>
                                  </div>
                  
                                  <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label">Narration: </label>
                                        <div class="col-sm-10">
                                            <input type="text" autocomplete="off" class="form-control"  value="{{$transaction->description}}"  name="description" required>
                                        </div>
                                 </div>
                
                
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer center">
                                  
                                    <button type="submit" class="btn btn-primary">Submit</button>
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