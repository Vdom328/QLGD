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
    Cài đặt nhân viên
@endsection
@section('title-page')
Cài đặt nhân viên
@endsection

@section('page_title_actions')
    <div><i class="fas fa-angle-right"></i> Cài đặt nhân viên <i class="fas fa-angle-right"></i> Thêm mới</div>
@endsection

@section('content')
    <style>
        input::placeholder {
            opacity: 0.4 !important;
        }
    </style>
    <form method="post" action="{{ route('staffs.create.save') }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        @csrf
        <div class="col-md-8 col-12">
            {{-- role --}}
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end">Quyền</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-4 col-12">
                        <select name="role" id="role" class="form-select">
                            <option value="">Vui lòng chọn</option>
                            @foreach ($roles as $role)
                                <option {{ old('role') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('role') }}</p>
                </div>
            </div>
            {{-- staff no --}}
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end">Mã số ND</div>
                <div class="row  col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-4 col-8">
                        <input type="number" class="form-control" value="{{ old('staff_no') }}" name="staff_no">
                    </div>
                    <div class="col-md-3 col-4">
                        <div id="auto-gen" class="btn-grey btn_staff_no  cursor-pointer">Tự động</div>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('staff_no') }}</p>
                </div>
            </div>
            {{-- fisrt naem and last name --}}
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-md-2 col-12 text-md-end">Tên ND</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-3 col-6">
                        <input type="text" class="first_name form-control"
                            value="{{ old('first_name') }}" name="first_name">
                    </div>
                    <div class="col-md-3 col-6">
                        <input type="text" class="form-control"  name="last_name"
                            value="{{ old('last_name') }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    @if ($errors->has('first_name'))
                        <p class="w-100 error mb-0">{{ $errors->first('first_name') }}</p>
                    @endif
                    <p class="w-100 error">{{ $errors->first('last_name') }}</p>
                </div>
            </div>
            {{-- phone number --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end">Số điện thoại</div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="tel" class="form-control" placeholder="" name="phone"
                            value="{{ old('phone') }}">
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('phone') }}</p>
                </div>
            </div>
            {{-- email --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end">Email</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="text" class="form-control"  name="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="teras">
                            <input type="checkbox" class="me-1" id="teras" name="is_notification_main_email"
                                value="1">
                                Nhận thông báo qua email này
                        </label>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('email') }}</p>
                </div>
            </div>
            {{-- password --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end">Mật khẩu</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-md-6 col-12">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    </div>

                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('password') }}</p>
                </div>
            </div>
            {{-- avatar --}}
            <div class="row d-flex flex-wrap align-items-center mb-2">
                <div class="col-md-2 col-12 text-md-end">Ảnh đại diện</div>
                <div class="row col-md-10 col-12 d-flex flex-wrap align-items-center">
                    <div id="containerImage">
                    </div>
                    <div class="col-md-3 col-4">
                        <button type="button" class="btn-grey button-image">Chọn</button>
                    </div>
                    <input type="file" accept="image/png, image/gif, image/jpeg" type="file" name="avatar"
                        id="inputImage" hidden>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-md-2 col-12 text-md-end"></div>
                <div class="row col-md-10 col-12 d-flex align-items-center">
                    <p class="w-100 error">{{ $errors->first('avatar') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            {{--  --}}
            <div class="d-flex flex-wrap align-items-center mb-3">
                <label class="form-check-label me-2" for="on-off-switch" data-on="0" data-off="1">Có hiệu lực / Vô hiệu hóa</label>
                <div class="form-check form-switch mt-1">
                    <input class="form-check-input  cursor-pointer" type="checkbox" checked id="on-off-switch"
                        name="status" value="1">
                </div>
                <label class="form-check-label me-2 d-none" id="checkbox-on">Vô hiệu hóa</label>
                <label class="form-check-label me-2 d-none" id="checkbox-off">Có hiệu lực</label>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-md-6 col-4 text-end pe-4">
                <a href="{{ route('staffs') }}" type="button" class="btn-dark-dark">Trở lại</a>
            </div>
            <div class="col-md-6 col-4 ps-4">
                <button type="submit" class="btn-dark-dark">Gửi</button>
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

            var $checkbox = $('#on-off-switch');
            var $labelOn = $('#checkbox-on');
            var $labelOff = $('#checkbox-off');

            $checkbox.change(function() {
                if ($checkbox.prop('checked')) {
                    $labelOn.removeClass('d-none');
                    $labelOff.addClass('d-none');
                } else {
                    $labelOn.addClass('d-none');
                    $labelOff.removeClass('d-none');
                }
            });

            if ($checkbox.prop('checked')) {
                $labelOn.removeClass('d-none');
                $labelOff.addClass('d-none');
            } else {
                $labelOn.addClass('d-none');
                $labelOff.removeClass('d-none');
            }
        });
    </script>
@endsection
