@extends ('admin.commonComponents') 

@section('title', 'طلبات المستخدمين الجديدة')


@section('contents')

        @if(session('success'))
            <div class="alert alert-success text-center" role="alert" style="z-index: 9999; font-size: 22px;">
                <h4>{{ session('success') }}</h4>
            </div>

        @endif
<div class="d-flex justify-content-center align-items-center mb-3 ">
    <i class="fa fa-envelope-open" aria-hidden="true" style="color:#88394E !important;"></i>
    <h3 class="card-title m-3">طلبات المستخدمين الجديدة</h3>
</div>

@if($pendingUsers->isEmpty())
    <p>لا يوجد طلبات</p>
@else
<table class="table table-striped table-hover table-bordered table-responsive text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">الاسم</th>
            <th scope="col">البريد الالكتروني</th>
            <th scope="col">الدور</th>
            <th scope="col">الحالة</th>
            <th scope="col">اجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendingUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if($user->status === 'pending')
                        <span class="badge badge-warning border-0" style="background-color: #88394E !important;">قيد الانتظار</span>
                    @elseif($user->status === 'approved')
                        <span class="badge badge-success">مقبول</span>
                    @else
                        <span class="badge badge-danger">مرفوض</span>
                    @endif
                </td>
                <td class="text-center d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ route('admin/users/show-user', $user->id) }}" class="btn btn-sm btn-success">عرض</a>
                    <form action="{{ route('admin/users/approve', $user->id) }}" method="POST" class="d-inline">
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