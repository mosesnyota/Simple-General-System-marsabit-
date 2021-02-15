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
                            <h4 class="page-title m-0">EDIT FUNDING TRANSACTION</h4>
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
                                <label for="funding_date" class="col-sm-2 col-form-label">Date Received</label>
                                <div class="col-sm-10">
                                <div class="input-group">
                                  <input type="text" class="form-control" autocomplete="off" id="datepicker-autoclose" name="funding_date" value="{{$funding->funding_date}}">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                </div><!-- input-group -->
                                </div>
                            </div>
    
                        <div class="form-group row">
                            <label for="original_amount" class="col-sm-2 col-form-label">Amount:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="number" name="original_amount" id="original_amount" class="form-control" value="{{$funding->original_amount}}">
                                </div>
                            </div>
                        </div>
    
                        
    
                          <div class="form-group row">
                            <label for="currency" class="col-sm-2 col-form-label">Currency</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="currency" style="width: 100%;">
                                      <option value="{{$funding->currency}}">{{$funding->currency}}</option>
                                      <option value="USD">USD</option>
                                      <option value="Euro">Euro</option>
                                      <option value="KSH">KSH</option>
                                      <option value="TSH">TSH</option>
                                      <option value="$">$</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="exchangerate" class="col-sm-2 col-form-label">Exchange Rate</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="number" name="exchangerate" id="exchangerate" class="form-control" value="{{$funding->exchangerate}}">
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="sponsor_id" class="col-sm-2 col-form-label">Financier/Source</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="sponsor_id" style="width: 100%;">
                                  
                                    @foreach ($sponsors as $sponsor)
                                      @if ($sponsor->sponsor_id == $funding->sponsor_id)
                                         <option value="{{$sponsor ->sponsor_id}}" selected>{{$sponsor ->sponsornames}}</option>
                                      @else
                                         <option value="{{$sponsor ->sponsor_id}}" >{{$sponsor ->sponsornames}}</option>
                                      @endif
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
    
                       
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="col text-center">
                                
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                          
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