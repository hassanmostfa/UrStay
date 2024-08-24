
@extends ('admin.commonComponents') 

@section('title', 'كل المستخدمين')

@section('contents')
<button class="btn btn-primary m-3" style="background:#88394E !important;">
    <i class="fa-solid fa-plus"></i>
    <a style="color:white; text-decoration: none; font-family: 'almarai' !important;" class="d-inline gap-2" href="{{route('admin/user/create')}}">
        اضافة مستخدم جديد
    </a>
</button>
<table class="table table-hover table-striped table-bordered text-center table-responsive mx-auto h-25 ">
    <thead>
        <th>#</th>
        <th>الاسم</th>
        <th>الدور</th> 
        <th>البريد الالكتروني</th>
        <th>اجراء</th>
    </thead>
    <tbody>
        @if ($users->count() )
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->email}}</td>
                <td colspan="2">
                    <a href="{{route('admin/user/edit' , $user->id)}}" class="btn btn-primary btn-sm" style="background:#88394E !important;">تعديل</a>
                    <form action="{{route('admin/user/destroy' , $user->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @else
        <tr class="text-center" class="text-center alert"><td colspan="4">لا يوجد بيانات حتي الان</td></tr>
        @endif
    </tbody>
</table>r

@endSection