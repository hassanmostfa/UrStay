@extends('layouts.admin')
@section('update_unit_active', 'active')

@section('title', 'الوحدات التي تم تعديلها')

@section('link_one', 'الوحدات')
@section('link_two', 'المحدثة')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

<div class="container mt-3">
    <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">الوحدات المحدثة</h1>
    <br>
    <div class="table-responsive">
        <table class="table  table-bordered table-hover text-center table-striped align-middle">
            <thead class="table text-white" style="background-color: #88394E;">
                <tr>
                    <th>رقم الوحدة</th>
                    <th>صورة الوحدة</th>
                    <th>العنون</th>
                    <th>المساحة</th>
                    <th>عدد الغرف</th>
                    <th>عدد الحمامات</th>
                    <th>الموقع</th>
                    <th>السعر</th>
                    <th>حمام سباحة</th>
                    <th>حالة الطلب</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($units as $unit)
<tr>
    <td>{{ $unit->id }}</td>
    <!-- Decode the JSON, and show the first image -->
    <td>
        @php
            $images = json_decode($unit->image, true); // Decode the JSON to an array
        @endphp
        @if (!empty($images) && is_array($images))
            <img src="{{ asset($images[0]) }}" alt="image" width="50px" height="50px">
        @else
            <span>No Image</span>
        @endif
    </td>
    <td>{{ $unit->title }}</td>
    <td>{{ $unit->size }}</td>
    <td>{{ $unit->rooms }}</td>
    <td>{{ $unit->bathrooms }}</td>
    <td>{{ $unit->location }}</td>

    <td>{{ $unit->price }}</td>
    <td>
        @if ($unit->pool == 1)
        <span class="badge bg-success">يوجد</span>
        @else
        <span class="badge bg-danger">لا يوجد</span>
        @endif
    </td>

    <td>
    {!! $unit->request_status == 'updated' ? '<span class="badge bg-primary">بانتظار الموافقة علي التعديل</span>' : 'التعديل تم' !!}
    </td>
</tr>


@endforeach
@if($units->count() == 0)
<tr>
    <td colspan="11">
        <h2>لا توجد وحدات مضافة</h2>
    </td>
</tr>
@endif
            </tbody>
        </table>
    </div>
</div>

@endSection
