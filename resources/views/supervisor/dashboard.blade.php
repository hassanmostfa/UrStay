<!doctype html>
<!doctype html>
<html lang="ar" dir="rtl">

<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Supervisor Dashboard</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.compat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/morris/morris.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/skins/default.css') }}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <!-- map -->
    <!-- Include Leaflet CSS and JS -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> -->

    <!-- Include Google Maps JS API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL0mf-wYCEO4N6xNkiJaau55bfRxdB4yk&libraries=places">
    </script>


</head>

</head>

<body>

    <style>
        body {
            direction: rtl;
            font-family: 'Almarai', sans-serif;
        }
    </style>
    <section class="body">

        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="{{ route('supervisor-dashboard') }}" class="logo">
                    <img src="{{ asset('home-assets/images/new-logo.png') }}" alt="URSTAY Owner" />
                </a>

                <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                    data-fire-event="sidebar-left-opened">
                    <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <!-- start: search & user box -->
            <div class="header-right">



                <span class="separator"></span>

                <div id="userbox" class="userbox">
                    <a href="#" data-bs-toggle="dropdown">
                        <figure class="profile-picture">
                            <img src= "{{ asset('user-assets/images/hassan.jpg') }}" alt="Joseph Doe"
                                class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
                        </figure>
                        <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                            <span class="name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                            <span class="role">مشرف عقاري</span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled p-0 my-2"
                            style="text-align:right !important;>
								<li class="divider">
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ route('supervisor.logout.web') }}"><i
                                        class="bx bx-power-off"></i> تسجيل خروح </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->

        <div class="inner-wrapper">

            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>@yield('title')</h2>

                    <div class="right-wrapper text-end">
                        <ol class="breadcrumbs">
                            <li>
                                <a href="{{route('supervisor-dashboard')}}">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>

                            <li><span>@yield('link_one')</span></li>

                            <li><span>@yield('link_two')</span></li>

                        </ol>

                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i
                                class="fas fa-chevron-left"></i></a>
                    </div>
                </header>

                <!-- start: page -->
                <div>
                    <h1>حسابات تحت ادارتي</h1>
                    <br>
                    <br>
                    {{-- Table displaying assigned permissions --}}
                    <div class="card bg-light px-3 mb-5">
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>اسم المالك</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $permission)
                                        <tr>
                                            <td>{{ $permission->owner->first_name . ' ' . $permission->owner->last_name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('supervisor.owner.dashboard', ['owner' => $permission->owner_id]) }}" class="btn btn-primary">عرض الحساب</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($accounts->count() ==0)
                                    <tr>
                                        <td colspan="2">
                                            <h2 style="text-align: center">لا توجد حسابات حتى الان</h2>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{-- Pagination --}}
                            <div class="d-flex justify-content-center">
                                {{ $accounts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: page -->
            </section>
        </div>

    </section>

    <!-- Vendor -->
    <script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/common/common.js') }}"></script>
    <script src="{{ asset('assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <!-- Specific Page Vendor -->
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-appear/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrapv5-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot.tooltip/jquery.flot.tooltip.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/vendor/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/vendor/raphael/raphael.js') }}"></script>
    <script src="{{ asset('assets/vendor/morris/morris.js') }}"></script>
    <script src="{{ asset('assets/vendor/gauge/gauge.js') }}"></script>
    <script src="{{ asset('assets/vendor/snap.svg/snap.svg.js') }}"></script>
    <script src="{{ asset('assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    <!-- Theme Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Theme Initialization Files -->
    <script src="{{ asset('assets/js/theme.init.js') }}"></script>

    <!-- Examples -->
    <script src="{{ asset('assets/js/examples/examples.dashboard.js') }}"></script>



    <style>
        /* Make all divs initially hidden */
        .content-div {
            display: none;
        }

        /* Add custom background color for the active div */
        .active-div {
            padding: 20px;
            border-radius: 8px;
        }

        /* Change the appearance of active buttons */
        .btn.active {
            background-color: #0d6efd !important;
            /* Primary color for active button */
            color: white !important;
        }
    </style>
    <style>
        /* Make all divs initially hidden */
        .content-div {
            display: none;
        }

        /* Add custom background color for the active div */
        .active-div {
            padding: 20px;
            border-radius: 8px;
        }

        /* Change the appearance of active buttons */
        .btn.active {
            background-color: #0d6efd !important;
            /* Primary color for active button */
            color: white !important;
        }
    </style>


</body>

</html>
