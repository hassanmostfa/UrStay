@extends('admin.mainComponents')

@section('title', 'المدن')

@section('link_one', 'المواقع الجغرافية')
@section('link_two', 'المدن')


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
                    <h4 class="my-0">اضافة مدينة جديدة</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.addCity') }}" method="POST">
                    @csrf
                    <div class="row">

                        <!-- City Name -->
                        <div class="col-md-12 mb-3">
                            <label for="city_name" style="font-weight: 600; font-size: 18px" class="form-label">اسم المدينة</label>
                            <input type="text" class="form-control" id="city_name" name="name" placeholder="ادخل اسم المدينة" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn text-white" style="background: #88304e;">اضف المدينة</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow" style="background-color: #fff;">
                <div class="card-header text-white py-2" style="background: #88304e;">
                    <h4 class="my-0">كل المدن</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>رقم المدينة</th>
                                <th>اسم المدينة</th>
                                <th>اجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example city row, replace with dynamic content -->
                            @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>
                                    <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                    <form action="{{ route('admin.deleteCity', $city->id) }}" method="POST" class="d-inline">
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
