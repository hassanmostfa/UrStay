@extends('layouts.admin')

@section('title', 'كل الوحدات')

@section('link_one', 'الوحدات')
@section('link_two', 'الكل')
@section('my_unit_active', 'active')
@php
    $categories = \App\Models\Unit::select('category')->distinct()->get();
    $cities = \App\Models\Unit::select('city_name')->distinct()->get();
@endphp

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <div class="container mt-3">
        <h1 style="text-align: center; color: #8e3151; font-family: MainFontBold">وحداتي</h1>
        <br>

        <!-- Filter Form -->

        <form method="GET" action="{{ route('owner.myUnits') }}">
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="text" id="search" value="{{ request()->get('search') }}" name="search" class="form-control m-0" placeholder="ابحث عن العنوان أو الموقع">
                </div>

                <div class="col-md-3 my-2">
                    <select id="category" name="category" class="form-select">
                        <option value="">اختر التصنيف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 my-2">
                    <select id="city" name="city" class="form-select">
                        <option value="">اختر المدينة</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 my-2">
                    <select id="status" name="status" class="form-select">
                        <option value="">اختر الحالة</option>
                        <option value="approved">تم قبول الوحدة</option>
                        <option value="completed">مقبول (تم استكمال البيانات)</option>
                        <option value="rejected">تم رفض الطلب</option>
                        <option value="pending">قيد المراجعة</option>
                    </select>
                </div>

                <div class="col-md-3 my-2 d-flex gap-2">
                    <a href="{{ route('owner.myUnits') }}" class="btn btn-dark w-100">الغاء الفلتر</a>
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
                        <th>العنون</th>
                        <th>التصنيف</th>
                        <th>المدينة</th>
                        <th>الحالة</th>
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
                            <td>{{ $unit->category }}</td>
                            <td>{{ $unit->city_name }}</td>
                            <td>
                                @if ($unit->request_status == 'approved')
                                    <span class="badge" style="background-color:#88304e">تم قبول الوحدة</span>
                                @elseif ($unit->request_status == 'completed')
                                    <span class="badge bg-success">مقبول (تم استكمال البيانات)</span>
                                @elseif ($unit->request_status == 'rejected')
                                <div class="d-flex gap-3 justify-content-center">

                                        <span class="badge bg-danger">تم رفض الطلب</span>
                                        <span class="badge bg-dark" data-toggle="modal"
                                        data-target="#rejectionModal_{{ $unit->id }}"
                                        style="display: block;cursor: pointer" data-reason="{{ $unit->rejection_reason }}">


                                        سبب الرفض

                                    </span>
                                </div>
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

                                @elseif ($unit->request_status == 'pending')
                                    <span class="badge bg-warning">قيد المراجعة</span>
                                @endif
                            </td>
                            <td>
                                @if ($unit->request_status == 'approved')
                                    <a href="{{ route('owner.unitDetails', $unit->id) }}"
                                        class="btn btn-secondary btn-sm">مقبول</a>
                                @else
                                    <a href="{{ route('owner.unitDetails', $unit->id) }}"
                                        class="btn btn-secondary btn-sm">عرض</a>
                                @endif

                                <a href="{{ route('owner.updateUnit', $unit->id) }}" class="btn btn-success btn-sm"
                                    style="background-color:#88304e">تعديل</a>
                                <a href="{{ route('owner.deleteUnit', $unit->id) }}" class="btn btn-danger btn-sm">حذف</a>
                            </td>
                        </tr>
                    @endforeach

                    @if ($units->count() == 0)
                        <tr>
                            <td colspan="10">
                                <h2>لا توجد وحدات مضافة</h2>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to get URL parameters
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)'),
                    results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            // Get the values from the URL
            const category = getUrlParameter('category');
            const city = getUrlParameter('city');
            const status = getUrlParameter('status');
            const search = getUrlParameter('search'); // Get the search parameter

            // Set the selected value for category
            if (category) {
                const categorySelect = document.getElementById('category');
                categorySelect.value = category;
            }

            // Set the selected value for city
            if (city) {
                const citySelect = document.getElementById('city');
                citySelect.value = city;
            }

            // Set the selected value for status
            if (status) {
                const statusSelect = document.getElementById('status');
                statusSelect.value = status;
            }

            // Set the value for search input
            if (search) {
                const searchInput = document.getElementById('search');
                searchInput.value = search;
            }
        });
    </script>
@endsection
