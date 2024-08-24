@extends ('admin.commonComponents') 

@section('title', 'اضافة مستخدم جديد')


@section('contents')

<div class="d-flex justify-content-center align-items-center ">
    <i class="fa-solid fa-user" style="color:#88394E !important;"></i>
    <h2 class="m-3">اضافة مستخدم جديد</h2>
</div>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('admin/user/store') }}" method="POST" class="container">
    @csrf

    <!-- Card 1 -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-white">
            <span>#</span>
            المعلومات الأساسية
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="أدخل الاسم">
            </div>

            <div class="form-group text-end">
                <label for="role" class="form-label">الدور</label>
                <select name="role" id="role" class="form-select">
                    <option selected disabled>اختر الدور</option>
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
                <input type="email" name="email" id="email" class="form-control" placeholder="أدخل البريد الالكتروني">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="أدخل كلمة المرور">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary d-block m-auto my-3" style="background:#88394E !important;">اضافة</button>
</form>

        </div>
    </div>
</div>
@endsection