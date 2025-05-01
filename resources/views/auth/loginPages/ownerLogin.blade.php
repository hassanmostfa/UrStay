@extends('layouts.owner')

@section('title', 'Login as owner')
@section('body-class', 'Register-body')

@section('content')
    <div class="boxed_wrapper">

        <div class="login-wrapper container">
            <div class="text">
                <h1>ﺣَﻴّﺎك اﻟﻠّﻪ</h1>
                <p>
                    ﻣﺮﺣﺒًﺎ ﺑﻜﻢ ﻳﻮرﺳﺘﺎي! اﻧﻀﻢ إلى ﻣﺠﺘﻤﻊ اﻟﻤُﻀِﻴﻔين واﺳﺘﻔﺪ ﻣﻦ
                    <br>
                    ﻣﻨﺼﺔ ﻣُﺒﺘﻜﺮة ﺗﺘﻴﺢ ﻟﻚ ﻋﺮض وﺣﺪاﺗﻚ اﻟﻌﻘﺎرﻳﺔ أﻣﺎم آﻻف اﻟﻀﻴﻮف
                    <br>
                    ﺳﺠﻞ اﻵن وزد ﻣﻦ ﻓﺮص اﺳتﺜﻤﺎرك اﻟﻌﻘﺎري ﺑﻜﻞ ﺳﻬﻮﻟﺔ وﺛﻘﺔ
                </p>
            </div>
            <div class="login-card">
                <form method="post" action="{{ route('ownerLoginAction') }}">
                    <img src="{{ asset('/site/imgs/iconF-01.png') }}" style="width: 100px; display: block; margin: auto;margin-bottom: 32px;" alt="">
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
                    <div class="input-row">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="text" name="phone_or_email" id="first_name" class="form-control" placeholder="رقم الهاتف او البريد الالكتروني" required>
                                @error('phone_or_email')
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
                    @if (session('error'))
                        <div class="alert alert-danger" style="color: red;text-align: center;magin: 16px 0 32px">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="btns">
                        <button type="submit" >ﺗﺴﺠﻴﻞ اﻟﺪﺧﻮل</button>
                        أو
                        <a href="{{ route('owner.register') }}" >ﺗﺴﺠﻴﻞ جديد</a>
                    </div>
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
