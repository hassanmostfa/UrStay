@extends('admin.mainComponents')

@section('title', 'الاحياء')

@section('link_one', 'المواقع الجغرافية')
@section('link_two', 'الاحياء')

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
                    <h4 class="my-0">اضافة حي جديد</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.addDistrict') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- City Selection -->
                        <div class="col-md-4 mb-3">
                            <label for="city" style="font-weight: 600; font-size: 18px" class="form-label">اختر المدينة</label>
                            <select id="city" name="city_id" class="form-control" required>
                                <option value="" disabled selected>المدن التابعة للمحافظة المختارة</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District Name -->
                        <div class="col-md-12 mb-3">
                            <label for="city_name" style="font-weight: 600; font-size: 18px" class="form-label">اسم الحي</label>
                            <input type="text" class="form-control" id="city_name" name="name" placeholder="ادخل اسم الحي" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn text-white" style="background: #88304e;">اضف الحي</button>
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
                    <h4 class="my-0">كل الاحياء</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>رقم الحي</th>
                                <th>اسم الحي</th>
                                <th>المدينة التي يوجد به هذا الحي</th>
                                <th>اجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example district row, replace with dynamic content -->
                            @foreach($districts as $district)
                            <tr>
                                <td>{{ $district->id }}</td>
                                <td>{{ $district->name }}</td>
                                <td>{{ $district->city->name }}</td>
                                <td>
                                    <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                    <form action="{{ route('admin.deleteDistrict', $district->id) }}" method="POST" class="d-inline">
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
@endsection
