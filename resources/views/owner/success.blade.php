@extends('layouts.owner')

@section('title', "Success")
@section('body-class', "Register-body")

@section('content')
    <div class="container login-card add_your_unit has-outline" style="display: flex;flex-direction: column;justify-content: center;align-items: center;padding: 0 15px 30px;">
        <img src="{{ asset('/site/imgs/iconLs-06.png') }}" style="width: 330px;" alt="">
        <h1 style="font-family: MainFontBold;font-size: 48px;color: #fff;margin-top: 16px;">ﺗﻢ إﺿﺎﻓﺔ وحدتك ﺑﻨﺠﺎح!</h1>
        <p>تم  إضافة وحدتك بنجاح , يتم الان مراجعتها من قبل المسؤولين سوف نخبرك عند الموافقة او الرفض</p>

        <a href="{{ route('owner.myUnits') }}" style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
            عرض جميع وحداتي
        </a>
    </div>
@endsection
