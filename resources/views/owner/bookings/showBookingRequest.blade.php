@extends('owner.mainComponents')

@section('title',  'بيانات حجز')

@section('link_one', 'الحجوزات')
@section('link_two', 'عرض')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif


<div class="container mt-2">
    <div class="row">
        <div class="col-md-12 offset-md-2">
            <div class="card">
                <div class="card-header p-3 text-white" style="background-color: #88394E !important;">
                    <h3 class="my-0"> بيانات حجز الوحدة  رقم :  {{ $completed_unit->unit_id }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Left side: Table for Unit Details -->
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>اسم المستاجر</th>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                </tr>

                                <tr>
                                    <th>البريد الالكتروني الخاص بالمستاجر</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <th>رقم الوحدة المراد حجزها </th>
                                    <td>{{ $completed_unit->unit_id }}</td>
                                </tr>

                                <tr>
                                    <th>رقم الحجز</th>
                                    <td>{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <th>بداية الحجز</th>
                                    <td>{{ $booking->start_date }}</td>
                                </tr>

                                <tr>
                                    <th>نهاية الحجز</th>
                                    <td>{{ $booking->end_date}}</td>
                                </tr>

                                <tr>
                                    <th>السعر المعروض من المستخدم</th>
                                    <td>
                                        @if ($booking->user_price == null)
                                            <span class="badge bg-danger">التفاوض غير متاح</span>
                                        @else
                                            {{ $booking->user_price }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>ملاحظات</th>
                                    <td>
                                        @if ($booking->note != null)
                                            {{ $booking->note }}
                                        @else
                                        <span class="badge bg-danger">لا يوجد</span>
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <th>السعر الكلي</th>
                                    <td>{{ $booking->total_price }}</td>
                                </tr>
                            </table>
                            
                            <div class="d-flex justify-content-start mt-3 gap-2">
                            
                            @if ($booking->booking_status == 'in_negotiation')
                                <a href="{{ route('owner.newBookings') }}" style="background-color: #88394E !important;" class="btn btn-secondary mt-3">عودة إلى قائمة الطلبات</a>
                            @else
                                <a href="{{ route('owner.bookings') }}" style="background-color: #88394E !important;" class="btn btn-secondary mt-3">عودة إلى قائمة الطلبات</a>
                            @endif
                        
                        @if ($booking->booking_status == 'in_negotiation')
                        <form action="{{ route('owner.acceptBooking', $booking->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">قبول</button>
                        </form>

                        <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        رفض
                        </button>
                        @endif
                    </div>

                     <!-- Modal -->
                     <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 800px;">
                            <div class="modal-content">
                            <div class="modal-header justify-content-start">
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                <h1 class="modal-title fs-5 m-0" id="staticBackdropLabel">هل تريد رفض هذه الوحدة؟ رقم</h1>
                            </div>
                            <div class="modal-body">
                            <form action="#" method="POST">
                                @csrf
                                @method('PUT')
                                    
                                <div class="mb-3">
                                    <label for="reason" class="form-label" style="font-weight: bold;">سبب الرفض</label>
                                    <textarea class="form-control" id="reason" name="rejection_reason" rows="3"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-3">إرسال</button>
                                <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">اغلاق</button>

                            </form>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    </div>


                        </div>
                    </div>
@endsection
