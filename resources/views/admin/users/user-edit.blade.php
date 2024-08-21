@extends ('admin.commonComponents') 

@section('title', 'تعديل بيانات المستخدم')

@section('contents')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            <hr />
            <form action="{{ route('admin/user/update' , $user->id) }}" method="POST" class="container mt-5 p-4 border rounded">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">اسم المستخدم</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">الدور</label>
        <select name="role" id="" class="form-select">
            <option disabled selected> {{ $user->role }}</option>
            <option value="admin">Admin</option>
            <option value="owner">Owner</option>
            <option value="user">User</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status" class="form-label">البريد الالكتروني</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="أدخل البريد الالكتروني">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">كلمة المرور</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary w-100" style="background:#88394E !important;">تعديل</button>
</form>

        </div>
    </div>
</div>
@endsection 