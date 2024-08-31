@extends ('owner.main-owner-dashboard') 

@section('title', 'اضافة وحدة جديدة')

@section('contents')
<div class="d-flex justify-content-center align-items-center " style="font-family: 'almarai' !important;">
    <i class="fa-solid fa-building" style="color:#88394E !important;"></i>
    <h2 class="m-3">اضافة وحدة جديد</h2>
</div>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('owner/store-unit') }}" enctype="multipart/form-data" method="POST" class="container p-4 bg-light shadow-sm rounded">
    @csrf
    <!-- Card 1 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0"><span>#</span>معلومات المالك</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">اسم المالك</label>
                    <input type="text" name="owner_name" id="name" class="form-control" placeholder="Enter owner name">
                </div>

                <!-- To send owner id -->
                <input type="hidden" name="owner_id" id="owner_id" class="form-control" value="{{ Auth::user()->id }}">
                <!-- To send owner id -->
                
                <div class="col-md-6">
                    <label class="form-label">العنوان (الوصف المختصر للوحدة)</label>
                    <input type="text" name="unit_title" id="title" class="form-control" placeholder="Enter unit title">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">سعر الوحده</label>
                    <input type="text" name="unit_price" id="price" class="form-control" placeholder="Enter unit price">
                </div>
                <div class="col-md-6">
                    <label class="form-label">موقع الوحده</label>
                    <input type="text" name="unit_location" id="location" class="form-control" placeholder="ex : الرياض">
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0"><span>#</span>مواصفات الوحدة</h5>
        </div>
        <div class="card-body">
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
        </div>
    </div>

    <!-- Card 3 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0"><span>#</span>تفاصيل إضافية</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">تصنيف الوحدة</label>
                    <select name="unit_type" id="unit_type" class="form-select">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach 
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الحالة</label>
                    <select name="unit_status" id="unit_status" class="form-select">
                        <option value="متاح">اختر الحالة</option>
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
        </div>
    </div>

    <!-- Card 4 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
            
            <h5 class="card-title mb-0"><span>#</span>ملحقات الوحدة</h5>
        </div>
        <div class="card-body">
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
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">الرخصة الاولي</label>
                    <input type="file" name="lisence_one" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">الرخصة الثانية</label>
                    <input type="file" name="lisence_two" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-lg mt-3" style="background:#88394E !important;">حفظ</button>
</form>


        </div>
    </div>
</div>
@endSection