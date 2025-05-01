@extends('admin.mainComponents')

@section('title', 'المناطق')


@section('link_one', 'المواقع الجغرافية')
@section('link_two', 'المناطق')

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
                        <h4 class="my-0">اضافة منطقة جديدة</h4></h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('admin.addZone') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Zone Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="zone" style="font-weight: 600; font-size: 18px" class="form-label">اسم المنطقة</label>
                                <input type="text" class="form-control" id="zone" name="name" placeholder="ادخل اسم المنطقة" required>
                            </div>

                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn text-white" style="background: #88304e;">اضف المنطقة</button>
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
                        <h4 class="my-0">كل المناطق</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>رقم المنطقة</th>
                                    <th>اسم المنطقة</th>
                                    <th>عدد المحافظات المتاحة لدينا في هذه المنطقة</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example zone row, replace with dynamic content -->
                                @foreach($zones as $zone)
                                <tr>
                                    <td>{{ $zone->id }}</td>
                                    <td>{{ $zone->name }}</td>
                                    <td>{{ $zone->governorates_count }}</td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                        <form action="{{ route('admin.deleteZone', $zone->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
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
