@extends('supervisor.mainComponents')

@section('title', 'اضافة وحده جديدة')

@section('link_one', 'الوحدات')
@section('link_two', 'اضافة وحده جديدة')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <!-- <div class="card-header text-white font-weight-bold py-2" style="background: #88304e;">
                    <h4 class="my-0">Add New Unit</h4>
                </div> -->
                <div class="p-3">
                    <form action="{{ route('manage.owner.addUnitAction', ['owner' => $owner->id]) }}" enctype="multipart/form-data" method="POST" id="multi-step-form">
                        @csrf

                <!-- Card 1 -->
                <div class="card mb-3 bg-white step" id="step-1">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                             معلومات العقار
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </h2>
                    <div class="card-body p-0 shadow-none">
                        <!-- Row 1: Title -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="title" style="font-weight: 600; font-size: 18px" class="form-label">1 - اسم العقار</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="ادخل اسم العقار الذي سيظهر للضيوف" required>
                            </div>
                        </div>

                        <!-- Row 2: Category -->

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="category" style="font-weight: 600; font-size: 18px" class="form-label">2 - التصنيف</label>
                                <p class="text-muted" style="font-size: 16px; font-weight: 700">اختر التصنيف المناسب</p>
                                <div class="row">
    @foreach($categories as $category)
        <div class="col-md-3 mb-3">
            <!-- Radio input for category selection -->
            <input type="radio" class="btn-check" name="category" id="category_{{ $category->id }}" value="{{ $category->name }}" required>

            <!-- Label acts as the card and shows the category name -->
            <label class="category-card p-3 text-white" for="category_{{ $category->id }}"
                style="background: url('{{'http://127.0.0.1:8000/' . $category->image?? 'https://img.gathern.co/1400x0/1/aLZQa83sN5QHZITxazgIcs2c3y9CzeHx.jpeg' }}') no-repeat center center; background-size: cover; border-radius: 10px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">
                <span class="text-white p-2" style="background: #27232357; border-radius: 5px;">{{ $category->name }}</span>
            </label>
        </div>
    @endforeach
</div>
                            </div>
                        </div>
    <!-- CSS to style the cards -->
    <style>
        /* Default card styling */
        .category-card {
            position: relative;
            background: url('{{ $category->image ?? 'https://via.placeholder.com/300' }}') no-repeat center center;
            background-size: cover;
            border-radius: 10px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            color: white;
            overflow: hidden; /* Ensures the overlay doesn't spill out of the card */
        }

        /* Light overlay using a pseudo-element */
        /* .category-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgb(72 69 69 / 21%);
            z-index: 1;
        } */

        /* Ensuring the text appears on top of the overlay */
        .category-card span {
            position: relative;
            z-index: 1000;
        }
        /* Hover effect for cards */
        .category-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Styling for the selected card (when radio button is checked) */
        input[type="radio"]:checked + .category-card {
            border: 3px solid #007bff; /* Highlight the selected card with a blue border */
            transform: scale(1.05); /* Slightly scale the card */
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.5); /* Add a blue shadow */
        }
    </style>


                            <!-- Row 2: Category and Subcategory -->
                            <!-- <div class="row mb-3">

                                <div class="col-md-6">
                                    <label for="subcategory" style="font-weight: 600; font-size: 18px" class="form-label">3 - التصنيف الفرعي</label>
                                    <select id="subcategory" name="subcategory_id" class="form-control" required>
                                        <option value="" disabled selected>اختر التصنيف الفرعي</option>
                                        Subcategories will be loaded dynamically based on the selected category
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="sub_subcategory" style="font-weight: 600; font-size: 18px" class="form-label">4 - التصنيف الفرعي الثاني</label>
                                    <select id="sub_subcategory" name="sub_subcategory_id" class="form-control">
                                        <option value="" disabled selected>اختر التصنيف الفرعي الثاني</option>
                                        Sub-subcategories will be loaded dynamically based on the selected subcategory
                                    </select>
                                </div>
                            </div> -->

                            <!-- Hidden Inputs to store names -->
                            <!-- <input type="hidden" id="category_name" name="category"> -->
                            <!-- <input type="hidden" id="subcategory_name" name="subcategory">
                            <input type="hidden" id="sub_subcategory_name" name="sub_sub_category"> -->

                        <!-- Navigation Buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn next-btn" data-next-step="2" style="background-color: #88304e; color: #fff">التالي</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Card 2 -->
                <div class="card mb-3 mt-0 bg-white step" id="step-2" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            عنوان العقار
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </h2>

                        <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="location" style="font-weight: 600; font-size: 18px" class="form-label">اختر عنوان العقار المناسب من الخريطة</label>
                                <input type="text" class="form-control" id="address" name="location" placeholder="مثال : الرياض " required>
                            </div>
                        </div>
                        <div id="map" style="height: 500px; width: 100%;"></div>
                    </div>



                        <!-- Row 3: Location -->
                        <!-- <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="location" style="font-weight: 600; font-size: 18px" class="form-label">اختر عنوان العقار المناسب من الخريطة</label>
                                <input type="text" class="form-control" id="address" name="location" placeholder="مثال : الرياض " required>
                            </div>
                        </div> -->

                      <!-- OSM Map container -->
                    <!-- <div id="map" style="height: 500px"></div> -->

                    <!-- Input fields for location details -->
                    <!-- <input type="text" id="latitude" name="latitude" placeholder="Latitude" hidden>
                    <input type="text" id="longitude" name="longitude" placeholder="Longitude" hidden> -->
                    <!-- <input type="text" id="address" name="address" placeholder="Full Address" class="form-control my-3"> -->
                    <!-- <input type="text" id="country" name="country" placeholder="Country">
                    <input type="text" id="state" name="state" placeholder="State"> -->
                    <!-- <input type="text" id="city" name="city" placeholder="City">
                    <input type="text" id="postcode" name="postcode" placeholder="Postal Code"> -->

                        <!-- Navigation Buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn  next-btn" data-next-step="3" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="1" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="card mb-3 mt-0 bg-white step" id="step-3" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            تاكيد عنوان العقار
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </h2>
                        <div class="card-body p-0 shadow-none">
    <!-- Row 1: Zone Selection and Governorate Selection -->
    <div class="row mb-3">
        <div class="col-md-12 mb-2">
            <label for="zone" style="font-weight: 600; font-size: 18px" class="form-label">1 - المنطقة</label>
            <select id="zone" name="zone_id" class="form-control" required>
                <option value="" disabled selected>اختر المنطقة</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" data-name="{{ $zone->name }}">{{ $zone->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-2">
            <label for="governorate" style="font-weight: 600; font-size: 18px" class="form-label">2 - المحافظة</label>
            <select id="governorate" name="governorate_id" class="form-control" required>
                <option value="" disabled selected>اختر المحافظة</option>
                <!-- Governorates will be loaded dynamically based on the selected zone -->
            </select>
        </div>
    </div>

    <!-- Row 2: City Selection and District Selection -->
    <div class="row">
        <div class="col-md-12 mb-2">
            <label for="city" style="font-weight: 600; font-size: 18px" class="form-label">3 - المدينة</label>
            <select id="city" name="city_id" class="form-control" required>
                <option value="" disabled selected>اختر المدينة</option>
                <!-- Cities will be loaded dynamically based on the selected governorate -->
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="district" style="font-weight: 600; font-size: 18px" class="form-label">4 - الحي</label>
            <select id="district" name="district_id" class="form-control" required>
                <option value="" disabled selected>اختر الحي</option>
                <!-- Districts will be loaded dynamically based on the selected city -->
            </select>
        </div>
    </div>

    <!-- Hidden Input to Store the Selected Names -->
    <input type="hidden" name="zone_name" id="selected_zone_name">
    <input type="hidden" name="governorate_name" id="selected_governorate_name">
    <input type="hidden" name="city_name" id="selected_city_name">
    <input type="hidden" name="district_name" id="selected_district_name">
</div>

                                <!-- Navigation Buttons -->
                                <button type="button" class="btn  next-btn" data-next-step="4" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="2" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>


                            <!-- Card 4 -->
                            <div class="card mb-3 mt-0 bg-white step" id="step-4" style="display: none;">
                            <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                تفاصيل العقار
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </h2>
                                <div class="card-body p-0 shadow-none">

                                    <div class="card-body p-0 shadow-none">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Size -->
                                            <div class="mb-3">
                                                <label for="size" style="font-weight: 600; font-size: 18px" class="form-label">1 - مساحة عقارك (بالمتر مربع) </label>
                                                <input type="number" class="form-control" id="size" name="size" placeholder="ادخل المساحة " required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="facilities" style="font-weight: 600; font-size: 18px;" class="form-label">مرافق العقار الاساسية</label>
                                        <div class="d-flex flex-wrap" id="roomFacilitiesItems">
                                            <!-- Room facilities items cards will be inserted here -->
                                        </div>
                                        <div id="selectedRoomContainer"></div> <!-- Container for hidden inputs -->

                                        <!-- Button to add new facility input -->
                                        <button id="addFacilityBtn" type="button" class="btn btn-outline-primary my-3"><i class="fa fa-plus mx-2" aria-hidden="true"></i>اضافة مرفق</button>

                                        <!-- Container to hold dynamic facility inputs -->
                                        <div id="facilityInputsContainer"></div>
                                    </div>


                                    <!-- Navigation Buttons -->
                                    <button type="button" class="btn next-btn" data-next-step="5" style="background-color: #88304e; color: #fff">التالي</button>
                                    <button type="button" class="btn prev-btn" data-prev-step="3" style="background-color: #88304e; color: #fff">السابق</button>
                                </div>
                            </div>

                            </div>
                            <!-- Card 5 -->
                        <div class="card mb-3 mt-0 bg-white p-3 step" id="step-5" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            تفاصيل غرف النوم

                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </h2>
                        <div class="col-md-12">
                                    <!-- Rooms -->
                                    <div class="mb-3">
                                        <label for="rooms" style="font-weight: 600; font-size: 18px" class="form-label">عدد الغرف</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger" type="button" id="decrement-rooms"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            <input type="number" style="width: 100px" class="form-control text-center mx-3" id="rooms" name="rooms" placeholder="ادخل عدد الغرف" value="0" required>
                                            <button class="btn btn-outline-danger" type="button" id="increment-rooms"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                    <!-- No. of Single Beds -->
                                    <div class="mb-3">
                                        <label for="no_of_single_beds" style="font-weight: 600; font-size: 18px" class="form-label">عدد الاسرة المفردة</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger" type="button" id="decrement-single-beds"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            <input type="number" class="form-control text-center mx-3" id="no_of_single_beds" name="no_of_single_beds" placeholder="ادخل عدد الاسرة المفردة" value="0" required>
                                            <button class="btn btn-outline-danger" type="button" id="increment-single-beds"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                    <!-- No. of Master Beds -->
                                    <div class="mb-3">
                                        <label for="no_of_master_beds" style="font-weight: 600; font-size: 18px" class="form-label">عدد الاسرة الماستر</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger" type="button" id="decrement-master-beds"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            <input type="number" class="form-control text-center mx-3" id="no_of_master_beds" name="no_of_master_beds" placeholder="ادخل عدد الاسرة الماستر" value="0" required>
                                            <button class="btn btn-outline-danger" type="button" id="increment-master-beds"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                </div>
                                <!-- Navigation Buttons -->
                                <button type="button" class="btn next-btn" data-next-step="6" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="4" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>
                         <!-- Card 6 -->
                         <div class="card mb-3 mt-0 bg-white p-3 step" id="step-6" style="display: none;">
                            <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                تفاصيل المسبح (ان وجد)

                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </h2>
                        <div class="col-md-12">


                            <div class="col-md-4">
                                            <!-- pool -->
                                            <div class="mb-3">
                                                <label for="pool" style="font-weight: 600; font-size: 18px" class="form-label">يوجد مسبح ؟</label>
                                                <select id="pool" name="pool" class="form-control" required>
                                                    <option value="1">نعم</option>
                                                    <option value="0">لا</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <!--pool_size-->
                                            <div class="mb-12">
                                                <label for="pool_size" style="font-weight: 600; font-size: 18px" class="form-label">مساحة المسبح (ان وجد)</label>
                                                <input type="text" class="form-control" id="pool_size" name="pool_size" placeholder="ادخل مساحة المسبح">
                                            </div>
                                        </div>
                                </div>


                                <!-- Navigation Buttons -->
                                <button type="button" class="btn next-btn" data-next-step="7" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="5" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>

                            <!-- Card 7 -->
                        <div class="card-body mb-3 mt-0 bg-white p-3 step" id="step-7" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            مرافق المطبخ

                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </h2>
                                <div class="col-md-12">
                                    <!-- No of Table Chairs -->
                                    <div class="mb-3">
                                        <label for="table_chairs" style="font-weight: 600; font-size: 18px" class="form-label">عدد كراسي طاولة الطعام</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger" type="button" id="decrement-table-chairs"><i class="fa fa-minus"></i></button>
                                            <input type="number" class="form-control text-center mx-3" id="table_chairs" name="table_chairs" placeholder="ادخل عدد كراسي طاولة الطعام" value="0" required>
                                            <button class="btn btn-outline-danger" type="button" id="increment-table-chairs"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>


                                <!-- Kitchen (JSON) -->
                                <div class="mb-3">
                                    <label for="kitchen" style="font-weight: 600; font-size: 18px" class="form-label">مرافق المطبخ</label>
                                    <div class="d-flex flex-wrap" id="kitchenItems">
                                        <!-- Kitchen items cards will be inserted here -->
                                    </div>
                                    <!-- <small class="form-text text-muted">اختر المرافق التي ترغب بها</small> -->
                                    <input type="hidden" id="kitchen" name="kitchen[]">

                                    <!-- Button to add new kitchen input -->
                                    <button id="addKitchenBtn" type="button" class="btn btn-outline-primary my-3"><i class="fa fa-plus mx-2"></i>اضافة مرفق</button>

                                    <!-- Container to hold dynamic kitchen inputs -->
                                    <div id="kitchenInputsContainer"></div>
                                </div>

        <style>
    .selected-item {
        border: 2px solid #88304e;
        width: 150px !important;
        border-radius: 12px;
        color: #88304e;
        font-weight: bold;
        width: 100px;
        text-align: center;
    }

    .selected-item p {
        margin: 0;
    }
</style>
                            </div>
                                <!-- Navigation Buttons -->
                                <button type="button" class="btn next-btn" data-next-step="8" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="6" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>

                        <!-- Card 8 -->
                        <div class="card mb-3 mt-0 bg-white p-3 step" id="step-8" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                             تفاصيل دورات المياة
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </h2>

                                <div class="col-md-4">
                                    <!-- Bathrooms -->
                                    <div class="mb-3">
                                        <label for="bathrooms" style="font-weight: 600; font-size: 18px" class="form-label">عدد الحمامات</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger" type="button" id="decrement-bathrooms"><i class="fa fa-minus"></i></button>
                                            <input type="number" class="form-control text-center mx-3" id="bathrooms" name="bathrooms" placeholder="ادخل عدد الحمامات" value="0">
                                            <button class="btn btn-outline-danger" type="button" id="increment-bathrooms"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>


                                <!-- Bathroom Facilities Section -->
                                <div class="mb-3">
                                <label for="bathroom_facilities" style="font-weight: 600; font-size: 18px;" class="form-label">مرافق الحمام</label>
                                <div class="d-flex flex-wrap" id="bathroomFacilitiesItems">
                                    <!-- Bathroom facilities items cards will be inserted here -->
                                </div>
                                <small class="form-text text-muted">اختر المرافق التي ترغب بها</small>
                                <div id="selectedBathroomContainer"></div> <!-- Container for hidden inputs -->

                                <!-- Button to add new bathroom facility input (Arabic) -->
                                <button id="addBathroomFacilityBtn" type="button" class="btn btn-outline-primary my-3"><i class="fa fa-plus mx-2"></i>إضافة مرفق حمام</button>

                                <!-- Container to hold dynamic bathroom facilities inputs -->
                                <div id="bathroomFacilitiesInputsContainer"></div>
                            </div>

                                <!-- Navigation Buttons -->
                                <button type="button" class="btn next-btn" data-next-step="9" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="7" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>

                            <!-- Card 9 for Additional Facilities -->
                            <div class="card mb-3 mt-0 bg-white p-3 step" id="step-9" style="display: none;">
                                    <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e;">
                                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                        مرافق العقار الاضافية  (اختياري)
                                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </h2>

                                    <div class="mb-3">
                                        <label for="additional_facilities" style="font-weight: 600; font-size: 18px;" class="form-label">المرافق الإضافية</label>
                                        <div class="d-flex flex-wrap" id="additionalFacilitiesItems">
                                            <!-- Additional facilities items cards will be inserted here -->
                                        </div>
                                        <small class="form-text text-muted">اختر المرافق التي ترغب بها</small>
                                        <div id="selectedAdditionalContainer"></div> <!-- Container for hidden inputs -->

                                        <!-- Button to add new additional facility input (Arabic) -->
                                        <button id="addAdditionalFacilityBtn" type="button" class="btn btn-outline-primary my-3"><i class="fa fa-plus mx-2"></i>إضافة مرفق إضافي</button>

                                        <!-- Container to hold dynamic additional facilities inputs -->
                                        <div id="additionalFacilitiesInputsContainer"></div>
                                    </div>


                                    <!-- Navigation Buttons -->
                                    <button type="button" class="btn next-btn" data-next-step="10" style="background-color: #88304e; color: #fff;">التالي</button>
                                    <button type="button" class="btn prev-btn" data-prev-step="8" style="background-color: #88304e; color: #fff;">السابق</button>
                                </div>


                                <!-- Card 10 -->
                        <div class="card mb-3 mt-0 bg-white p-3 step" id="step-10" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            مميزات العقار
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </h2>

                        <div class="mb-3">
                            <label class="form-label">اختر المزايا:</label>
                            <div id="advantagesItems" class="d-flex flex-wrap"></div>

                            <!-- Container to hold hidden inputs -->
                            <div id="selectedAdvantagesContainer"></div>

                            <!-- Button to add new advantage input (Arabic) -->
                            <button id="addAdvantageBtn" type="button" class="btn btn-outline-primary my-3"><i class="fa fa-plus mx-2"></i>إضافة ميزة</button>

                            <!-- Container to hold dynamic advantage inputs -->
                            <div id="advantagesInputsContainer"></div>
                        </div>
                                <!-- Navigation Buttons -->
                                <button type="button" class="btn next-btn" data-next-step="11" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="9" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>
                            <!-- Card 11 -->
                        <div class="card mb-3 mt-0 bg-white step" id="step-11" style="display: none;">
                            <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                صور العقار
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </h2>
                            <div class="card-body p-0 shadow-none">
                                <div class="mb-3">
                                    <h3>علي حسب خياراتك اثناء التسجيل مطلوب منك رفع صورة واحده علي الاقل لكل من الاتي : </h3>
                                    <hr/>
                                    <div class="mb-3">
                                        <ul>
                                            <li><span id="no_of_rooms"></span> صورة لغرفة النوم</li>
                                            <li><span>1</span> صورة للمطبخ </li>
                                            <li><span>1</span> صورة للمسبح</li>
                                            <li><span id ="no_of_bathrooms"></span>صورة لدورات المياة</li>
                                            <li><span>1</span> صورة للمبني</li>
                                            <li><span>1</span> صورة للمرافق</li>
                                        </ul>
                                </div>

                               <!-- Main Property Images -->
                                <div class="mb-3">
                                    <label for="image" style="font-weight: 600; font-size: 18px" class="form-label">صور العقار الاساسية التي ستظهر للضيوف</label>
                                    <input type="file" class="form-control" id="image" name="images[]" multiple required>
                                </div>

                                <!-- Preview Container for Main Property Images -->
                                <div id="main_image_preview" class="d-flex flex-wrap mt-3"></div>

                                <!-- Rooms Images -->
                                <div class="mb-3">
                                    <label for="rooms_images" style="font-weight: 600; font-size: 18px" class="form-label">صور الغرف</label>
                                    <input type="file" class="form-control" id="rooms_images" name="rooms_images[]" multiple required>
                                </div>

                                <!-- Preview Container for Room Images -->
                                <div id="room_image_preview" class="row"></div>


                                <!-- Kitchen Images -->
                                <div class="mb-3">
                                    <label for="kitchen_images" style="font-weight: 600; font-size: 18px" class="form-label">صور المطبخ</label>
                                    <input type="file" class="form-control" id="kitchen_images" name="kitchen_images[]" multiple required>
                                </div>

                                <!-- Preview Container for Kitchen Images -->
                                <div id="kitchen_image_preview" class="row"></div>


                                <!-- Pool Images -->
                                <div class="mb-3">
                                    <label for="pool_images" style="font-weight: 600; font-size: 18px" class="form-label">صور المسبح</label>
                                    <input type="file" class="form-control" id="pool_images" name="pool_images[]" multiple>
                                </div>

                                <!-- Preview Container for Pool Images -->
                                <div id="pool_image_preview" class="row"></div>

                                <!-- Bathrooms Images -->
                                <div class="mb-3">
                                    <label for="bathroom_images" style="font-weight: 600; font-size: 18px" class="form-label">صور الحمامات</label>
                                    <input type="file" class="form-control" id="bathroom_images" name="bathroom_images[]" multiple required>
                                </div>

                                <!-- Preview Container for Bathrooms Images -->
                                <div id="bathroom_image_preview" class="row"></div>

                                <!-- Building Images -->
                                <div class="mb-3">
                                    <label for="building_images" style="font-weight: 600; font-size: 18px" class="form-label">صور المبني</label>
                                    <input type="file" class="form-control" id="building_images" name="building_images[]" multiple required>
                                </div>

                                <!-- Preview Container for Building Images -->
                                <div id="building_image_preview" class="row"></div>


                                <!-- facilities images -->
                                <div class="mb-3">
                                    <label for="facilities_images" style="font-weight: 600; font-size: 18px" class="form-label">صور المرافق</label>
                                    <input type="file" class="form-control" id="facilities_images" name="facilities_images[]" multiple required>
                                </div>

                                <!-- Preview Container for Facilities Images -->
                                <div id="facilities_image_preview" class="row"></div>


                                <!-- Additional Images -->
                                <div class="mb-3">
                                    <label for="additional_images" style="font-weight: 600; font-size: 18px" class="form-label">صور اضافية</label>
                                    <input type="file" class="form-control" id="additional_images" name="additional_images[]" multiple>
                                </div>

                                <!-- Preview Container for Additional Images -->
                                <div id="additional_image_preview" class="row"></div>

                                <!-- Navigation Buttons -->
                                 <div></div>
                                <button type="button" class="btn next-btn" data-next-step="12" style="background-color: #88304e; color: #fff">التالي</button>
                                <button type="button" class="btn prev-btn" data-prev-step="10" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>
                        </div>

                        </div>

                        <!-- Card 12 -->
                    <div class="card mb-3 mt-0 bg-white step" id="step-12" style="display: none;">
                        <h2 class="text-center mt-0 mb-2 border-bottom pb-2" style="font-weight: 800; font-size: 22px; color: #88304e" >
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                            الخطوة الاخيرة
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </h2>
                        <div class="card-body p-0 shadow-none">
                        <div class="card-body p-0 shadow-none">
                            <div class="row">

                            <div class="form-group mb-3">
                                <label for="has_mot_permission"  style="font-weight: 600; font-size: 18px">هل لديك تصريح من وزارة السياحة؟</label>
                                <div>
                                    <label>
                                        <input type="radio" name="has_mot_permission" value="1" onclick="toggleFileInput()"> نعم
                                    </label>
                                    <label>
                                        <input type="radio" name="has_mot_permission" value="0" onclick="toggleFileInput()"> لا
                                    </label>
                                </div>
                            </div>

                            <!-- File input (hidden by default) -->
                            <div class="form-group" id="fileInput" class="mb-3" style="display: none;">
                                <label for="file_upload">ارفق التصريح</label>
                                <input type="file" class="form-control" name="mot_permission" id="file_upload">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" style="font-weight: 600; font-size: 18px" class="form-label mt-2">وصف العقار</label>
                                <textarea class="form-control" id="description" name="description" rows="9" placeholder="ادخل وصف مميز لعقارك"></textarea>
                            </div>

                            <!-- Submit Button -->

                            <div class="d-flex justify-content-start mt-3 gap-3">
                                <button type="submit" class="btn" style="background-color:transparent ; color: #88304e; border: 1px solid #88304e; font-weight: 600">تاكيد</button>
                                <button type="button" class="btn prev-btn" data-prev-step="11" style="background-color: #88304e; color: #fff">السابق</button>
                            </div>
                        </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
