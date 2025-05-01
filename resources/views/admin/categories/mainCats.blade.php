@extends('admin.mainComponents')

@section('title', 'التصنيفات الاساسية')


@section('link_one', 'التصنيفات')
@section('link_two', 'الاساسية')


@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow" style="background-color: #fff;">
                    <div class="card-header text-white font-weight-bold py-2" style="background: #88304e;">
                        <h4 class="my-0">اضافة تصنيف جديد</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.addCategory') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <!-- category Name -->
                            <div class="mb-3">
                                <label for="category_name" style="font-weight: 600; font-size: 18px" class="form-label">اسم التصنيف</label>
                                <input type="text" class="form-control" id="category_name" name="name" placeholder="ادخل اسم التصنيف" required>
                            </div>

                            <!-- Category Image -->
                            <div class="mb-3">
                                <label for="category_image" style="font-weight: 600; font-size: 18px" class="form-label">صورة التصنيف</label>
                                <input type="file" class="form-control" id="category_image" name="image">
                                <small class="form-text text-muted">يجب عليك اختيار صورة من فضلك</small>
                                <img src="" id="category_image_preview" class="img-thumbnail" style="max-width: 200px; margin-top: 10px;">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn text-white" style="background: #88304e;">اضف التصنيف</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<hr/>

<div class="container mt-2 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow" style="background-color: #fff;">
                    <div class="card-header text-white py-2" style="background: #88304e;">
                        <h4 class="my-0">كل التصنيفات</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>رقم التصنيف</th>
                                    <th>اسم التصنيف</th>
                                    <th>اجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example category row, replace with dynamic content -->
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                        <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" class="d-inline">
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
