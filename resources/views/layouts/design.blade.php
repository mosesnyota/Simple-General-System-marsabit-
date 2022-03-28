<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Don Technical Institute Marsabit</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        <!-- morris css -->
        <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <!-- DataTables -->
        <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('modalheader.css')}}" rel="stylesheet" type="text/css">
        
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script src="{{asset('sweetaleart/sweetalert.min.js')}}"></script>
        <link href="{{asset('sweetaleart/sweetalert.min.css')}}" rel="stylesheet" type="text/css">
         <!-- Plugins css -->
         <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
         <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
         <link href="{{asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    
    <style>
        .form-group.required .control-label:after {
          content:"*";
          color:red;
        }


        /* Formatting search box */
    .search-box{
        width: 100%;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }

    

    </style>
    

    <script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
      alert("Key Up");
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
    


<script language="javascript">
function checkInput(inputs){
 
  if (inputs > 100) {
   alert("INPUT ERROR!\nThe Value Given "+inputs+" is Bigger Than 100");
  // swal.fire('Marks cannot be greater than 100');
   
   inputs.value="";
   return false;
   
  }
}

function getValues() {  
        
        var admisions = new Array();//get admision numbers as an array
        var marks = new Array();// get marks as an array
        
        marks = document.getElementsByName('subject');
        admisions = document.getElementsByName('adms');
           
           //alert("total fields = " + marks.length+"  and adms= "+admisions.length);
        
         var toSave= new Array(admisions.length);// create a new array for storing saved combined array
         var tomarks= new Array(admisions.length);
           
        for(var a = 0; a < admisions.length; a++){
           var objs = document.getElementsByName('adms').item(a);
           var obj = document.getElementsByName('subject').item(a);
           if(obj.value==null || obj.value==""){
           obj.value=0;
           }
            toSave[a]=objs.value;
            tomarks[a]=obj.value;
            document.demo.subs.value = toSave.toString();
            document.demo.ads.value = tomarks.toString();
          // alert(toSave[a]);
        }
        
        
        }
    

</script>

 
    
    </head>


    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

        <!-- Begin page -->
        <div id="wrapper" class="toggled" class="button-menu-mobile open-left waves-effect">

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.leftmenu')
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

    <div class="content-page">

    <div class="content">
                    <!-- Top Bar Start -->
        <div class="topbar">

        <div class="topbar-left	d-none d-lg-block">
                            <div class="text-center">
                               
                            </div>
                        </div>

            <nav class="navbar-custom">

                 <!-- Search input -->
                 <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input" type="search" placeholder="Search" />
                        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                            <i class="mdi mdi-close-circle"></i>
                        </a>
                    </div>
                  </div>

                   <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                            <i class="mdi mdi-magnify noti-icon"></i>
                        </a>
                    </li>
                    <li class="list-inline-item dropdown notification-list nav-user">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/users/avatar-6.jpg')}}" alt="user" class="rounded-circle">
                            <span class="d-none d-md-inline-block ml-1"> {{Auth::user()->name}}<i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                            <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i>Profile</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted"></i>Change Password</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i>Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted"></i> Logout</a>

                        </div>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                </form>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    @can('VIEW_SCHOOL')
                      <a href="{{URL::to('/')}}/school" class="btn btn-info btn-md"   role="button"><b class="fas fa-school"> SCHOOL </b></a>
                      @endcan
                      @can('VIEW_PRODUCTION')
                      <a href="{{URL::to('/')}}/production" class="btn btn-warning btn-md"   role="button"><b class="fas fa-industry"> PRODUCTION </b></a>
                      @endcan
                      @can('VIEW PETTY CASH')
                      <a href="{{URL::to('/')}}/pettycash" class="btn btn-secondary btn-md"   role="button"><b class="fas fa-piggy-bank"> CASH </b></a>
                      @endcan
                      @can('VIEW_EXPENSES')
                      <a href="{{URL::to('/')}}/expense" class="btn btn-success btn-md"   role="button"><b class="fas fa-money-bill-alt"> EXPENSES </b></a>
                      @endcan
                      @can('VIEW_ASSETS')
                      <a href="{{URL::to('/')}}/catalogue" class="btn btn-primary btn-md"   role="button"><b class="fa fa-bank"> ASSETS INVENTORY </b></a>
                      @endcan
                </ul>
            </nav>
        </div>
        @yield('content')
        <!-- Top Bar End -->
    </div> <!-- content -->
    <footer class="footer">
         © <?php echo date('Y') ?> Don Bosco Technical School <span class="d-none d-md-inline-block"> </i></span>
    </footer>
</div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/detect.js')}}"></script>
        <script src="{{asset('assets/js/fastclick.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{asset('plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>

        <!-- dashboard js -->
        <script src="{{asset('assets/pages/dashboard.int.js')}}"></script>        

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>


        
    

        <!-- Required datatable js -->
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/pdfmake.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/vfs_fonts.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
        <!-- Responsive examples -->
        <script src="{{asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{asset('datatables.init.js')}}"></script>        

       
        <!-- Plugins js -->
        <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>   
        
        <!-- Plugins Init js -->
        <script src="{{asset('assets/pages/form-advanced.js')}}"></script>
        

<!-- Dropzone js -->
<script src="{{asset('plugins/dropzone/dist/dropzone.js')}}"></script>


<!-- page script -->
<script>




$( document ).ready(function() {
  $("div.dataTables_filter input").focus();
});


  

$( document ).ready(function() {
    $("#wrapper").toggleClass("toggle");
});


  $(function () {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $('.sparkline').each(function () {
      var $this = $(this)
      $this.sparkline('html', $this.data())
    })

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines()
    drawMouseSpeedDemo()

  })

  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {
      type    : 'bar',
      barColor: '#aaf'
    })
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
      {
        composite: true,
        fillColor: false,
        lineColor: 'red'
      })


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline()

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
      {
        type  : 'line',
        height: '2.5em',
        width : '4em'
      })

    // Customized line chart
    $('#linecustom').sparkline('html',
      {
        height      : '1.5em',
        width       : '8em',
        lineColor   : '#f00',
        fillColor   : '#ffa',
        minSpotColor: false,
        maxSpotColor: false,
        spotColor   : '#77f',
        spotRadius  : 3
      })

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', { type: 'bar' })

  

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', { type: 'tristate' })
    $('.sparktristatecols').sparkline('html',
      {
        type    : 'tristate',
        colorMap: {
          '-2': '#fa7',
          '2' : '#44f'
        }
      })

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {
      fillColor     : false,
      changeRangeMin: 0,
      chartRangeMax : 10
    })
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
      {
        composite     : true,
        fillColor     : false,
        lineColor     : 'red',
        changeRangeMin: 0,
        chartRangeMax : 10
      })

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
      {
        fillColor     : false,
        normalRangeMin: -1,
        normalRangeMax: 8
      })
    $('#normalExample').sparkline('html',
      {
        fillColor       : false,
        normalRangeMin  : 80,
        normalRangeMax  : 95,
        normalRangeColor: '#4f4'
      })

    // Discrete charts
    $('.discrete1').sparkline('html',
      {
        type     : 'discrete',
        lineColor: 'blue',
        xwidth   : 18
      })
    $('#discrete2').sparkline('html',
      {
        type          : 'discrete',
        lineColor     : 'blue',
        thresholdColor: 'red',
        thresholdValue: 4
      })

    // Bullet charts
    $('.sparkbullet').sparkline('html', { type: 'bullet' })

    // Pie charts
    $('.sparkpie').sparkline('html', {
      type  : 'pie',
      height: '1.0em'
    })

    // Box plots
    $('.sparkboxplot').sparkline('html', { type: 'box' })
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
      {
        type        : 'box',
        raw         : true,
        showOutliers: true,
        target      : 6
      })

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type                     : 'box',
      tooltipFormatFieldlist   : ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    })

    // click event demo sparkline
    $('.clickdemo').sparkline()
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
      value         = region.y
      alert('Clicked on x=' + region.x + ' y=' + region.y)
    })

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline()
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
      value         = region.y
      $('.mouseoverregion').text('x=' + region.x + ' y=' + region.y)
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('')
    })
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500 // update display every 500ms
    var lastmousex       = -1
    var lastmousey       = -1
    var lastmousetime
    var mousetravel      = 0
    var mpoints          = []
    var mpoints_max      = 30
    $('html').mousemove(function (e) {
      var mousex = e.pageX
      var mousey = e.pageY
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey))
      }
      lastmousex = mousex
      lastmousey = mousey
    })
    var mdraw = function () {
      var md      = new Date()
      var timenow = md.getTime()
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000)
        mpoints.push(pps)
        if (mpoints.length > mpoints_max) {
          mpoints.splice(0, 1)
        }
        mousetravel = 0
        $('#mousespeed').sparkline(mpoints, {
          width        : mpoints.length * 2,
          tooltipSuffix: ' pixels per second'
        })
      }
      lastmousetime = timenow
      setTimeout(mdraw, mrefreshinterval)
    }
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>



<!-- Page script -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date range picker
    $('#projectstartdate').datetimepicker({
        format: 'L'
    });

    $('#activityenddate').datetimepicker({
        format: 'L'
    });

    

    //Date range picker
    $('#projectenddate').datetimepicker({
        format: 'L'
    });
    

    $('#datetimepicker4').datetimepicker({
        format: 'L'
    });
    
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

<script>
  $(function () {
      var tbl = $("#stafftable");
      $("#stafftable").DataTable({
          "responsive": true,
          "autoWidth": false,
          "bInfo" : false,
          
      });
      $('#example3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
      });
  });

  $('#datatable-buttons2').dataTable( {
  "createdRow": function( row, data, dataIndex ) {
    if ( data[3] == "Received Stock" ) {
      $(row).addClass( 'danger' );
    }
  }
} );

</script>

<script>

$(function () {
      var tbl = $("#datatablewwww2");
      $("#datatablewwww2").DataTable({
          "responsive": true,
          "autoWidth": false,
          "bInfo" : false,
          
      });
  });


  

$(document).ready(function() {

  var tbl = $('#mytable');

  
 

var settings={dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]};


settings.buttons = [
    {  
        extend:'pdfHtml5',
        text:'PDF',
        orientation:'portrait',
        customize : function(doc){
            var colCount = new Array();
            $(tbl).find('tbody tr:first-child td').each(function(){
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
            doc.content[1].table.widths = colCount;
           
        }
    },'excel', 'print'
];

$('#mytable').dataTable(settings);


  } );
</script>







<script>
  $(function () {
      var tbl = $("#nobuttonstable");
      $("#nobuttonstable").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "bInfo" : true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "responsive": true,
      });
      $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
      });
  });
</script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'details' );
</script> 




<script>
  $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var activityname  = $('#'+id).children('td[data-target=activityname]').text();
            $('#userd').val(activityname);
            $('#userId').val(id);
            $('#modal-markactivity').modal('toggle');
      });
    });
</script>


<script>
  $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=updatedispersementvotehead]',function(){
            var id  = $(this).data('id');
            var activityname  = $('#'+id).children('td[data-target=narrationname]').text();
            $('#narration22').val(activityname);
            $('#disbursmentid').val(id);
            $('#modal-assignvotehead').modal('toggle');
      });
    });
</script>


<script>
  $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=payfee]',function(){
            var id  = $(this).data('id');
            var student_name  = $('#'+id).children('td[data-target=student_name]').text();
            var balance  = $('#'+id).children('td[data-target=balance]').text();
            $('#balance').val(balance.trim());
            $('#student_name').val(student_name);
            $('#student_id').val(id);
            $('#modal-payfee').modal('toggle');
      });
    });


    $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=payinvoice]',function(){
            var id  = $(this).data('id');

            var customer  = $('#'+id).children('td[data-target=customer_names2]').text();
            var narration  = $('#'+id).children('td[data-target=narration2]').text();
            var balance  = $('#'+id).children('td[data-target=balance33]').text();
            var totalamount  = $('#'+id).children('td[data-target=amount2]').text();

            
            $('#customer1').val(customer.trim());
            $('#narration1').val(narration.trim());
            $('#balance1').val("Invoice Total = "+ totalamount + "    Current Balance = "+ balance.trim());
            $('#amount').val(balance.trim());
            $('#invoice_id').val(id);
            $('#modal-payinvoice').modal('toggle');
      });
    });



    $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=complete_transaction]',function(){
            var id  = $(this).data('id');
            var issuedT  = $('#'+id).children('td[data-target=issued_to]').text();
            var amntT  = $('#'+id).children('td[data-target=amount1]').text();
            $('#issuedd').val(issuedT.trim());
            $('#amnt').val(amntT.trim());
            $('#transaction_id').val(id);
            $('#modal-completetransaction').modal('toggle');
      });
    });

    

    $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=addcopy]',function(){
            var id  = $(this).data('id');
            var assetname  = $('#'+id).children('td[data-target=asset_name]').text();
            
            $('#asset_name').val(assetname.trim());
            $('#asset_name2').val(assetname.trim());
            
            $('#asset_id').val(id);
            $('#modal-addcopy').modal('toggle');
      });
    });
 

    $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=receivestock]',function(){
            var id  = $(this).data('id');
            var productname  = $('#'+id).children('td[data-target=product_name]').text();
            
            $('#product_named').val(productname.trim());
           
            $('#product_id').val(id);
            $('#modal-receive').modal('toggle');
      });
    });


    $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=issuestock]',function(){
            var id  = $(this).data('id');
            var productname  = $('#'+id).children('td[data-target=product_name]').text();
            
            $('#product_named2').val(productname.trim());
           
            $('#product_id').val(id);
            $('#modal-issue').modal('toggle');
      });
    });
    



</script>









@include('sweetalert::alert')

<script type="text/javascript">
  $("body").on("click",".deledisburse",function(){
    var current_object = $(this);
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "error",
        showCancelButton: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    },function (result) {
        if (result) {
            var action = current_object.attr('data-action');
            var token = jQuery('meta[name="csrf-token"]').attr('content');
            var id = current_object.attr('data-id');

            $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
            $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
            $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
            $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
            $('body').find('.remove-form').submit();
        }
    });
});



$(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons77').DataTable({
        lengthChange: false,
        buttons: ['excel', 'pdf', 'print']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
} );



</script>


<script>
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});





$('.remove-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'The Student Will be set as Completed/Left!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});


</script>


<script>
$('.accept-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This Quotation Will be turned into an invoice!',
        icon: 'success',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>


<script>
$('.accept-return').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Return This Item',
        text: 'Confirm the Staff Member has returned the item',
        icon: 'success',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>

 
<script>
$('.printclassreport').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Choose Course to print',
        text: '',
        icon: 'success',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>





<script>
  jQuery('#datepicker-deadline').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#datepicker-startdate').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#datepicker-projectstart').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#datepicker-projectdeadline').datepicker({
        autoclose: true,
        todayHighlight: true
    });

  
</script>

<script>


!function($) {
  "use strict";

  var MorrisCharts = function() {};

  //creates Donut chart
  MorrisCharts.prototype.createDonutChart = function(element, data, colors) {
      Morris.Donut({
          element: element,
          data: data,
          resize: true,
          colors: colors
      });
  },
  //creates Donut chart Dark
  MorrisCharts.prototype.createDonutChart1 = function(element, data, colors) {
      Morris.Donut({
          element: element,
          data: data,
          resize: true,
          colors: colors,
          labelColor: '#fff',
          backgroundColor: '#4bbbce'
      });
  },
  MorrisCharts.prototype.init = function() {

    /**
     * This section checks if the budget balances are set
     * They are set if the page being visited is the dashboard
     * if not the dashboard, just set default values.
     * The goal is just to avoid errors when visiting other pages
     * 
     */

   <?php  if(Route::currentRouteName() == 'home'){    ?>

    var expense = <?php echo $expense['thisyear']; ?>;
    var blanace = <?php echo ($incomePerYear[date('Y')]); ?> ;

    var noOfStudents =  <?php echo (
        $studentDetails['male'] + $studentDetails['female'] ); ?> ;


    var costPerSd = <?php echo ($expense['thisyear']/ 
             ($studentDetails['male'] + $studentDetails['female']) ); ?>;
    
    var costLastYear = <?php echo ($expense['expelastyear']/ 
             ($studentDetails['male'] + $studentDetails['female']) ); ?>;

    var incomePerStudent = <?php echo ($incomePerYear[date('Y') -1]) / ($studentDetails['male'] + $studentDetails['female']); ?> ;

    <?php }  else{  ?>


    var expense = 1;
    var blanace = 1 ;

  <?php }  ?>
     
     

      //creating donut chart
      var $donutData = [
         
          {label: "Expenses", value: expense},
          {label: "Income", value: blanace}
      ];
      this.createDonutChart('morrisdonut1', $donutData, ['#4bbbce', '#5985ee', '#46cd93']);


        
      //creating donut chart
      var $donutData4 = [
         
         {label: "This Year", value: costPerSd.toFixed(0)},
         {label: "Last Year", value: costLastYear.toFixed(0)}
     ];
     this.createDonutChart('morrisdonut7', $donutData4, ['#4bbbce', '#5985ee', '#46cd93']);


     //creating donut chart
     var $donutData5 = [
         
         {label: "Expense/Student", value: costLastYear.toFixed(0)},
         {label: "Income/Student", value: incomePerStudent.toFixed(0)}
     ];
     this.createDonutChart('morrisdonut8', $donutData5, ['#4bbbce', '#5985ee', '#46cd93']);


     //creating donut chart
     var $donutData6 = [
         
         {label: "Expenses", value: expense},
         {label: "Income", value: blanace}
     ];
     this.createDonutChart('morrisdonut9', $donutData6, ['#4bbbce', '#5985ee', '#46cd93']);









      //creating donut chart Dark
      var $donutData1 = [
          {label: "Expenses", value: expense},
          {label: "Income", value: blanace}
      ];
      this.createDonutChart1('morrisdonut2', $donutData1, ['#f0f1f4', '#f0f1f4', '#f0f1f4']);

      //create line chart Dark
      var $data1  = [
          { y: '2009', a: 20, b: 5 },
          { y: '2010', a: 45,  b: 35 },
          { y: '2011', a: 50,  b: 40 },
          { y: '2012', a: 75,  b: 65 },
          { y: '2013', a: 50,  b: 40 },
          { y: '2014', a: 75,  b: 65 },
          { y: '2015', a: 100, b: 90 }
      ];
      this.createLineChart1('mymorrisdark', $data1, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#5985ee', '#46cd93']);
  },
  //init
  $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

//initializing 
function($) {
  "use strict";
  $.MorrisCharts.init();
}(window.jQuery);

</script>









<script>


!function ($) {
    "use strict";

    var Dashboard = function () {
    };

    //creates line chart
    Dashboard.prototype.createLineChart = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Line({
          element: element,
          data: data,
          xkey: xkey,
          ykeys: ykeys,
          labels: labels,
          hideHover: 'auto',
          gridLineColor: '#eef0f2',
          resize: true, //defaulted to true
          lineColors: lineColors
        });
    },

    //creates Donut chart
    Dashboard.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true,
            colors: colors
        });
    },




    Dashboard.prototype.init = function () {


      
    var year0 =  new Date().getFullYear();
    var year1 = new Date().getFullYear() - 1;
    var year2 = new Date().getFullYear() - 2;
    var year3 = new Date().getFullYear() - 3;
   
    
    <?php  if(isset($incomePerYear[date('Y')])){    ?>
    var incomeY0 = <?php echo $incomePerYear[date('Y')]; ?>;
    var incomeY1 = <?php echo $incomePerYear[date('Y') - 1]; ?>;
    var incomeY2 = <?php echo $incomePerYear[date('Y') - 2]; ?>;
    var incomeY3 = <?php echo $incomePerYear[date('Y') - 3]; ?>;

    var expenseY0 = <?php echo $expensesPerYear[date('Y')]; ?>;
    var expenseY1 = <?php echo $expensesPerYear[date('Y') - 1]; ?>;
    var expenseY2 = <?php echo $expensesPerYear[date('Y') - 2]; ?>;
    var expenseY3 = <?php echo $expensesPerYear[date('Y') - 3]; ?>;


<?php } else { ?>
    var incomeY0 = 100;
    var incomeY1 = 100;
    var incomeY2 = 100;
    var incomeY3 = 100;


  <?php }  ?>



        //create line chart
            
        var $data  = [
            { y: ""+year3, a: parseFloat(incomeY3),  b: expenseY3 },
            { y: ""+year2, a: parseFloat(incomeY2),  b: expenseY2 },
            { y: ""+year1, a: parseFloat(incomeY1),  b: expenseY1 },
            { y: ""+year0, a: parseFloat(incomeY0),  b: expenseY0 }
          ];
        this.createLineChart('morris-line-example1', $data, 'y', ['a', 'b'], ['Income', 'Expenses'], ['#46cd93', '#5985ee']);

        //creating donut chart
        var $donutData = [
            {label: "Budget", value: 12},
            {label: "Used", value: 30},
            {label: "Balance", value: 20}
        ];
        this.createDonutChart('morris-donut-example', $donutData, ['#4bbbce', '#5985ee', '#46cd93']);

    },

        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.Dashboard.init();
    }(window.jQuery);
</script>




    </body>
</html>