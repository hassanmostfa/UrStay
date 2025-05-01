@extends('owner.mainComponents')

@section('title', 'اعطاء تصريح للمشرفين')

@section('link_one', 'تصريحات المشرفين')
@section('link_two', 'اضافة')

@section('content')
<div class="container">
    <h2>اعطاء تصريحات للمشرفين</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table displaying assigned permissions --}}
    <div class="card bg-light px-3 mb-5">
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>اسم المشرف</th>
                        <th>التصريح</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permessions as $permission)
                        <tr>
                            <td>{{ $permission->supervisor->first_name . ' ' . $permission->supervisor->last_name }}</td>
                            <td>
                                @if($permission->permission == 'units_managment')
                                    ادارة وحدات
                                @elseif($permission->permission == 'booking_managment')
                                    ادارة حجوزات
                                @endif
                            </td>
                           <td>
                                <a class="btn btn-danger" href="{{ route("permission.delete", ["id" => $permission->id]) }}">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $permessions->links() }}
            </div>
        </div>
    </div>

    {{-- Form to assign new permissions --}}
    <form action="{{ route('owner.assignPermissions') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="supervisor">اختار مشرف عقاري</label>
            <select name="supervisor_id" id="supervisor" class="form-control" required>
                @foreach($supervisors as $supervisor)
                    <option value="{{ $supervisor->id }}">{{ $supervisor->first_name . ' - ' . $supervisor->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="role">اختار تصريح:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="units_managment">ادارة وحدات</option>
                <option value="booking_managment">ادارة حجوزات</option>
            </select>
        </div>

        <input type="hidden" name="owner_id" value="{{ auth()->user()->id }}">

        <button type="submit" class="btn btn-primary mt-4">اعطاء التصريح</button>
    </form>
</div>
@endsection
