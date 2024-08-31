    <!DOCTYPE html>
    <html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('Styling/main.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
        </div>
        </div>
        <!-- partial:partials/_navbar.html -->
        <style>
            nav a{
                margin-right: 10px !important;
                margin-left: 10px !important;
            }
        </style>
        <nav class=" main_navbar navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="padding-top: 0px !important ; margin-top: 0px!important;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo text-center" href="index.html"><img src="{{asset('user-assets/images/logo.png')}}" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('user-assets/images/small-logo.png')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex justify-content-between align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
            </button>
            <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form>
            </div>
            <ul class="navbar-nav navbar-nav-left">
            <li class="nav-item nav-profile dropdown" >
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img mx-2">
                    <img src="{{asset('images/faces/face1.jpg')}}" alt="image">
                    <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black">{{Auth::user()->name}}</p>
                </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">
                    تسجيل خروج<i class="mdi mdi-logout me-2 text-primary ml-2"></i></a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link " style="color:#88394E !important;">
                <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            <li class="nav-item dropdown" style="color:#88394E !important;">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
                </a>
                <div style="color:#88394E !important;" class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0 text-center">الرسائل</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                    <img src="{{asset('images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">ارسل اليك حسن رسالة</h6>
                    <p class="text-gray mb-0"> منذ 15 دقيقة </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 رسائل جديدة</h6>
                </div>
            </li>
            <li class="nav-item dropdown"style="color:#88394E !important;">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0 text-center">الاشعارات</h6>
                <div class="dropdown-divider " ></div>
                <a class="dropdown-item preview-item" >
                    <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                        <i class="mdi mdi-calendar"></i>
                    </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                        <i class="mdi mdi-cog"></i>
                    </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                        <i class="mdi mdi-link-variant"></i>
                    </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                    </div>
                </a>
                <div class="dropdown-divider" style="color:#88394E !important;"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block" style="color:#88394E !important;">
                <a class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
                </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block" style="color:#88394E !important;">
                <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
                </a>
            </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
            </button>
        </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                <div class="nav-profile-image" style="margin-left: 10px !important;">
                    <img src="{{asset('images/faces/face1.jpg')}}" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
                    <span class="text-secondary text-small">{{Auth::user()->role}} </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin/home')}}">
                    <i class="mdi mdi-home menu-icon" style="color:#88394E !important;"></i>
                <span style="color:#88394E !important;" class="menu-title">لوحة تحكم المشرف</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="mdi mdi-crosshairs-gps menu-icon" style="color:#88394E !important;"></i></i>
                    <span style="color:#88394E !important;"  class="menu-title">التصنيفات</span>
                    <i class="menu-arrow" style="color:#88394E !important;"></i>
                </a>
                <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/categories')}}">كل التصنيفات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/categories/create')}}"> اضافة تصنيف</a>
                    </li>
                </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="ui-basic">
                <i class="fa-solid fa-users" style="color:#88394E !important;"></i>
                    <span style="color:#88394E !important;"  class="menu-title" >المستخدمين</span>
                    <i class="menu-arrow" style="color:#88394E !important;"></i>
                </a>
                <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/users')}}">كل المستخدمين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/user/create')}}">اضافة مستخدم جديد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/users/new-requests')}}">طلبات المستخدمين </a>
                    </li>
                </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#units" aria-expanded="false" aria-controls="ui-basic">
                <i class="fa fa-building-o" style="color:#88394E !important;" aria-hidden="true"></i>
                    <span style="color:#88394E !important;"  class="menu-title" >الوحدات</span>
                    <i class="menu-arrow" style="color:#88394E !important;"></i>
                </a>
                <div class="collapse" id="units">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/units')}}"> كل الوحدات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/units/new-requests')}}">طلبات الوحدات</a>
                    </li>
                </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#bookings" aria-expanded="false" aria-controls="ui-basic">
                <i class="fa fa-calendar-check-o" style="color:#88394E !important;" aria-hidden="true"></i>
                    <span style="color:#88394E !important;"  class="menu-title" >الحجوزات</span>
                    <i class="menu-arrow" style="color:#88394E !important;"></i>
                </a>
                <div class="collapse" id="bookings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/bookings')}}"> كل الحجوزات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#000 !important;" href="{{route('admin/bookings/new-requests')}}">طلبات الحجز</a>
                    </li>
                </ul>
                </div>
            </li>
            
            </ul>
        </nav>
        <!-- partial -->
        <div class="w-100" style="background-color: #f5f5f5;">

            @yield('contents')
        </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
            </footer> -->
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
    </body>
    </html>