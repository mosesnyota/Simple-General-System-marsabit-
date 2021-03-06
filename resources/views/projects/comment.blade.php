@extends('layouts.design')
@section('content')
<!-- Start content -->
<div class="content">



<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">EDIT PROJECT COMMENT</h4>
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
                        <form class="form-horizontal" method="post" action="../{{$project->project_id}}/save" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                          <div class="card-body">
                            <div class="form-group row">
                              <label for="project_name" class="col-sm-2 col-form-label">Project Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="project_name" name="project_name" value="{{$project ->project_name}}" disabled>
                              </div>
                            </div> 
                            
                              
                            <div class="form-group row">
                                <label for="details" class="col-sm-2 col-form-label">Project</label>
                                <div class="col-sm-10">
                                    
                                    <textarea rows="5" cols="80" id="summary-ckeditor" name="details"><?php echo $project->details; ?></textarea>
                                </div>
                              </div> 
                            
                              
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <div class="col text-center">
                                  <button type="submit" class="btn btn-secondary">Save Project</button>
                              </div>
                            
                          </div>
                          
                          <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->            

    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->

<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>

<!-- End Right content here -->
@endsection