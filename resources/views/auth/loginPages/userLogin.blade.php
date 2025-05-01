@extends('layouts.site')

@section('title', 'Login')

@section('content')
    <div class="boxed_wrapper">

        <div class="login-container">
            <div class="login-card">
                <h1> تسجيل دخول مستخدم </h1>
                <form method="post" action="{{ route('userLoginAction') }}">
                    @csrf
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
                    <div class="form-group">
                        <label for="phone_or_email" style="display: block; text-align: right;">رقم الهاتف او البريد
                            الالكتروني</label>
                        <input type="text" name="phone_or_email"  dir="ltr" id="email" class="form-control text-left" required>
                    </div>
                    <div class="form-group">
                        <label for="password" style="display: block; text-align: right;">كلمة المرور</label>
                        <input type="password" name="password" dir="ltr" id="password" class="form-control" placeholder="••••••••"
                            required>
                    </div>
                    <!-- <div class="form-group form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label class="form-check-label" for="remember">تذكرني لاحقا</label>
                        </div> -->
                    @if (session('error'))
                        <div class="alert alert-danger" style="color: red;text-align: center;magin: 16px 0 32px">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">سجل الدخول</button>
                    </div>
                    <p>ليس لديك حساب حتي الان؟ <a href="{{ route('userRegister') }}">انشأ حسابك</a></p>
                </form>
            </div>
        </div>

    </div>

    <script>
        function changeLanguage(lang) {
            console.log("Changing language to: " + lang);
            $.ajax({
                url: '/language/' + lang,
                type: 'GET',
                success: function(data) {
                    console.log("Language changed successfully, reloading page.");
                    window.location.reload();
                },
                error: function(error) {
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
