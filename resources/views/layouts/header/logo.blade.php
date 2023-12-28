<div class="app-header__logo">
    <!-- <div class="logo-src"></div> -->
    <div class="header__pane ms-auto">
        <div>
            @if (Auth::User())
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic mb-1" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            @endif
        </div>
    </div>
    <a class="d-flex align-items-center" href="{{route('home')}}">
        <div class="logo-src d-flex align-items-center"><img src="{{ asset('images/solar_logo.png') }}" /></div>
        <h3 class="text-logo ms-2 text-dark mb-1">Quản lý giảng đường</h3>
    </a>
</div>
<div class="app-header__mobile-menu">
    <div>
        @if (Auth::User())
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        @endif
    </div>
</div>
<div class="app-header__menu">
    @include('layouts.header.header-right')
</div>
