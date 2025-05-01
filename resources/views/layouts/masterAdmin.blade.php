<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/site/imgs/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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

    <link rel="stylesheet" href="{{ asset('/site/css/main.css') }}?v={{ time() }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL0mf-wYCEO4N6xNkiJaau55bfRxdB4yk&libraries=places"></script>

    <title>Urstay | @yield('title')</title>
</head>

<body>

    <div class="main-conent">
        <nav id="menu" class="nav-main" role="navigation">
            @if(Auth::guard('admin')->user()->isMaster)
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
                        <li class="d-flex align-items-center">
                            <a class="nav-link" href="{{ route('admin.zones') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                المناطق
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.governorates') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                المحافظات
                            </a>
                        </li>
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
                <li class="nav-parent">
                    <a class="nav-link" href="#">
                    <i class="fa fa-building" aria-hidden="true"></i>
                        <span>الوحدات</span>
                    </a>
                    <ul class="nav nav-children">
                        <li>
                            <a class="nav-link" href="{{ route('admin.allUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                كل الوحدات
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.getApprovedUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الوحدات المعتمدة
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ route('admin.newUnitsRequests') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الطلبات الجديدة
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ route('admin.updatedUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الطلبات المحدثة
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ route('admin.rejectedUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الطلبات المرفوضة
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Units -->
                <li class="nav-parent">
                    <a class="nav-link" href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                        <span>المشرفين</span>
                    </a>
                    <ul class="nav nav-children">
                        <li>
                            <a class="nav-link" href="{{ route('admin.supervisors') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                كل المشرفين
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-parent">
                    <a class="nav-link" href="#">
                    <i class="fa fa-user-shield" aria-hidden="true"></i>
                        <span>المسؤولين</span>
                    </a>
                    <ul class="nav nav-children">
                        <li>
                            <a class="nav-link" href="{{ route('admins.index') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                كل المسؤولين
                            </a>
                        </li>
                    </ul>
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

                <!-- Units -->
                <li class="nav-parent">
                    <a class="nav-link" href="#">
                    <i class="fa fa-building" aria-hidden="true"></i>
                        <span>الوحدات</span>
                    </a>
                    <ul class="nav nav-children">
                        <li>
                            <a class="nav-link" href="{{ route('admin.allUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                كل الوحدات
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.getApprovedUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الوحدات المعتمدة
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ route('admin.newUnitsRequests') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الطلبات الجديدة
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ route('admin.updatedUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الطلبات المحدثة
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ route('admin.rejectedUnits') }}">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                الطلبات المرفوضة
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
            @endif
        </nav>

        @include('includes.master-header')
        @yield('content')
        @include('includes.admin-footer')
    </div>


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
                        governorateSelect.innerHTML = '<option value="" disabled selected>Select a Governorate</option>';
                        data.forEach(governorate => {
                            governorateSelect.innerHTML += `<option value="${governorate.id}">${governorate.name}</option>`;
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
                        subcategorySelect.innerHTML = '<option value="" disabled selected>Select a Subcategory</option>';

                        data.forEach(subcategory => {
                            subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            });
        });
        </script>

        @yield('scripts')

</body>

</html>
