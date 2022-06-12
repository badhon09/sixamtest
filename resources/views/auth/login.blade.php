<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('public/logofiles/')}}">

    <!-- Plugins css -->
    <link href="{{url('/public/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/public/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Tables css -->
    <link href="{{url('/public/assets/libs/bootstrap-table/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="{{url('/public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/public/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->

    <!-- Plugins css -->
    <link href="{{url('/public/assets/libs/mohithg-switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/public/assets/libs/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/public/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/public/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/public/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet"
        type="text/css" />

    <!-- App css -->
    <link href="{{url('/public/assets/css/config/default/bootstrap.min.css')}}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{url('/public/assets/css/config/default/app.min.css')}}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{url('/public/assets/css/config/default/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href="{{url('/public/assets/css/config/default/app-dark.min.css')}}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{url('/public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="index.html" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{asset('public/logofiles/')}}" alt="" height="22">
                                        </span>
                                    </a>

                                    <a href="index.html" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{asset('public/logofiles/')}}" alt="" height="22">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your email/username/phone  and password </p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address / Username / Phone</label>

                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>



                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; Developed by <b>Badhon Kumer Ghosh</b>
    </footer>

    <!-- Vendor js -->
    <script src="{{url('/public/assets/js/vendor.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{url('/public/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <script src="{{url('/public/assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

    <!-- Footable js -->
    <script src="{{url('/public/assets/libs/footable/footable.all.min.js')}}"></script>

    <!-- Init js -->
    <script src="{{url('/public/assets/js/pages/foo-tables.init.js')}}"></script>

    <!-- Bootstrap Tables js -->
    <script src="{{url('/public/assets/libs/bootstrap-table/bootstrap-table.min.js')}}"></script>

    <!-- Init js -->
    <script src="{{url('/public/assets/js/pages/bootstrap-tables.init.js')}}"></script>

    <!-- third party js -->
    <script src="{{url('/public/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <!-- third party js ends -->

    <!-- Tickets js -->
    <script src="{{url('/public/assets/js/pages/tickets.js')}}"></script>

    <script src="{{url('/public/assets/libs/mohithg-switchery/switchery.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/multiselect/js/jquery.multi-select.js')}}"></script>
    <script src="{{url('/public/assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/jquery-mockjax/jquery.mockjax.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{url('/public/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{url('/public/assets/js/pages/form-advanced.init.js')}}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{url('/public/assets/js/pages/dashboard-1.init.js')}}"></script>

    <!-- App js-->
    <script src="{{url('/public/assets/js/app.min.js')}}"></script>

</body>

</html>
