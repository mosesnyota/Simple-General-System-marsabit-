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
                            <h4 class="page-title m-0">EDIT PAYMENT TRANSACTION </h4>
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
                    <div class="form-group row">
                        <label for="student_name" class="col-sm-2 col-form-label">Student Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$payment->first_name.' '.$payment->middle_name.' '.$payment->surname}}" name="student_name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="student_name" class="col-sm-2 col-form-label">Student Admno:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$payment->student_no}}" name="student_no" disabled>
                        </div>
                    </div>
                     

                    <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label"> Date Paid: </label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" name="payment_date" value="{{ date('m/d/Y', strtotime( $payment ->payment_date)) }}" required>
                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                    </div><!-- input-group -->
                    </div>
                </div> 


                <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" value="{{$payment->amount}}" name="amount" required>
                        </div>
                    </div>

                <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Payment Method</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="payment_method" style="width: 100%;"  required>
                                
                               @if($payment->payment_method == 'Cash') 
                                <option selected value="Cash">Cash</option>
                                <option value="Mpesa">Mpesa</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                                <option value="Others">Others</option>

                               @elseif($payment->payment_method == 'Mpesa')
                               <option value="Cash">Cash</option>
                                <option selected  value="Mpesa">Mpesa</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                                <option value="Others">Others</option>

                               @elseif($payment->payment_method == 'Bank Deposit')
                               <option value="Cash">Cash</option>
                                <option value="Mpesa">Mpesa</option>
                                <option selected  value="Bank Deposit">Bank Deposit</option>
                                <option value="Others">Others</option>

                               @elseif($payment->payment_method == 'Others')
                               <option value="Cash">Cash</option>
                                <option value="Mpesa">Mpesa</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                                <option selected  value="Others">Others</option>
                                @endif
                                
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Reference:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$payment->reference}}" name="reference" required>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-primary">UPDATE RECORD</button>
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