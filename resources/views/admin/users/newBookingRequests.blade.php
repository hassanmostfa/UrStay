
@extends ('admin.commonComponents') 

@section('title', 'طلبات الحجز')

@section('contents')


    @if(session('success'))
        <div class="alert alert-success text-center" style="z-index: 9999; font-size: 20px;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center" style="z-index: 9999; font-size: 20px;">{{ session('error') }}</div>
    @endif


<div class="d-flex justify-content-center align-items-center my-3 gap-2">
<i class="fa fa-calendar-check-o" style="color:#88394E !important; font-size: 22px" aria-hidden="true"></i>
    <h3 class="m-0">طلبات الحجز الجديدة</h3>
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
        @if ($newBookings->count() )
            @foreach ($newBookings as $newBooking)
            <tr>
                <td>{{$newBooking->id}}</td>
                <td>{{$newBooking->start_date}}</td>
                <td>{{$newBooking->end_date}}</td>
                <td>{{$newBooking->owner_id}}</td>
                <td>{{$newBooking->user_id}}</td>
                <td>{{$newBooking->unit_id}}</td>
                <td>
                    @if($newBooking->status === 'confirmed')
                        <span class="badge badge-success">مؤكد</span>
                        @elseif($newBooking->status === 'cancelled')
                        <span class="badge badge-danger">مرفوض</span>
                        @elseif($newBooking->status === 'pending')
                        <span class="badge badge-warning border-0" style="background-color: #88394E !important;">قيد الانتظار</span>
                    @endif
                </td>
                <td colspan="2">
                    <div class="d-flex justify-content-center align-items-center my-3 gap-2 ">
                    <a href="{{route('admin/bookings/show-booking-details', $newBooking->id)}}" class="btn btn-success btn-sm">التفاصيل</a>
                    <form action="{{route('admin/bookings/approve', $newBooking->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-sm" style="background:#88394E !important; font-family: 'almarai' !important; color:white">تاكيد</button>
                    </form>
                    <form action="{{route('admin/bookings/cancel', $newBooking->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-sm btn-danger" style=" font-family: 'almarai' !important; color:white">الغاء</button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
        @else
        <tr class="text-center" class="text-center alert w-100"><td colspan="8" class="text-center alert w-100">لا يوجد بيانات حتي الان</td></tr>
        @endif
    </tbody>
</table>r

@endSection