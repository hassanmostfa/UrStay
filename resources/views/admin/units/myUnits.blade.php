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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<div class="container mt-3">
    <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">وحدات تحت اشرافي</h1>
    <br>
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

        @if ($unit->request_status == 'approved')

            <span class="badge" style="background-color:#88304e">مقبولة</span>

        @elseif ($unit->request_status == 'completed')

            <span class="badge bg-success">مكتملة</span>

        @elseif ($unit->request_status == 'rejected')

            <span class="badge bg-danger"

                  data-toggle="modal"

                  data-target="#rejectionModal_{{$unit->id}}"
                    style="display: block;cursor: pointer"
                  data-reason="{{ $unit->rejection_reason }}">


                تم رفض الطلب

            </span>
    <!-- Modal Structure -->

<div class="modal fade" style="z-index: 999999999999999999;margin-top: 120px;" id="rejectionModal_{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="rejectionModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="rejectionModalLabel">سبب الرفض</h5>

                <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="rejectionReason">

                {{ $unit->rejection_reason }}
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>

            </div>

        </div>

    </div>

</div>
        @elseif ($unit->request_status == 'pending')

            <span class="badge bg-warning">قيد المراجعة</span>

        @elseif ($unit->request_status == 'updated')

            <span class="badge bg-info">تم تحديثها</span>

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
        <div class="d-flex justify-content-start gap-2 align-items-end">
            <a href="{{ route('admin.unitDetails', $unit->id) }}"
                class="btn btn-secondary">عرض</a>
            <a href="{{ route('admin.updateUnit' , $unit->id) }}" class="btn btn-success" style="background-color:#88304e">تعديل</a>
            <a href="{{ route('admin.deleteUnit' , $unit->id) }}" class="btn btn-danger">حذف</a>
            @if ($unit->request_status == 'pending')
                <form action="{{ route('admin.approveUnit', $unit->id) }}" method="POST"
                    class="mt-3">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">قبول</button>
                </form>

                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop_{{$unit->id}}">
                    رفض
                </button>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$unit->id}}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header justify-content-start">
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <h1 class="modal-title fs-5 m-0" id="staticBackdropLabel">هل تريد رفض هذه
                            الوحدة؟ رقم{{ $unit->id }}</h1>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.rejectUnit', $unit->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="reason" class="form-label"
                                    style="font-weight: bold;">سبب الرفض</label>
                                <textarea class="form-control" id="reason" name="rejection_reason" rows="3"></textarea>
                            </div>

                            <button type="submit"
                                class="btn btn-primary btn-block mt-3">إرسال</button>
                            <button type="button" class="btn btn-secondary mt-3"
                                data-bs-dismiss="modal">اغلاق</button>

                        </form>
                    </div>
                </div>

            </div>
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


@endSection
