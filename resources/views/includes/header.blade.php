<header>
    <div class="container">
        <a href="{{ route('home') }}">
            <img src="{{asset('/site/imgs/logo.png')}}" alt="logo" class="logo">
        </a>
        <nav>
            <a href="{{ route('home') }}" class="active">اﻟﺮﺋﻴﺴﻴﺔ</a>
            <a href="">ﻋﻦ ﻳﻮرﺳﺘﺎي</a>
            <a href="">اﻟﻮﺣﺪات والخدﻣﺎت</a>
            <a href="">اﻟﺒﺎﻗﺎت واﻷﺳﻌـــﺎر</a>
        </nav>
        <form action="">
            <input type="text" name="search" id="search">
            <button type="submit">
                <img src="{{asset('/site/imgs/search-icon.png')}}" alt="">
            </button>
        </form>
        <div class="btn">
            <a href="{{route('supervisor.register')}}">
                <img src="{{asset('/site/imgs/Entry-04.svg')}}" alt="">
                <span style="width: 130px; display: block;text-align:center">
                    اﻟﻤُشــرف
                 </span>
            </a>
            <div class="owner_btn_wrapper" style="position: relative;">

                <a href="" class="owner-login-btn">
                    <img src="{{asset('/site/imgs/Entry-03.svg')}}" alt="">
                     <span style="width: 120px; display: block;text-align:center">
                        اﻟﻤُﻀﻴﻔين
                     </span>

                </a>
                <div class="nav-pop-up" style="display: none;flex-direction: column;position: absolute;top: 100%;width: 200px;background: #fff;border-radius: 30px;padding: 10px;margin-top: 16px;">
                    <a href="{{ route('owner.login') }}" style="width: 100%">
                        دخول اﻟﻤُﻀﻴﻔين
                    </a>
                    <a href="{{ route('owner.register') }}" style="width: 100%">
                        تسجيل اﻟﻤُﻀﻴﻔين
                    </a>
                </div>
            </div>
        </div>
        <button class="more_btn">
            <svg clip-rule="evenodd" fill-rule="evenodd" height="512" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg" id="fi_10550106"><g transform="translate(-240 -336)"><path d="m255 356c0-.796-.316-1.559-.879-2.121-.562-.563-1.325-.879-2.121-.879-1.986 0-5.014 0-7 0-.796 0-1.559.316-2.121.879-.563.562-.879 1.325-.879 2.121v7c0 .796.316 1.559.879 2.121.562.563 1.325.879 2.121.879h7c.796 0 1.559-.316 2.121-.879.563-.562.879-1.325.879-2.121zm15 0c0-.796-.316-1.559-.879-2.121-.562-.563-1.325-.879-2.121-.879-1.986 0-5.014 0-7 0-.796 0-1.559.316-2.121.879-.563.562-.879 1.325-.879 2.121v7c0 .796.316 1.559.879 2.121.562.563 1.325.879 2.121.879h7c.796 0 1.559-.316 2.121-.879.563-.562.879-1.325.879-2.121zm-4.379-5.207 4.172-4.172c1.171-1.171 1.171-3.071 0-4.242l-4.172-4.172c-1.171-1.171-3.071-1.171-4.242 0l-4.172 4.172c-1.171 1.171-1.171 3.071 0 4.242l4.172 4.172c1.171 1.171 3.071 1.171 4.242 0zm-10.621-9.793c0-.796-.316-1.559-.879-2.121-.562-.563-1.325-.879-2.121-.879-1.986 0-5.014 0-7 0-.796 0-1.559.316-2.121.879-.563.562-.879 1.325-.879 2.121v7c0 .796.316 1.559.879 2.121.562.563 1.325.879 2.121.879h7c.796 0 1.559-.316 2.121-.879.563-.562.879-1.325.879-2.121z"></path></g></svg>
        </button>
        <div class="toggled-menu">
            <form action="">
                <input type="text" name="search" id="search">
                <button type="submit">
                    <img src="{{asset('/site/imgs/search-icon.png')}}" alt="">
                </button>
            </form>
            <nav>
                <a href="" class="active">اﻟﺮﺋﻴﺴﻴﺔ</a>
                <a href="">ﻋﻦ ﻳﻮرﺳﺘﺎي</a>
                <a href="">اﻟﻮﺣﺪات والخدﻣﺎت</a>
                <a href="">اﻟﺒﺎﻗﺎت واﻷﺳﻌـــﺎر</a>
            </nav>
            <div class="btn">
                <a href="{{ route('supervisor.login') }}">
                    <img src="{{asset('/site/imgs/Entry-04.svg')}}" alt="">
                    دﺧﻮل ﻣُشرفي اﻟﻮﺣــﺪات
                </a>
                <a href="{{route('owner.login')}}">
                    <img src="{{asset('/site/imgs/Entry-03.svg')}}" alt="">
                    دﺧﻮل اﻟﻤُﻀﻴﻔين
                </a>
            </div>

            <button class="close-menu">
                <svg enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg" id="fi_5254940"><path d="m292.2 256 109.9-109.9c10-10 10-26.2 0-36.2s-26.2-10-36.2 0l-109.9 109.9-109.9-109.9c-10-10-26.2-10-36.2 0s-10 26.2 0 36.2l109.9 109.9-109.9 109.9c-10 10-10 26.2 0 36.2 5 5 11.55 7.5 18.1 7.5s13.1-2.5 18.1-7.5l109.9-109.9 109.9 109.9c5 5 11.55 7.5 18.1 7.5s13.1-2.5 18.1-7.5c10-10 10-26.2 0-36.2z"></path></svg>
            </button>

        </div>
    </div>
</header>
