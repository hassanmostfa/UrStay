@extends('layouts.add-unit')

@section('body-class', 'add-unit-body')

@section('title', 'اضافة وحده جديدة')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="login-card add_your_unit add_unit_now has-outline">
                    <div class="p-3">
                        <form action="{{ route('owner.addUnitAction') }}" enctype="multipart/form-data" method="POST"
                            id="multi-step-form">
                            @csrf

                            <!-- Name and Category -->
                            <div class=" step" id="step-1">
                                <h1>ﻧﻔّﺨَﺮ ﺑﺈﻧﻀِﻤﺎﻣﻚ ﻟﻴﻮرﺳﺘﺎي!</h1>
                                <p>ﺧﻄﻮات ﺑﺴﻴﻄﺔ وﻧﺴﺠﻞ وﺣﺪﺗﻚ ﻣﻌﻨﺎ</p>
                                <div class="">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="title" style="font-weight: 600; font-size: 18px"
                                                class="form-label">أدخِل اسماً رائعاً لعقارك الذي ترغب بإضافته</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="ادخل اسم العقار الذي سيظهر للضيوف" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="category" style="font-weight: 600; font-size: 18px"
                                                class="form-label">اﻟﺮﺟﺎء اﺧﺘﻴﺎر ﻧﻮع اﻟﻌﻘﺎر اﻟﺬي ﺗﺮﻏﺐ ﺑﺈﺿﺎﻓﺘﺔ</label>
                                            <div
                                            class="radios"
                                                style="display: flex;flex-wrap: wrap;  justify-content: center; align-items: center; gap: 40px">
                                                @foreach ($categories as $category)
                                                    <div>
                                                        <!-- Radio input for category selection -->
                                                        <input type="radio" class="btn-check" name="category"
                                                            id="category_{{ $category->id }}" value="{{ $category->name }}"
                                                            required>

                                                        <!-- Label acts as the card and shows the category name -->
                                                        <label class="category-card  text-white"
                                                            for="category_{{ $category->id }}">
                                                            {{ $category->name }}
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
                                            background-size: cover;
                                            border-radius: 8px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            font-size: 20px;
                                            font-weight: 500;
                                            transition: all 0.3s ease-in;
                                            color: white;
                                            overflow: hidden;
                                            background: #ffffff;
                                            color: #681a37 !important;
                                            font-family: MainFont;
                                            padding: 8px 24px;
                                            border: 1px solid #fff;
                                        }

                                        .category-card span {
                                            position: relative;
                                            z-index: 1000;
                                        }

                                        /* Hover effect for cards */
                                        .category-card:hover {
                                            background: #681a37;
                                            color: #fff !important;
                                        }

                                        /* Styling for the selected card (when radio button is checked) */
                                        input[type="radio"]:checked+.category-card {
                                            /* Add a blue shadow */
                                            background: #681a37;
                                            color: #fff !important;
                                        }
                                    </style>

                                    <!-- Navigation Buttons -->
                                    <div class="row">
                                        <div class="col-md-12" style="direction: ltr; margin-top: 20px;">
                                            <button type="button" class="next-btn" data-next-step="2"
                                                style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Location -->
                            <div class="step" id="step-2" style="display: none;">
                                <h1>ﺣَﺪِد ﻋﻨـــﻮان ﻋﻘــــﺎرك!</h1>
                                <p style="margin-bottom: 24px !important">اﺿﺎﻓـــﺔ ﻋﻨﻮاﻧﻚ ﺻﺎر أﺳﻬﻞ</p>
                                <div class="">
                                    <div class="row mb-3">
                                        <div class="col-md-12 text-right">
                                            <button type="button" class="get-loc-btn" onclick="getCurrentLocation()"
                                                style="">إحضار موقعي الحالي</button>
                                        </div>
                                    </div>



                                    <div class="map_wrapper">
                                        <label for="location"
                                            style="font-weight: 600; margin-right: 20px; font-size: 25px !important;margin-right: 0;margin-bottom: 16px !important;"
                                            class="form-label">ﺣﺪد ﻋﻘﺎرك ﻣﻦ الخرﻳﻄﺔ</label>
                                        <div id="map" style="height: 500px; width: 100%;"></div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="address" name="location"
                                                    style="color: #fff;   background: transparent;text-align: center;padding: 0 !important;margin: 0 !important;"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="3"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="1"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>
                            <!-- Card 3 -->
                            <div class="step" id="step-3" style="display: none;">
                                <h1>ﺣَﺪِد ﻋﻨـــﻮان ﻋﻘــــﺎرك!</h1>
                                <p style="margin-bottom: 24px !important">اﺿﺎﻓـــﺔ ﻋﻨﻮاﻧﻚ ﺻﺎر أﺳﻬﻞ</p>
                                <br>
                                <div class="">
                                    <!-- Row 2: City Selection and District Selection -->
                                    <div class="row">
                                        <div>
                                            @php
                                                $cities = \App\Models\City::all();
                                            @endphp
                                            <div class="select-wrapper">
                                                <label for="city" style="font-weight: 600; font-size: 18px"
                                                    class="form-label">المدينة</label>
                                                <select id="city" name="city_id" class="form-control" required>
                                                    <option value="" disabled selected>اختر المدينة</option>
                                                    @foreach ($cities as $item)
                                                        <option value="{{ $item->id }}" data-name="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                    <!-- Cities will be loaded dynamically based on the selected governorate -->
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="select-wrapper">
                                                <label for="district" style="font-weight: 600; font-size: 18px"
                                                    class="form-label">الحي</label>
                                                <select id="district" name="district_id" class="form-control" required>
                                                    <option value="" disabled selected>اختر الحي</option>
                                                    <!-- Districts will be loaded dynamically based on the selected city -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hidden Input to Store the Selected Names -->
                                    <input type="hidden" name="city_name" id="selected_city_name">
                                    <input type="hidden" name="district_name" id="selected_district_name">
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="4"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="2"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>


                            <!-- Card 4 -->
                            <div class=" step" id="step-4" style="display: none;">
                                <h1>ﺗﻔﺎﺻﻴﻞ اﻟﻌﻘـــــﺎر</h1>
                                <p>اﺿﻒ ﺗﻔﺎﺻﻴﻞ ﻋﻘﺎرك اﻻﺳﺎﺳﻴﺔ</p>
                                <div>

                                    <div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!-- Size -->
                                                <div class="mb-3">
                                                    <label for="size" style="font-weight: 600; font-size: 18px"
                                                        class="form-label">ﻣﺴﺎﺣﺔ اﻟﻌﻘﺎر ﺑﺎﻟﻤتر ﻣﺮﺑﻊ</label>
                                                    <input type="number" class="form-control" id="size"
                                                        name="size" placeholder="ادخل المساحة " required style="margin: 12px 0 32px !important;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="facilities" style="font-weight: 600; font-size: 18px;"
                                                class="form-label">ﺣﺪد ﻣﺮاﻓﻖ اﻟﻌﻘﺎر اﻻﺳﺎﺳﻴﺔ</label>
                                            <div class="d-flex flex-wrap" id="roomFacilitiesItems">
                                                <!-- Room facilities items cards will be inserted here -->
                                            </div>
                                            <div id="selectedRoomContainer"></div> <!-- Container for hidden inputs -->

                                            <!-- Button to add new facility input -->
                                            <button id="addFacilityBtn" type="button"
                                            style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
                                            اﺿﺎﻓﺔ ﻣﺮﻓﻖ آﺧﺮ
                                            <img src="{{ asset('/site/imgs/addinfo-14-14.png') }}" alt="">
                                            </button>

                                            <!-- Container to hold dynamic facility inputs -->
                                            <div id="facilityInputsContainer"></div>
                                        </div>


                                        <!-- Navigation Buttons -->
                                        <div class="row">
                                            <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                                <button type="button" class=" next-btn" data-next-step="5"
                                                    style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                                <button type="button" class=" prev-btn" data-prev-step="3"
                                                    style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- Card 5 -->
                            <div class="step" id="step-5" style="display: none;">
                                <h1>ﺗﻔﺎﺻﻴﻞ اﻟﻤﺮاﻓﻖ اﻟﻤُﺨﺘﺎرة</h1>
                                <p style="margin-bottom: 80px !important">اﺿﻒ ﺗﻔﺎﺻﻴﻞ اﻟﻤﺮاﻓﻖ اﻻﺳﺎﺳﻴﺔ</p>
                                <div class="d-flex gap-4 align-items-center mt-4 rmmb" style="flex-wrap: wrap;  justify-content: center;">
                                    <!-- Rooms -->
                                    <div class="mb-3">
                                        <label for="rooms" style="font-weight: 600; font-size: 18px"
                                            class="form-label">عدد الغرف</label>
                                        <div class="input-group inc-group">
                                            <button class="btn btn-outline-danger" type="button" id="decrement-rooms"><i
                                                    class="fa fa-minus" aria-hidden="true"></i></button>
                                            <input type="number"  style="margin: 0 !important"
                                                class="form-control text-center mx-3" id="rooms" name="rooms"
                                                placeholder="ادخل عدد الغرف" value="0" required>
                                            <button class="btn btn-outline-danger" type="button" id="increment-rooms"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                    <!-- No. of Single Beds -->
                                    <div class="mb-3">
                                        <label for="no_of_single_beds" style="font-weight: 600; font-size: 18px"
                                            class="form-label">عدد الاسرة المفردة</label>
                                        <div class="input-group inc-group">
                                            <button class="btn btn-outline-danger" type="button"
                                                id="decrement-single-beds"><i class="fa fa-minus"
                                                    aria-hidden="true"></i></button>
                                            <input type="number"  style="margin: 0 !important" class="form-control text-center mx-3"
                                                id="no_of_single_beds" name="no_of_single_beds"
                                                placeholder="ادخل عدد الاسرة المفردة" value="0" required>
                                            <button class="btn btn-outline-danger" type="button"
                                                id="increment-single-beds"><i class="fa fa-plus"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                    <!-- No. of Master Beds -->
                                    <div class="mb-3">
                                        <label for="no_of_master_beds" style="font-weight: 600; font-size: 18px"
                                            class="form-label">عدد الاسرة الماستر</label>
                                        <div class="input-group inc-group">
                                            <button class="btn btn-outline-danger" type="button"
                                                id="decrement-master-beds"><i class="fa fa-minus"
                                                    aria-hidden="true"></i></button>
                                            <input type="number"  style="margin: 0 !important" class="form-control text-center mx-3"
                                                id="no_of_master_beds" name="no_of_master_beds"
                                                placeholder="ادخل عدد الاسرة الماستر" value="0" required>
                                            <button class="btn btn-outline-danger" type="button"
                                                id="increment-master-beds"><i class="fa fa-plus"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                </div>
                                <!-- Navigation Buttons -->
                                <div class="row mt-4">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="6"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="4"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>
                                >
                            </div>
                            <!-- Card 6 -->
                            <div class=" step" id="step-6" style="display: none;">
                                <h1> تفاصيل المسبح (ان وجد) </h1>
                                <p style="margin-bottom: 80px !important">اﺿﻒ ﺗﻔﺎﺻﻴﻞ المسبح اﻻﺳﺎﺳﻴﺔ</p>
                                <div class="col-md-12 rmmb">


                                    <div class="col-md-4" style="  margin-bottom: 60px;">
                                        <!-- pool -->
                                        <div class="mb-3">
                                            <label for="pool" style="font-weight: 600; font-size: 18px"
                                                class="form-label">يوجد مسبح ؟</label>
                                            <select id="pool" name="pool" class="form-control" required>
                                                <option value="1">نعم</option>
                                                <option value="0">لا</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <!--pool_size-->
                                        <div class="mb-12">
                                            <label for="pool_size" style="font-weight: 600; font-size: 18px"
                                                class="form-label">مساحة المسبح (ان وجد)</label>
                                            <input type="text" class="form-control" id="pool_size" name="pool_size"
                                                placeholder="ادخل مساحة المسبح">
                                        </div>
                                    </div>
                                </div>


                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="7"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="5"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>

                            <!-- Card 7 -->
                            <div class=" step" id="step-7" style="display: none;">
                                <h1>ﺗﻔﺎﺻﻴﻞ المطبخ</h1>
                                <p>اﺿﻒ ﺗﻔﺎﺻﻴﻞ ﻋﻘﺎرك اﻻﺳﺎﺳﻴﺔ</p>

                                <div class="col-md-12">
                                    <!-- No of Table Chairs -->
                                    <div class="mb-3" style="width: max-content;margin-bottom: 50px !important;">
                                        <label for="table_chairs" style="font-weight: 600; font-size: 18px;font-size: 18px !important;text-align: center;margin-bottom: 10px !important;"
                                            class="form-label">عدد كراسي طاولة الطعام</label>
                                        <div class="input-group inc-group">
                                            <button class="btn btn-outline-danger" type="button"
                                                id="decrement-table-chairs"><i class="fa fa-minus"></i></button>
                                            <input type="number"  style="margin-bottom: 0 !important" class="form-control text-center mx-3" id="table_chairs"
                                                name="table_chairs" placeholder="ادخل عدد كراسي طاولة الطعام"
                                                value="0" required>
                                            <button class="btn btn-outline-danger" type="button"
                                                id="increment-table-chairs"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>


                                    <!-- Kitchen (JSON) -->
                                    <div class="mb-3">
                                        <label for="kitchen" style="font-weight: 600; font-size: 18px"
                                            class="form-label">مرافق المطبخ</label>
                                        <div class="d-flex flex-wrap" id="kitchenItems">
                                            <!-- Kitchen items cards will be inserted here -->
                                        </div>
                                        <!-- <small class="form-text text-muted">اختر المرافق التي ترغب بها</small> -->
                                        <input type="hidden" id="kitchen" name="kitchen[]">

                                        <!-- Button to add new kitchen input -->
                                        <button id="addKitchenBtn" type="button"                                             style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
                                            اﺿﺎﻓﺔ ﻣﺮﻓﻖ آﺧﺮ
                                            <img src="{{ asset('/site/imgs/addinfo-14-14.png') }}" alt="">
                                        </button>

                                        <!-- Container to hold dynamic kitchen inputs -->
                                        <div id="kitchenInputsContainer"></div>
                                    </div>

                                    <style>
                                        .selected-item {
                                            border-radius: 8px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            font-size: 22px !important;
                                            font-weight: 500;
                                            transition: all 0.3s ease-in;
                                            color: white;
                                            overflow: hidden;
                                            background: #ffffff;
                                            background-color: rgb(255, 255, 255);
                                            color: #681a37;
                                            font-family: MainFont;
                                            padding: 15px 24px !important;
                                            border: 1px solid #fff;
                                        }

                                        .selected-item p {
                                            margin: 0;
                                        }
                                    </style>
                                </div>
                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="8"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="6"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>

                            <!-- Card 8 -->
                            <div class=" step" id="step-8" style="display: none;">
                                <h1> تفاصيل دورات المياة </h1>
                                <p>اﺿﻒ ﺗﻔﺎﺻﻴﻞ ﻋﻘﺎرك اﻻﺳﺎﺳﻴﺔ</p>

                                <div class="col-md-4">
                                    <!-- Bathrooms -->
                                    <div class="mb-3" style="width: max-content;margin-bottom: 50px !important;">
                                        <label for="bathrooms" style="font-weight: 600; font-size: 18px;font-size: 18px !important;text-align: center;margin-bottom: 10px !important;"
                                            class="form-label">عدد الحمامات</label>
                                        <div class="input-group inc-group">
                                            <button class="btn btn-outline-danger" type="button"
                                                id="decrement-bathrooms"><i class="fa fa-minus"></i></button>
                                            <input type="number"  style="margin-bottom: 0 !important" class="form-control text-center mx-3" id="bathrooms"
                                                name="bathrooms"  value="0">
                                            <button class="btn btn-outline-danger" type="button"
                                                id="increment-bathrooms"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>


                                <!-- Bathroom Facilities Section -->
                                <div class="mb-3">
                                    <label for="bathroom_facilities" style="font-weight: 600; font-size: 18px;"
                                        class="form-label">مرافق الحمام</label>
                                    <div class="d-flex flex-wrap" id="bathroomFacilitiesItems">
                                        <!-- Bathroom facilities items cards will be inserted here -->
                                    </div>
                                    <div id="selectedBathroomContainer"></div> <!-- Container for hidden inputs -->

                                    <!-- Button to add new bathroom facility input (Arabic) -->
                                    <button id="addBathroomFacilityBtn" type="button"                                          style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
                                        اﺿﺎﻓﺔ ﻣﺮﻓﻖ آﺧﺮ
                                        <img src="{{ asset('/site/imgs/addinfo-14-14.png') }}" alt="">
                                    </button>

                                    <!-- Container to hold dynamic bathroom facilities inputs -->
                                    <div id="bathroomFacilitiesInputsContainer"></div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="9"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="7"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>

                            <!-- Card 9 for Additional Facilities -->
                            <div class=" step" id="step-9" style="display: none;">
                                <h1>ﺗﻔﺎﺻﻴﻞ اﻟﻤﺮاﻓﻖ اﻹﺿﺎﻓﻴﺔ </h1>
                                <p>اﺿﻒ ﺗﻔﺎﺻﻴﻞ اﻟﻤﺮاﻓﻖ اﻹﺿﺎﻓﻴﺔ</p>

                                <div class="mb-3">
                                    <label for="additional_facilities" style="font-weight: 600; font-size: 18px;"
                                        class="form-label">المرافق الإضافية</label>
                                    <div class="d-flex flex-wrap" id="additionalFacilitiesItems">
                                        <!-- Additional facilities items cards will be inserted here -->
                                    </div>
                                    <div id="selectedAdditionalContainer"></div> <!-- Container for hidden inputs -->

                                    <!-- Button to add new additional facility input (Arabic) -->
                                    <button id="addAdditionalFacilityBtn" type="button"
                                    style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
                                        اﺿﺎﻓﺔ ﻣﺮﻓﻖ آﺧﺮ
                                        <img src="{{ asset('/site/imgs/addinfo-14-14.png') }}" alt="">
                                    </button>


                                    <!-- Container to hold dynamic additional facilities inputs -->
                                    <div id="additionalFacilitiesInputsContainer"></div>
                                </div>


                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="10"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="8"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>


                            <!-- Card 10 -->
                            <div class="step" id="step-10" style="display: none;">
                                <h1> مميزات العقار  </h1>
                                <p>اﺿﻒ مميزات العقار</p>

                                <div class="mb-3">
                                    <label class="form-label">اختر المزايا:</label>
                                    <div id="advantagesItems" class="d-flex flex-wrap"></div>

                                    <!-- Container to hold hidden inputs -->
                                    <div id="selectedAdvantagesContainer"></div>

                                    <!-- Button to add new advantage input (Arabic) -->
                                    <button id="addAdvantageBtn" type="button"
                                    style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
                                        اﺿﺎﻓﺔ ﻣﺮﻓﻖ آﺧﺮ
                                        <img src="{{ asset('/site/imgs/addinfo-14-14.png') }}" alt="">
                                    </button>

                                    <!-- Container to hold dynamic advantage inputs -->
                                    <div id="advantagesInputsContainer"></div>
                                </div>
                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                        <button type="button" class=" next-btn" data-next-step="11"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                        <button type="button" class=" prev-btn" data-prev-step="9"
                                            style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                    </div>
                                </div>

                            </div>
                            <!-- Card 11 -->
                            <div class="step" id="step-11" style="display: none;">
                                <h1>ﺻُــﻮر اﻟﻌﻘـــــــــﺎر </h1>
                                <p>ﺻﻮر اﻟﻌﻘﺎر اﻻﺳﺎﺳﻴﺔ واﻟﻤﺮاﻓﻖ اﻟتي ﺗﻢ أﺧﺘﻴﺎرﻫﺎ</p>
                                <div>
                                    <div class="mb-3">
                                        <h3>يرجى رفع صورة واحدة على الأقل لكل من الآتي حتى تكتمل عملية التسجيل</h3>
                                        <!-- Main Property Images -->
                                        <div class="files-input-wrapper">
                                        <div class="file-input-group">
                                            <div class="mb-3">
                                                <label for="image" style="font-weight: 600; font-size: 18px"
                                                    class="form-label">
                                                    ﺻﻮر اﻟﻌﻘﺎر اﻷﺳﺎﺳﻴﺔ اﻟتي ﺳﺘﻈﻬﺮ ﻟﻀﻴﻮف
                                                    <div class="file">
                                                        إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                    </div>
                                                </label>
                                                <input type="file" class="form-control" id="image" name="images[]"
                                                    multiple required>
                                            </div>

                                            <!-- Preview Container for Main Property Images -->
                                            <div id="main_image_preview" class="d-flex flex-wrap mt-3"></div>
                                        </div>

                                        <!-- Rooms Images -->
                                        <div class="file-input-group">

                                        <div class="mb-3">
                                            <label for="rooms_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                صور الغرف
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="rooms_images"
                                                name="rooms_images[]" multiple required>
                                        </div>

                                        <!-- Preview Container for Room Images -->
                                        <div id="room_image_preview" class="row"></div>
                                    </div>


                                    <div class="file-input-group">

                                        <!-- Kitchen Images -->
                                        <div class="mb-3">
                                            <label for="kitchen_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                صور المطبخ
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="kitchen_images"
                                                name="kitchen_images[]" multiple required>
                                        </div>

                                        <!-- Preview Container for Kitchen Images -->
                                        <div id="kitchen_image_preview" class="row"></div>
                                    </div>

                                    <div class="file-input-group">

                                        <!-- Pool Images -->
                                        <div class="mb-3">
                                            <label for="pool_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                صور المسبح
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="pool_images"
                                                name="pool_images[]" multiple>
                                        </div>

                                        <!-- Preview Container for Pool Images -->
                                        <div id="pool_image_preview" class="row"></div>
                                    </div>

                                    <div class="file-input-group">

                                        <!-- Bathrooms Images -->
                                        <div class="mb-3">
                                            <label for="bathroom_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                صور الحمامات
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="bathroom_images"
                                                name="bathroom_images[]" multiple required>
                                        </div>

                                        <!-- Preview Container for Bathrooms Images -->
                                        <div id="bathroom_image_preview" class="row"></div>
                                    </div>

                                    <div class="file-input-group">

                                        <!-- Building Images -->
                                        <div class="mb-3">
                                            <label for="building_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                صور المبني
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="building_images"
                                                name="building_images[]" multiple required>
                                        </div>

                                        <!-- Preview Container for Building Images -->
                                        <div id="building_image_preview" class="row"></div>
                                    </div>

                                    <div class="file-input-group">
                                        <!-- facilities images -->
                                        <div class="mb-3">
                                            <label for="facilities_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                ﺻﻮر اﻟﻤﺮاﻓﻖ اﻻﺿﺎﻓﻴﺔ ﻟﻌﻘﺎرك : ﻣﺼﻌﺪ ، اﻃﻼﻟﺔ، ﻏﺮﻓﺔ أﻣﻦ وﻏيرﻫﺎ
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="facilities_images"
                                                name="facilities_images[]" multiple required>
                                        </div>

                                        <!-- Preview Container for Facilities Images -->
                                        <div id="facilities_image_preview" class="row"></div>
                                    </div>

                                    <div class="file-input-group">
                                        <!-- Additional Images -->
                                        <div class="mb-3">
                                            <label for="additional_images" style="font-weight: 600; font-size: 18px"
                                                class="form-label">
                                                ﺻﻮر اﻟﻤﺰاﻳﺎ اﻻﺿﺎﻓﻴﺔ ﻟﻌﻘﺎرك : اﻟﻌﺎب اﻃﻔﺎل ، ﻏﺮﻓﺔ ﺳﺎﺋﻖ ، وﻏيرﻫﺎ
                                                <div class="file">
                                                    إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                </div>
                                            </label>
                                            <input type="file" class="form-control" id="additional_images"
                                                name="additional_images[]" multiple>
                                        </div>

                                        <!-- Preview Container for Additional Images -->
                                        <div id="additional_image_preview" class="row"></div>
                                    </div>
                                    </div>

                                        <!-- Navigation Buttons -->
                                        <div class="row">
                                            <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                                <button type="button" class=" next-btn" data-next-step="12"
                                                    style=" color: #fff; padding: 10px 30px 10px 30px;">التالي</button>
                                                <button type="button" class=" prev-btn" data-prev-step="10"
                                                    style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Card 12 -->
                            <div class="step" id="step-12" style="display: none;">
                                <h1> الخطوة الاخيرة  </h1>
                                <p>اكمل اخر خطوة</p>
                                <div class="">
                                    <div class="">
                                        <div class="row">

                                            <div class="form-group mb-3">
                                                <label for="has_mot_permission"
                                                    style="font-weight: 600; font-size: 18px">هل لديك تصريح من وزارة
                                                    السياحة؟</label>
                                                <div class="d-flex gap-4">
                                                    <label for="has_mot_permission" class="radio">
                                                        <input type="radio" name="has_mot_permission" id="has_mot_permission" value="1"
                                                            onclick="toggleFileInput()" required> نعم
                                                    </label>
                                                    <label for="has_mot_permission_2" class="radio">
                                                        <input type="radio" name="has_mot_permission" id="has_mot_permission_2" value="0"
                                                            onclick="toggleFileInput()" required> لا
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- File input (hidden by default) -->
                                            <div class="file-input-group" id="fileInput" class="mb-3"
                                                style="display: none;">
                                                <label for="file_upload" class="form-label" style="width: 250px">
                                                    ارفق التصريح
                                                    <div class="file">
                                                        إﺧﺘﻴﺎر ﻣﻠــــﻒ
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 5l0 14"></path> <path d="M5 12l14 0"></path> </svg>
                                                    </div>
                                                    <input type="file" class="form-control" style="display: none" name="mot_permission"
                                                        id="file_upload">
                                                </label>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-3">
                                                <label for="description" style="font-weight: 600; font-size: 18px"
                                                    class="form-label mt-2">وصف العقار</label>
                                                <textarea class="form-control" id="description" name="description" style="height: 200px;width: 100%; margin-right: 0 !important"
                                                    placeholder="ادخل وصف مميز لعقارك"></textarea>
                                            </div>

                                            <!-- Submit Button -->

                                            <div class="col-md-12 d-flex gap-3" style="direction: ltr; margin-top: 20px;">
                                                <button type="submit" class="submit-btn">تاكيد</button>
                                                <button type="button" class="prev-btn" data-prev-step="11"
                                                    style=" color: #fff; padding: 10px 30px 10px 30px;">السابق</button>
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
    </div>

    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const currentLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        // نقل الخريطة إلى موقع المستخدم
                        map.setCenter(currentLocation);
                        map.setZoom(15);

                        // وضع علامة (ماركر) على موقع المستخدم
                        if (marker) {
                            marker.setPosition(currentLocation);
                        } else {
                            marker = new google.maps.Marker({
                                position: currentLocation,
                                map: map,
                            });
                        }

                        // الحصول على العنوان بناءً على الموقع
                        geocodeLatLng(currentLocation);
                    },
                    (error) => {
                        alert("فشل في الحصول على الموقع: " + error.message);
                    }
                );
            } else {
                alert("المتصفح لا يدعم خاصية تحديد الموقع الجغرافي.");
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
    const confirmAddressButton = document.getElementById('confirm-address');
        const nextButton = document.querySelector('.next-btn[data-next-step="3"]');

        confirmAddressButton.addEventListener('click', function() {
            nextButton.disabled = false;  // تفعيل زر التالي
        });
        });
                    // When city is selected, fetch related districts
            document.getElementById('city').addEventListener('change', function() {
                var cityId = this.value;
                var cityName = this.options[this.selectedIndex].getAttribute('data-name');

                // Set city name in hidden input
                document.getElementById('selected_city_name').value = cityName;

                fetch(`/owner/get-districts/${cityId}`)
                    .then(response => response.json())
                    .then(data => {
                        var districtSelect = document.getElementById('district');
                        districtSelect.innerHTML =
                            '<option value="" disabled selected>اختر الحي</option>';
                        data.forEach(district => {
                            districtSelect.innerHTML +=
                                `<option value="${district.id}" data-name="${district.name}">${district.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            });

            // When district is selected, set the district name in hidden input
            document.getElementById('district').addEventListener('change', function() {
                var districtName = this.options[this.selectedIndex].getAttribute('data-name');
                document.getElementById('selected_district_name').value = districtName;
            });

    </script>
    @if ($errors->any())
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    Toastify({
                        text: "{{ $error }}",
                        duration: 6000, // Duration in milliseconds
                        gravity: "top", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "#e04e5c",
                    }).showToast();
                @endforeach
            });
        </script>
    @endif

@endsection
