@extends ('admin.commonComponents') 

@section('title', 'تعديل بيانات المستخدم')

@section('contents')
<div class="d-flex justify-content-center align-items-center ">
    <i class="fa-solid fa-pen-to-square" style="color:#88394E !important;"></i>
    <h2 class="m-3">تعديل بيانات المستخدم</h2>
</div>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('admin/user/update', $user->id) }}" method="POST" class="container mt-5">
    @csrf
    @method('PUT')

    <!-- Card 1 -->
    <div class="card mb-4 shadow bg-white">
        <div class="card-header bg-white">
        <span>#</span>
            معلومات المستخدم
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">اسم المستخدم</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">الدور</label>
                <select name="role" value="{{ $user->role }}" id="role" class="form-select">
                    <option disabled selected>{{ $user->role }}</option>
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                    <option value="user">User</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
        <span>#</span>
            معلومات الدخول
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="email" class="form-label">البريد الالكتروني</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="أدخل البريد الالكتروني">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary d-block m-auto my-3" style="background:#88394E !important;">تعديل</button>
</form>

        </div>
    </div>
</div>
@endsection 