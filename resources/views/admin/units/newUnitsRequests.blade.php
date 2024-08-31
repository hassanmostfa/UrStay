@extends ('admin.commonComponents') 

@section('title', 'طلبات الوحدات الجديدة')


@section('contents')
    
    @if(session('success'))
        <div class="alert alert-success text-center" style="z-index: 9999; font-size: 20px;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center" style="z-index: 9999; font-size: 20px;">{{ session('error') }}</div>
    @endif

<div class="d-flex justify-content-center align-items-center mb-3 ">
    <i class="fa fa-building" aria-hidden="true" style="color:#88394E !important;"></i>
    <h3 class="card-title m-3">طلبات الوحدات الجديدة</h3>
</div>

@if($pendingUnits->isEmpty())
    <p>لا يوجد طلبات</p>
@else
<table class="table table-striped table-hover table-bordered table-responsive text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">المالك</th>
            <th scope="col">العنوان</th>
            <th scope="col">الموقع</th>
            <th scope="col">المساحة</th>
            <th scope="col">التصنيف</th>
            <th scope="col">حالة الطلب</th>
            <th scope="col">اجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendingUnits as $unit)
            <tr>
                <td>{{ $unit->owner_name }}</td>
                <td>{{ $unit->unit_title }}</td>
                <td>{{ $unit->unit_location }}</td>
                <td>{{ $unit->unit_size }}</td>
                <td>{{ $unit->unit_type }}</td>
                <td>
                    @if($unit->request_status === 'pending')
                        <span class="badge badge-warning border-0" style="background-color: #88394E !important;">قيد الانتظار</span>
                    @elseif($unit->request_status === 'approved')
                        <span class="badge badge-success">مقبول</span>
                    @else
                        <span class="badge badge-danger">مرفوض</span>
                    @endif
                </td>
                <td class="text-center d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ route('admin/units/show-unit', $unit->id) }}" class="btn btn-sm btn-success">عرض</a>
                    <form action="{{ route('admin/units/approve', $unit->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-success border-0" style="background-color: #88394E !important; font-family: 'almarai' !important;">تاكيد</button>
                    </form>
                    <a href="#" class="btn btn-sm btn-danger">رفض</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection