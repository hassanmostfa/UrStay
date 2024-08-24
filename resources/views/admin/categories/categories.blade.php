@extends ('admin.commonComponents') 

@section('title', 'التصنيفات')

@section('contents')
<button class="btn btn-primary m-3" style="background:#88394E !important;">
    <i class="fa-solid fa-plus"></i>
    <a style="color:white; text-decoration: none; font-family: 'almarai' !important; " href="{{route('admin/categories/create')}}">
        اضافة تصنيف جديد
    </a>
</button>
<table class="table table-hover table-striped table-bordered text-center table-responsive mx-auto h-25 ">
    <thead>
        <th>#</th>
        <th>الاسم</th>
        <th>الوصف</th> 
        <th>الحالة</th>
        <th>اجراء</th>
    </thead>
    <tbody>
        @if ($categories->count() )
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->status}}</td>
                <td colspan="2">
                    <a href="{{{route('admin/categories/edit', $category->id)}}}" class="btn btn-primary btn-sm" style="background:#88394E !important;">تعديل</a>
                    <a href="{{{route('admin/categories/destroy', $category->id)}}}" class="btn btn-danger btn-sm">حذف</a>
                </td>
            </tr>
            @endforeach
        @else
        <tr class="text-center"><td colspan="4">لا يوجد بيانات حتي الان</td></tr>
        @endif
    </tbody>
</table>
@endsection