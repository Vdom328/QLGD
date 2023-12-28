<div class="app-sidebar sidebar-shadow">
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li>
                    <a href="#" class="ps-0 text-sidebar"> Cài đặt </a>
                    <ul class="mm-collapse mm-show">
                        <li>
                            <a href="{{ route('staffs') }}"
                                class="{{ strpos(Route::currentRouteName(), 'staffs') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'staffs.create') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'staffs.create') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'profile.index') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/administrator-solid.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Cài đặt người dùng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('classroom.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'classroom.index') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'classroom.create') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/ios-paper.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Cài đặt phòng học
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
