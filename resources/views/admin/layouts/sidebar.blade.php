<div>
    <style>
        .sidebar{
            background-color: #7223b5 !important;
            color: white
        }
    </style>
</div>

<ul class="navbar-nav  sidebar  accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-white d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15 col-md-4">
            @isset($SiteOption)
            <img src="{{asset('img/just.png')}}" alt="" srcset="" width="100%">
            @endisset
        </div>
        <div class="sidebar-brand-text mx-2 col-md-8">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link text-white" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
         User System
    </div>
    <!-- Nav Item Customer - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="text-white nav-link @if(!request()->is('admin/student*')) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
        <div id="collapseOne" class="collapse @if(request()->is('admin/student*')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management</h6>
                <a class="  collapse-item" href="{{ route('admin.user.index') }}">View All</a>
                <a class=" collapse-item" href="{{ route('admin.user.create') }}">Add new </a>
            </div>
        </div>
    </li>
     <!-- Nav Item Department - Utilities Collapse Menu -->
     <li class="nav-item">
        <a class="text-white nav-link @if (!request()->is('admin/department*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Staff Departments</span>
        </a>
        <div id="collapseTwo" class="collapse @if(request()->is('admin/department*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Department Management</h6>
                <a class="collapse-item" href="{{ route('admin.department.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.department.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Item Staff - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/staff*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-users"></i>
            <span>Staff</span>
        </a>
        <div id="collapseThree" class="collapse @if(request()->is('admin/staff*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Staff Management</h6>
                <a class="collapse-item " href="{{ route('admin.staff.index') }}">View All</a>
                <a class="collapse-item " href="{{ route('admin.staff.create') }}">Add new</a>
            </div>
        </div>
    </li>
     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Divider -->
    <!-- Heading -->
        
    <!-- Nav Cast Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Cast Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/cast*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-users"></i>
            <span>Actor/Actress</span>
        </a>
        <div id="collapseSix" class="collapse  @if(request()->is('admin/cast*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header ">Actor/Actress Management</h6>
                <a class="collapse-item" href="{{ route('admin.cast.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.cast.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Genre Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Genre Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/genre*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseSeven"
            aria-expanded="true" aria-controls="collapseSeven">
            <i class="fas fa-book"></i>
            <span>Movie Genres</span>
        </a>
        <div id="collapseSeven" class="collapse @if(request()->is('admin/genre*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Genres Management</h6>
                <a class="collapse-item" href="{{ route('admin.genre.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.genre.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Language Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Language Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/language*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseEight"
            aria-expanded="true" aria-controls="collapseEight">
            <i class="fas fa-language"></i>
            <span>Movie Languages</span>
        </a>
        <div id="collapseEight" class="collapse @if(request()->is('admin/language*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Languages Management</h6>
                <a class="collapse-item " href="{{ route('admin.language.index') }}">View All</a>
                <a class="collapse-item " href="{{ route('admin.language.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Production Company Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Production Company Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/pcompany*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseNine"
            aria-expanded="true" aria-controls="collapseNine">
            <i class="fas fa-building"></i>
            <span>Production Company</span>
        </a>
        <div id="collapseNine" class="collapse @if(request()->is('admin/pcompany*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Production Companies</h6>
                <a class="collapse-item" href="{{ route('admin.pcompany.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.pcompany.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Directors Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Directors Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/director*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseTen"
            aria-expanded="true" aria-controls="collapseTen">
            <i class="fas fa-table"></i>
            <span>Directors</span>
        </a>
        <div id="collapseTen" class="collapse @if(request()->is('admin/director*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Director Management</h6>
                <a class="collapse-item" href="{{ route('admin.director.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.director.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Countries - Utilities Collapse Menu -->
     <div class="sidebar-heading">
        Country Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/country*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseEleven"
            aria-expanded="true" aria-controls="collapseEleven">
            <i class="fas fa-flag"></i>
            <span>Countries</span>
        </a>
        <div id="collapseEleven" class="collapse @if(request()->is('admin/country*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Country Management</h6>
                <a class="collapse-item" href="{{ route('admin.country.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.country.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Movie Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Movie Management
    </div>
    <li class="nav-item">
        <a class="nav-link text-white @if (!request()->is('admin/movie*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseTwelve"
            aria-expanded="true" aria-controls="collapseTwelve">
            <i class="fas fa-film"></i>
            <span>Movies</span>
        </a>
        <div id="collapseTwelve" class="collapse @if(request()->is('admin/movie*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded">
                <h6 class="collapse-header">Movie Management</h6>
                <a class="collapse-item" href="{{ route('admin.movie.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('admin.movie.create') }}">Add new</a>
            </div>
        </div>
    </li>
       <!-- Divider -->
       <hr class="sidebar-divider">
       <!-- Heading -->
       <div class="sidebar-heading">
        Email System
       </div>
       <!-- Nav Email Services - Utilities Collapse Menu -->
       <li class="nav-item">
           <a class="nav-link text-white @if (!request()->is('admin/email*'))
               collapsed
           @endif" href="#" data-toggle="collapse" data-target="#collapseFour"
               aria-expanded="true" aria-controls="collapseFour">
               <i class="fa fa-envelope"></i>
               <span>Email Service</span>
           </a>
           <div id="collapseFour" class="collapse @if(request()->is('admin/email*')) show @endif" aria-labelledby="headingUtilities"
               data-parent="#accordionSidebar">
               <div class="bg-primary py-2 collapse-inner rounded">
                   <h6 class="collapse-header">Email Management</h6>
                   <a class="collapse-item" href="{{ route('admin.email.index') }}">View All</a>
                   <a class="collapse-item" href="{{ route('admin.email.create') }}">Add new</a>
               </div>
           </div>
       </li>
   
       <!-- Divider -->
       <hr class="sidebar-divider">
       <!-- Heading -->
       <div class="sidebar-heading">
            Complaints System
       </div>
       <!-- Nav Item Support - Utilities Collapse Menu -->
       <li class="nav-item">
           <a class="nav-link text-white @if (!request()->is('student/support*'))
               collapsed
           @endif" href="#" data-toggle="collapse" data-target="#collapseFive"
               aria-expanded="true" aria-controls="collapseFive">
               <i class="fas fa-ticket-alt"></i>
               <span>Support</span>
           </a>
           <div id="collapseFive" class="collapse @if(request()->is('student/support*')) show @endif" aria-labelledby="headingUtilities"
               data-parent="#accordionSidebar">
               <div class="bg-primary py-2 collapse-inner rounded">
                   <h6 class="collapse-header">Support Ticket Management</h6>
                   <a class="collapse-item" href="{{ route('admin.support.index') }}">View Support Tickets</a>
               </div>
           </div>
       </li>
       
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
    System Settings 
    </div>
    <!-- Nav Email Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.settings.edit') }}">
            <i class="fa fa-cog"></i>
            <span>Settings</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item active">
            
        <a class="nav-link text-white" href="{{ route('admin.logout') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar - Logout - CopyRight) -->
    @include('../layouts/sidebar_toggle')
    <!-- End Sidebar Toggler (Sidebar - Logout - CopyRight) -->
</ul>