@extends('admin.commonComponents')

@section('title', 'عرض بيانات الوحدة')

@section('contents')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="row g-0">
            <!-- Text Data Column -->
            <div class="col-lg-6">
                <div class="card-body px-4 py-3">
                    <h2 class="card-title mb-4 text-center">{{ $unit->unit_title }}</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>الموقع:</strong></span>
                            <span>{{ $unit->unit_location }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>اسم المالك:</strong></span>
                            <span>{{ $unit->owner_name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>التقييم:</strong></span>
                            <span>{{ $unit->rate}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>المساحة:</strong></span>
                            <span>{{ $unit->unit_size }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>السعر:</strong></span>
                            <span>{{ $unit->unit_price }} EGP</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>عدد الغرف:</strong></span>
                            <span>{{ $unit->unit_rooms }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>عدد الحمامات:</strong></span>
                            <span>{{ $unit->unit_bathrooms }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>التصنيف:</strong></span>
                            <span>{{ $unit->unit_type }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>البريد الالكتروني للمالك:</strong></span>
                            <span>{{ $unit->owner_email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>هاتف المالك:</strong></span>
                            <span>{{ $unit->owner_phone }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>الوصف:</strong>
                            <p class="mb-0 mt-2">{{ $unit->unit_description }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Image Preview Column -->
            <div class="col-lg-6">
                @if($unit->unit_image)
                    <img src="{{ url('http://127.0.0.1:8000/' . $unit->unit_image) }}" alt="Image of {{ $unit->unit_title }}" class="img-fluid rounded-end h-100">
                @else
                    <div class="card-body text-center">
                        <p class="text-muted">No image available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
