<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="mdi mdi-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        
            
        
        
    </div>

    <div class="sidebar-inner slimscrollleft">
        
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{URL::to('/')}}" class="waves-effect">
                        <i class="dripicons-home"></i>
                        
                        <B> DASHBOARD </B>
                    </a>
                </li>


                @can('VIEW_SCHOOL')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap"></i><span> <B>  SCHOOL </B></span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="{{URL::to('/')}}/school"><b class="fas fa-school" aria-hidden="true"> School Dashboard </b></a></li>
                        <li><a href="{{URL::to('/')}}/courses"><b class="fa fa-chart-pie" aria-hidden="true"> Manage Courses </b></a></li>
                        <li><a href="{{URL::to('/')}}/students"><b class="fa fa-users" aria-hidden="true"> Manage Students </b></a></li>
                        <li><a href="{{URL::to('/')}}/students/create"><b class="fa fa-user" aria-hidden="true"> Add New Student </b></a></li>
                        <li><a href="{{URL::to('/')}}/students/old"><b class="fa fa-users" aria-hidden="true"> Old Students </b></a></li>

                    </ul>
                </li> @endcan


                @can('VIEW_SCHOOL')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-school"></i><span><B>  SCHOOL FEES </B></span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{URL::to('/')}}/schoolfees"><b class="fa fa-chart-line" aria-hidden="true">  Fees Dashboard</b></a></li>
                        <li><a href="{{URL::to('/')}}/feevotehead"><b class="fa fa-print" aria-hidden="true"> Fee Voteheads </b></a></li>
                        <li><a href="{{URL::to('/')}}/feereceipts"><b class="fa fa-print" aria-hidden="true"> View Receipts </b></a></li>
                        <li><a href="{{URL::to('/')}}/createfeeinvoice"><b class="fa fa-chart-bar" aria-hidden="true">Create Fee Invoices </b></a></li>
                        <li><a href="{{URL::to('/')}}/school/feereports"><b class="fa fa-chart-pie" aria-hidden="true">Fee Balances Reports </b></a></li>
                    </ul>
                </li> @endcan

                @can('VIEW_SCHOOL')
               

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-users"></i><span><B>  SPONSORSHIP </B></span>
                        <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span>
                    </a>
                    <ul class="list-unstyled" id="sponsorship-menu">
                        <li><a href="{{ URL::to('/') }}/sponsors"><b class="fa fa-chart-line" aria-hidden="true">  List of Sponsors</b></a></li>
                        <li><a href="{{ URL::to('/') }}/sponsors/assignsponsor"><b class="fa fa-print" aria-hidden="true"> Student to Sponsors </b></a></li>
                        <li><a href="{{ URL::to('/') }}/sponsors/sponsorshipreports"><b class="fa fa-print" aria-hidden="true"> Sponsored Students List </b></a></li>
                    </ul>
                </li>
                
                
                
                @endcan

           

                @can('VIEW_ASSETS')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-view-thumb"></i><span> CATALOGUE </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                    <li><a href="{{URL::to('/')}}/locations"><b class="fa fa-chart-line" aria-hidden="true"> Manage Stores </b></a></li>
                    <a href="{{URL::to('/')}}/catalogue" class="fa fa-chart-line"   ><b class="dripicons-view-thumb"> Catalogue </b></a>
                    <a href="{{URL::to('/')}}/catalogcategories" class="fa fa-chart-line"   ><b class="dripicons-view-thumb"> ASSET CATEGORY </b></a>
                  
                    </ul>
                </li> 
                @endcan  

                @can('VIEW_EXPENSES')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-money-check-alt"></i> <span> EXPENSES </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="{{URL::to('/')}}/expense"><b class="fa fa-dollar-sign" aria-hidden="true"> Manage Expenses </b></a></li>
                        <li><a href="{{URL::to('/')}}/expensecategory"><b class="fa fa-dollar-sign" aria-hidden="true"> Expenses Category</b></a></li>
  
                        
                    </ul>
                </li>
                @endcan




                @can('VIEW_PRODUCTION')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-money-check-alt"  style="color:orange"></i> <span style="color:orange"> PRODUCTION </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{URL::to('/')}}/production"><b class="fas fa-money-check-alt" aria-hidden="true"> Unpaid Invoices </b></a></li>
                        <li><a href="{{URL::to('/')}}/production/all"><b class="fas fa-money-check-alt" aria-hidden="true"> Paid Invoices </b></a></li>
                        <li><a href="{{URL::to('/')}}/quotations"><b class="fas fa-money-check-alt" aria-hidden="true"> Manage Quotations </b></a></li>

                    </ul>
                </li>
                @endcan 

                @can('VIEW_SCHOOL')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-sms" style="color:green"></i><span style="color:green"> <B> SMS COMM </B> </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">

                        <li><a href="{{URL::to('/')}}/smscommunication"><b class="fa fa-sms" style="color:green" aria-hidden="true"> Send SMS </b></a></li>
                        <li><a href="{{URL::to('/')}}/smscommunication/sentsms"><b class="fa fa-sms" style="color:green" aria-hidden="true">View Sent SMS </b></a></li>

                    </ul>
                </li> @endcan



                @can('VIEW_STAFF')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i> <span> STAFF </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="{{URL::to('/')}}/staff"> <b class="fa fa-users" > Manage Staff </b></a></li>
                        <li><a href="{{URL::to('/')}}/staffleavedays"> <b class="fa fa-users" > Staff Leave Days </b></a></li>
                    </ul>
                </li> 
                @endcan

                @can('VIEW_SUPPLIERS')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i> <span> SUPPLIERS </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="{{URL::to('/')}}/suppliers"> <b class="fa fa-users" > Manage Suppliers </b></a></li>
                    </ul>
                </li> 
                @endcan

                @can('VIEW CUSTOMERS')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i> <span> CUSTOMERS </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="{{URL::to('/')}}/customers"> <b class="fa fa-users" > Manage Customers </b></a></li>
                    </ul>
                </li> 
                @endcan


               



               
               

                @can('VIEW PETTY CASH')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-dollar-sign"></i> <span> PETTY CASH </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="{{URL::to('/')}}/pettycash"> <b class="fas fa-dollar-sign" > Manage Transactions </b></a></li>
                    </ul>
                </li> @endcan

               

               
            

                @can('IS ADMINISTRATOR')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-copy"></i><span> USERS RIGHTS </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{URL::to('/')}}/roles">Manage Roles</a></li>
                        <li><a href="{{URL::to('/')}}/permissions">Manage Permissions</a></li>
                    </ul>
                </li> @endcan


            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>