@extends('admin.mainComponents')

@section('title', 'التصنيفات الفرعية')

@section('link_one', 'التصنيفات')
@section('link_two', 'الفرعية')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<!-- Add Subcategory Form -->
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <div class="card-header text-white font-weight-bold py-2" style="background: #88304e;">
                    <h4 class="my-0">اضافة تصنيف فرعي جديد</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.addSubCategory') }}" method="POST">
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

                        <!-- Subcategory Name -->
                        <div class="mb-3">
                            <label for="sub_category_name" style="font-weight: 600; font-size: 18px" class="form-label">اسم التصنيف الفرعي</label>
                            <input type="text" class="form-control" id="sub_category_name" name="name" placeholder="ادخل اسم التصنيف الفرعي" required>
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

<!-- Display Subcategories -->
<div class="container mt-2 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <div class="card-header text-white py-2" style="background: #88304e;">
                    <h4 class="my-0">كل التصنيفات الفرعية</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>رقم التصنيف الفرعي</th>
                                <th>اسم التصنيف الفرعي</th>
                                <th>اسم التصنيف الرئيسي</th>
                                <th>اجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subCategories as $subCategory)
                            <tr>
                                <td>{{ $subCategory->id }}</td>
                                <td>{{ $subCategory->name }}</td>
                                <td>{{ $subCategory->category->name }}</td>
                                <td>
                                    <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                    <form action="{{ route('admin.deleteSubCategory', $subCategory->id) }}" method="POST" class="d-inline">
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
