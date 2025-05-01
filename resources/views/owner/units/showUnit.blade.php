@extends('layouts.admin')

@section('title', 'تفاصيل الوحدة')

@section('link_one', 'الوحدات')
@section('link_two', 'تفاصيل الوحدة')

@section('content')
<div class="container mt-2 bg-white p-3">
    {{-- <!-- Buttons bar -->
    <div class="btn-group w-100 gap-2 d-flex justify-content-center my-3" role="group">
        <button type="button" class="btn btn-outline-primary" id="btn1">بيانات الوحدة</button>
        <button type="button" class="btn btn-outline-primary" id="btn2">استكمال بيانات الوحدة</button>
        <button type="button" class="btn btn-outline-primary" id="btn3">رابط جديد</button>
    </div> --}}

    <!-- Divs to be toggled -->
    <div class="mt-3">
        <div id="div3" class="content-div active-div" style="display: block;"> <!-- Default visible with background -->
            <h3>Content of Div 1</h3>
            <p>This is the first div, displayed by default.</p>
        </div>

        <div id="div2" class="content-div">
            @if($unit->request_status == 'completed')
                <h3 class="text-center">تم استكمال بيانات الوحدة بنجاح</h3>
            @else
            <form action="{{ route('owner.completeUnit', $unit->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 pt-0">
                                    <label for="saturday_price">سعر يوم السبت</label>
                                    <input type="number" step="0.01" class="form-control" id="saturday_price" name="saturday_price" required>
                                </div>

                                <div class="form-group col-md-6 pt-0">
                                    <label for="sunday_price">سعر يوم الأحد</label>
                                    <input type="number" step="0.01" class="form-control" id="sunday_price" name="sunday_price" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="monday_price">سعر يوم الاثنين</label>
                                    <input type="number" step="0.01" class="form-control" id="monday_price" name="monday_price" required>
                                </div>

                                <div class="form-group col-md-6 pt-0">
                                    <label for="tuesday_price">سعر يوم الثلاثاء</label>
                                    <input type="number" step="0.01" class="form-control" id="tuesday_price" name="tuesday_price" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="wednesday_price">سعر يوم الأربعاء</label>
                                    <input type="number" step="0.01" class="form-control" id="wednesday_price" name="wednesday_price" required>
                                </div>

                                <div class="form-group col-md-6 pt-0">
                                    <label for="thursday_price">سعر يوم الخميس</label>
                                    <input type="number" step="0.01" class="form-control" id="thursday_price" name="thursday_price" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="friday_price">سعر يوم الجمعة</label>
                                    <input type="number" step="0.01" class="form-control" id="friday_price" name="friday_price" required>
                                </div>

                                <div class="form-group col-md-6 pt-0">
                                    <label for="availability_of_booking">حالة الوحده</label>
                                    <select class="form-control" id="availability_of_booking" name="availability_of_booking" required>
                                        <option value="1">متاح</option>
                                        <option value="0">غير متاح</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="negotiable_price"> هل سعر قابل للتفاوض ؟</label>
                                    <select class="form-control" id="negotiable_price" name="negotiable_price" required>
                                        <option value="1">نعم</option>
                                        <option value="0">لا</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 pt-0">
                                    <label for="booking_status">نوع الحجز</label>
                                    <select class="form-control" id="booking_status" name="booking_status" required>
                                        <option value="immediate">فوري</option>
                                        <option value="previous_date">بموعد مسبق</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3">حفظ</button>
                            <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">اغلاق</button>

                        </form>
                        @endif
        </div>

        <div id="div1" class="content-div p-0">
            <div class="container mt-2">
            <div class="row">
                <div class="col-md-12 offset-md-2">
                    <div class="card">
                        <div class="card-header p-3 text-white" style="background-color: #88394E !important;">
                            <h3 class="my-0">الوحدة  رقم :  {{ $unit->id }}</h3>
                        </div>
                        <h2 style="font-family: MainFontbold">صور الوحدة</h2>
                        @php
                            $main_images = json_decode($unit->image, true) ?? []; // Decode JSON images
                            // Decode each field that contains JSON-encoded images
                            $roomsImages = json_decode($unit->rooms_images, true) ?? [];
                            $kitchenImages = json_decode($unit->kitchen_images, true) ?? [];
                            $poolImages = json_decode($unit->pool_images, true) ?? [];
                            $bathroomImages = json_decode($unit->bathroom_images, true) ?? [];
                            $buildingImages = json_decode($unit->building_images, true) ?? [];
                            $facilitiesImages = json_decode($unit->facilities_images, true) ?? [];
                            $additionalImages = json_decode($unit->additional_images, true) ?? [];

                            // Merge all images into a single array
                            $images = array_merge(
                                $main_images,
                                $roomsImages,
                                $kitchenImages,
                                $poolImages,
                                $bathroomImages,
                                $buildingImages,
                                $facilitiesImages,
                                $additionalImages,
                            );
                        @endphp

                        @include('admin.units.images')

                        <div class="card-body">
                            <div class="row">
                                <!-- Left side: Table for Unit Details -->
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>العنوان:</th>
                                            <td>{{ $unit->title }}</td>
                                        </tr>

                                        <tr>
                                            <th>التصنيف:</th>
                                            <td>{{ $unit->category }}</td>
                                        </tr>

                                        <!-- <tr>
                                            <th>التصنيف الفرعي:</th>
                                            <td>{{ $unit->sub_category }}</td>
                                        </tr>

                                        <tr>
                                            <th>التصنيف الفرعي الثاني:</th>
                                            <td>{{ $unit->sub_sub_category }}</td>
                                        </tr> -->

                                        <tr>
                                            <th>المساحة:</th>
                                            <td>{{ $unit->size }} متر مربع</td>
                                        </tr>

                                        <tr>
                                            <th>عدد الغرف:</th>
                                            <td>{{ $unit->rooms }}</td>
                                        </tr>

                                        <tr>
                                            <th>عدد الاسرة المفردة</th>
                                            <td>{{ $unit->no_of_single_beds }}</td>
                                        </tr>

                                        <tr>
                                            <th>عدد الاسرة الماستر</th>
                                            <td>{{ $unit->no_of_master_beds }}</td>
                                        </tr>

                                        <tr>
                                            <th>عدد الحمامات:</th>
                                            <td>{{ $unit->bathrooms }}</td>
                                        </tr>

                                        <tr>
                                    <th>مرافق الحمام:</th>
                                    <td>
                                        @php
                                            // Get bathroom facilities
                                            $facilities = $unit->bathroom_facilities;

                                            // Check if the facilities are an array or a JSON string
                                            if (is_array($facilities)) {
                                                // Already an array, no need to decode
                                            } elseif (is_string($facilities)) {
                                                // It's a JSON string, decode it
                                                $facilities = json_decode($facilities, true);
                                                // Check if decoding failed
                                                if (json_last_error() !== JSON_ERROR_NONE) {
                                                    $facilities = []; // Reset to empty array if decoding failed
                                                }
                                            } else {
                                                $facilities = []; // Not a string or array, set to empty array
                                            }
                                        @endphp

                                        @if (!empty($facilities))
                                            @foreach ($facilities as $facility)
                                                <div>
                                                    <span>{{ trim($facility) }}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>لا توجد مرافق</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>عدد كراسي طاولة الطعام</th>
                                    <td>{{ $unit->table_chairs }}</td>
                                </tr>

                                <tr>
                                    <th>مرافق المطبخ:</th>
                                    <td>
                                        @php
                                            // Get bathroom facilities
                                            $facilities = $unit->kitchen;

                                            // Check if the facilities are an array or a JSON string
                                            if (is_array($facilities)) {
                                                // Already an array, no need to decode
                                            } elseif (is_string($facilities)) {
                                                // It's a JSON string, decode it
                                                $facilities = json_decode($facilities, true);
                                                // Check if decoding failed
                                                if (json_last_error() !== JSON_ERROR_NONE) {
                                                    $facilities = []; // Reset to empty array if decoding failed
                                                }
                                            } else {
                                                $facilities = []; // Not a string or array, set to empty array
                                            }
                                        @endphp

                                        @if (!empty($facilities))
                                            @foreach ($facilities as $facility)
                                                <div>
                                                    <span>{{ trim($facility) }}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>لا توجد مرافق</span>
                                        @endif
                                    </td>
                                </tr>


                                        <tr>
                                            <th>مرافق اضافية:</th>
                                            <td>
                                                @php
                                                    // Get additional facilities
                                                    $facilities = $unit->additional_facilities;

                                                    // Check if the facilities are an array or a JSON string
                                                    if (is_array($facilities)) {
                                                        // Already an array, no need to decode
                                                    } elseif (is_string($facilities)) {
                                                        // It's a JSON string, decode it
                                                        $facilities = json_decode($facilities, true);
                                                        // Check if decoding failed
                                                        if (json_last_error() !== JSON_ERROR_NONE) {
                                                            $facilities = []; // Reset to empty array if decoding failed
                                                        }
                                                    } else {
                                                        $facilities = []; // Not a string or array, set to empty array
                                                    }
                                                @endphp

                                                @if (!empty($facilities))
                                                    @foreach ($facilities as $facility)
                                                        <div>
                                                            <span>{{ trim($facility) }}</span> <!-- Trim to remove extra spaces -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span>لا توجد مرافق</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>مميزات الوحده:</th>
                                            <td>
                                                @php
                                                    // Get advantages
                                                    $advantages = $unit->advantages;

                                                    // Check if the advantages are an array or a JSON string
                                                    if (is_array($advantages)) {
                                                        // Already an array, no need to decode
                                                    } elseif (is_string($advantages)) {
                                                        // It's a JSON string, decode it
                                                        $advantages = json_decode($advantages, true);
                                                        // Check if decoding failed
                                                        if (json_last_error() !== JSON_ERROR_NONE) {
                                                            $advantages = []; // Reset to empty array if decoding failed
                                                        }
                                                    } else {
                                                        $advantages = []; // Not a string or array, set to empty array
                                                    }
                                                @endphp

                                                @if (!empty($advantages))
                                                    @foreach ($advantages as $advantage)
                                                        <div>
                                                            <span>{{ trim($advantage) }}</span> <!-- Trim to remove extra spaces -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span>لا توجد مميزات</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> الوصف :</th>
                                            <td>
                                                @if ($unit->description == null)
                                                    <span class="badge bg-danger">  لا يوجد وصف</span>
                                                    @else
                                                        <span>{{ $unit->description }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>المرافق:</th>
                                            <td>
                                            @php
                                                    $facilities =$unit->facilities;
                                                    if (is_string($facilities)) {
                                                        $facilities = json_decode($facilities, true);
                                                        if (json_last_error() !== JSON_ERROR_NONE) {
                                                            $facilities = [];
                                                        }
                                                    }
                                                @endphp

                                                @if (!empty($facilities) && is_array($facilities))
                                                    @foreach ($facilities as $facility)
                                                        <div>
                                                            <span>{{ $facility }}</span> <!-- Trim to remove extra spaces -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span>لا توجد مرافق</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>الموقع:</th>
                                            <td>{{ $unit->location }}</td>
                                        </tr>

                                        <tr>
                                            <th>السعر:</th>
                                            <td>{{ $unit->price }} ريال سعودي</td>
                                        </tr>

                                        <tr>
                                            <th>حمام سباحة:</th>
                                            <td>
                                                @if ($unit->pool == 1)
                                                    <span class="badge bg-success">يوجد</span>
                                                @else
                                                    <span class="badge bg-danger">لا يوجد</span>
                                                @endif
                                            </td>
                                        </tr>

                                        @if ($unit->pool == 1)
                                            <tr>
                                                <th>حجم حمام السباحة:</th>
                                                <td>{{ $unit->pool_size }} متر مربع</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th>الحالة:</th>
                                            <td>
                                                @if ($unit->status == 'available')
                                                    <span class="badge bg-success">متاحة</span>
                                                @elseif ($unit->status == 'reserved')
                                                    <span class="badge bg-warning">محجوزة</span>
                                                @else
                                                    <span class="badge bg-danger">غير متاحة</span>
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                            </div>

                            <a href="{{ route('owner.myUnits') }}" style="background-color: #88394E !important;" class="btn btn-secondary mt-3">عودة إلى قائمة الوحدات</a>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>

@endsection
