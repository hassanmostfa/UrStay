@extends('layouts.owner')

@section('title', 'Login as owner')
@section('body-class', 'Register-body')

@section('content')
    <div class="boxed_wrapper">

        <div class="login-wrapper container">
            <div class="text">
                <h1>ﺣَﻴّﺎك اﻟﻠّﻪ</h1>
                <p>
                    ﻣﺮﺣﺒًﺎ ﺑﻜﻢ ﻳﻮرﺳﺘﺎي! فريق خدمة العملاء مستعد لمساعدتك
                    <br>
                    تواصلوا معنا عبر البريد الالكتروني او ارقام الهواتف المذكورة
                    <br>
                    
                </p>
            </div>
            <div class="text" style="font-size: 22px; border-left: none; color: #FFFFFF; line-height: 1.5;">
                <p style="margin: 5px 0;">البريد الإلكتروني <br>
                    <a href="mailto:info@urstaysa.com" style="color: #FFFFFF; text-decoration: none;">info@urstaysa.com</a>
                </p>
                <p style="margin: 5px 0;">ارقام التواصل <br>
                    <a href="tel:0595538708" style="color: #FFFFFF; font-family: Arial, sans-serif; text-decoration: none;">0595538708</a> - 
                    <a href="tel:0595538019" style="color: #FFFFFF; font-family: Arial, sans-serif; text-decoration: none;">0595538019</a>
                </p>
            </div>

        </div>

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

    <!-- jQuery plugins -->
<script src="{{ asset('user-assets/js/jquery.js') }}"></script>
<script src="{{ asset('user-assets/js/popper.min.js') }}"></script>
<script src="{{ asset('user-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('user-assets/js/owl.js') }}"></script>
<script src="{{ asset('user-assets/js/wow.js') }}"></script>
<script src="{{ asset('user-assets/js/validation.js') }}"></script>
<script src="{{ asset('user-assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('user-assets/js/appear.js') }}"></script>
<script src="{{ asset('user-assets/js/scrollbar.js') }}"></script>
<script src="{{ asset('user-assets/js/jquery.nice-select.min.js') }}"></script>

<!-- main-js -->
<script src="{{ asset('user-assets/js/script.js') }}"></script>

@endsection
