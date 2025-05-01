@extends('admin.mainComponents')

@section('title', 'وحدات تحت اشرافي')


@section('link_one', 'الوحدات')
@section('link_two', 'الكل')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

<div class="container mt-3">
    <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">وحدات تحت اشراف: {{ $admin->first_name . ' ' . $admin->last_name}}</h1>
    <br>
    <div class="table-responsive">
        <table class="table  table-bordered table-hover text-center table-striped align-middle">
            <thead class="table text-white" style="background-color: #88394E;">
                <tr>
                    <th>#</th>
                    <th>صورة الوحدة</th>
                    <th>العنون</th>
                    <th>المساحة</th>
                    <th>عدد الغرف</th>
                    <th>عدد الحمامات</th>
                    <th>السعر</th>
                    <th>حمام سباحة</th>
                    <th>الحالة</th>
                    <th>تحت اشراف</th>
                    <th>الاجراءات</th>
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

    <td>{{ $unit->price }}</td>
    <td>
        @if ($unit->pool == 1)
        <span class="badge bg-success">يوجد</span>
        @else
        <span class="badge bg-danger">لا يوجد</span>
        @endif
    </td>
    <td>
        @if ($unit->request_status == 'approved')
        <span class="badge" style="background-color:#88304e">متاحة</span>
        @elseif ($unit->status == 'reserved')
        <span class="badge bg-warning">محجوزة</span>
        @else
        <span class="badge bg-danger">غير متاحة</span>
        @endif
    </td>
    <td>
        @if($unit->admin)
        {{$unit->admin->first_name . ' ' . $unit->admin->last_name}}
        @else
        لا يوجد مشرف
        @endif
    </td>
    <td>
        @if(($unit->admin && $unit->admin->id  == auth()->id()) || auth()->user()->isMaster)
        <a href="{{ route('admin.unitDetails', $unit->id) }}" class="btn btn-secondary btn-sm">عرض</a>
        <a href="{{ route('admin.updateUnit' , $unit->id) }}" class="btn btn-success btn-sm" style="background-color:#88304e">تعديل</a>
        <a href="{{ route('admin.deleteUnit' , $unit->id) }}" class="btn btn-danger btn-sm">حذف</a>
        @endif
        @if(!$unit->managed_by && !auth()->user()->isMaster)
            <a href="{{ route('addmin.assing.unit' , ['unitId' => $unit->id, 'adminId' => auth()->id()]) }}" class="btn btn-success btn-sm">استلام</a>
        @endif
    </td>
</tr>
@endforeach

            </tbody>
        </table>
    </div>
</div>


@endSection
