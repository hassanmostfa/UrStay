@extends('admin.mainComponents')

@section('title', 'المشرفين ')

@section('link_one', 'المشرفين ')
@section('link_two', 'كل المشرفين')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supervisors as $supervisor)
            <tr>
                <td>{{ $supervisor->first_name }}</td>
                <td>{{ $supervisor->last_name }}</td>
                <td>{{ $supervisor->phone }}</td>
                <td>{{ $supervisor->email }}</td>
                <td>{{ $supervisor->isApproved ? "تم التفعيل" : "غير مفعل" }}</td>
                <td>
                    @if($supervisor->isApproved == 0)
                        <a href="{{ route('supervisor.approve', $supervisor->id) }}" class="btn btn-success">Approve</a>
                    @else
                        <a href="{{ route('supervisor.reject', $supervisor->id) }}" class="btn btn-danger">Reject</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination links -->
{{ $supervisors->links() }}

@endsection