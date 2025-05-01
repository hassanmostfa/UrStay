@extends('admin.mainComponents')

@section('title', 'كل الوحدات')


@section('link_one', 'الوحدات')
@section('link_two', 'تفاصيل الوحدة')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 offset-md-2">
                <div class="card">
                    <div class="card-header p-3 text-white" style="background-color: #88394E !important;">
                        <h3 class="my-0">الوحدة رقم : {{ $unit->id }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left side: Table for Unit Details -->
                            <!-- Right side: Carousel for Images -->
                            <div class="col-md-12">
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

                                <!-- Preview Mot permission image -->
                                @if ($unit->has_mot_permission == 1)
                                    <div class="mt-3">
                                        <h2 style="font-family: MainFontbold">صور التصريح</h2>
                                        <a href="{{ asset($unit->mot_permission) }}" download="التصريح" class="mb-3 btn btn-success">تحميل التصريح</a>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>اسم المالك</th>
                                        <td>{{ $unit->owner->first_name }} {{ $unit->owner->last_name }}</td>
                                    </tr>


                                    <tr>
                                        <th>كود المالك</th>
                                        <td>{{ $unit->owner_id }}</td>
                                    </tr>

                                    <tr>
                                        <th>البريد الالكتروني الخاص بالمالك</th>
                                        <td>{{ $unit->owner->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>تصريح وزارة السياحة للوحده</th>
                                        <td>
                                            @if ($unit->has_mot_permission == 1)
                                                <span class="badge bg-success">يوجد تصريح</span>
                                            @else
                                                <span class="badge bg-danger">لا يوجد تصريح</span>
                                            @endif
                                        </td>
                                    </tr>


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
                                                        <span>{{ trim($facility) }}</span>
                                                        <!-- Trim to remove extra spaces -->
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
                                                        <span>{{ trim($advantage) }}</span>
                                                        <!-- Trim to remove extra spaces -->
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
                                                <span class="badge bg-danger"> لا يوجد وصف</span>
                                            @else
                                                <span>{{ $unit->description }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>المرافق:</th>
                                        <td>
                                            @php
                                                $facilities = $unit->facilities;
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
                                                        <span>{{ $facility }}</span>
                                                        <!-- Trim to remove extra spaces -->
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
                                        <th>هل الوحده مكتملة البيانات؟</th>
                                        <td>
                                            @if ($completedUnit)
                                                <span class="badge bg-success">نعم</span>
                                            @else
                                                <span class="badge bg-danger">لا</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="d-flex justify-content-start mt-3 gap-2">
                            <a href="{{ route('admin.allUnits') }}" style="background-color: #88394E !important;"
                                class="btn btn-secondary mt-3">عودة إلى قائمة الوحدات</a>

                            @if ($unit->request_status == 'pending')
                                <form action="{{ route('admin.approveUnit', $unit->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">قبول</button>
                                </form>

                                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    رفض
                                </button>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 800px;">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-start">
                                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <h1 class="modal-title fs-5 m-0" id="staticBackdropLabel">هل تريد رفض هذه الوحدة؟
                                            رقم{{ $unit->id }}</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.rejectUnit', $unit->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="reason" class="form-label" style="font-weight: bold;">سبب
                                                    الرفض</label>
                                                <textarea class="form-control" id="reason" name="rejection_reason" rows="3"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block mt-3">إرسال</button>
                                            <button type="button" class="btn btn-secondary mt-3"
                                                data-bs-dismiss="modal">اغلاق</button>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
