@extends('layouts.admin')

@section('title', 'تعديل الوحدة')

@section('link_one', 'الوحدات')
@section('link_two', 'تعديل الوحدة')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-3 text-white" style="background-color: #88394E !important;">
                    <h3 class="my-0">تعديل بيانات الوحدة رقم : {{ $unit->id }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('owner.updateUnitAction', $unit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">العنوان:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $unit->title }}">
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">التصنيف:</label>
                                    <input type="text" class="form-control" id="category" name="category" value="{{ $unit->category }}">
                                </div>

                                <!-- <div class="mb-3">
                                    <label for="sub_category" class="form-label">التصنيف الفرعي:</label>
                                    <input type="text" class="form-control" id="sub_category" name="sub_category" value="{{ $unit->sub_category }}">
                                </div>

                                <div class="mb-3">
                                    <label for="sub_sub_category" class="form-label">التصنيف الفرعي الثاني:</label>
                                    <input type="text" class="form-control" id="sub_sub_category" name="sub_sub_category" value="{{ $unit->sub_sub_category }}">
                                </div> -->

                                <div class="mb-3">
                                    <label for="size" class="form-label">المساحة:</label>
                                    <input type="text" class="form-control" id="size" name="size" value="{{ $unit->size }}">
                                </div>

                                <div class="mb-3">
                                    <label for="rooms" class="form-label">عدد الغرف:</label>
                                    <input type="number" class="form-control" id="rooms" name="rooms" value="{{ $unit->rooms }}">
                                </div>

                                <div class="mb-3">
                                    <label for="rooms" class="form-label">عدد الاسرة المفردة:</label>
                                    <input type="number" class="form-control" id="no_of_single_beds" name="no_of_single_beds" value="{{ $unit->no_of_single_beds }}">
                                </div>
                                <div class="mb-3">
                                    <label for="rooms" class="form-label">عدد الاسرة الماستر:</label>
                                    <input type="number" class="form-control" id="no_of_master_beds" name="no_of_master_beds" value="{{ $unit->no_of_master_beds }}">
                                </div>

                                <div class="mb-3">
                                    <label for="bathrooms" class="form-label">عدد الحمامات:</label>
                                    <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ $unit->bathrooms }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">مرافق الحمام:</label>
                                    <div id="bathroom_facilities">
                                        @php
                                            $bathroom_facilities = $unit->bathroom_facilities;
                                            if (is_string($bathroom_facilities)) {
                                                $bathroom_facilities = json_decode($bathroom_facilities, true);
                                                if (json_last_error() !== JSON_ERROR_NONE) {
                                                    $bathroom_facilities = [];
                                                }
                                            }
                                        @endphp

                                        @if (!empty($bathroom_facilities) && is_array($bathroom_facilities))
                                            @foreach ($bathroom_facilities as $facility)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="bathroom_facilities[]" value="{{ trim($facility) }}">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="bathroom_facilities[]">
                                                <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addInput('bathroom_facilities')">إضافة مرافق حمام</button>
                                </div>

                                <div class="mb3">
                                    <label for="kitchen" class="form-label">عدد كراسي طاولة الطعام</label>
                                    <input type="number" class="form-control" id="table_chairs" name="table_chairs" value="{{ $unit->table_chairs }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">مرافق المطبخ:</label>
                                    <div id="kitchen">
                                        @php
                                            $kitchen = $unit->kitchen;
                                            if (is_string($kitchen)) {
                                                $kitchen = json_decode($kitchen, true);
                                                if (json_last_error() !== JSON_ERROR_NONE) {
                                                    $kitchen = [];
                                                }
                                            }
                                        @endphp

                                        @if (!empty($kitchen) && is_array($kitchen))
                                            @foreach ($kitchen as $facility)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="kitchen[]" value="{{ trim($facility) }}">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="kitchen[]">
                                                <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addInput('kitchen')">إضافة مرافق مطبخ</button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">مرافق اضافية:</label>
                                    <div id="additional_facilities">
                                        @php
                                            $additional_facilities = $unit->additional_facilities;
                                            if (is_string($additional_facilities)) {
                                                $additional_facilities = json_decode($additional_facilities, true);
                                                if (json_last_error() !== JSON_ERROR_NONE) {
                                                    $additional_facilities = [];
                                                }
                                            }
                                        @endphp

                                        @if (!empty($additional_facilities) && is_array($additional_facilities))
                                            @foreach ($additional_facilities as $facility)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="additional_facilities[]" value="{{ trim($facility) }}">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="additional_facilities[]">
                                                <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addInput('additional_facilities')">إضافة مرافق إضافية</button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">مميزات الوحدة:</label>
                                    <div id="advantages">
                                        @php
                                            $advantages = $unit->advantages;
                                            if (is_string($advantages)) {
                                                $advantages = json_decode($advantages, true);
                                                if (json_last_error() !== JSON_ERROR_NONE) {
                                                    $advantages = [];
                                                }
                                            }
                                        @endphp

                                        @if (!empty($advantages) && is_array($advantages))
                                            @foreach ($advantages as $advantage)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="advantages[]" value="{{ trim($advantage) }}">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="advantages[]">
                                                <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addInput('advantages')">إضافة ميزة</button>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">الوصف:</label>
                                    <textarea class="form-control" id="description" name="description">{{ $unit->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">المرافق:</label>
                                    <div id="facilities">
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
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="facilities[]" value="{{ trim($facility) }}">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="facilities[]">
                                                <button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="addInput('facilities')">إضافة مرفق</button>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">الموقع:</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ $unit->location }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">حمام سباحة:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pool" name="pool" value="1" {{ $unit->pool ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pool">
                                            يوجد
                                        </label>
                                    </div>
                                </div>

                                @if ($unit->pool)
                                    <div class="mb-3">
                                        <label for="pool_size" class="form-label">حجم حمام السباحة:</label>
                                        <input type="text" class="form-control" id="pool_size" name="pool_size" value="{{ $unit->pool_size }}">
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="status" class="form-label">الحالة:</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="available" {{ $unit->status == 'available' ? 'selected' : '' }}>متاحة</option>
                                        <option value="reserved" {{ $unit->status == 'reserved' ? 'selected' : '' }}>محجوزة</option>
                                        <option value="unavailable" {{ $unit->status == 'unavailable' ? 'selected' : '' }}>غير متاحة</option>
                                    </select>
                                </div>

                                <!-- Attach Mot permission of the unit -->
                                <div class="mb-3">
                                    <label for="mot_permission" class="form-label">ارفاق تصريح وزارة السياحة الخاص بالوحدة</label>
                                    <input type="file" class="form-control" id="mot_permission" name="mot_permission">
                                </div>
                                <div>
                                    @if ($unit->request_status == 'rejected')
                                        <button type="submit" class="btn btn-secondary">اعادة الارسال</button>
                                    @else
                                    <button type="submit" class="btn btn-primary" style="background-color: #88394E !important;">تحديث</button>
                                    @endif

                                    <a href="{{ route('owner.myUnits') }}" style="background-color: #88394E !important;" class="btn btn-secondary">عودة إلى قائمة الوحدات</a>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-3 text-white" style="background-color: #88394E !important;">
                    <h3 class="my-0">تعديل البيانات المستكملة للوحده رقم : {{ $unit->id }}</h3>
                </div>
                <div class="card-body">
                    @if ($completed_unit)
                    <form action="{{ route('owner.updateCompletedUnit', $completed_unit->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Saturday Price -->
                        <div class="form-group">
                            <label for="saturday_price">سعر يوم السبت</label>
                            <input type="text" class="form-control" id="saturday_price" name="saturday_price" value="{{ old('saturday_price', $completed_unit->saturday_price) }}" required>
                        </div>

                        <!-- Sunday Price -->
                        <div class="form-group">
                            <label for="sunday_price">سعر يوم الاحد</label>
                            <input type="text" class="form-control" id="sunday_price" name="sunday_price" value="{{ old('sunday_price', $completed_unit->sunday_price) }}" required>
                        </div>

                        <!-- Monday Price -->
                        <div class="form-group">
                            <label for="monday_price">سعر يوم الاثنين</label>
                            <input type="text" class="form-control" id="monday_price" name="monday_price" value="{{ old('monday_price', $completed_unit->monday_price) }}" required>
                        </div>

                        <!-- Tuesday Price -->
                        <div class="form-group">
                            <label for="tuesday_price">سعر يوم الثلاثاء</label>
                            <input type="text" class="form-control" id="tuesday_price" name="tuesday_price" value="{{ old('tuesday_price', $completed_unit->tuesday_price) }}" required>
                        </div>

                        <!-- Wednesday Price -->
                        <div class="form-group">
                            <label for="wednesday_price">سعر يوم الأربعاء</label>
                            <input type="text" class="form-control" id="wednesday_price" name="wednesday_price" value="{{ old('wednesday_price', $completed_unit->wednesday_price) }}" required>
                        </div>

                        <!-- Thursday Price -->
                        <div class="form-group">
                            <label for="thursday_price">سعر يوم الخميس</label>
                            <input type="text" class="form-control" id="thursday_price" name="thursday_price" value="{{ old('thursday_price', $completed_unit->thursday_price) }}" required>
                        </div>

                        <!-- Friday Price -->
                        <div class="form-group">
                            <label for="friday_price">سعر يوم الجمعة</label>
                            <input type="text" class="form-control" id="friday_price" name="friday_price" value="{{ old('friday_price', $completed_unit->friday_price) }}" required>
                        </div>

                        <!-- Availability of Booking -->
                        <div class="form-group">
                            <label for="availability_of_booking">حالة الوحده</label>
                            <select class="form-control" id="availability_of_booking" name="availability_of_booking">
                                <option value="1" {{ old('availability_of_booking', $completed_unit->availability_of_booking) == 1 ? 'selected' : '' }}>متاحة</option>
                                <option value="0" {{ old('availability_of_booking', $completed_unit->availability_of_booking) == 0 ? 'selected' : '' }}>غير متاحة</option>
                            </select>
                        </div>

                        <!-- Negotiable Price -->
                        <div class="form-group">
                            <label for="negotiable_price">هل السعر قابل للتفاوض ؟</label>
                            <select class="form-control" id="negotiable_price" name="negotiable_price">
                                <option value="1" {{ old('negotiable_price', $completed_unit->negotiable_price) == 1 ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('negotiable_price', $completed_unit->negotiable_price) == 0 ? 'selected' : '' }}>لا</option>
                            </select>
                        </div>

                        <!-- Booking Status -->
                        <div class="form-group">
                            <label for="booking_status">نوع الحجز</label>
                            <select class="form-control" id="booking_status" name="booking_status">
                                <option value="1" {{ old('booking_status', $completed_unit->booking_status) == 1 ? 'selected' : '' }}>فوري</option>
                                <option value="0" {{ old('booking_status', $completed_unit->booking_status) == 0 ? 'selected' : '' }}>بموعد مسبق</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 text-center">تحديث</button>
                    </form>

                    @else
                    <p class="text-center text-danger" style="font-size: 20px;">هذه الوحدة ليست مكتملة حتي الان</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addInput(containerId) {
        var container = document.getElementById(containerId);
        var newInput = document.createElement('div');
        newInput.className = 'input-group mb-2';
        newInput.innerHTML = '<input type="text" class="form-control" name="' + containerId + '[]"><button type="button" class="btn btn-outline-secondary" onclick="removeInput(this)">إزالة</button>';
        container.appendChild(newInput);
    }

    function removeInput(button) {
        var inputGroup = button.parentElement;
        inputGroup.parentElement.removeChild(inputGroup);
    }

    function removeImage(button) {
        var imageContainer = button.parentElement;
        imageContainer.parentElement.removeChild(imageContainer);
    }
</script>

@endsection
