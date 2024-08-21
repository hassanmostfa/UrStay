@extends('owner.main-owner-dashboard')

@section('title', 'تعدبل ببانات الوحدة')

@section('contents')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('owner/unit/update', $unit->id) }}" method="POST" class="container mt-5 p-4 border rounded">
    @csrf
    <div class="mb-3">
        <label for="owner_name" class="form-label">اسم المالك</label>
        <input type="text" name="owner_name" id="owner_name" value="{{ $unit->owner_name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_price" class="form-label">السعر</label>
        <input type="text" name="unit_price" id="unit_price" value="{{ $unit->unit_price }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_location" class="form-label">العنوان</label>
        <input type="text" name="unit_location" id="unit_location" value="{{ $unit->unit_location }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_size" class="form-label">المساحة</label>
        <input type="text" name="unit_size" id="unit_size" value="{{ $unit->unit_size }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_rooms" class="form-label">عدد الغرف</label>
        <input type="text" name="unit_rooms" id="unit_rooms" value="{{ $unit->unit_rooms }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_bathrooms" class="form-label">عدد الحمامات</label>
        <input type="text" name="unit_bathrooms" id="unit_bathrooms" value="{{ $unit->unit_bathrooms }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_type" class="form-label">تصنيف الوحدة</label>
        <select name="unit_type" id="unit_type" class="form-select">
            <option>{{ $unit->unit_type }}</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
            @endforeach  
        </select>
    </div>

    <div class="mb-3">
        <label for="unit_status" class="form-label">حالة الوحدة</label>
        <select name="unit_status" id="unit_status" class="form-select">
            <option>{{ $unit->unit_status }}</option>
            <option>متاح</option>
            <option>غير متاح</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="owner_email" class="form-label">البريد الالكتروني للمالك</label>
        <input type="email" name="owner_email" id="owner_email" value="{{ $unit->owner_email }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="owner_phone" class="form-label">هاتف المالك </label>
        <input type="tel" name="owner_phone" id="owner_phone" value="{{ $unit->owner_phone }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="unit_description" class="form-label">الوصف</label>
        <textarea name="unit_description" id="unit_description" placeholder="Description" rows="3" class="form-control">{{ $unit->unit_description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-lg" style="background:#88394E !important;">تعديل</button>
</form>

        </div>
    </div>
</div>
@endsection
