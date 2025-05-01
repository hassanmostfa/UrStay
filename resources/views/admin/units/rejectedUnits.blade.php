@extends('admin.mainComponents')

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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<div class="container mt-3">
    <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">الطلبات المرفوضة</h1>
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
                    <th>سبب الرفض</th>
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
    <span class="badge bg-danger" data-toggle="modal"
    data-target="#rejectionModal_{{ $unit->id }}"
    style="display: block;cursor: pointer" data-reason="{{ $unit->rejection_reason }}">


    عرض سبب الرفض

</span>
<!-- Modal Structure -->

<div class="modal fade" style="z-index: 999999999999999999;margin-top: 120px;"
    id="rejectionModal_{{ $unit->id }}" tabindex="-1" role="dialog"
    aria-labelledby="rejectionModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="rejectionModalLabel">سبب الرفض</h5>

                <button type="button" class="close btn btn-danger btn-sm"
                    data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="rejectionReason">

                {{ $unit->rejection_reason }}
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">إغلاق</button>

            </div>

        </div>

    </div>

</div>

</td>
    <td>
        @if(($unit->admin && $unit->admin->id  == auth()->id()) || auth()->user()->isMaster)
        <div class="d-flex justify-content-start gap-2 align-items-end">

        <a href="{{ route('admin.unitDetails', $unit->id) }}" class="btn btn-secondary btn-sm">عرض</a>
        <a href="{{ route('admin.updateUnit' , $unit->id) }}" class="btn btn-success btn-sm" style="background-color:#88304e">تعديل</a>
        <a href="{{ route('admin.deleteUnit' , $unit->id) }}" class="btn btn-danger btn-sm">حذف</a>
        </div>
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
