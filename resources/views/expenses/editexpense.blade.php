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
                            <h4 class="page-title m-0">EDIT BILL </h4>
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
                                <label for="expense_date" class="col-sm-2 col-form-label">Bill Date</label>
                                <div class="col-sm-10">
                                  <div class="input-group">
                                  <input type="text" class="form-control" required autocomplete="off" id="datepicker-autoclose" name="expense_date" value="{{$expense->expense_date}}">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                </div><!-- input-group -->
                                </div>
                            </div>
    
                        <div class="form-group row">
                            <label for="expense_amount" class="col-sm-2 col-form-label">Bill Amount:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="number" name="expense_amount" autocomplete="off" id="expense_amount" class="form-control" value="{{$expense->expense_amount}}" required >
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Expense Category</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" autocomplete="off" name="category_id" style="width: 100%;"   required>
                                    <option value="">--SELECT EXPENSE CATEGORY--</option>
                                    @foreach ($categories as $category)
                                    @if ($category ->category_id == $expense->category_id)
                                     <option value="{{$category ->category_id}}" selected>{{$category ->categoryname}}</option>
                                    @else
                                     <option value="{{$category ->category_id}}">{{$category ->categoryname}}</option>
                                    @endif
                                     
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
    
                        
    
                        <div class="form-group row">
                            <label for="narration" class="col-sm-2 col-form-label">Narration</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="text" name="narration" autocomplete="off" id="narration" class="form-control" value="{{$expense->narration}}" required>
                                </div>
                            </div>
                        </div>
    
    
                        <div class="form-group row">
                            <label for="paidto" class="col-sm-2 col-form-label">Supplier</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="paidto" id="paidto" class="form-control" value="{{$expense->paidto}}">
                                </div>
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