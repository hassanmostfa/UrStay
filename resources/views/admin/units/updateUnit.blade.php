@extends('admin.mainComponents')

@section('title', ' تعديل وحده')


@section('link_one', 'الوحدات')
@section('link_two', 'تعديل وحده')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-md-12 offset-md-2">
            <div class="card">
                <div class="card-header p-3 text-white" style="background-color: #88394E !important;">
                    <h3 class="my-0">تعديل الوحدة رقم : {{ $unit->id }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateUnitAction', $unit->id) }}" method="POST">
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

                                <div class="mb-3">
                                    <label for="sub_category" class="form-label">التصنيف الفرعي:</label>
                                    <input type="text" class="form-control" id="sub_category" name="sub_category" value="{{ $unit->sub_category }}">
                                </div>

                                <div class="mb-3">
                                    <label for="sub_sub_category" class="form-label">التصنيف الفرعي الثاني:</label>
                                    <input type="text" class="form-control" id="sub_sub_category" name="sub_sub_category" value="{{ $unit->sub_sub_category }}">
                                </div>

                                <div class="mb-3">
                                    <label for="size" class="form-label">المساحة:</label>
                                    <input type="text" class="form-control" id="size" name="size" value="{{ $unit->size }}">
                                </div>

                                <div class="mb-3">
                                    <label for="rooms" class="form-label">عدد الغرف:</label>
                                    <input type="number" class="form-control" id="rooms" name="rooms" value="{{ $unit->rooms }}">
                                </div>

                                <div class="mb-3">
                                    <label for="bed_type" class="form-label">نوع السرير:</label>
                                    <input type="text" class="form-control" id="bed_type" name="bed_type" value="{{ $unit->bed_type }}">
                                </div>

                                <div class="mb-3">
                                    <label for="bed_size" class="form-label">حجم السرير:</label>
                                    <input type="text" class="form-control" id="bed_size" name="bed_size" value="{{ $unit->bed_size }}">
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
                                    <label for="setting_type" class="form-label">نوع المجلس:</label>
                                    <input type="text" class="form-control" id="setting_type" name="setting_type" value="{{ $unit->setting_type }}">
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
                                    <label for="price" class="form-label">السعر:</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ $unit->price }}">
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
                                <div>
                                    <button type="submit" class="btn btn-primary" style="background-color: #88394E !important;">تحديث</button>

                                    <a href="{{ route('admin.allUnits') }}" style="background-color: #88394E !important;" class="btn btn-secondary">عودة إلى قائمة الوحدات</a>
                                </div>
                            </div>
                        </div>
                    </form>

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

