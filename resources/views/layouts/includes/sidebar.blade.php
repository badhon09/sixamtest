 <div class="left-side-menu">

     <div class="h-100" data-simplebar>

         <!-- User box -->
         {{-- <div class="user-box text-center">
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
         </div> --}}

         <?php
session_start();
  $permissions = \App\Models\User::with('permission')->find(Auth::user()->user_id)->permission->pluck('permissionHeader.header_name')->toArray();

  $_SESSION["permissions"] = $permissions;

        Gate::define('product_menu', function () {

            if (in_array('product_menu', $_SESSION["permissions"])) {
                return true;
            } else {
                return false;
            }
        });




        Gate::define('import_product_menu', function ($user) {

            if (in_array('import_product_menu',  $_SESSION["permissions"] )) {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('userpermission_menu', function ($user) {

            if (in_array('userpermission_menu',  $_SESSION["permissions"] )) {
                return true;
            } else {
                return false;
            }
        });







?>


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

                 @can('product_menu')
                 <li>
                    <a href="{{route('products.index')}}" >
                        <i data-feather="airplay"></i>
                        <span> Products </span>
                    </a>
                </li>
                @endcan

                @can('import_product_menu')
                <li>
                    <a href="{{route('products.import')}}" >
                        <i data-feather="airplay"></i>
                        <span> import products </span>
                    </a>
                </li>
                @endcan


                @can('userpermission_menu')
                <li>
                    <a href="{{route('users.index')}}" >
                        <i data-feather="airplay"></i>
                        <span>User Role Permissions </span>
                    </a>
                </li>
                @endcan


             </ul>

         </div>
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
