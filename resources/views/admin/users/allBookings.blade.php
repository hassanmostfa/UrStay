
@extends ('admin.commonComponents') 

@section('title', 'كل الحجوزات')

@section('contents')
<div class="d-flex justify-content-center align-items-center my-3 gap-2">
<i class="fa fa-calendar-check-o" style="color:#88394E !important; font-size: 22px" aria-hidden="true"></i>
    <h3 class="m-0">كل الحجوزات</h3>
</div>
<table class="table table-hover table-striped table-bordered text-center table-responsive mx-auto h-25 ">
    <thead>
        <th>رقم الحجز</th>
        <th>بداية الحجز </th>
        <th>نهاية الحجز</th> 
        <th>رقم المالك</th>
        <th>رقم المستاجر</th>
        <th>رقم الوحدة</th>
        <th>الحالة</th>
        <th>اجراء</th>
    </thead>
    <tbody>
        @if ($bookings->count() )
            @foreach ($bookings as $booking)
            <tr>
                <td>{{$booking->id}}</td>
                <td>{{$booking->start_date}}</td>
                <td>{{$booking->end_date}}</td>
                <td>{{$booking->owner_id}}</td>
                <td>{{$booking->user_id}}</td>
                <td>{{$booking->unit_id}}</td>
                <td>
                    @if($booking->status === 'confirmed')
                        <span class="badge badge-success">مؤكد</span>
                        @elseif($booking->status === 'cancelled')
                        <span class="badge badge-danger">مرفوض</span>
                        @elseif($booking->status === 'completed')
                        <span class="badge badge-success border-0" style="background-color: #88394E !important;">مكتمل</span>
                    @endif
                </td>
                <td colspan="2">
                    <a href="{{route('admin/bookings/show-booking-details', $booking->id)}}" class="btn btn-primary btn-sm" style="background:#88394E !important;">التفاصيل</a>
                </td>
            </tr>
            @endforeach
        @else
        <tr class="text-center" class="text-center alert w-100"><td colspan="4">لا يوجد بيانات حتي الان</td></tr>
        @endif
    </tbody>
</table>r

@endSection