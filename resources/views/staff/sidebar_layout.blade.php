<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('staff.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15 col-md-4">
            @isset($SiteOption)
            <img src="{{ asset($SiteOption[1]->value) }}" alt="" srcset="" width="100%">
            @endisset
        </div>
        <div class="sidebar-brand-text mx-2 col-md-8">Staff Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/staff">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Heading -->
    
    <div class="sidebar-heading">
        Cast Management
    </div>
    <!-- Nav Cast Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/cast*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-users"></i>
            <span>Actor/Actress</span>
        </a>
        <div id="collapseOne" class="collapse @if(request()->is('staff/cast*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actor/Actress Management</h6>
                <a class="collapse-item" href="{{ route('staff.cast.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.cast.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Genre Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Genre Management
    </div>
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/genre*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-book"></i>
            <span>Movie Genres</span>
        </a>
        <div id="collapseThree" class="collapse @if(request()->is('staff/genre*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Genres Management</h6>
                <a class="collapse-item" href="{{ route('staff.genre.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.genre.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Language Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Language Management
    </div>
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/language*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-language"></i>
            <span>Movie Languages</span>
        </a>
        <div id="collapseFour" class="collapse @if(request()->is('staff/language*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Languages Management</h6>
                <a class="collapse-item" href="{{ route('staff.language.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.language.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Production Company Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Production Company Management
    </div>
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/pcompany*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-building"></i>
            <span>Production Company</span>
        </a>
        <div id="collapseFive" class="collapse @if(request()->is('staff/pcompany*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Production Companies</h6>
                <a class="collapse-item" href="{{ route('staff.pcompany.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.pcompany.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <!-- Nav Directors Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Directors Management
    </div>
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/director*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-table"></i>
            <span>Directors</span>
        </a>
        <div id="collapseSix" class="collapse @if(request()->is('staff/director*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Director Management</h6>
                <a class="collapse-item" href="{{ route('staff.director.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.director.create') }}">Add new</a>
            </div>
        </div>
    </li>
     <!-- Nav Item Countries - Utilities Collapse Menu -->
     <div class="sidebar-heading">
        Country Management
    </div>
    <!-- Nav Countries - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/country*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseEight"
            aria-expanded="true" aria-controls="collapseEight">
            <i class="fas fa-flag"></i>
            <span>Countries</span>
        </a>
        <div id="collapseEight" class="collapse @if(request()->is('staff/country*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Country Management</h6>
                <a class="collapse-item" href="{{ route('staff.country.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.country.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Movie Services - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        Movie Management
    </div>
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/movie*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseSeven"
            aria-expanded="true" aria-controls="collapseSeven">
            <i class="fas fa-film"></i>
            <span>Movies</span>
        </a>
        <div id="collapseSeven" class="collapse @if(request()->is('staff/movie*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Movie Management</h6>
                <a class="collapse-item" href="{{ route('staff.movie.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.movie.create') }}">Add new</a>
            </div>
        </div>
    </li>
     <!-- Nav Item Support - Utilities Collapse Menu -->
    <hr class="sidebar-divider">
    <!-- Heading -->

         <div class="sidebar-heading">
             User Management
         </div>
         <!-- Nav Email Services - Utilities Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link @if (!request()->is('staff/user*'))
                 collapsed
             @endif" href="#" data-toggle="collapse" data-target="#collapseNine"
                 aria-expanded="true" aria-controls="collapseNine">
                 <i class="fas fa-users"></i>
                 <span>Users</span>
             </a>
             <div id="collapseNine" class="collapse @if(request()->is('staff/user*')) show @endif" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">User Management</h6>
                     <a class="collapse-item" href="{{ route('staff.user.index') }}">View All</a>
                     <a class="collapse-item" href="{{ route('staff.user.create') }}">Add new</a>
                 </div>
             </div>
         </li>
          <!-- Nav Item Support - Utilities Collapse Menu -->
         <hr class="sidebar-divider">
         <!-- Heading -->
    <div class="sidebar-heading">
         Email System
    </div>
    <!-- Nav Email Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/email*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseTen"
            aria-expanded="true" aria-controls="collapseTen">
            <i class="fas fa-table"></i>
            <span>Email Service</span>
        </a>
        <div id="collapseTen" class="collapse @if(request()->is('staff/email*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Email Management</h6>
                <a class="collapse-item" href="{{ route('staff.email.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.email.create') }}">Add new</a>
            </div>
        </div>
    </li>
     <!-- Nav Item Support - Utilities Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link @if (!request()->is('student/support*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseEleven"
            aria-expanded="true" aria-controls="collapseEleven">
            <i class="fas fa-ticket-alt"></i>
            <span>Support</span>
        </a>
        <div id="collapseEleven" class="collapse @if(request()->is('student/support*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Support Ticket Management</h6>
                <a class="collapse-item" href="{{ route('staff.support.index') }}">View Support Tickets</a>
            </div>
        </div>
    </li>
   

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item active">
            
        <a class="nav-link" href="{{ route('staff.logout') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar - Logout - CopyRight) -->
    @include('../layouts/sidebar_toggle')
    <!-- End Sidebar Toggler (Sidebar - Logout - CopyRight) -->

    

</ul>