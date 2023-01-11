 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="{{ auth()->user() ? route('staff.dashboard') : route('students.dashboard') }}">
                 <i class="icon-grid menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>

         @if (!auth()->user())
             <li class="nav-item">
                 <a class="nav-link" href="index.html">
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
     </ul>
 </nav>
