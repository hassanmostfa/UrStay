@extends('admin.mainComponents')

@section('title', 'المحافظات')

@section('link_one', 'المواقع الجغرافية')
@section('link_two', 'االمحافظات')

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
                    <h4 class="my-0">اضافة محافظة جديدة</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.addGovernorate') }}" method="POST">
                    @csrf
                    <div class="row">

                        <!-- Zone Selection (Will be filled dynamically) -->
                        <div class="col-md-12 mb-3">
                            <label for="zone" style="font-weight: 600; font-size: 18px" class="form-label">اختر المنطقة</label>
                            <select id="zone" name="zone_id" class="form-control" required>
                                <option value="" disabled selected> المناطق هنا</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Governorate Name -->
                        <div class="col-md-12 mb-3">
                            <label for="governorate_name" style="font-weight: 600; font-size: 18px" class="form-label">اسم المحافظة</label>
                            <input type="text" class="form-control" id="governorate" name="name" placeholder="ادخل اسم المحافظة" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn text-white" style="background: #88304e;">اضف المحافظة</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<hr/>

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <div class="card-header text-white py-2" style="background: #88304e;">
                    <h4 class="my-0">كل المحافظات</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>رقم المحافظة</th>
                                <th>اسم المحافظة</th>
                                <th>المنطقة التي يوجد بها هذه المحافظة</th>
                                <th>عدد المدن المتاحة لدينا في هذه المحافظة</th>
                                <th>اجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example governorate row, replace with dynamic content -->
                            @foreach($governorates as $governorate)
                            <tr>
                                <td>{{ $governorate->id }}</td>
                                <td>{{ $governorate->name }}</td>
                                <td>{{ $governorate->zone->name }}</td>
                                <td>{{  $governorate->cities_count }}</td>
                                <td>
                                    <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                    <form action="{{ route('admin.deleteGovernorate', $governorate->id) }}" method="POST" class="d-inline">
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
