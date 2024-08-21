@extends ('admin.commonComponents') 

@section('title', 'اضافة مستخدم جديد')

@section('contents')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
    <form action="{{ route('admin/user/store') }}" method="POST" class="container">
    @csrf
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


    <div class="form-group">
        <label for="status" class="form-label">البريد الالكتروني</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="أدخل البريد الالكتروني">
    </div>

    
    <div class="form-group">
        <label for="status" class="form-label">كلمة المرور</label>
        <input type="password" name="password" id="email" class="form-control" placeholder="أدخل  كلمة المرور">
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-4" style="background:#88394E !important;">اضافة</button>
</form>
        </div>
    </div>
</div>
@endsection