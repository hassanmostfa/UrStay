@extends('admin.mainComponents')

@section('title', 'الطلبات المكتملة')


@section('link_one', 'الوحدات')
@section('link_two', 'المكتملة')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

<div class="container mt-3">
    <div class="table-responsive">
        <table class="table  table-bordered table-hover text-center table-striped align-middle">
            <thead class="table text-white" style="background-color: #88394E;">
                <tr>
                    <th>#</th>
                    <th>صورة الوحدة</th>
                    <th>اسم الوحدة</th>
                    <th>المضيف</th>
                    <th>هاتف المضيف</th>
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
    <td>{{ $unit->owner->first_name . ' ' .  $unit->owner->last_name}}</td>
    <td>{{ $unit->owner->phone}}</td>
    <td>
        @if($unit->admin)
        {{$unit->admin->first_name . ' ' . $unit->admin->last_name}}
        @else
        لا يوجد مشرف
        @endif
    </td>

    <td>
        <a href="{{ route('admin.unitDetails', $unit->id) }}" class="btn btn-secondary btn-sm">عرض</a>
        <form action="{{ route('admin.approveUnit', $unit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success btn-sm">قبول</button>
        </form>
        <form action="{{ route('admin.rejectUnit', $unit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger btn-sm">رفض</button>
        </form>
    </td>
</tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>


@endSection
