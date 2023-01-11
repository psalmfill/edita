 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link"
                 href="{{ auth('student')->user() ? route('student.dashboard') : route('staff.dashboard') }}">
                 <i class="icon-grid menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>
         {{-- {{ dd(auth('student')->user()) }} --}}
         @if (auth('student')->user())
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('student.projects') }}">
                     <i class="mdi mdi-book-minus menu-icon"></i>
                     <span class="menu-title">My Projects</span>
                 </a>
             </li>
         @else
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('staff.students') }}">
                     <i class="mdi mdi-account-multiple menu-icon"></i>
                     <span class="menu-title">Students</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('staff.projects') }}">
                     <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                     <span class="menu-title">Projects</span>
                 </a>
             </li>
         @endif
         {{-- <li class="nav-item">
             <a class="nav-link" href="{{ route('profile') }}">
                 <i class="mdi mdi-account mdi-account menu-icon"></i>
                 <span class="menu-title">Account</span>
             </a>
         </li> --}}
         <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}">
                 <i class="mdi mdi-logout mdi-account menu-icon"></i>
                 <span class="menu-title">Logout</span>
             </a>
         </li>
     </ul>
 </nav>
