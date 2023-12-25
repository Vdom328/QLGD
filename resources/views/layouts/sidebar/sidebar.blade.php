<div class="app-sidebar sidebar-shadow">
    {{-- @include('layouts.header.logo') --}}

    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li>
                    <a href="#" class="ps-0 text-sidebar"> 設定 </a>
                    <ul class="mm-collapse mm-show">
                        <li>
                            <a href="{{ route('staffs') }}"
                                class="{{ strpos(Route::currentRouteName(), 'staffs') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'staffs.create') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'staffs.create') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'profile.index') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/administrator-solid.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                スタッフ設定
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
