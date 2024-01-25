     <style>
         .custom-heading {
             font-family: 'Arial', sans-serif;
             font-size: 24px;
             font-weight: bold;
             color: #333;
             text-transform: uppercase;
         }

         .custom-heading span {
             color: #fff;
             /* Custom color for the letters inside the span elements */
         }
     </style>
     <!-- partial:partials/_sidebar.html -->
     <nav class="sidebar sidebar-offcanvas" id="sidebar">
         <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
             <a class="sidebar-brand brand-logo" href="{{ url('redirect') }}">
                 {{-- <img src="/admin-assets/assets/images/logo.svg" alt="logo" /> --}}
                 <h6 class="custom-heading"><span>M</span><span>N</span><span>A</span></h6>
             </a>
             <a class="sidebar-brand brand-logo-mini" href="{{ url('redirect') }}">
                 <h6>MNA</h6>
                 {{-- <img src="/admin-assets/assets/images/logo-mini.svg" alt="logo" /> --}}
             </a>
         </div>
         <ul class="nav">
             <li class="nav-item profile">
                 <div class="profile-desc">
                     <div class="profile-pic">
                         <div class="count-indicator">
                             <img class="img-xs rounded-circle "
                                 src="https://png.pngtree.com/png-clipart/20190520/original/pngtree-vector-users-icon-png-image_4144740.jpg"
                                 alt="">
                             <span class="count bg-success"></span>
                         </div>
                         <div class="profile-name">
                             <h5 class="mb-0 font-weight-normal">Naveed</h5>
                             {{-- <span></span> --}}
                         </div>
                     </div>
                     {{-- <a href="#" id="profile-dropdown" data-toggle="dropdown"><i
                             class="mdi mdi-dots-vertical"></i></a> --}}
                     <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                         aria-labelledby="profile-dropdown">
                         <a href="#" class="dropdown-item preview-item">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-dark rounded-circle">
                                     <i class="mdi mdi-settings text-primary"></i>
                                 </div>
                             </div>
                             <div class="preview-item-content">
                                 <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                             </div>
                         </a>
                         <div class="dropdown-divider"></div>
                         <a href="#" class="dropdown-item preview-item">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-dark rounded-circle">
                                     <i class="mdi mdi-onepassword  text-info"></i>
                                 </div>
                             </div>
                             <div class="preview-item-content">
                                 <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                             </div>
                         </a>
                         <div class="dropdown-divider"></div>
                         <a href="#" class="dropdown-item preview-item">
                             <div class="preview-thumbnail">
                                 <div class="preview-icon bg-dark rounded-circle">
                                     <i class="mdi mdi-calendar-today text-success"></i>
                                 </div>
                             </div>
                             <div class="preview-item-content">
                                 <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                             </div>
                         </a>
                     </div>
                 </div>
             </li>
             <li class="nav-item nav-category">
                 <span class="nav-link">Navigation</span>
             </li>
             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ url('redirect') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-speedometer"></i>
                     </span>
                     <span class="menu-title">Dashboard</span>
                 </a>
             </li>
             {{-- <li class="nav-item menu-items">
                 <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                     aria-controls="ui-basic">
                     <span class="menu-icon">
                         <i class="mdi mdi-laptop"></i>
                     </span>
                     <span class="menu-title">Products</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-basic">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="{{ route('view.product') }}">Add Products</a>
                         </li>
                         <li class="nav-item"> <a class="nav-link" href="{{ route('show.product') }}">Show Products</a>
                         </li>
                     </ul>
                 </div>
             </li> --}}

             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ route('view.product') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-playlist-play"></i>
                     </span>
                     <span class="menu-title">Add Products</span>
                 </a>
             </li>
             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ route('show.product') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-playlist-play"></i>
                     </span>
                     <span class="menu-title">Show Products</span>
                 </a>
             </li>

             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ route('view.category') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-playlist-play"></i>
                     </span>
                     <span class="menu-title">Add Category</span>
                 </a>
             </li>

             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ route('show.category') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-playlist-play"></i>
                     </span>
                     <span class="menu-title">Show Category</span>
                 </a>
             </li>

             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ route('view.orders') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-playlist-play"></i>
                     </span>
                     <span class="menu-title">Orders</span>
                 </a>
             </li>

             <li class="nav-item menu-items">
                 <a class="nav-link" href="{{ route('view.message') }}">
                     <span class="menu-icon">
                         <i class="mdi mdi-playlist-play"></i>
                     </span>
                     <span class="menu-title">Message</span>
                 </a>
             </li>
         </ul>
     </nav>
