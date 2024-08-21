@extends ('owner.main-owner-dashboard') 

@section('title', 'اضافة وحدة جديدة')

@section('contents')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('owner/store-unit') }}" enctype="multipart/form-data" method="POST" class="container p-4 bg-light shadow-sm rounded">
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">اسم المالك</label>
            <input type="text" name="owner_name" id="name" class="form-control" placeholder="Enter owner name">
        </div>
        <div class="col-md-6">
            <label class="form-label">العنوان(الوصف المختصر للوحدة)</label>
            <input type="text" name="unit_title" id="title" class="form-control" placeholder="Enter unit title">
        </div>
    </div>

    <input type="hidden" name="owner_id" value="{{ auth()->user()->id }}">

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">سعر الوحده</label>
            <input type="text" name="unit_price" id="price" class="form-control" placeholder="Enter unit price">
        </div>
        <div class="col-md-6">
            <label class="form-label">موقع الوجده</label>
            <input type="text" name="unit_location" id="location" class="form-control" placeholder="ex : الرياض">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">مساحة الوحدة</label>
            <input type="text" name="unit_size" id="size" class="form-control" placeholder="Enter unit size">
        </div>
        <div class="col-md-6">
            <label class="form-label">عدد الغرف</label>
            <input type="text" name="unit_rooms" id="rooms" class="form-control" placeholder="Enter number of rooms">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">عدد الحمامات</label>
            <input type="text" name="unit_bathrooms" id="bathrooms" class="form-control" placeholder="Enter number of bathrooms">
        </div>
        <div class="col-md-6">
            <label class="form-label">التقييم</label>
            <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter unit rate">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label"> تصنيف الوحدة</label>
            <select name="unit_type" id="unit_type" class="form-select">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">الحالة</label>
            <select name="unit_status" id="unit_status" class="form-select">
                <option value="2">اختر الحالة</option>
                <option value="متاح">متاح</option>
                <option value="غير متاح">غير متاح</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">البريد الالكتروني للمالك</label>
            <input type="email" name="owner_email" id="email" class="form-control" placeholder="Enter owner email">
        </div>
        <div class="col-md-6">
            <label class="form-label">هاتف المالك</label>
            <input type="text" name="owner_phone" id="phone" class="form-control" placeholder="Enter owner phone">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">الوصف</label>
            <textarea name="unit_description" rows="3" class="form-control" placeholder="Enter unit description"></textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">صورة الوحدة</label>
            <input type="file" name="unit_image" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-lg mt-3" style="background:#88394E !important;">حفظ</button>
</form>

        </div>
    </div>
</div>
@endSection