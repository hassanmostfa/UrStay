@extends ('admin.commonComponents') 

@section('title', 'تعديل التصنيف')

@section('contents')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('admin/categories/update' , $category->id) }}" method="POST" class="container mt-5 p-4 border rounded">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">اسم التصنيف</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">كود التصنيف</label>
        <input type="text" name="slug" id="slug" value="{{ $category->slug }}" class="form-control">
    </div>

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
        <textarea name="description" id="description" placeholder="Description" rows="3" class="form-control">{{ $category->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100" style="background:#88394E !important;">تعديل</button>
</form>

        </div>
    </div>
</div>
@endsection 