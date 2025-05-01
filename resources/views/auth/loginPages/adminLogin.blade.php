@extends('layouts.owner')

@section('body-class', 'Register-body')

@section('title', "Login As Admin")

@section('content')
    <div class="boxed_wrapper">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

        <div class="login-wrapper container" style="justify-content: center">
            <div class="login-card">
                <form method="post" action="{{ route('adminLoginAction') }}">
                    <img src="{{ asset('/site/imgs/iconF-01.png') }}" style="width: 100px; display: block; margin: auto;margin-bottom: 10px;" alt="">
                    @csrf
                    <h1 style="margin: 0;color: #fff;font-family: MainFontBold;">سجل الدخول كمسؤل</h1>
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">خطأ!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><span class="block sm:inline">{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="input-row">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="email" name="email" id="email" class="form-control" placeholder="البريد الالكتروني" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <img src="{{ asset('site/imgs/iconLs-01.png') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="password" name="password" dir="ltr" id="password" class="form-control" placeholder="••••••••" required>
                                <img src="{{ asset('site/imgs/iconLs-03.png') }}" />
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">تذكرني لاحقا</label>
                    </div> -->
                    <div class="btns">
                        <button type="submit">سجل الدخول</button>
                    </div>
                </form>
            </div>
        </div>
{{--
        <!-- Footer -->
        <footer class="main-footer" style="direction: rtl;">
            <div class="auto-container">
                <div class="widget-section">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget">
                                <figure class="footer-logo"><a href="#"><img src="user-assets/images/footer-logo.png" alt=""></a></figure>
                                <p style="text-align: right;">اكتشف مجموعة من الشقق المفروشة في المدن الرئيسية في السعودية مع URSTAY. مثالية للإقامات القصيرة والطويلة الأجل.</p>
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
                                        <li>ساعات العمل: الأحد - الخميس: 9 صباحاً إلى 6 مساءً</li>
                                        <li>الجمعة مغلق</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom centred">
                    <div class="auto-container">
                        <div class="copyright">
                            <p>جميع الحقوق محفوظة 2024 لشركة UrStay&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><span>خريطة الموقع</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><span>الشروط والأحكام</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end --> --}}

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

@endsection
