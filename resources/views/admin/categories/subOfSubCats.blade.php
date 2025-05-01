@extends('admin.mainComponents')

@section('title', 'التصنيفات الفرعية الثانية')

@section('link_one', 'التصنيفات')
@section('link_two', 'الفرعية الثانية')


@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<!-- Add Sub-Subcategory Form -->
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <div class="card-header text-white font-weight-bold py-2" style="background: #88304e;">
                    <h4 class="my-0">اضافة تصنيف فرعي ثاني جديد</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.addSubOfSubCategory') }}" method="POST">
    @csrf

    <!-- Category Selection -->
    <div class="mb-3">
        <label for="category" style="font-weight: 600; font-size: 18px" class="form-label">اختر التصنيف</label>
        <select id="category" name="category_id" class="form-control" required>
            <option value="" disabled selected>التصنيفات هنا</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Subcategory Selection (Will be filled dynamically) -->
     <div class="mb-3">
        <label for="subcategory" style="font-weight: 600; font-size: 18px" class="form-label">اختر التصنيف الفرعي</label>
        <select id="subcategory" name="sub_category_id" class="form-control" required></select>
    </div>

    <!-- Sub-Subcategory Name -->
    <div class="mb-3">
        <label for="sub_subcategory_name" style="font-weight: 600; font-size: 18px" class="form-label">اسم التصنيف الفرعي الثاني</label>
        <input type="text" class="form-control" id="sub_subcategory_name" name="name" placeholder="ادخل اسم التصنيف الفرعي الثاني" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn text-white" style="background: #88304e;">اضافة</button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>

<hr/>

<!-- Display Sub of Subcategories -->
<div class="container mt-2 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <div class="card-header text-white py-2" style="background: #88304e;">
                    <h4 class="my-0">كل التصنيفات الفرعية الثانية</h4>
                </div>
                <div class="card-body">
                <table class="table table-bordered table-striped table-hover text-center">
    <thead class="bg-light">
        <tr>
            <th>رقم التصنيف الفرعي الثاني</th>
            <th>اسم التصنيف الفرعي الثاني</th>
            <th>اسم التصنيف الفرعي</th>
            <th>اسم التصنيف الرئيسي</th>
            <th>اجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subOfSubCategories as $subOfSubCategory)
            <tr>
                <td>{{ $subOfSubCategory->id }}</td>
                <td>{{ $subOfSubCategory->name }}</td>
                <td>{{ $subOfSubCategory->subCategory->name }}</td>
                <td>{{ $subOfSubCategory->subCategory->category->name }}</td>
                <td>
                    <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                    <form action="{{ route('admin.deleteSubOfSubCategory', $subOfSubCategory->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</div>

@endSection
