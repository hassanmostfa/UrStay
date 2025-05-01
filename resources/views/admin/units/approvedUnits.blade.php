@extends('admin.mainComponents')

@section('title', 'الوحدات المعتمدة')


@section('link_one', 'الوحدات')
@section('link_two', 'المعتمدة')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

<div class="container mt-3">
    <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">الوحدات المعتمدة</h1>
    <br>
    <form method="GET" id="filterForm">
        <div class="row mb-3">

            <div class="col-md-9 my-2">
                <select id="category" name="" class="form-select" onchange="updateFormAction()">
                    <option value="">اختر الحالة</option>
                    <option value="{{ route('admin.allUnits') }}">كل الحالات</option>
                    <option value="{{ route('admin.newUnitsRequests') }}">الوحدات الجديدة</option>
                    <option value="{{ route('admin.getApprovedUnits') }}">الوحدات المعتمدة</option>
                    <option value="{{ route('admin.rejectedUnits') }}">الوحدات المرفوضة</option>
                    <option value="{{ route('admin.updatedUnits') }}">الوحدات المحدثة</option>
                </select>
            </div>

            <div class="col-md-3 my-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">بحث</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table  table-bordered table-hover text-center table-striped align-middle">
            <thead class="table text-white" style="background-color: #88394E;">
                <tr>
                    <th>#</th>
                    <th>صورة الوحدة</th>
                    <th>اسم الوحدة</th>
                    <th>المضيف</th>
                    <th>هاتف المضيف</th>
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

<script>
    function updateFormAction() {
        var form = document.getElementById('filterForm');
        var category = document.getElementById('category').value;
        form.action = category ? category : '#'; // Set the action to the selected route or '#' if none is selected
    }
</script>

@endSection
