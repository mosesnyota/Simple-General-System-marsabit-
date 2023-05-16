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
                                <div class="col-md-6">
                                    <h4 class="page-title m-0"><button type="button" class="btn btn-secondary btn-md  mr-1"
                                        > <b >  <h3><b> {{" Fee Invoices "}} </b></h3>
                                        </b></button> </h4>
                                </div>
                                <div class="col-md-6">
                                @can('VIEW_SCHOOL_FEES')
                            <button type="button"  class="btn btn-primary btn-md float-right mr-1 btn-rounded"  target="_blank"  data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Fee Invoices </b></button>
                            @endcan
                                 <a href="{{URL::to('/')}}/school" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back </b></a>
                                </div>

                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end page-title-box -->
                    </div>
                </div>

                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable"
                                    class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th width="10%" data-visible="false">#</th>
                                            <th width="10%">Admn</th>
                                            <th  style="width: 30%">Student Name</th>
                                            <th >Course</th>
                                            <th>Fee Balance</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($students as $student)

                                            @php
                                            $balance = $student->balance;


                                            @endphp
                                                <tr id="{{$student ->student_id}}">
                                                    <td>{{ $counter }}</td>
                                                    <td data-target="student_id" >{{ $student->student_id   }}</td>
                                                    <td data-target="student_no" >{{ $student->student_no   }}</td>
                                                    <td data-target="student_name">{{$student->first_name." ".$student->middle_name." ".$student->surname}}</td>
                                                    <td data-target="department" >{{ $student->department   }}</td> 
                                                    <td data-target="balance" > <?php if ( $balance  > 1000) { ?>
                                                        <span class="badge badge-warning"><b> {{number_format($balance ,2)}}</b></span>
                                                        <?php } else { ?>
                                                        <span class="badge badge-info">{{number_format($balance ,2)}}</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>

                                                    
                                                    <a class="btn btn-primary btn-sm" href="schoolfees/{{$student->student_id}}/viewstatement"><i class="fas fa-eye"> Statement</i></a>
                                                    <button type="button" class="btn btn-warning btn-sm"> <a  data-role="payfee"  data-id="{{$student->student_id}}"> <i class="fa fa-euro-sign" > Pay Fee </i></a>  </button>  
                                                                
                                                            
                                                    <?php $counter += 1; ?>
                                                </tr>
                                            @endforeach
                                      
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>


                

               

                



            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    
<div class="modal fade bs-example-modal-lg" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">PRINT FEE INVOICES</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="bulkreports" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label"> Term </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="term" style="width: 100%;" required>
                                <option value="">--SELECT TERM--</option>
                                <option value="Term 1">Term 1</option>
                                  <option value="Term 2">Term 2</option>
                                  <option value="Term 3">Term 3</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="paidto" class="col-sm-2 col-form-label"> Year </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="year" style="width: 100%;" required>
                                <option value="">--SELECT YEAR--</option>
                                  <option value="2022">2022</option>
                                  <option value="2023">2023</option>
                                  <option value="2024">2024</option>
                                  <option value="2025">2025</option>
                            </select>
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


@include('fee.modals')
    <!-- End Right content here -->
@endsection
