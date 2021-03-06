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
                                    <h4 class="page-title m-0">PUSH TRANSACTION TO PROJECT</h4>
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
          
                  <div class="col-3">
                    
                    <div class="card">

                       

                        <img src="{{asset('images/forward.png')}}" alt="LOGO"  width="100%" height="25%" class="centre">
                        <!-- /.card-header -->
                     <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                        <div class="table-responsive">
                            <table class="table m-0" >
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                               
                            <tr>
                                <td>Petty Cash to Project</td>
                                
                                <td><span class="badge badge-success"></span></td>
                            </tr>
                            
                           
                           
                           
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>

                    <!-- /.card -->
                  </div>

                  <div class="col-9">
                    
                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body">
                
                    
                    <form role="form" method="post" action="../../pushtransaction/{{$transaction->transactionid}}/push" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="box-body"> 
                            
                           
        
                            <div class="form-group row">
                                <label for="project_id" class="col-sm-2 col-form-label">Project</label>
                                <div class="col-sm-10">
                                    <select  class="form-control select2" name="project_id" style="width: 100%;"  required>
                                        <option value="">----Select Project-----</option>
                                        @foreach ($projects as $project)
                                          <option value="{{$project ->project_id}}">{{$project ->project_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>

                            

                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>           

                </div>
                </div>
                
            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

   


@endsection