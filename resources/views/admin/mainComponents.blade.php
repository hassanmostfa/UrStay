<!doctype html>
<html lang = "ar" dir = "rtl">

<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>UrStay | Admin Dashboard</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">
    <!-- Include Toastify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/site/css/admin.css') }}?v={{ time() }}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <style>
        .notifications_pop_up {
            display: none;
            /* Hidden by default */
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 300px;
            overflow-y: auto;
            /* Enable scrolling */
            overflow-y: auto;
            left: 0;
            top: calc(100% + 24px);
            overflow: hidden;
            min-width: 260px;
            border-radius: 8px;
        }

        .notifications_pop_up {
            overflow: hidden auto;
            scrollbar-width: thin;
            /* Makes scrollbar thin */
            scrollbar-color: #88394e transparent;
            /* Scrollbar thumb color and track color */
            -ms-overflow-style: scrollbar;
            /* Shows scrollbar in IE and Edge */
        }

        .notifications_pop_up ::-webkit-scrollbar {
            width: 4px;
            /* Width of the scrollbar */
        }

        .notifications_pop_up :-webkit-scrollbar-thumb {
            background-color: #88394e;
            /* Color of the scrollbar thumb */
            border-radius: 10px;
            /* Rounded corners */
        }

        .notifications_pop_up.active {
            display: block;
            /* Show when active */
        }

        .notification {
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: block;
            font-family: MainFontBold;
            font-size: 16px;
            color: #88394e;
            text-decoration: none;
        }

        .notification:last-child {
            border-bottom: none;
            /* Remove border from last notification */
        }
    </style>

</head>

<body>

    <style>
        body {
            direction: rtl;
            font-family: 'Almarai', sans-serif;
        }
    </style>

    <section class="body">

        {{-- <!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="#" class="logo">
						<img src="{{asset('home-assets/images/new-logo.png')}}" alt="URSTAY Admin" width="75" height="35" />
					</a>

					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>

				</div>

				<!-- start: search & user box -->
				<div class="header-right">


					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-bs-toggle="dropdown">
							<figure class="profile-picture">
								<img src= "{{asset('user-assets/images/hassan.jpg')}}" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
								<span class="role">{{ Auth::user()->isMaster ? "ادمن" : "مشرف" }}</span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled p-0 my-2" style="text-align:right !important;>
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('admin.logout') }}"><i class="bx bx-power-off"></i> تسجيل خروح </a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
            --}}
        @include('includes.master-header')
        <div class="inner-wrapper" style="padding-top: 0;">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">
                <div class="nano">

                    <div class="nano-content p-0">
                        <nav id="menu" class="nav-main" role="navigation">
                            @if (Auth::guard('admin')->user()->isMaster)
                                <ul class="nav nav-main p-0">
                                    <li>
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                                            <span>لوحة التحكم</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a class="nav-link" href="#">
                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                            <span>المواقع الجغرافية</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <!-- <li>
    <a class="nav-link" href="{{ route('admin.countries') }}">
    countries List
    </a>
    </li> -->

                                            <li>
                                                <a class="nav-link" href="{{ route('admin.cities') }}">
                                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                                    المدن
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('admin.districts') }}">
                                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                                    الاحياء
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Categories -->
                                    <li class="nav-parent">
                                        <a class="nav-link" href="#">
                                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                                            <span>التصنيفات</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a class="nav-link" href="{{ route('admin.categories') }}">
                                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                                    القائمة الرئيسية
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('admin.subCategories') }}">
                                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                                    التصنيفات الفرعية
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="{{ route('admin.subOfSubCategories') }}">
                                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                                    التصنيفات الفرعية الثانية
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <!-- Units -->
                                    <li>
                                        <a class="nav-link" href="{{ route('admin.allUnits') }}">
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                            كل الوحدات
                                        </a>
                                    </li>

                                    <!-- Supervisors -->
                                    <li>
                                        <a class="nav-link" href="{{ route('admin.supervisors') }}">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>المشرفين</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('admins.index') }}">
                                            <i class="fa fa-user-shield" aria-hidden="true"></i>
                                            <span>المسؤولين </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#">
                                            <i class="fa-solid fa-file-invoice"></i>
                                            <span>التقارير </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link text-danger" href="{{ route('admin.logout') }}">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            <span>تسجيل الخروج</span>
                                        </a>
                                    </li>


                                    <!-- <li>
    <a class="nav-link" href="#">
          <i class="fa fa-users" aria-hidden="true"></i>
    <span>العملاء</span></span>
    </a>
    </li> -->


                                </ul>
                            @else
                                <ul class="nav nav-main p-0">
                                    <li>
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                                            <span>لوحة التحكم</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="nav-link" href="{{ route('admin.allUnits') }}">
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                            كل الوحدات
                                        </a>
                                    </li>

                                    <li>
                                        <a class="nav-link" href="{{ route('admin.myUnits') }}">
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                            <span>وحدات تحت اشرافي</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="nav-link text-danger" href="{{ route('admin.logout') }}">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            <span>تسجيل الخروج</span>
                                        </a>
                                    </li>



                                </ul>
                            @endif
                        </nav>


                        <script>
                            // Maintain Scroll Position
                            if (typeof localStorage !== 'undefined') {
                                if (localStorage.getItem('sidebar-left-position') !== null) {
                                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                                    sidebarLeft.scrollTop = initialPosition;
                                }
                            }
                        </script>

                    </div>

            </aside>
            <!-- end: sidebar -->

            <section role="main" class="content-body" style="margin-top: 40px;margin-bottom: 40px">

                <!-- start: page -->
                <div>
                    @yield('content')
                </div>
                <!-- end: page -->
            </section>
        </div>

        <aside id="sidebar-right" class="sidebar-right">
            <div class="nano">
                <div class="nano-content">
                    <a href="#" class="mobile-close d-md-none">
                        Collapse <i class="fas fa-chevron-right"></i>
                    </a>

                    <div class="sidebar-right-wrapper">

                        <div class="sidebar-widget widget-calendar">
                            <h6>Upcoming Tasks</h6>
                            <div data-plugin-datepicker data-plugin-skin="dark"></div>

                            <ul>
                                <li>
                                    <time datetime="2021-04-19T00:00+00:00">04/19/2021</time>
                                    <span>Company Meeting</span>
                                </li>
                            </ul>
                        </div>

                        <div class="sidebar-widget widget-friends">
                            <h6>Friends</h6>
                            <ul>
                                <li class="status-online">
                                    <figure class="profile-picture">
                                        <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                                <li class="status-online">
                                    <figure class="profile-picture">
                                        <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                                <li class="status-offline">
                                    <figure class="profile-picture">
                                        <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                                <li class="status-offline">
                                    <figure class="profile-picture">
                                        <img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </aside>

    </section>
    @include('includes.admin-footer')

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


    <!-- AJAX Script for Dynamic Zone and Governorate Selection -->
    <script>
        // When country is selected, fetch related zones
        // document.getElementById('country').addEventListener('change', function() {
        //     var countryId = this.value;
        //     fetch(`/admin/get-zones/${countryId}`)
        //         .then(response => response.json())
        //         .then(data => {
        //             var zoneSelect = document.getElementById('zone');
        //             zoneSelect.innerHTML = '<option value="" disabled selected>Select a Zone</option>';
        //             data.forEach(zone => {
        //                 zoneSelect.innerHTML += `<option value="${zone.id}">${zone.name}</option>`;
        //             });
        //         });
        // });

        // When zone is selected, fetch related governorates
        document.getElementById('zone').addEventListener('change', function() {
            var zoneId = this.value;
            fetch(`/admin/get-governorates/${zoneId}`)
                .then(response => response.json())
                .then(data => {
                    var governorateSelect = document.getElementById('governorate');
                    governorateSelect.innerHTML =
                        '<option value="" disabled selected>Select a Governorate</option>';
                    data.forEach(governorate => {
                        governorateSelect.innerHTML +=
                            `<option value="${governorate.id}">${governorate.name}</option>`;
                    });
                });
        });

        // When governorate is selected, fetch related cities
        document.getElementById('governorate').addEventListener('change', function() {
            var governorateId = this.value;
            fetch(`/admin/get-cities/${governorateId}`)
                .then(response => response.json())
                .then(data => {
                    var citySelect = document.getElementById('city');
                    citySelect.innerHTML = '<option value="" disabled selected>Select a City</option>';
                    data.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });
                });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categorySelect = document.getElementById('category');
            var subcategorySelect = document.getElementById('subcategory');

            categorySelect.addEventListener('change', function() {
                var categoryId = this.value;

                // Fetch related subcategories for the selected category
                fetch(`/admin/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.innerHTML =
                            '<option value="" disabled selected>Select a Subcategory</option>';

                        data.forEach(subcategory => {
                            subcategorySelect.innerHTML +=
                                `<option value="${subcategory.id}">${subcategory.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
        integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if(auth()->user()->isMaster)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function connectSSE() {
                const source = new EventSource('/api/admin/SSE-get-notifications/{{ auth()->id() }}');

                source.onopen = function() {
                    // console.log('SSE connection established');
                };

                source.onerror = function(error) {
                    // console.error('SSE connection error:', error);
                    source.close();
                    // Attempt to reconnect after 5 seconds
                    setTimeout(connectSSE, 5000);
                };

                source.addEventListener('message', function(event) {
                    try {
                        const data = JSON.parse(event.data);
                        console.log('Received notification:', data);
                        // Handle the notification here (e.g., show toast notification)
                        showNotification(data.message, data.href);
                    } catch (error) {
                        console.error('Error parsing SSE data:', error);
                    }
                });
            }

            function showNotification(message, href) {
                Toastify({
                    text: '<a href="' + href + '" style="color: #fff" target="_blank">' + message + "</a>",
                    duration: 5000, // Set to -1 to make it persistent
                    close: true, // Allows the user to close the toast manually
                    gravity: "top", // Position from the top
                    position: 'right', // Position from the right
                    backgroundColor: "#301c3e", // Background color
                }).showToast();

            }

            // Example usage:
            connectSSE();
        });

        document.addEventListener('DOMContentLoaded', () => {
            const notificationsPopUp = document.querySelector('.notifications_pop_up');
            const showNotificationsButton = document.getElementById('show_notifications');
            let currentPage = 1; // Start on the first page
            let loading = false; // To prevent multiple requests at the same time

            // Function to fetch notifications
            const fetchNotifications = async (page) => {
                if (loading) return; // Prevent multiple requests
                loading = true;

                try {
                    const response = await fetch(`/api/get-admin-notifications?page=${page}`);
                    const data = await response.json();

                    if (data.data.length) {
                        data.data.forEach(notification => {
                            const notificationElement = document.createElement('a');
                            notificationElement.href = notification.href;
                            notificationElement.target = "_blank";
                            notificationElement.classList.add('notification');
                            notificationElement.textContent = notification
                            .msg; // Adjust according to your notification structure
                            notificationsPopUp.appendChild(notificationElement);
                        });
                    }

                    loading = false; // Reset loading state
                } catch (error) {
                    console.error('Error fetching notifications:', error);
                    loading = false; // Reset loading state
                }
            };

            // Show notifications on button click
            showNotificationsButton.addEventListener('click', () => {
                notificationsPopUp.classList.toggle('active'); // Toggle visibility
                if (notificationsPopUp.classList.contains('active')) {
                    fetchNotifications(currentPage); // Fetch the first page of notifications
                }
            });

            // Load more notifications on scroll
            notificationsPopUp.addEventListener('scroll', () => {
                if (notificationsPopUp.scrollTop + notificationsPopUp.clientHeight >= notificationsPopUp
                    .scrollHeight) {
                    currentPage++; // Increment page number
                    fetchNotifications(currentPage); // Fetch next page of notifications
                }
            });
        });
    </script>
    @endif

    @yield('scripts')

</body>

</html>
