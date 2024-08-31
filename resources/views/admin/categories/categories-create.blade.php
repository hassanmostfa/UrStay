@extends ('admin.commonComponents') 

@section('title', 'اضافة تصنيف جديد')

@section('contents')
<div class="d-flex justify-content-center align-items-center gap-2 mt-3 ">
    <i class="fa-solid fa-plus" style="color:#88394E !important;"></i>
    <h2 class="text-3xl">اضافة تصنيف جديد</h2>
</div>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('admin/categories/store') }}" method="POST" class="container">
    @csrf

    <!-- Card 1 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
        <span>#</span>
            تفاصيل التصنيف
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="أدخل الاسم">
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">كود التصنيف</label>
                <input type="text" name="slug" id="slug" class="form-control" placeholder="أدخل كود التصنيف">
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
        <span>#</span>
            حالة التصنيف والوصف
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="status" class="form-label">الحالة</label>
                <select name="status" id="status" class="form-control">
                    <option value="2" disabled>اختر الحالة</option>
                    <option value="متاح">متاح</option>
                    <option value="غير متاح">غير متاح</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">الوصف</label>
                <textarea name="description" id="description" rows="3" class="form-control" placeholder="أدخل الوصف"></textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary  d-block m-auto my-3" style="background:#88394E !important; font-family: 'almarai' !important;">تنفيذ</button>
</form>


        </div>
    </div>
</div>
@endsection