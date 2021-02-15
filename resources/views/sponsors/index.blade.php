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
                                    <h4 class="page-title m-0">SPONSORS/FINANCIERS/PROJECTS PARTNERS</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Options
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                                <a class="dropdown-item" href="#">Export to Excel</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Print List</a>
                                            </div>
                                        </div>
                                    </div>
                                        <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addsponsor" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add New </b></button>
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
                    <div class="card">
                      
                      <!-- /.card-header -->
                      <div class="card-body">
                        
                          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                          <thead>
                          <tr>
                            <th width="10%">#</th>
                            <th>Name/Organization</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            <?php $counter = 1 ; ?>
                            @if(count($sponsors) > 0)
                            @foreach($sponsors as $sponsor)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$sponsor ->sponsornames}}</td>
                                        <td>{{$sponsor ->contactperson}}</td>
                                        <td>{{$sponsor ->email}}</td>
                                        <td>{{$sponsor ->phone}}</td>
                                        
                                        <td>
                                          <a class="btn btn-primary btn-sm" href="editsponsor/{{$sponsor->sponsor_id}}"><i class="fas fa-edit"></i></a>
                                          <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="editsponsor/destroy/{{$sponsor->sponsor_id}}"> <a  data-role="deletesponsor"  data-id="{{$sponsor->sponsor_id}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                           
                                          <a class="btn btn-primary btn-sm" href="viewsponsor/{{$sponsor->sponsor_id}}/view"><i class="fas fa-eye"></i></a>

                                        </td> 
                                         <?php $counter += 1 ; ?>
                                    </tr>
                                @endforeach 
                        @endif
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

    


    
  <div class="modal fade bs-example-modal-lg" id="modal-addsponsor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Project Sponsor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="sponsors/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                   

                  <div class="form-group row">
                      <label for="sponsornames" class="col-sm-2 col-form-label">Name/Organization:</label>
                      <div class="col-sm-10">
                          <input type="text" autocomplete="off" class="form-control" id="sponsornames" name="sponsornames" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="contactperson" class="col-sm-2 col-form-label">Contact Person:</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="contactperson" name="contactperson" required>
                    </div>
                </div>

                <div class="form-group row">
                      <label for="address" class="col-sm-2 col-form-label">Address:</label>
                      <div class="col-sm-10">
                          <input type="text" autocomplete="off" class="form-control" id="address" name="address" required>
                      </div>
                  </div>

                 

                   

                     <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  </div>
                                  <input type="text" name="email" id="email" class="form-control"
                                  autocomplete="off" required>
                          </div>
                      </div>
                  </div>
                    
                     
               

              <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" required>                        </div>
                </div>
            </div>

                   

                    <div class="form-group row">
                      <label for="startdate" class="col-sm-2 col-form-label">With Us From:</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" name="startdate">
                          <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                      </div><!-- input-group -->
                      </div>
                  </div>


                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

    <!-- End Right content here -->
@endsection


