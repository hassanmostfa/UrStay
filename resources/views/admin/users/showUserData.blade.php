@extends ('admin.commonComponents') 

@section('title', 'عرض بيانات المستخدم')


@section('contents')
<div class="container mt-2">
    <div class="row">
        <div class="offset-md-2">
            <div class="card">
                <div class="card-header text-white" style="background-color: #88394E !important;">
                    <h3>بيانات المستخدم</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>الاسم:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>البريد الالكتروني:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>الدور:</th>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                        <tr>
                            <th>الحالة:</th>
                            <td>
                                @if($user->status === 'pending')
                                    <span class="badge border-0" style="background-color: #88394E !important;">قيد الانتظار</span>
                                @elseif($user->status === 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>الهوية الشخصية</th>
                            <td>{{ $user->pid }}</td>
                        </tr>
                        <tr>
                            <th>الصورة الشخصية</th>
                            <td>{{ $user->image}}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin/users/new-requests') }}" style="background-color: #88394E !important;" class="btn btn-secondary mt-3">Back to User List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection