@php
    use App\Classes\Enum\RoleUserEnum;
@endphp
<div class="app-sidebar sidebar-shadow">
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                {{-- settings --}}
                <li>
                    @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value)
                        <a href="#" class="ps-0 text-sidebar"> Cài đặt </a>
                        <ul class="mm-collapse mm-show">
                            <li>
                                <a href="{{ route('staffs') }}"
                                    class="{{ strpos(Route::currentRouteName(), 'staffs') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'home') === 0 ? 'mm-active' : '' }}
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
                            <li>
                                <a href="{{ route('class.index') }}"
                                    class="{{ strpos(Route::currentRouteName(), 'class.index') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'class.create') === 0 ? 'mm-active' : '' }}
                                       {{ strpos(Route::currentRouteName(), 'class.update') === 0 ? 'mm-active' : '' }}">
                                    <img src="{{ asset('assets/images/icons/th.png') }}"
                                        class="menu_icon icon-bxs-dashboard" />
                                    Lớp học
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('settings.index') }}"
                                    class="{{ strpos(Route::currentRouteName(), 'settings.index') === 0 ? 'mm-active' : '' }}">
                                    <img src="{{ asset('assets/images/icons/menu.jpg') }}"
                                        class="menu_icon icon-bxs-dashboard" />
                                    Cài đặt chung
                                </a>
                            </li>
                        </ul>
                    @endif
                </li>
                {{-- requai --}}
                <li>
                    <a href="#" class="ps-0 text-sidebar"> Chỉ định </a>
                    <ul class="mm-collapse mm-show">
                        @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value || Auth()->user()->level() == RoleUserEnum::STAFF->value)
                            @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value)
                                <li>
                                    <a href="{{ route('labs.index') }}"
                                        class="{{ strpos(Route::currentRouteName(), 'labs.index') === 0 ? 'mm-active' : '' }}">
                                        <img src="{{ asset('assets/images/icons/invoice.png') }}"
                                            class="menu_icon icon-bxs-dashboard" />
                                        Môn học chỉ định
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="
                                @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value)
                                    {{ route('teacherSubject.index') }}
                                @else
                                    {{ route('teacherSubject.update', Auth()->user()->id) }}
                                @endif
                                "
                                    class="{{ strpos(Route::currentRouteName(), 'teacherSubject.index') === 0 ? 'mm-active' : '' }}
                                    {{ strpos(Route::currentRouteName(), 'teacherSubject.update') === 0 ? 'mm-active' : '' }}">
                                    <img src="{{ asset('assets/images/icons/truck.png') }}"
                                        class="menu_icon icon-bxs-dashboard" />
                                    Giảng viên chỉ định
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="
                            @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value || Auth()->user()->level() == RoleUserEnum::STAFF->value)
                                {{ route('student.index') }}
                            @else
                                {{ route('student.update', Auth()->user()->id) }}
                            @endif
                            "
                                class="{{ strpos(Route::currentRouteName(), 'student.index') === 0 ? 'mm-active' : '' }}
                                {{ strpos(Route::currentRouteName(), 'student.update') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/edit.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                Sinh viên chỉ định
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- view --}}
                <li>
                    <a href="#" class="ps-0 text-sidebar"> Thời khóa biểu</a>
                    <ul class="mm-collapse mm-show">
                        @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value)
                            <li>
                                <a href="{{ route('scheduler.index') }}"
                                    class="{{ strpos(Route::currentRouteName(), 'scheduler.index') === 0 ? 'mm-active' : '' }}">
                                    <img src="{{ asset('assets/images/icons/notes.png') }}"
                                        class="menu_icon icon-bxs-dashboard" />
                                    Thời khóa biểu
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('scheduleUser.index') }}"
                                class="{{ strpos(Route::currentRouteName(), 'scheduleUser.index') === 0 ? 'mm-active' : '' }}">
                                <img src="{{ asset('assets/images/icons/calculator.png') }}"
                                    class="menu_icon icon-bxs-dashboard" />
                                TKB người dùng
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
