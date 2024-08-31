@extends ('admin.commonComponents') 

@section('title', 'تعديل التصنيف')

@section('contents')
<div class="d-flex justify-content-center align-items-center ">
    <i class="fa-solid fa-pen-to-square" style="color:#88394E !important;"></i>
    <h2 class="m-3">تعديل بيانات التصنيف</h2>
</div>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('admin/categories/update', $category->id) }}" method="POST" class="container mt-5">
    @csrf

    <!-- Card 1 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
        <span>#</span>
            تفاصيل التصنيف
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">اسم التصنيف</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">كود التصنيف</label>
                <input type="text" name="slug" id="slug" value="{{ $category->slug }}" class="form-control">
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
            <div class="mb-3">
                <label for="status" class="form-label">الحالة</label>
                <select name="status" id="status" class="form-select">
                    <option value="" disabled selected>اختر الحالة</option>
                    <option value="متاح" {{ $category->status == 'متاح' ? 'selected' : '' }}>متاح</option>
                    <option value="غير متاح" {{ $category->status == 'غير متاح' ? 'selected' : '' }}>غير متاح</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea name="description" id="description" placeholder="الوصف" rows="3" class="form-control">{{ $category->description }}</textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary d-block m-auto my-3" style="background:#88394E !important; font-family: 'almarai' !important;">تعديل</button>
</form>

        </div>
    </div>
</div>
@endsection 