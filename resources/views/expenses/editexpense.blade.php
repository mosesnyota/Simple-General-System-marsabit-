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
                            <h4 class="page-title m-0">EDIT EXPENSE </h4>
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
                                <label for="expense_date" class="col-sm-2 col-form-label">Expense Date</label>
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
                                   
                                    @foreach ($categories as $category)
                                    @if ($category ->category_id == $expense->category_id)
                                     <option value="{{$category ->category_id}}" selected>{{$category ->expense_category}}</option>
                                    @else
                                     <option value="{{$category ->category_id}}">{{$category ->expense_category}}</option>
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
                        <label for="category_id" class="col-sm-2 col-form-label"> Department</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="department_id" style="width: 100%;" required>
                                
                                @foreach ($departments as $department)

                                    @if ($department ->course_id == $expense->department_id)
                                        <option selected value="{{$department ->course_id}}">{{$department ->course_name}}</option>
                                    @else
                                    <option value="{{$department ->course_id}}">{{$department ->course_name}}</option>
                                    @endif

                                 
                                @endforeach


                                
                            </select>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="paidto" class="col-sm-2 col-form-label"> Supplier </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="supplier_id" style="width: 100%;" required>
                               
                                @foreach ($suppliers as $supply)

                                   @if ($supply ->supplier_id == $expense->supplier_id)
                                        <option selected value="{{$supply->supplier_id}}">{{$supply ->supplier_name}}</option>
                                    @else
                                        <option value="{{$supply->supplier_id}}">{{$supply ->supplier_name}}</option>
                                    @endif
                                  
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                       
                    <div class="form-group row">
                        <label for="paidto" class="col-sm-2 col-form-label"> Status </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="cur_status" style="width: 100%;" required>
                               
                               
                                  @if ($expense->cur_status == 'Paid')
                                        <option selected value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Partial">Partially Paid</option>
                                  @elseif($expense->cur_status == 'Unpaid')
                                        <option  value="Paid">Paid</option>
                                        <option selected value="Unpaid">Unpaid</option>
                                        <option value="Partial">Partially Paid</option>
                                  @elseif($expense->cur_status == 'Partial')
                                        <option  value="Paid">Paid</option>
                                        <option  value="Unpaid">Unpaid</option>
                                        <option selected value="Partial">Partially Paid</option>
                                  
                                @endif
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