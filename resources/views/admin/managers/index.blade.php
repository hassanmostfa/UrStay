@extends('admin.mainComponents')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- جدول المسؤولين -->
            <div class="card mt-4">
                <div class="card-header">المسؤولين</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>الاسم الاول</th>
                                <th>الاسم الاخير</th>
                                <th>البريد الإلكتروني</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>{{ $admin->first_name }}</td>
                                    <td>{{ $admin->last_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.adminUnits', ['id' => $admin->id]) }}" class="btn btn-sm btn-primary">عرض الوحدات</a>
                                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('هل أنت متأكد؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لم يتم العثور على مسؤولين.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- الترقيم (إذا لزم الأمر) -->
                    {{ $admins->links() }}
                </div>
            </div>

                        <!-- نموذج إضافة مسؤول -->
                        <div class="card">
                            <div class="card-header">إضافة مسؤول</div>

                            <div class="card-body">
                                <form action="{{ route('admins.store') }}" method="POST">
                                    @csrf

                                    <!-- الاسم -->
                                    <div class="form-group mb-3">
                                        <label for="name">الاسم الاول</label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- الاسم -->
                                    <div class="form-group mb-3">
                                        <label for="name">الاسم الاخير</label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- البريد الإلكتروني -->
                                    <div class="form-group mb-3">
                                        <label for="email">البريد الإلكتروني</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- كلمة المرور -->
                                    <div class="form-group mb-3">
                                        <label for="password">كلمة المرور</label>
                                        <input type="password" name ="password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- زر الإرسال -->
                                    <button type="submit" class="btn btn-primary">إضافة مسؤول</button>
                                </form>
                            </div>
                        </div>

                        <div class="">
                            <!-- Existing content here -->

                            <!-- Add the unit assignment form at the end -->
                            <div class="card mt-4">
                                <div class="card-header">تعيين وحدة إلى مسؤول</div>

                                <div class="card-body">
                                    <form action="{{ route('assignUnitToAdmin') }}" method="POST">
                                        @csrf

                                        <!-- Select Unit with Select2 -->
                                        <div class="form-group mb-3">
                                            <label for="unit">اختر الوحدة</label>
                                            <select name="unit_id" id="unit" class="form-control select2 @error('unit_id') is-invalid @enderror" required>
                                                <option value="">اختر وحدة</option>
                                                @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Select Admin with Select2 -->
                                        <div class="form-group mb-3">
                                            <label for="admin">اختر المسؤول</label>
                                            <select name="admin_id" id="admin" class="form-control select2 @error('admin_id') is-invalid @enderror" required>
                                                <option value="">اختر مسؤول</option>
                                                @foreach($allAdmins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->first_name }} {{ $admin->last_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('admin_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">تعيين الوحدة</button>
                                    </form>
                                </div>
                            </div>
                        </div>
<br>
<br>
<br>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Select2 JS and CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 on both select elements
        $('.select2').select2({
            placeholder: "اختر",
            allowClear: true
        });
    });
</script>
@endsection
