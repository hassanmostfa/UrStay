
@extends('layouts.site')

@section('title', "Register")

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="boxed_wrapper">

       <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>

            <nav class="menu-box">
                <div class="menu-outer"></div>

                <div class="btn-box" style="margin-top: 40px;">
                    <a href="#" class="theme-btn-one"><span class="btn-shape"></span>انضم الينا</a>
                </div>
            </nav>
        </div>
        <!-- End Mobile Menu -->

        <!-- Registration Form -->
        <div class="container login-container">
                <div class="col-md-8">
                    <div class="card login-card">
                        <h1>تسجيل ضيف جديد</h1>
                        <div class="card-body">
                            <form method="POST" id="phone-form" dir="rtl">
                                @csrf
                                <div class="form-group">
                                    <label for="phone_input" style="text-align: right; display: block;">رقم الهاتف</label>
                                    <div class="input-group" style="direction: ltr;display: flex; align-items: center;gap: 8px">
                                        <span class="input-group-text key">966</span>
                                        <input type="text" class="form-control" id="phone_input" name="phone" placeholder="5XXXXXXXX" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 w-100">إرسال كود التحقق</button>
                            </form>

                            <div id="otp-section" style="display:none;" dir="ltr">
                                <form method="POST" id="otp-form">
                                    @csrf
                                    <input type="text" class="form-control mt-3" name="otp" placeholder="أدخل كود التحقق" required>
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary mt-3 w-100">تحقق من OTP</button>
                                    </form>

                                    <!-- Resend OTP -->
                                    <!-- <form method="POST" id="resend-otp-form">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mt-3 w-100" id="resend-otp-btn">اعادة ارسال كود التحقق</button>
                                    </form> -->
                                </div>
                            </div>

                            <div id="user-section" style="display:none;"  dir="rtl">
                                <form enctype="multipart/form-data" action="{{ route('userRegisterSave')}}" method="POST" id="user-form">
                                    @csrf
                                    <div class="form-group row text-right">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <label for="first_name" class="form-label">الاسم الأول</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="الاسم الأول" required>
                                            @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <label for="last_name" class="form-label">اسم العائلة</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="الاسم الأخير" required>
                                            @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" style="text-align: right; display: block;">البريد الالكتروني</label>
                                        <input type="email" name="email" dir="ltr" id="email" class="form-control text-left" placeholder="name@company.com" required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label for="password" style="text-align: right; display: block;">كلمة المرور</label>
                                        <input type="password" name="password" dir="ltr" id="password" class="form-control" placeholder="••••••••" required>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-check" style="margin-right: 20px !important;display: flex; gap: 4px;align-items: center;justify-content: start">
                                        <input type="checkbox" class="form-check-input" id="terms" required style="text-align: right; display: block;width: max-content; margin: 0">
                                        <label class="form-check-label" style="text-align: right; display: flex;align-items: center; gap: 4px" for="terms">لقد وافقت علي <a href="#">السياسات والشروط</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100" style="background-color: #88304e; border-color: #88304e;">انشاء حساب</button>
                                    <p class="text-center mt-3">
                                        لديك حساب بالفعل؟ <a href="{{ route('user-login') }}" style="color: #88304e;">سجل دخولك هنا</a>
                                    </p>
                                </form>
                            </div>

                            <div id="success" style="display: none;flex-direction: column;justify-content: center;align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="55" height="55" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                                <h1>
                                    تم انشاء حسابك بنجاح
                                </h1>
                            </div>

                        </div>
                    </div>
            </div>
        </div>

        {{-- <!-- Modal -->
        <div class="modal fade text-center" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">تم التسجيل بنجاح</h5>
                    </div>
                    <div class="modal-body">
                    تم التسجيل بنجاح ،يمكنك الان تسجيل الدخول
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('user-login') }}'">موافق</button>
                    </div>
                </div>
            </div>
        </div>
 --}}
        {{-- <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="far fa-long-arrow-up"></span>
        </button> --}}
    </div>


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
                    $('#user-section').show();
                } else {
                    alert(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + jqXHR.responseJSON.message || 'Unknown error');
            }
        });
    });

    $('#user-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('phone', $("#phone-form #phone_input").val()); // Append the phone input

        $.ajax({
            type: "POST",
            url: "{{ route('userRegisterSave') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success === true) {
                    $('#success').show().css('display', 'flex');
                    $('#user-section').hide()
                    setTimeout(() => {
                        window.location.href = '{{ route("user-login") }}'
                    }, 1000);
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
