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

    <div class="container text-right my-5">
        <div class="row flex-column">
            <h1 style="color: #89314f !important;">{{ $unit->unit_title }}</h1>
            <span> كوود الوحدة : {{ $unit->id }}</span>
        </div>
        <div class="row my-4 font-weight-bold">
            <span class="ml-4"> <i class="fas fa-star ml-2" style="color: #ffc107;"></i>التقييم : {{ $unit->rate }}</span>
            <span class="ml-4"><i class="fas fa-map-marker-alt ml-2" style="color: #89314f !important;"></i>موقع الوحدة : {{ $unit->unit_location }}</span>
            <span class="ml-4"><i class="fas fa-home ml-2" style="color: #89314f !important;"></i>المساحة : {{ $unit->unit_size }} م<sup>2</sup></span>
        </div>
        <div class="row my-3">
            <img style="height: 500px;border-radius: 20px;" class="img-fluid w-100" src="{{ url('http://127.0.0.1:8000/' . $unit->unit_image) }}" alt="Image of {{ $unit->unit_title }}" class="img-fluid">
        </div>
        <div class="row my-5 justify-content-between ">
            <div class="col-sm-7">
                <div class="description mb-4" style="font-size: 18px;line-height: 32px;">
                    <h2 class="font-weight-bold" style="color: #89314f !important;">الوصف: </h2>
                    <p class="text-justify" style="color: #6c757d;">{{ $unit->unit_description }}</p>
                </div>
                <hr/>
                <div class="owner mb-4" style="font-size: 18px;line-height: 32px;">
                    <h2 class="font-weight-bold" style="color: #89314f !important;">عن المضيف: </h2>
                    <div class="d-flex align-items-center justify-content-start gap-2 my-4">
                        <img style="width: 70px;height: 70px;" class="rounded-circle img-fluid ml-2" src="{{ url('images/faces/face1.jpg') }}" alt="User Image">
                        <h5 class="ml-3 font-weight-bold my-0">{{ $unit->owner_name }}</h5>
                        <span class="ml-3"><i class="fas fa-envelope ml-2" style="color: #89314f !important;"></i> البريد الالكتروني : {{ $unit->owner_email }}</span>
                        <span class="ml-3"><i class="fas fa-phone ml-2" style="color: #89314f !important;"></i> الهاتف : {{ $unit->owner_phone }}</span>
                    </div>
                </div>
                <hr/>
                <div class="options mb-4" style="font-size: 18px;line-height: 32px;">
                    <h2 class="font-weight-bold" style="color: #89314f !important;">المواصفات : </h2>
                    <div class="d-flex justify-content-start flex-wrap flex-column gap-2 my-4">
                        <ul>
                            <li><i class="fas fa-bed ml-2" style="color: #89314f !important;"></i>العدد الغرف : {{ $unit->unit_rooms }}</li>
                            <li><i class="fas fa-bath ml-2" style="color: #89314f !important;"></i>عدد الحمامات : {{ $unit->unit_bathrooms }}</li>
                            <li><i class="fa fa-thermometer-quarter ml-2" style="color: #89314f !important;"></i>الحالة : {{ $unit->unit_status }}</li>
                            <li><i class="fas fa-map-marked ml-2" style="color: #89314f !important;"></i>التصنيف : {{ $unit->unit_type }}</li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h6 class="card-title mb-0">السعر : {{ $unit->unit_price }}ريال سعودي / ليلة</h6>
                    </div>
                    <div class="card-body">
    <form action="{{ route('book-unit', $unit->id) }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">تاريخ البداية</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">تاريخ النهاية</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
        </div>

        <!-- Section to Display Number of Days -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">عدد الأيام</label>
                <input type="text" id="days_count" class="form-control" readonly>
            </input>
        </div>
        <hr/>
        <button type="submit" class="btn w-100 text-center mt-3" style="background-color: #89314f !important;color: white;">
            حجز الوحدة
        </button>
    </form>
</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
    document.getElementById('start_date').addEventListener('change', calculateDays);
    document.getElementById('end_date').addEventListener('change', calculateDays);

    function calculateDays() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        
        if (startDate && endDate && endDate >= startDate) {
            const timeDifference = endDate.getTime() - startDate.getTime();
            const daysDifference = timeDifference / (1000 * 3600 * 24);
            document.getElementById('days_count').value = daysDifference + 1; // Include start day
        } else {
            document.getElementById('days_count').value = '';
        }
    }
</script>
</body>
</html>