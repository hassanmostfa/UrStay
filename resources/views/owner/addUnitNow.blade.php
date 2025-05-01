@extends('layouts.owner')

@section('title', "Welcome")
@section('body-class', "Register-body")

@section('content')
    <div class="container login-card add_your_unit has-outline" style="display: flex;flex-direction: column;justify-content: center;align-items: center;padding: 0 15px 50px;">
        <img src="{{ asset('/site/imgs/cangrad.Icon-13.png') }}" style="width: 330px;" alt="">
        <h1 style="font-family: MainFontBold;font-size: 48px;color: #fff;margin-top: 16px;">ﺗﻢ إﺿﺎﻓﺔ ﻣﻌﻠﻮﻣﺎﺗﻚ ﺑﻨﺠﺎح!</h1>
        <p>راﺋﻊ! ﺗﻢ اﻛﻤﺎل ﺧﻄﻮة اﻟﺘﺴﺠﻴﻞ 1 اﻟﺮﺟﺎء أﺿﺎﻓﺔ ﻋﻘﺎرك ﺣتى ﻳﺘﻢ اﻛﻤﺎل الخطوة 2</p>
        <a href="{{ route('owner.addUnit') }}" style="padding: 8px 32px;color: #fff;font-size: 18px;text-decoration: none">
            أﺿﻒ ﻋﻘﺎرك اﻵن
            <img src="{{ asset('/site/imgs/addinfo-14-14.png') }}" alt="">
        </a>
        <div class="complete">
            ﺗﻢ أﻛﺘﻤــــــــــــــــــــــــﺎل
            <p>
                <span>ﺧﻄﻮة 1</span> - ﺧﻄﻮة 2
            </p>
        </div>
    </div>
@endsection
