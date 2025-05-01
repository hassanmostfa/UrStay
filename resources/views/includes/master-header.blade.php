<header
    style="z-index: 88888888; padding: 12px 0 !important;position: relative;display: flex;align-items: center;gap: 60px;padding-right: 28px !important;justify-content: space-between">
    <div style="display: flex; align-items: center;gap: 60px">

        <div style="display: flex; align-items: center">
            <div style="padding: 8px;border-radius: 8px;border: none;background: #88304e;"
                class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html"
                data-fire-event="sidebar-left-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 6l16 0" />
                    <path d="M4 12l16 0" />
                    <path d="M4 18l16 0" />
                </svg>
            </div>
        </div>
        <div style="display: flex; align-items: center;gap: 40px">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('/site/imgs/logo.png') }}" style="width: 130px;" alt="logo" class="logo">
            </a>
        </div>
    </div>

    <div style="display: flex;flex-direction: row-reverse;align-items: center;gap: 20px;padding-left: 20px;">
        <svg version="1.1" id="fi_64572" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" width="45.532px" height="45.532px" viewBox="0 0 45.532 45.532"
            style="enable-background:new 0 0 45.532 45.532;width: 35px;height: 36px;fill: #311c3e;"
            xml:space="preserve">
            <g>
                <path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765
                    S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53
                    c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012
                    c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592
                    c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z"></path>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
        </svg>
        @if(auth()->user()->isMaster)
        <div class="notification_wrapper" style="position: relative">
            <button id="show_notifications" style="background: #ffffff48;box-shadow: rgba(149, 157, 165, 0.053) 0px 8px 24px;border: none;border-radius: 50px;padding: 10px;">

                <svg id="fi_2645897" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                    width="512" xmlns="http://www.w3.org/2000/svg" style="width: 20px;height: 20px;">
                    <g>
                        <path
                            d="m411 262.862v-47.862c0-69.822-46.411-129.001-110-148.33v-21.67c0-24.813-20.187-45-45-45s-45 20.187-45 45v21.67c-63.59 19.329-110 78.507-110 148.33v47.862c0 61.332-23.378 119.488-65.827 163.756-4.16 4.338-5.329 10.739-2.971 16.267s7.788 9.115 13.798 9.115h136.509c6.968 34.192 37.272 60 73.491 60 36.22 0 66.522-25.808 73.491-60h136.509c6.01 0 11.439-3.587 13.797-9.115s1.189-11.929-2.97-16.267c-42.449-44.268-65.827-102.425-65.827-163.756zm-170-217.862c0-8.271 6.729-15 15-15s15 6.729 15 15v15.728c-4.937-.476-9.94-.728-15-.728s-10.063.252-15 .728zm15 437c-19.555 0-36.228-12.541-42.42-30h84.84c-6.192 17.459-22.865 30-42.42 30zm-177.67-60c34.161-45.792 52.67-101.208 52.67-159.138v-47.862c0-68.925 56.075-125 125-125s125 56.075 125 125v47.862c0 57.93 18.509 113.346 52.671 159.138z">
                        </path>
                        <path
                            d="m451 215c0 8.284 6.716 15 15 15s15-6.716 15-15c0-60.1-23.404-116.603-65.901-159.1-5.857-5.857-15.355-5.858-21.213 0s-5.858 15.355 0 21.213c36.831 36.831 57.114 85.8 57.114 137.887z">
                        </path>
                        <path
                            d="m46 230c8.284 0 15-6.716 15-15 0-52.086 20.284-101.055 57.114-137.886 5.858-5.858 5.858-15.355 0-21.213-5.857-5.858-15.355-5.858-21.213 0-42.497 42.497-65.901 98.999-65.901 159.099 0 8.284 6.716 15 15 15z">
                        </path>
                    </g>
                </svg>
            </button>
            <div class="notifications_pop_up">
            </div>
        </div>
        @endif
    </div>
</header>
