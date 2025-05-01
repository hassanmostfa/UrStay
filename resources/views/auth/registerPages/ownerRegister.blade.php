@extends('layouts.owner')

@section('title', 'Register')
@section('body-class', 'Register-body')

@section('content')
    <div class="boxed_wrapper">
        <!-- preloader -->
        <div class="preloader"></div>
        <!-- preloader -->

        <!-- Registration Form -->
        <div class="container login-container">
            <div class="card login-card">
                <div class="card-body">
                    <form method="POST" id="phone-form" dir="rtl">
                        @csrf
                        <div class="phone-group">
                            <img src="{{ asset('/site/imgs/iconF-01.png') }}" alt="">
                            <div class="input-wrapper">
                                <span class="input-group-text key">+966</span>
                                <input type="text" class="form-control" id="phone_input" name="phone"
                                    placeholder="5XXXXXXXX" required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                <img src="{{ asset('/site/imgs/MobileIcon-08-08.png') }}" alt="">
                            </div>
                        </div>
                        <button type="submit">أرﺳﻞ ﻛﻮد اﻟﺘﺤﻘﻖ</button>
                    </form>

                    <div id="otp-section" style="display:none;" dir="ltr">
                        <form method="POST" id="otp-form">
                            @csrf
                            <div class="otp-group">

                                <img src="{{ asset('/site/imgs/iconF-01.png') }}" alt="">
                                <h1>
                                    <img src="{{ asset('/site/imgs/otp-10-10.png') }}" alt="">
                                    أدﺧﻞ ﻛﻮد اﻟﺘﺤﻘﻖ اﻟﻤﺮﺳﻞ ﻋلى ﺟﻮاﻟﻚ
                                </h1>
                                <div class="code-input-wrapper">

                                    <input type="text" class="cube" maxlength="1" oninput="moveToNext(this)" />
                                    <input type="text" class="cube" maxlength="1" oninput="moveToNext(this)" />
                                    <input type="text" class="cube" maxlength="1" oninput="moveToNext(this)" />
                                    <input type="text" class="cube" maxlength="1" oninput="moveToNext(this)" />

                                    <input type="text" class="cube" maxlength="1" oninput="moveToNext(this)" />

                                    <input type="text" class="cube" maxlength="1" oninput="moveToNext(this)" />

                                </div>
                            </div>


                            <input type="hidden" id="hiddenInput" name="otp" />

                            <button type="submit" class="btn btn-primary mt-3 w-100">ﺗﺤَﻘّﻖ</button>
                        </form>

                        <!-- Resend OTP -->
                        <!-- <form method="POST" id="resend-otp-form">
                                                @csrf
                                                <button type="submit" class="btn btn-primary mt-3 w-100" id="resend-otp-btn">اعادة ارسال كود التحقق</button>
                                            </form> -->
                    </div>
                </div>

                <div id="welcome-section"
                    style="display: none; flex-direction: column; justify-content: center; align-items: center;">
                    <h1 style="margin: 0;font-family: MainFontBold;font-size: 40px;">حياك الله</h1>
                    <h1 style="margin: 0;font-family: MainFontBold;font-size: 28px;">يسعدنا انضمامك معنا كمضيف.</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-handshake"
                        width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#88304e" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                        <path
                            d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                        <path d="M12.5 15.5l2 2" />
                        <path d="M15 13l2 2" />
                    </svg>
                    <br>
                    <br>
                    <button id="next-step">التالي</button>
                </div>

                <div id="owner-section"  style="display: none" dir="rtl">
                    <h1>أﻛﻤِﻞ ﺑﻴَﺎﻧﺎﺗﻚ وأﻧﻀّﻢ ﻟﻤُﺠﺘﻤﻌﻨﺎ اﻟﺮاﺋﻊ!</h1>
                    <form enctype="multipart/form-data" action="{{ route('registerAction') }}" method="POST" id="owner-form">
                        @csrf
                        <div class="input-row">
                            <div class="input-group">
                                <label for="first_name" class="form-label">
                                    الاسم الأول
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 12l8 -4.5"></path> <path d="M12 12v9"></path> <path d="M12 12l-8 -4.5"></path> <path d="M12 12l8 4.5"></path> <path d="M12 3v9"></path> <path d="M12 12l-8 4.5"></path> </svg>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="الاسم الأول" required>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <img src="{{ asset('site/imgs/iconLs-01.png') }}" />
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="last_name" class="form-label">
                                    اسم العائلة
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 12l8 -4.5"></path> <path d="M12 12v9"></path> <path d="M12 12l-8 -4.5"></path> <path d="M12 12l8 4.5"></path> <path d="M12 3v9"></path> <path d="M12 12l-8 4.5"></path> </svg>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="الاسم الأخير" required>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <img src="{{ asset('site/imgs/iconLs-01.png') }}" />
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="email" class="form-label">
                                    البريد الالكتروني
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 12l8 -4.5"></path> <path d="M12 12v9"></path> <path d="M12 12l-8 -4.5"></path> <path d="M12 12l8 4.5"></path> <path d="M12 3v9"></path> <path d="M12 12l-8 4.5"></path> </svg>
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" name="email" dir="ltr" id="email" class="form-control text-left" placeholder="name@company.com" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <img src="{{ asset('site/imgs/iconLs-02.png') }}" />
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="password" class="form-label">
                                    كلمة المرور
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 12l8 -4.5"></path> <path d="M12 12v9"></path> <path d="M12 12l-8 -4.5"></path> <path d="M12 12l8 4.5"></path> <path d="M12 3v9"></path> <path d="M12 12l-8 4.5"></path> </svg>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" dir="ltr" id="password" class="form-control" placeholder="••••••••" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <img src="{{ asset('site/imgs/iconLs-03.png') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="btn-wrapper">
                            <div class="form-group form-check" style="display: flex; gap: 4px;align-items: center;justify-content: start">
                                <input type="checkbox" class="form-check-input" id="terms" required style="text-align: right; display: none;width: max-content; margin: 0">
                                <label class="form-check-label" style="text-align: right; display: flex;align-items: center; gap: 4px" for="terms">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                                    </div>
                                    لقد وافقت علي <a href="https://urstaysa.com/privacy-policy">السياسات والشروط</a><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 12l8 -4.5"></path> <path d="M12 12v9"></path> <path d="M12 12l-8 -4.5"></path> <path d="M12 12l8 4.5"></path> <path d="M12 3v9"></path> <path d="M12 12l-8 4.5"></path> </svg> </label>
                            </div>
                            <button type="submit" class="btn btn-success w-100" style="background-color: #88304e; border-color: #88304e;">انشاء حساب</button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>

    </div>


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


    <script>
        $(document).ready(function() {
            $('#phone-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ route('send.otp') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            $('#otp-section').show();
                            $('#phone-form').hide();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error: ' + jqXHR.responseJSON.message || 'Unknown error');
                    }
                });
            });

            $('#otp-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                formData += '&phone=' + encodeURIComponent($("#phone-form #phone_input").val());

                $.ajax({
                    type: "POST",
                    url: "{{ route('verify.otp') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            $('#otp-section').hide();
                            $('#owner-section').show();
                            $('.login-card').addClass('has-outline');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error: ' + jqXHR.responseJSON.message || 'Unknown error');
                    }
                });
            });

            $("#next-step").on("click", function() {
                $('#welcome-section').hide();
                $('#owner-section').show();
            })

            $('#owner-form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('phone', $("#phone-form #phone_input").val()); // Append the phone input

                $.ajax({
                    type: "POST",
                    url: "{{ route('registerAction') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success === true) {
                            // $('#success').show().css('display', 'flex');
                            $('#owner-section').hide()
                            $('.login-card').removeClass('has-outline');
                            // setTimeout(() => {
                                window.location.href =
                                    '{{ route('owner.addUnitNow') }}'
                            // }, 1000);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error: ' + jqXHR.responseJSON.message || 'Unknown error');
                    }
                });
            });
        });

        function moveToNext(current) {

            if (current.value.length >= 1) {

                const next = current.nextElementSibling;

                if (next) {

                    next.focus();

                }

            }

            updateHiddenInput();

        }


        document.querySelectorAll('.cube').forEach(input => {

            input.addEventListener('keydown', function(e) {

                if (e.key === 'Backspace' && this.value === '') {

                    const prev = this.previousElementSibling;

                    if (prev) {

                        prev.focus();

                    }

                }

                updateHiddenInput();

            });


            input.addEventListener('paste', function(e) {

                e.preventDefault();

                const pastedValue = e.clipboardData.getData('text').trim();

                distributePastedValue(pastedValue);

            });

        });


        function updateHiddenInput() {

            const values = Array.from(document.querySelectorAll('.cube')).map(input => input.value).join('');

            document.getElementById('hiddenInput').value = values;

        }


        function distributePastedValue(pastedValue) {

            const inputs = document.querySelectorAll('.cube');

            let index = 0;

            for (let char of pastedValue) {

                if (index < inputs.length) {

                    inputs[index].value = char;

                    index++;

                }

            }

            updateHiddenInput();

        }
    </script>


    <!-- jQuery plugins -->

@endsection
