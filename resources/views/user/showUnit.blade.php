<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض تفاصيل الوحدة</title>
    <link rel="stylesheet" href="{{url('Styling/main.css')}}">

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color: #f9fafb;">

@if (Session::has('success'))
        <div class="alert alert-success text-right">{{ Session::get('success') }}</div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger text-right">{{ Session::get('error') }}</div>
    @endif

    <div class="container text-right my-5">
        <div class="row flex-column">
            <h1 style="color: #88304e !important;">{{ $unit->title }}</h1>
            <span> كود الوحدة : {{ $unit->id }}</span>
        </div>
        <div class="row my-4 font-weight-bold">
            <span class="ml-4"> <i class="fas fa-star ml-2" style="color: #ffc107;"></i>التقييم : {{ $unit->rate ?? 'لا يوجد تقييم' }} </span>
            <span class="ml-4"><i class="fas fa-map-marker-alt ml-2" style="color: #88304e !important;"></i>موقع الوحدة : {{ $unit->location }}</span>
            <span class="ml-4"><i class="fas fa-home ml-2" style="color: #88304e !important;"></i>المساحة : {{ $unit->size }} م<sup>2</sup></span>
            <span class="ml-4"><i class="fas fa-home ml-2" style="color: #88304e !important;"></i>هل السعر قابل للتفاوض ؟ : {{ $completedUnit->negotiable_price ? 'نعم' : 'لا' }}</span>
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                @php
                    $images = json_decode($unit->image, true); // Decode JSON images
                @endphp
                @if (!empty($images) && is_array($images))
                    <div id="unitCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image) }}" class="d-block w-100 rounded" alt="Unit Image" style="height: 400px; object-fit: cover;">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="position: absolute; bottom: 15px; right: 20px;">
                                        <i class="fas fa-search"></i>
                                        عرض كل الصور
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid w-100" alt="No Image Available">
                @endif
            </div>


            <!-- Start Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: black; color: white;">
            <div class="modal-header border-0 py-0">

            </div>
            <div class="modal-body">
                @php
                    $images = json_decode($unit->image, true); // Decode JSON images
                    $rooms_images = json_decode($unit->rooms_images, true); // Decode JSON rooms images
                    $kitchen_images = json_decode($unit->kitchen_images, true); // Decode JSON kitchen images
                    $pool_images = json_decode($unit->pool_images, true); // Decode JSON pool images
                    $bathroom_images = json_decode($unit->bathroom_images, true); // Decode JSON bathroom images
                    $building_images = json_decode($unit->building_images, true); // Decode JSON building images
                    $facilities_images = json_decode($unit->facilities_images, true); // Decode JSON facilities images
                    $additional_images = json_decode($unit->additional_images, true); // Decode JSON additional images
                    // Merge the two arrays
                    $allImages = array_merge($images ?? [], $rooms_images ?? [], $kitchen_images ?? [], $pool_images ?? [], $bathroom_images ?? [], $building_images ?? [], $facilities_images ?? [], $additional_images ?? []);
                @endphp

                <h5 class="modal-title mb-2" id="exampleModalLongTitle">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
                    صور الوحدة ({{ count($allImages) }}) صورة <!-- Showing the number of images -->
                </h5>

                @if(!empty($allImages) && is_array($allImages))
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($allImages as $index => $image)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($allImages as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset($image) }}" class="d-block w-100" alt="صورة الوحدة" style="max-height: 450px;">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">السابق</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">التالي</span>
                    </a>
                </div>
                @else
                    <p>لا توجد صور لهذه الوحدة.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom CSS to make the modal bigger and set the background to black */
    .modal-dialog {
        max-width: 1000px; /* Increase modal width */
    }
    .modal-body {
        max-height: 700px; /* Increase modal height */
        overflow-y: auto;  /* Allow scrolling if the content is too large */
    }
    .modal-content {
        background-color: black; /* Set background color to black */
    }
    .carousel-indicators li {
        background-color: white; /* Make carousel indicators visible */
    }
</style>


            <!-- End Modal -->

            <div class="col-md-3">
                <div class="row">
                @php
                        $images = json_decode($unit->rooms_images, true); // Decode JSON images
                    @endphp
                    @if (!empty($images) && is_array($images))
                        <div id="unitCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img  style="height :195px; margin-bottom : 10px; margin-left:10px; width:280px" src="{{ asset($image) }}" class="d-block rounded" alt="Unit Image" style="object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid w-100" alt="No Image Available">
                    @endif
                </div>
                <div class="row">
                @php
                        $images = json_decode($unit->kitchen_images, true); // Decode JSON images
                    @endphp
                    @if (!empty($images) && is_array($images))
                        <div id="unitCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img  style="height : 195px ; width:280px"   src="{{ asset($image) }}" class="d-block rounded" alt="Unit Image" style="object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid " alt="No Image Available">
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                @php
                        $images = json_decode($unit->building_images, true); // Decode JSON images
                    @endphp
                    @if (!empty($images) && is_array($images))
                        <div id="unitCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img  style="height :195px; margin-bottom : 10px; width:280px" src="{{ asset($image) }}" class="d-block rounded" alt="Unit Image" style="object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid" alt="No Image Available">
                    @endif
                </div>
                <div class="row">
                @php
                        $images = json_decode($unit->facilities_images, true); // Decode JSON images
                    @endphp
                    @if (!empty($images) && is_array($images))
                        <div id="unitCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img  style="height : 195px ; width:280px !important"  src="{{ asset($image) }}" class="d-block rounded" alt="Unit Image" style="object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid w-100" alt="No Image Available">
                    @endif
                </div>
            </div>
        </div>


        <div class="row my-5 justify-content-between ">
            <div class="col-sm-7">
                <div class="description mb-4" style="font-size: 18px;line-height: 32px;">
                    <h2 class="font-weight-bold" style="color: #89314f !important;">الوصف: </h2>
                    <p class="text-justify" style="color: #6c757d;">{{ $unit->description }}</p>
                </div>
                <hr/>
                <div class="owner mb-4" style="font-size: 18px;line-height: 32px;">
                    <h2 class="font-weight-bold" style="color: #89314f !important;">عن المضيف: </h2>
                    <div class="d-flex align-items-center justify-content-start gap-2 my-4">
                        <img style="width: 70px;height: 70px;" class="rounded-circle img-fluid ml-2" src="{{ url('images/faces/face1.jpg') }}" alt="User Image">
                        <h5 class="ml-3 font-weight-bold my-0">{{ $owner->first_name }} {{ $owner->last_name }}</h5>
                        <span class="ml-3"><i class="fas fa-envelope ml-2" style="color: #89314f !important;"></i> البريد الالكتروني : {{ $owner->email }}</span>
                        <!-- <span class="ml-3"><i class="fas fa-phone ml-2" style="color: #89314f !important;"></i> الهاتف : {{ $owner->phone }}</span> -->
                    </div>
                </div>
                <hr/>
                <div class="options mb-4" style="font-size: 18px;line-height: 32px;">
                    <h2 class="font-weight-bold" style="color: #89314f !important;">المواصفات : </h2>
                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-building"></i>
                            مرافق العقار
                        </h4>
                        <ul>
                            @php
                                // Check if 'facilities' is already an array, if not, decode it
                                $facilities = is_array($unit->facilities) ? $unit->facilities : json_decode($unit->facilities, true);
                            @endphp

                            @if (!empty($facilities) && is_array($facilities))
                                @foreach ($facilities as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-tint"></i>
                            عدد دورات المياه
                        </h4>
                        <ul>
                           <li>دورات المياه : {{ $unit->bathrooms }}</li>
                        </ul>
                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-door-open"></i>
                            مرافق دورات المياه
                        </h4>
                        <ul>
                            @php
                                // Check if 'bathroom_facilities' is already an array, if not, decode it
                                $bathroom_facilities = is_array($unit->bathroom_facilities) ? $unit->bathroom_facilities : json_decode($unit->bathroom_facilities, true);
                            @endphp

                            @if (!empty($bathroom_facilities) && is_array($bathroom_facilities))
                                @foreach ($bathroom_facilities as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-kitchen-set"></i>
                            مرافق المطبخ
                        </h4>
                        <ul>
                            @php
                                // Check if 'kitchen' is already an array, if not, decode it
                                $kitchen_facilities = is_array($unit->kitchen) ? $unit->kitchen : json_decode($unit->kitchen, true);
                            @endphp

                            @if (!empty($kitchen_facilities) && is_array($kitchen_facilities))
                                @foreach ($kitchen_facilities as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            @endif

                            <!-- Display the number of table chairs -->
                            <li>عدد كراسي طاولة الطعام : {{ $unit->table_chairs }}</li>
                        </ul>

                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-bed"></i>
                            تفاصيل الغرف
                        </h4>
                        <ul>
                           <li>عدد الغرف  : {{ $unit->rooms }}</li>
                           <li>عدد الاسرة المفردة  : {{ $unit->no_of_single_beds }}</li>
                           <li>عدد الاسرة الماستر  : {{ $unit->no_of_master_beds }}</li>
                        </ul>
                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-wifi"></i>
                            مميزات العقار
                        </h4>
                        <ul>
                            @php
                                // Check if 'advantages' is already an array, if not, decode it
                                $advantages = is_array($unit->advantages) ? $unit->advantages : json_decode($unit->advantages, true);
                            @endphp

                            @if (!empty($advantages) && is_array($advantages))
                                @foreach ($advantages as $advantage)
                                    <li>{{ $advantage }}</li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-swimming-pool"></i>
                             هل يوجد مسبح ؟
                        </h4>
                        <ul>
                         @if ($unit->pool == 1)
                            <li class="badge bg-success text-white">يوجد</li>
                            <li>مساحة المسبح : {{ $unit->pool_size }}</li>
                         @else
                            <li class="badge bg-danger text-white">لا يوجد</li>
                         @endif
                        </ul>
                    </div>
                    <hr/>

                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 mt-4">
                        <h4>
                            <i class="fas fa-circle-check"></i>
                            مميزات العقار الاضافية
                        </h4>
                        <ul>
                            @php
                                // Check if 'additional_facilities' is already an array, if not, decode it
                                $additional_facilities = is_array($unit->additional_facilities) ? $unit->additional_facilities : json_decode($unit->additional_facilities, true);
                            @endphp

                            @if (!empty($additional_facilities) && is_array($additional_facilities))
                                @foreach ($additional_facilities as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            @endif
                        </ul>

                    </div>


                </div>
            </div>
            <div class="col-sm-4">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h6 class="card-title mb-0">حجز الوحدة</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center">
                            <i class="fas fa-bookmark text-warning" style="font-size: 16px; margin-left: 5px;"></i>
                            <p class="mb-0">يمكنك حجز هذه الوحدة : </p>
                            <span class="badge bg-warning text-white rounded" style="font-size: 12px; font-weight: 500; padding: 5px 10px;">
                                {{ $completedUnit->booking_status == 'immediate' ? 'فوري' : 'بموعد مسبق' }}
                            </span>
                        </div>

                        <!-- Include Flatpickr CSS and JS -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                        <form action="{{ route('user.bookUnit', $unit->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="start_date" class="form-label">تاريخ البدء</label>
                                <input type="text" placeholder="اختر تاريخ" name="start_date" id="start_date" class="form-control flatpickr" required>
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                                <input type="text" placeholder="اختر تاريخ" name="end_date" id="end_date" class="form-control flatpickr" required>
                            </div>

                            @if($completedUnit->negotiable_price)
                                <label for="user_price">سعر الضيف</label>
                                <input type="number" class="form-control" name="user_price" id="user_price" step="0.01">
                            @endif

                            <label for="note">ملاحظات</label>
                            <textarea name="note" class="form-control" id="note"></textarea>

                            <h4>السعر الإجمالي: <span id="total_price">0</span> <small>ر.س</small></h4>

                            <button type="submit" class="btn btn-primary">احجز الآن</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.querySelectorAll('#start_date, #end_date').forEach(function(element) {
        element.addEventListener('change', function() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                // Fetch the URL from the named route using Laravel's route() helper
                const url = '{{ route("user.calculatePrice") }}';

                // Using fetch to make a POST request
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for Laravel
                    },
                    body: JSON.stringify({
                        start_date: startDate,
                        end_date: endDate,
                        unit_id: {{ $completedUnit->unit_id }}
                    })
                })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    // Update the total price in the DOM
                    document.getElementById('total_price').textContent = data.total_price;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Fetch reserved dates from the server
        $.ajax({
            url: '/units/{{ $unit->id }}/reserved-dates',
            method: 'GET',
            success: function (response) {
                console.log(response); // Check the response data here to ensure it's valid

                // Create an array to hold disabled dates
                const disabledDates = [];

                // Iterate through the response to gather reserved dates
                response.forEach(function (booking) {
                    if (booking.start_date && booking.end_date) {
                        const startDate = new Date(booking.start_date);
                        const endDate = new Date(booking.end_date);

                        // Push all dates in the range into the disabledDates array
                        while (startDate <= endDate) {
                            disabledDates.push(new Date(startDate)); // Push a clone of the date
                            startDate.setDate(startDate.getDate() + 1); // Move to the next date
                        }
                    } else {
                        console.error('Invalid booking data:', booking);
                    }
                });

                // Initialize Flatpickr
                flatpickr('.flatpickr', {
                    dateFormat: "Y-m-d", // Format for your date input
                    minDate: "today", // Prevent past dates
                    disable: disabledDates,
                    // You can add other Flatpickr options here
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching reserved dates:', error);
            }
        });
    });
</script>

</body>
</html>
