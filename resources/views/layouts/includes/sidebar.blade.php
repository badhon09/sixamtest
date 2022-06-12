 <div class="left-side-menu">

     <div class="h-100" data-simplebar>

         <!-- User box -->
         <div class="user-box text-center">
             <img src="{{url('/public/assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                 class="rounded-circle avatar-md">
             <div class="dropdown">
                 <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                     data-bs-toggle="dropdown">Geneva Kennedy</a>
                 <div class="dropdown-menu user-pro-dropdown">

                     <!-- item-->
                     <a href="javascript:void(0);" class="dropdown-item notify-item">
                         <i class="fe-user me-1"></i>
                         <span>My Account</span>
                     </a>

                     <!-- item-->
                     <a href="javascript:void(0);" class="dropdown-item notify-item">
                         <i class="fe-settings me-1"></i>
                         <span>Settings</span>
                     </a>

                     <!-- item-->
                     <a href="javascript:void(0);" class="dropdown-item notify-item">
                         <i class="fe-lock me-1"></i>
                         <span>Lock Screen</span>
                     </a>

                     <!-- item-->
                     <a href="javascript:void(0);" class="dropdown-item notify-item">
                         <i class="fe-log-out me-1"></i>
                         <span>Logout</span>
                     </a>

                 </div>
             </div>
             <p class="text-muted">Admin Head</p>
         </div>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <ul id="side-menu">

                 <li class="menu-title">Navigation</li>

                 <li>
                     <a href="{{route('home')}}" >
                         <i data-feather="airplay"></i>

                         <span> Dashboard </span>
                     </a>

                 </li>



{{--                 <li>--}}
{{--                     <a href="#sidebarEcommerce" data-bs-toggle="collapse">--}}
{{--                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>--}}
{{--                         <span> Reports </span>--}}
{{--                         <span class="menu-arrow"></span>--}}
{{--                     </a>--}}
{{--                     <div class="collapse" id="sidebarEcommerce">--}}
{{--                         <ul class="nav-second-level">--}}
{{--                             <li>--}}
{{--                                 <a href="{{route('reports.leads')}}">Leads</a>--}}
{{--                             </li>--}}
{{--                             <li>--}}
{{--                                 <a href="{{route('reports.followup')}}">Followup</a>--}}
{{--                             </li>--}}

{{--                         </ul>--}}
{{--                     </div>--}}
{{--                 </li>--}}


             </ul>

         </div>
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
