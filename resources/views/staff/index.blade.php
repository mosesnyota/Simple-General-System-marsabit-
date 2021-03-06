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
                                    <h4 class="page-title m-0">STAFF</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Options
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                               
                                            </div>
                                        </div>
                                    </div>
                                        <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal_newstaff" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Staff </b></button>
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



                                
                                <table id="mytable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $counter = 1; ?>
                                        @if (count($staffs) > 0)
                                            @foreach ($staffs as $staff)
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>{{ $staff->firstname.' '.$staff->othernames }}</td>
                                                    <td>{{ $staff->name }}</td>
                                                    <td>{{ $staff->phone }}</td>
                                                    <td>{{ $staff->email }}</td>

                                                    <td>
                                                      <a class="btn btn-primary btn-sm" href="editstaff/{{$staff->staffid}}"><i class="fas fa-edit"></i></a>
                                                      <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="staff/destroy/{{$staff->staffid}}"> <a  data-role="deletestaff"  data-id="{{$staff->staffid}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                                      <a class="btn btn-primary btn-sm" href="staff/{{$staff->staffid}}/view"><i class="fas fa-eye"></i></a>
                                                 

                                                    </td> 



                                                    <?php $counter += 1; ?>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    @include('staff.staffmodals')

    <!-- End Right content here -->
@endsection


