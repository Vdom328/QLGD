<div class="dropdown header d-flex align-items-center">
    @if (Auth::check())
        <div class="me-3 form-size-icon fas fa-bell text-secondary cursor-pointer">
            <span class="notification-count">8</span>
        </div>
        <div class="dropdown-toggle d-flex align-items-center" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            @if (Auth::user()->profile->avatar == null)
                <img class="rounded-circle avatar" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                    alt="">
            @else
                <img class="rounded-circle avatar"
                    src="{{ asset('storage/avatarUser/' . Auth::user()->profile->avatar) }}" alt="">
            @endif
            <label class="ms-2 me-2 d-md-block d-none">
                {{ Auth::user()->profile->fullname }}
            </label>
        </div>
    @endif
    <div class="dropdown-menu dropdown-menu-right dropdown-profile mt-1">
        <div class="user-profile-area">

            <div class="dropdown-item d-flex align-items-center hover-effect col-12">
                <a @if (Auth::check()) href="{{ route('profile.index', Auth::id()) }}" @endif
                    class="dropdown-item d-flex align-items-center hover-effect">
                    <img src="/assets/images/icons/user.png" class="icon-logout me-3" /><label
                        for="">ユーザー情報</label>
                </a>
            </div>
            <div class="dropdown-item d-flex align-items-center hover-effect col-12">
                <form action="{{ route('logout') }}" method="post" class="col-12">
                    {{ csrf_field() }}
                    <button type="submit" tabindex="0" class="dropdown-item ml-1 col-12" id="logoutButton">
                        <img src="/assets/images/icons/logoutt.png" class="icon-logout me-3" />
                        <label for="logoutButton">ログアウト</label>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
