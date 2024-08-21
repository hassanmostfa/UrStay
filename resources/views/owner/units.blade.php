@extends ('owner.main-owner-dashboard') 

@section('title', 'لوحة تحكم المالك')

@section('contents')
<button class="btn btn-primary btn-lg m-3" style="background:#88394E !important;"><a class="text-white text-decoration-none" href="{{route('owner/create-unit')}}">اضافة وحدة جديدة</a></button>
<table class="table table-hover table-striped table-bordered text-center table-responsive mx-auto h-25 ">
    <thead>
        <th>#</th>
        <th>اسم المالك</th>
        <th>السعر</th>
        <th>المساحة</th>
        <th>عدد الغرف</th>
        <th>عدد الحمامات</th>
        <th>العنوان</th>
        <th>الوصف</th>
        <th>التصنيف</th>
        <th>اجراء</th>
    </thead>
    <tbody>
        @if ($units->count() )
            @foreach ($units as $unit)
            <tr>
                <td>{{$unit->id}}</td>
                <td>{{$unit->owner_name}}</td>
                <td>{{$unit->unit_price}}</td>
                <td>{{$unit->unit_size}}</td>
                <td>{{$unit->unit_rooms}}</td>
                <td>{{$unit->unit_bathrooms}}</td>
                <td>{{$unit->unit_location}}</td>
                <td>{{$unit->unit_description}}</td>
                <td>{{$unit->unit_type}}</td>
                <td colspan="2">
                    <a href="{{route('owner/unit/edit', $unit->id)}}" class="btn btn-primary btn-sm" style="background:#88394E !important;">تعديل</a>
                    <a href="{{route('owner/unit/destroy', $unit->id)}}" class="btn btn-danger btn-sm">حذف</a>
                </td>
            </tr>
            @endforeach
        @else
        <tr class="text-center"><td colspan="4">No data found</td></tr>
        @endif
    </tbody>
</table>
@endSection