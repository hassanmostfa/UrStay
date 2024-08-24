<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>UrStay - luxury apartments</title>
<meta name="author" content="Sayed Khattab">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Fav Icon -->
<link rel="icon" href="user-assets/images/favicon.png" type="image/png">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Stylesheets -->
<link href="user-assets/css/font-awesome-all.css" rel="stylesheet">
<link href="user-assets/css/flaticon.css" rel="stylesheet">
<link href="user-assets/css/owl.css" rel="stylesheet">
<link href="user-assets/css/bootstrap.css" rel="stylesheet">
<link href="user-assets/css/jquery.fancybox.min.css" rel="stylesheet">
<link href="user-assets/css/animate.css" rel="stylesheet">
<link href="user-assets/css/nice-select.css" rel="stylesheet">
<link href="user-assets/css/color.css" rel="stylesheet">
<link href="user-assets/css/style.css" rel="stylesheet">
<link href="user-assets/css/responsive.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

</head>


<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">


        <!-- preloader -->
        <div class="preloader"></div>
        <!-- preloader -->


        <!-- main header -->
        <header class="main-header style-one">
            <!-- header-top -->
            <div class="header-top">
            <div class="auto-container">
                    <div class="top-inner clearfix">
                        <ul class="info pull-left clearfix">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation">
                                <li><a href="{{ route('login') }}" style="color: white; font-weight: 800;">دخول المضيفين</a></li>   
                                <li class="dropdown"><a href="#" style="color: white;">تواصل معنا</a></li>  
                                <li class="dropdown"><a href="#" style="color: white;">من نحن</a></li> 
                            </ul>
                        </div>
                        </ul>
                        <div class="right-column pull-right clearfix">
                            <ul class="social-links clearfix">
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                            <div class="dropdown-box clearfix">
                                <div class="language">
                                    <a href="#" class="link" onclick="changeLanguage('en')">العربية</a>
                                    <ul>
                                        <li><a href="#" onclick="changeLanguage('ar')">English</a></li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!-- header-lower -->
            <div class="auto-container">
                <div class="header-lower">
                    <div class="outer-box" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="menu-right-content" style="order: 1;">
                            <div class="btn-box"><a href="{{ route('register') }}" class="theme-btn-one"><span class="btn-shape"></span>انضم الينا</a></div>
                        </div>
                        <div class="menu-area" style="order: 2;">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                            
                            </nav>
                        </div>
                        <div class="logo-box" style="order: 3;">
                            <figure class="logo"><a href="/"><img src="user-assets/images/logo.png" alt=""></a></figure>
                        </div>
                    </div>
                </div>
            </div>



            <!--sticky Header-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="header-lower">
                        <div class="outer-box" style="display: flex; justify-content: space-between; align-items: center; top: 0px !important;">
                            <div class="menu-right-content" style="order: 1;">
                                <div class="btn-box"><a href="{{ route('register')}}" class="theme-btn-one"><span class="btn-shape"></span>انضم الينا</a></div>
                            </div>
                            <div class="menu-area" style="order: 2;">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler">
                                    <i class="icon-bar"></i>
                                    <i class="icon-bar"></i>
                                    <i class="icon-bar"></i>
                                </div>
                                <nav class="main-menu navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        
                                        <!-- <ul class="navigation">
                                        <li><a href="{{ route('login') }}" style="color: #89314f; font-weight: 800;">دخول الملاك</a></li>   
                                        <li class="dropdown"><a href="#">تواصل معنا</a></li>  
                                        <li class="dropdown"><a href="#">خدماتنا</a></li> 
                                        <li class="dropdown"><a href="#">من نحن</a></li> 
                                            <li class="current dropdown"><a href="/">الرئيسية</a></li>
                                        </ul> -->
                                    </div>
                                </nav>
                            </div>
                            <div class="logo-box" style="order: 3;">
                                <figure class="logo"><a href="/"><img src="user-assets/images/logo.png" alt=""></a></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

       <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>
            
            <nav class="menu-box">
                <!-- إزالة محتويات القائمة الأصلية -->
                <div class="menu-outer"></div>
                
                <!-- استبدال الأزرار الأصلية بزر "انضم إلينا" -->
                <div class="btn-box" style="margin-top: 40px;">
                    <a href="{{ route('register') }}" class="theme-btn-one"><span class="btn-shape"></span>انضم الينا</a>
                </div>
            </nav>
        </div>
        <!-- End Mobile Menu -->



        <!-- banner-section -->
        <section class="banner-section">
            <div class="banner-carousel owl-theme owl-carousel owl-nav-none">
                <!-- Slide Item 1 -->
                <div class="slide-item" style="direction: rtl !important;">
                    <div class="image-layer" style="background-image:url(user-assets/images/banner/banner-1.jpg)"></div>
                    <div class="auto-container" style="direction: rtl !important; text-align: center; display: flex; align-items: center; justify-content: space-between;">
                        <div class="content-box" style="width: 60%;">
                            <h1>اعرض عقارك معنا في UrStay والباقي علينا</h1>
                            <p style="font-weight: 100 !important;">
                            اشترك في منصة Urstay وزوّد دخلك من خلال وصولك لشريحة كبيرة من المستأجرين الباحثين عن إقامة مميزة.</p>
                            <div class="btn-box clearfix">
                                <a href="#" class="theme-btn-one"><span class="btn-shape"></span>اضف عقارك الآن</a>
                            </div>
                        </div>
                        <img src="user-assets/images/banner/phone.png" alt="Phone" style="width: 40%; height: auto;">
                    </div>
                </div>
                <!-- Slide Item 2 -->
                <div class="slide-item" style="direction: rtl !important;">
                    <div class="image-layer" style="background-image:url(assets/images/banner/banner-2.jpg)"></div>
                    <div class="auto-container" style="direction: rtl !important; text-align: center; display: flex; align-items: center; justify-content: space-between;">
                        <div class="content-box" style="width: 60%;">
                            <h1>سجل عقارك معنا في UrStay والباقي علينا</h1>
                            <p style="font-weight: 100 !important;">
                            انضمامك إلى منصة يور ستاي كمضيف يزيد من دخلك بعرض وحدتك الى جمهور واسع من النزلاء داخل المملكة وخارجها المهتمين بتجربة اقامة مميزة في حضارتنا السعودية.                            </p>
                            <div class="btn-box clearfix">
                                <a href="#" class="theme-btn-one"><span class="btn-shape"></span>اضف عقارك الآن</a>
                            </div>
                        </div>
                        <img src="user-assets/images/banner/phone.png" alt="Phone" style="width: 40%; height: auto;">
                    </div>
                </div>
                <!-- Slide Item 3 -->
                <div class="slide-item" style="direction: rtl !important;">
                    <div class="image-layer" style="background-image:url(user-assets/images/banner/banner-3.jpg)"></div>
                    <div class="auto-container" style="direction: rtl !important; text-align: center; display: flex; align-items: center; justify-content: space-between;">
                        <div class="content-box" style="width: 60%;">
                        <h1>اعرض عقارك معنا في UrStay والباقي علينا</h1>
                        <p style="font-weight: 100 !important;">
                        اشترك في منصة Urstay وزوّد دخلك من خلال وصولك لشريحة كبيرة من المستأجرين الباحثين عن إقامة مميزة.</p>
                        </p>
                            <div class="btn-box clearfix">
                                <a href="#" class="theme-btn-one"><span class="btn-shape"></span>اضف عقارك الآن</a>
                            </div>
                        </div>
                        <img src="user-assets/images/banner/phone.png" alt="Phone" style="width: 40%; height: auto;">
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-section end -->



        <!-- service-form-section -->
        <section class="service-form-section" style="direction: rtl;">
            <span class="title-text">UrStay</span>
            <div class="auto-container">
                <div class="service-form">
                    <div class="title-inner">
                        <div class="text" style="text-align: center;">
                            <h2>وش نقدم لك في منصة يور ستاي</h2>
                        </div>
                    </div>
                    <div class="carousel-inner" style="direction: ltr;">
                <div class="project-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="user-assets/images/gallery/111.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="link"><a href="#">استوديو فاخر</a></div>
                                    <h2>تصميم حديث، إطلالات مدينة</h2>
                                    <div class="btn-box"><a href="#" class="theme-btn-one"><span class="btn-shape"></span>احجز الآن</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="user-assets/images/gallery/222.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="link"><a href="#">جناح عائلي</a></div>
                                    <h2>واسع للعائلات</h2>
                                    <div class="btn-box"><a href="#" class="theme-btn-one"><span class="btn-shape"></span>احجز الآن</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="user-assets/images/gallery/333.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="link"><a href="#">شقة تنفيذية</a></div>
                                    <h2>أناقة ووظائف</h2>
                                    <div class="btn-box"><a href="#" class="theme-btn-one"><span class="btn-shape"></span>احجز الآن</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </section>

        <!-- service-form-section end -->

        <!-- service-section -->
        <section class="service-section bg-color-1" style="margin-top: 120px; direction: rtl;">
            <div class="pattern-layer" style="background-image: url(user-assets/images/shape/shape-1.png);"></div>
            <div class="auto-container">
                <div class="title-inner clearfix">
                    <div class="sec-title light text-right">
                        <span>تأجير الشقق المفروشة</span>
                        <h2>مساحات سكنية عالية الجودة ومريحة</h2>
                    </div>
                    <div class="text">
                        <p style="text-align: right;">استكشف مجموعتنا الواسعة من الشقق المفروشة بالكامل المصممة لراحتك وملاءمتك. استمتع بأفضل معايير الفخامة والموقع.</p>
                    </div>
                </div>
                <div class="three-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one" style="direction: ltr;">
                    <div class="service-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="#"><img src="user-assets/images/service/service-1.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="icon"><i class="icon-icon6"></i></div>
                                </div>
                                <div class="text">
                                    <h3><a href="#">شقق فاخرة</a></h3>
                                    <p>اكتشف شققنا الفاخرة التي تقدم وسائل راحة ومرافق عالية الجودة لضمان تجربة سكن حصرية.</p>
                                </div>
                                <div class="link"><a href="#">احجز الآن</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="service-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="#"><img src="user-assets/images/service/service-2.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="icon"><i class="icon-icon5"></i></div>
                                </div>
                                <div class="text">
                                    <h3><a href="#">أجنحة عائلية</a></h3>
                                    <p>تعتبر أجنحتنا العائلية مثالية للمجموعات الكبيرة، حيث توفر غرفًا فسيحة ومرافق حديثة لإقامة مريحة.</p>
                                </div>
                                <div class="link"><a href="#">احجز الآن</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="service-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="#"><img src="user-assets/images/service/service-3.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <div class="icon-box">
                                    <div class="icon"><i class="icon-icon4"></i></div>
                                </div>
                                <div class="text">
                                    <h3><a href="#">إيجارات قصيرة الأجل</a></h3>
                                    <p>مثالية للمسافرين، توفر إيجاراتنا قصيرة الأجل المرونة والراحة مع جميع وسائل الراحة والرفاهية كما يجب.</p>
                                </div>
                                <div class="link"><a href="#">احجز الآن</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cta-text centred">
                    <p>تبحث عن شقة مفروشة للإيجار؟ نحن نوفر لك الحل!</p>
                    <h3>استخدم موقعنا الالكتروني<i class="icon-mob"></i> <a href="#"></a> أو <a href="#"><span>حمل التطبيق الآن</span></a></h3>
                </div>
            </div>
        </section>
        <!-- service-section end -->

        <!-- units-section -->
        <section class="my-5 py-2" style="background-image: url(user-assets/images/shape/shape-7.png);">
    <h1 class="text-center my-5 text-bold" style="color:#88394E !important; font-size: 40px; font-weight: 700;">الوحدات</h1>

    @foreach ($units->chunk(4) as $unitChunk)
    <div class="row px-5">
        @foreach ($unitChunk as $unit)
        <!-- Card -->
        <style>
            .card-hover {
                transition: transform 0.3s ease;
            }
            .card-hover:hover {
                transform: scale(1.05);
            }
        </style>
        <div class="col-md-3 mb-4 card-hover">
            <div class="card text-right shadow">
                <img style="height: 200px;" src="{{ asset('uploads/'.$unit->unit_image) }}" class="card-img-top" alt="Unit Image">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 18px !important;">{{ $unit->unit_title }}</h5>
                    <span><i class="mr-2" style="color:#ffd700 !important;"><i class="fas fa-star"></i></i> التقييم : {{ $unit->rate }}</span><br>
                    <span style="background-color:#ececec; color:#000;" class="badge rounded"> الغرف : {{ $unit->unit_rooms }}</span>
                    <span style="background-color:#ececec; color:#000;" class="badge rounded ml-2"> الحمامات : {{ $unit->unit_bathrooms }}</span>
                    <span style="background-color:#ececec; color:#000;" class="badge rounded ml-2">المساحة : {{ $unit->unit_size }} م<sup>2</sup></span><br>
                    <span>السعر : {{ $unit->unit_price }} ريال سعودي</span><br>
                    <span>الموقع : {{ $unit->unit_location }}</span>
                    <br>
                    <a href="#" class="btn btn-primary mt-2">تفاصيل اكثر</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $units->links('pagination::bootstrap-4') }}
    </div>
</section>

<script>
    document.querySelectorAll('.readMore').forEach(function(element) {
        element.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            document.getElementById('shortDesc-' + id).style.display = 'none';
            document.getElementById('fullDesc-' + id).style.display = 'block';
        });
    });

    document.querySelectorAll('.showLess').forEach(function(element) {
        element.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            document.getElementById('fullDesc-' + id).style.display = 'none';
            document.getElementById('shortDesc-' + id).style.display = 'block';
        });
    });
</script>


        <!-- End units-section -->
        
        <!-- funfact-section -->
        <section class="funfact-section centred">
            <div class="map-layer" style="background-image: url(user-assets/images/shape/map-1.png);"></div>
            <div class="large-container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                        <div class="counter-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-icon7"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="260">0</span>
                                </div>
                                <p>عقارات تم اضافتها</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                        <div class="counter-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-icon8"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="1.9">0</span><span>k</span>
                                </div>
                                <p>عقارات تم حجزها</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                        <div class="counter-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-icon9"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="70">0</span><span>+</span>
                                </div>
                                <p>عملاء جدد</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                        <div class="counter-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-icon10"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="435">0</span>
                                </div>
                                <p>حجوزات هذا الشهر</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- funfact-section end -->

        <!-- project-section -->
        <section class="project-section bg-color-2" style="direction: rtl;">
            <div class="pattern-layer" style="background-image: url(user-assets/images/shape/shape-2.png);"></div>
            <div class="auto-container">
                <div class="title-inner clearfix">
                    <div class="sec-title text-right">
                        <span>تأجير الشقق المفروشة</span>
                        <h2>استكشف قوائم شققنا الحصرية</h2>
                    </div>
                    <div class="text">
                        <p style="text-align: right;">اكتشف مجموعتنا المختارة من الشقق المفروشة الفاخرة، المثالية للإقامات القصيرة أو الطويلة، مع جميع المرافق المضمونة.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-inner" style="direction: ltr;">
                <div class="project-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="user-assets/images/gallery/project-1.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="link"><a href="#">استوديو فاخر</a></div>
                                    <h2>تصميم حديث، إطلالات مدينة</h2>
                                    <div class="btn-box"><a href="#" class="theme-btn-one"><span class="btn-shape"></span>احجز الآن</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="user-assets/images/gallery/project-2.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="link"><a href="#">جناح عائلي</a></div>
                                    <h2>واسع للعائلات</h2>
                                    <div class="btn-box"><a href="#" class="theme-btn-one"><span class="btn-shape"></span>احجز الآن</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="user-assets/images/gallery/project-3.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="link"><a href="#">شقة تنفيذية</a></div>
                                    <h2>أناقة ووظائف</h2>
                                    <div class="btn-box"><a href="#" class="theme-btn-one"><span class="btn-shape"></span>احجز الآن</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- project-section end -->


        <!-- contact-info-section -->
        <section class="contact-info-section" style="direction: rtl;">
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.633428978583!2d46.675295715003774!3d24.713551784116733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f029b9b4a83a7%3A0x86b8a2e7398ba518!2sRiyadh%2C%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1631525487864!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="auto-container">
                <div class="info-inner">
                    <div class="row clearfix">
                        <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                            <div class="content_block_3">
                                <div class="content-box">
                                    <figure class="icon-layer"><img src="user-assets/images/icons/icon-9.png" alt=""></figure>
                                    <div class="sec-title" style="text-align: center;">
                                        <span>تأجير الشقق المفروشة</span>
                                        <h2>المدن التي نخدمها</h2>
                                    </div>
                                    <div class="text">
                                        <p style="text-align: right;">اكتشف شبكتنا الواسعة من الشقق المفروشة في المدن الكبرى في المملكة العربية السعودية. نقدم لك الفخامة والراحة بما يتناسب مع احتياجاتك، لضمان تجربة إقامة سلسة.</p>
                                        <ul class="location-list clearfix">
                                            <li>الرياض</li>
                                            <li>جدة</li>
                                            <li>الدمام</li>
                                            <li>الخبر</li>
                                            <li>مكة</li>
                                            <li>المدينة</li>
                                            <li>تبوك</li>
                                            <li>أبها</li>
                                            <li>الطائف</li>
                                            <li>القصيم</li>
                                            <li>نجران</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                            <div class="content_block_4">
                                <div class="content-box" style="background-image: url(user-assets/images/resource/contact-1.jpg);">
                                    <div class="text">
                                        <div class="support-box" style="text-align: center;">
                                            <div class="icon-box"><i class="icon-mob"></i></div>
                                            <span>احجز الآن!</span>
                                            <h3><a href="#">قم بتحميل التطبيق</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-info-section end -->

        <!-- main-footer -->
        <footer class="main-footer" style="direction: rtl;">
                <div class="auto-container">
                    <div class="widget-section">
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget logo-widget">
                                    <figure class="footer-logo"><a href="#"><img src="user-assets/images/footer-logo.png" alt=""></a></figure>
                                    <div class="text">
                                        <p style="text-align: right;">اكتشف مجموعة من الشقق المفروشة في المدن الرئيسية في السعودية مع URSTAY. مثالية للإقامات القصيرة والطويلة الأجل.</p>
                                    </div>
                                    <ul class="social-links clearfix" style="float: right;">
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget links-widget">
                                    <div class="widget-title">
                                        <h3>ما نقدمه</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="links-list clearfix">
                                            <li><a href="#">شقق فاخرة</a></li>
                                            <li><a href="#">أجنحة عائلية</a></li>
                                            <li><a href="#">شقق استوديو</a></li>
                                            <li><a href="#">الإسكان للشركات</a></li>
                                            <li><a href="#">إقامات طويلة</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget links-widget">
                                    <div class="widget-title">
                                        <h3>عن UrStay</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="links-list clearfix">
                                            <li><a href="#">من نحن</a></li>
                                            <li><a href="#">خدماتنا</a></li>
                                            <li><a href="#">المواقع</a></li>
                                            <li><a href="#">فريقنا</a></li>
                                            <li><a href="#">شهادات العملاء</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget contact-widget">
                                    <div class="widget-title">
                                        <h3>تواصل معنا</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="info clearfix">
                                            <li>الرياض، المملكة العربية السعودية</li>
                                            <li><a href="tel:+966500000000">(+966) 500 000 000</a></li>
                                            <li><a href="mailto:support@urstay.com">support@urstay.com</a></li>
                                            <li><span>ساعات العمل</span></li>
                                            <li>الأحد - الخميس: 9 صباحاً إلى 6 مساءً</li>
                                            <li>الجمعة مغلق</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="subscribe-inner clearfix"> -->
                        <!-- <div class="widget-title pull-left">
                            <h3>اشترك في نشرتنا الإخبارية</h3>
                        </div> -->
                        <!-- <div class="form-inner pull-right">
                            <form action="contact.html" method="post" class="subscribe-form clearfix">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="اسمك" required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="البريد الإلكتروني" required="">
                                </div>
                                <div class="message-btn">
                                    <button type="submit" class="theme-btn-one"><span class="btn-shape"></span>اشترك</button>
                                </div>
                            </form>
                        </div> -->
                    <!-- </div> -->
                    <div class="footer-bottom centred">
                        <div class="auto-container">
                            <div class="copyright">
                                <p> جميع الحقوق محفوظة 2024 لشركة UrStay&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><span>خريطة الموقع</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><span>الشروط والأحكام</span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
        </footer>
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="far fa-long-arrow-up"></span>
        </button>
    </div>

    <script>
        function changeLanguage(lang) {
            console.log("Changing language to: " + lang);
            $.ajax({
                url: '/language/' + lang,
                type: 'GET',
                success: function (data) {
                    console.log("Language changed successfully, reloading page.");
                    window.location.reload();
                },
                error: function (error) {
                    console.error('Error changing language:', error);
                }
            });
        }
    </script>


    <!-- jequery plugins -->
    <script src="user-assets/js/jquery.js"></script>
    <script src="user-assets/js/popper.min.js"></script>
    <script src="user-assets/js/bootstrap.min.js"></script>
    <script src="user-assets/js/owl.js"></script>
    <script src="user-assets/js/wow.js"></script>
    <script src="user-assets/js/validation.js"></script>
    <script src="user-assets/js/jquery.fancybox.js"></script>
    <script src="user-assets/js/appear.js"></script>
    <script src="user-assets/js/scrollbar.js"></script>
    <script src="user-assets/js/jquery.nice-select.min.js"></script>

    <!-- main-js -->
    <script src="user-assets/js/script.js"></script>

</body><!-- End of .page_wrapper -->
</html>
