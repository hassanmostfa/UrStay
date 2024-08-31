@extends ('admin.commonComponents') 

@section('title', 'عرض تفاصيل الحجز')


@section('contents')
<div class="container mt-2">
    <div class="row">
        <div class="offset-md-2">
            <div class="card">
                <div class="card-header text-white" style="background-color: #88394E !important;">
                    <h3>بيانات الحجز</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>رقم الحجز</th>
                            <td>{{ $booking->id }}</td>
                        </tr>
                        <tr>
                            <th>رقم الوحدة</th>
                            <td>{{ $unit->id }}</td>
                        </tr>
                        <tr>
                            <th>بداية الحجز:</th>
                            <td>{{ $booking->start_date }}</td>
                        </tr>
                        <tr>
                            <th>نهاية الحجز:</th>
                            <td>{{ $booking->end_date }}</td>
                        </tr>
                        <tr>
                            <th>الحالة:</th>
                            <td>
                                @if($booking->status === 'pending')
                                    <span class="badge border-0" style="background-color: #88394E !important;">قيد الانتظار</span>
                                @elseif($booking->status === 'confirmed')
                                    <span class="badge badge-success">مؤكد</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="badge badge-danger">مرفوض</span>
                                @elseif($booking->status === 'completed')
                                    <span class="badge badge-success border-0" style="background-color: #88394E !important;">مكتمل</span>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th>اسم المستاجر</th>
                            <td>{{ $user->name}}</td>
                        </tr>
                        <tr>
                            <th>البريد الالكتروني للمستاجر</th>
                            <td>{{ $user->email}}</td>
                        </tr>
                        <tr>
                            <th>اسم المالك  </th>
                            <td>{{ $unit->owner_name}}</td>
                        </tr>
                        <tr>
                            <th>هاتف المالك  </th>
                            <td>{{ $unit->owner_phone}}</td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-start align-items-center my-3 gap-2 ">
                    <a href="{{ route('admin/bookings') }}" style="background-color: #88394E !important;" class="btn btn-secondary border-0 mt-3">الرجوع للقائمة السابقة</a>
                    @if($booking->status === 'pending')
                    <form action="{{ route('admin/bookings/approve', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="background-color: #88394E !important;" class="btn btn-success border-0 mt-3">تاكيد الحجز</button>
                    </form>
                    <form action="{{ route('admin/bookings/cancel', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="font-family: 'almarai' !important;" class="btn btn-danger border-0 mt-3">الغاء</button>
                    </form>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection