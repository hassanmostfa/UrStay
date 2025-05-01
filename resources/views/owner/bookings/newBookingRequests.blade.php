@extends('owner.mainComponents')

@section('title',  ' الحجوزات الجديدة')

@section('link_one', 'الحجوزات')
@section('link_two', 'الجديدة')

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
                    <th>رقم الحجز</th>
                    <th>بداية الحجز </th>
                    <th>نهاية الحجز</th>
                    <th>السعر المعروض من المستخدم</th>
                    <th>ملاحظات</th>
                    <th>السعر الكلي</th>

                    <th>الاجراءات</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>
                        @if ($booking->user_price == null)
                            <span class="badge bg-danger">التفاوض غير متاح</span>
                        @else
                            {{ $booking->user_price }}
                        @endif
                    </td>

                    <td>
                        @if ($booking->note != null)
                            {{ $booking->note }}
                        @else
                        <span class="badge bg-danger">لا يوجد</span>
                        @endif
                    </td>

                    <td>{{ $booking->total_price }}</td>
                    <td>
                        <a href="{{ route('owner.bookingDetails', $booking->id) }}" class="btn btn-primary btn-sm">عرض</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endSection