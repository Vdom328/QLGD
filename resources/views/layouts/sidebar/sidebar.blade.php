<div class="app-sidebar sidebar-shadow">
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                {{-- settings --}}
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
                                Người dùng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('classroom.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'classroom.index') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'classroom.create') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'classroom.update') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/ios-paper.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Phòng học
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subject.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'subject.index') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'subject.create') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'subject.update') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/list_todo.jpg') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Môn học
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- requai --}}
                <li>
                    <a href="#" class="ps-0 text-sidebar"> Chỉ định </a>
                    <ul class="mm-collapse mm-show">
                        <li>
                            <a href="{{ route('labs.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'labs.index') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/invoice.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Môn học chỉ định
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('teacherSubject.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'teacherSubject.index') === 0 ? 'mm-active' : '' }}
                                {{ strpos(Route::currentRouteName(), 'teacherSubject.update') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/truck.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Giảng viên chỉ định
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- view --}}
                {{-- <li>
                    <a href="#" class="ps-0 text-sidebar"> Thời khóa biểu</a>
                    <ul class="mm-collapse mm-show">

                        <li>
                            <a href="{{ route('teacherSubject.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'teacherSubject.index') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/administrator-solid.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Thời khóa biểu
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('labs.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'labs.index') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/administrator-solid.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Thời khóa biểu giảng viên
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
