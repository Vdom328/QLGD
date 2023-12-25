@extends('layouts.app')

@section('template_linked_css')
    <style>
        .noti-email {
            padding: 10px;
            border: 1px solid;
            border-radius: 9px;
        }
    </style>
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/administrator-solid.png') }}" class="menu_icon icon-administrator-solid" />
@endsection

@section('page_title')
    スタッフ設定
@endsection
@section('title-page')
    スタッフ設定
@endsection

@section('page_title_actions')
    <div>> スタッフ設定 > スタッフ編集</div>
@endsection

@section('content')
    <style>
        input::placeholder {
            opacity: 0.4 !important;
        }
    </style>
    <form method="post" action="{{ route('profile.updateProfile') }}" class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm"
        enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $user->id }}">
        @csrf
        <div class="col-md-8 col-12">
            {{-- role --}}
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0">権限</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-4 col-12">
                        <input type="text" class="form-control" disabled value="{{ $user->roleUser->role->name }}"
                            name="role">
                        <input type="hidden" value="{{ $user->roleUser->role_id }}" name="role">

                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('role') }}</p>
                </div>
            </div>
            {{-- staff no --}}
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0">スタッフ番号</div>
                <div class="row  col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-4 col-8">
                        <input type="number" class="form-control" disabled
                            value="{{ old('staff_no', $user->profile->staff_no ?? '') }}" name="staff_no">
                        <input type="hidden" value="{{ $user->profile->staff_no }}" name="staff_no">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('staff_no') }}</p>
                </div>
            </div>
            {{-- fisrt naem and last name --}}
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-md-2 col-12 text-md-end p-0">スタッフ名</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-3 col-6">
                        <input type="text" class="form-control" placeholder="姓"
                            value="{{ old('first_name', $user->profile->first_name ?? '') }}" name="first_name">
                    </div>
                    <div class="col-md-3 col-6">
                        <input type="text" class="form-control" placeholder="名" name="last_name"
                            value="{{ old('last_name', $user->profile->last_name ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    @if ($errors->has('first_name'))
                        <p class="w-100 error mb-0">{{ $errors->first('first_name') }}</p>
                    @endif
                    <p class="w-100 error">{{ $errors->first('last_name') }}</p>
                </div>
            </div>
            {{-- fisrt name and last name kata --}}
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-md-2 col-12 text-md-end p-0">フリガナ</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-3 col-6">
                        <input type="text" class="form-control" placeholder="セイ" name="kana_first_name"
                            value="{{ old('kana_first_name', $user->profile->kana_first_name ?? '') }}">
                    </div>
                    <div class="col-md-3 col-6">
                        <input type="text" class="form-control" placeholder="メイ" name="kana_last_name"
                            value="{{ old('kana_last_name', $user->profile->kana_last_name ?? '') }}">
                    </div>

                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    @if ($errors->has('kana_first_name'))
                        <p class="w-100 error mb-0">{{ $errors->first('kana_first_name') }}</p>
                    @endif
                    <p class="w-100 error">{{ $errors->first('kana_last_name') }}</p>
                </div>
            </div>
            {{-- phone number --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end p-0">電話番号</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="tel" class="form-control" placeholder="" name="phone"
                            value="{{ old('phone', $user->profile->phone ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('phone') }}</p>
                </div>
            </div>
            {{-- TERAS --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end p-0">メインアドレス</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="text" class="form-control" placeholder="TERASアドレス" name="email"
                            value="{{ old('email', $user->email ?? '') }}">
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="teras">
                            <input type="checkbox" class="me-1 form-check-input" id="teras"
                                name="is_notification_main_email" value="1"
                                @if ($user->profile->is_notification_main_email ?? '' == Config::get('const.profile.yes')) checked @endif
                                @if (old('is_notification_main_email')) checked @endif>
                            このメールで通知を受け取る
                        </label>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('email') }}</p>
                </div>
            </div>
            {{-- enblue --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end p-0">サブアドレス</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="text" class="form-control" placeholder="enblueアドレス" name="sub_email"
                            value="{{ old('sub_email', $user->profile->sub_email ?? '') }}">
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="enblue">
                            <input type="checkbox" class="me-1 form-check-input" id="enblue"
                                name="is_notification_sub_email" value="1"
                                @if ($user->profile->is_notification_sub_email ?? '' == Config::get('const.profile.yes')) checked @endif
                                @if (old('is_notification_sub_email')) checked @endif>
                            このメールで通知を受け取る
                        </label>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('sub_email') }}</p>
                </div>
            </div>
            {{-- password --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end p-0">パスワード</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('password') }}</p>
                </div>
            </div>
            {{-- avatar --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end p-0">アイコン</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div id="containerImage" class="@if ($user->profile->avatar) col-3 @endif">
                        @if ($user->profile->avatar)
                            <input type="hidden" value="{{ $user->profile->avatar }}" name="avatar">
                            <img src="{{ asset('storage/avatarUser/' . $user->profile->avatar) ?? '' }}" alt=""
                                width="100%" height="100%">
                        @endif
                    </div>
                    <div class="col-md-3 col-4">
                        <button type="button" class="btn-grey button-image">選　択</button>
                    </div>
                    <input type="file" accept="image/png, image/gif, image/jpeg"  name="avatar"
                        id="inputImage" hidden>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end p-0"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('avatar') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            {{--  --}}
            <div class="d-flex flex-wrap align-items-center mb-3">
                <label class="form-check-label me-2" for="on-off-switch" data-on="1" data-off="0">有効 / 無効</label>
                <div class="form-check form-switch mt-1">
                    <input class="form-check-input" type="checkbox" id="on-off-switch" name="status" value="0" disabled
                        @if ($user->status == \App\Classes\Enum\StaffStatusEnum::INVALID->value) checked @endif @if (old('status')) checked @endif>
                </div>
            </div>
            {{--  --}}
            <div class="row d-flex flex-wrap align-items-center mb-3">
                <div class="col-12">メール通知設定</div>
            </div>
            {{--  --}}
            <div class=" d-flex flex-wrap align-items-center mb-3 noti-email col-xl-11 col-12">
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="todo_add_new_person_in_charge"
                            value="1" @if (
                                $user->UserNotificationSetting->todo_add_new_person_in_charge ??
                                    '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('todo_add_new_person_in_charge')) checked @endif>
                        自分が担当のToDoが発生した時
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="todo_expire_date" value="1"
                            @if ($user->UserNotificationSetting->todo_expire_date ?? '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('todo_expire_date')) checked @endif>
                        自分が担当のToDoの期限通知
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="todo_add_new" value="1"
                            @if ($user->UserNotificationSetting->todo_add_new ?? '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('todo_add_new')) checked @endif>
                        自分が登録者のToDoの期限通知
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="before_invoice_due_date"
                            value="1" @if ($user->UserNotificationSetting->before_invoice_due_date ?? '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('before_invoice_due_date')) checked @endif>
                        請求書未発行の期限日の前日(営業日)
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="deposit_withdrawal_alert"
                            value="1" @if (
                                $user->UserNotificationSetting->deposit_withdrawal_alert ??
                                    '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('deposit_withdrawal_alert')) checked @endif>
                        入出金アラートが発生した時
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="driver_information_not_sent"
                            value="1" @if (
                                $user->UserNotificationSetting->driver_information_not_sent ??
                                    '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('driver_information_not_sent')) checked @endif>
                        ドライバー情報未送信
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="before_QB_final_confirmation_deadline"
                            value="1" @if (
                                $user->UserNotificationSetting->before_QB_final_confirmation_deadline ??
                                    '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('before_QB_final_confirmation_deadline')) checked @endif>
                        QB最終確認の期限日の前日 (営業日)
                    </label>
                </div>
                <div class="col-12 mb-3">
                    <label>
                        <input type="checkbox" class="me-1 form-check-input" name="before_QB_specification_deadline"
                            value="1" @if (
                                $user->UserNotificationSetting->before_QB_specification_deadline ??
                                    '' == Config::get('const.user_notification_setting.yes')) checked @endif
                            @if (old('before_QB_specification_deadline')) checked @endif>
                        QB仕様書の期限の前日 (営業日)
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-md-6 col-4 text-end me-4">
                <a href="{{ route('home') }}" type="button" class="btn-dark-dark">戻　る</a>
            </div>
            <div class="col-md-6 col-4 ps-4">
                <button type="submit" class="btn-dark-dark">保　存</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            // click show avatar
            $('.button-image').click(function() {
                $('#inputImage').click();
            });

            $('#containerImage').click(function() {
                $('#inputImage').click();
            });

            $('#inputImage').change(function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgSrc = e.target.result;
                    var img = $('<img>').attr('src', imgSrc).css({
                        'width': '100%',
                        'height': '100%',
                    });
                    img.on('load', function() {
                        $('#containerImage').addClass('col-3');
                        $('#containerImage').empty().append(img);
                    });
                };
                reader.readAsDataURL(file);
            });

            // click load staff_no
            $(document).on("click", "#auto-gen", function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('profile.radomStaffNo') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $('input[name="staff_no"]').val(data.staff_no);
                    },
                });
            });
        });
    </script>
@endsection
