

  

<div class="modal fade bs-example-modal-lg" id="modal-recordExpense" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">RECORD AN EXPENSE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="expense/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                       
                        <div class="form-group row">
                            <label for="expense_date" class="col-sm-2 col-form-label"> Date</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" required autocomplete="off" id="datepicker-autoclose" name="expense_date" placeholder="Click here to select date">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>

                    <div class="form-group row">
                        <label for="expense_amount" class="col-sm-2 col-form-label"> Amount:</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                </div>
                                <input type="number" name="expense_amount" autocomplete="off" id="expense_amount" class="form-control" required >
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label"> Category</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="category_id" style="width: 100%;" required>
                                <option value="">--SELECT EXPENSE CATEGORY--</option>
                                @foreach ($categories as $category)
                                  <option value="{{$category ->category_id}}">{{$category ->expense_category}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label"> Department</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="department_id" style="width: 100%;" required>
                                <option value="">--SELECT DEPARTMENT --</option>
                                @foreach ($departments as $department)
                                  <option value="{{$department ->course_id}}">{{$department ->course_name}}</option>
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
                                <input type="text" name="narration" autocomplete="off" id="narration" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="paidto" class="col-sm-2 col-form-label"> Supplier </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="supplier_id" style="width: 100%;" required>
                                <option value="">--SELECT SUPPLIER--</option>
                                @foreach ($suppliers as $supply)
                                  <option value="{{$supply->supplier_id}}">{{$supply ->supplier_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="paidto" class="col-sm-2 col-form-label"> Status </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="cur_status" style="width: 100%;" required>
                                <option value="">--SELECT PAYMENT STATUS--</option>
                              
                                  <option value="Paid">Paid</option>
                                  <option value="Unpaid">Unpaid</option>
                                  <option value="Partial">Partially Paid</option>
                               
                                
                            </select>
                        </div>
                    </div>
                    

                    
                   
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
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




  

  

<div class="modal fade bs-example-modal-lg" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">EXPENSES REPORT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="expense/report1" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                        <div class="form-group">
                            <label>SELECT DATE RANGE</label>
                            <div>
                                <div class="input-daterange input-group" id="date-range">
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


  



  <div class="modal fade bs-example-modal-lg" id="modal-report2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">EXPENSES REPORT BY DEPARTMENTS </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="expense/report2" enctype="multipart/form-data" >
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

