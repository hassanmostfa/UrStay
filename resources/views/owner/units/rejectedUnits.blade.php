@extends('layouts.admin')
@section('rejected_unit_active', 'active')

@section('title', 'الوحدات المرفوضة')

@section('link_one', 'الوحدات')
@section('link_two', 'المرفوضة')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

<div class="container mt-3">
    <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">الوحدات المرفوضة</h1>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center table-striped align-middle">
            <thead class="table text-white" style="background-color: #88394E;">
                <tr>
                    <th>#</th>
                    <th>صورة الوحدة</th>
                    <th>العنوان</th>
                    <th>المساحة</th>
                    <th>عدد الغرف</th>
                    <th>عدد الحمامات</th>
                    <th>الموقع</th>
                    <th>حمام سباحة</th>
                    <th>حالة الطلب</th>
                    <th>سبب الرفض</th>
                    <th>التعديل واعادة الارسال</th>
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

                <td>
                    @if ($unit->pool == 1)
                        <span class="badge bg-success">يوجد</span>
                    @else
                        <span class="badge bg-danger">لا يوجد</span>
                    @endif
                </td>

                <td>
                    @if ($unit->request_status == 'rejected')
                        <span class="badge bg-danger">مرفوضة</span>
                    @elseif ($unit->request_status == 'accepted')
                        <span class="badge bg-success">مقبولة</span>
                    @else
                        <span class="badge bg-primary">بانتظار الموافقة علي التعديل</span>
                    @endif
                </td>

                <td>
                    <button type="button" class="btn btn-danger" style="font-size: 10px;" data-bs-toggle="modal" data-bs-target="#modal-{{ $unit->id }}">
                        اضغط هنا
                    </button>
                </td>

                <td>
                    @if ($unit->request_status == 'rejected')
                        <a href="{{ route('owner.updateUnit', $unit->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                    @endif
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{ $unit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel-{{ $unit->id }}" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 800px;">
                    <div class="modal-content">
                        <div class="modal-header justify-content-start">
                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h1 class="modal-title fs-5 m-0" id="modalLabel-{{ $unit->id }}">سبب رفض الوحدة رقم {{ $unit->id }}</h1>
                        </div>
                        <div class="modal-body">
                            {{ $unit->rejection_reason }}
                        </div>
                    </div>
                </div>
            </div>

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
@endsection
