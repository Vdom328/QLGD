@extends('layouts.app')

@section('template_linked_css')
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/menu.jpg') }}">
@endsection

@section('page_title')
    Cài đặt
@endsection
@section('title-page')
    Cài đặt
@endsection

@section('page_title_actions')
    <div><i class="fas fa-angle-right"></i> Cài đặt </div>
@endsection

@section('content')
    <form method="post" action="{{ route('settings.update') }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        @csrf
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-8 col-12">
                {{-- time_slots class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="time_slots">Một ngày có số tiết:</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <div class="col-md-6 col-12">
                            <input type="number" class="form-control" id="time_slots" placeholder="" name="time_slots"
                                value="{{ old('time_slots', $settings->time_slots) }}">
                        </div>
                    </div>
                </div>
                <div class=" d-flex flex-wrap align-items-center ">
                    <p class="w-100 error">{{ $errors->first('name') }}</p>
                </div>
            </div>

        </div>
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-6 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="paginate">Số bản ghi phân trang</label>
                    <div class="col-md-12 col-12 flex-wrap d-flex align-items-center">
                        <div class="col-md-8 col-12">
                            <input type="number" class="form-control" id="paginate" placeholder="" name="paginate"
                                value="{{ old('paginate', $settings->paginate) }}">
                        </div>
                    </div>
                </div>
                <div class=" d-flex flex-wrap align-items-center ">
                    <p class="w-100 error">{{ $errors->first('paginate') }}</p>
                </div>
            </div>

        </div>
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-4 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="block">Số tiết của tín chỉ</label>
                </div>
            </div>
            <div class="col-md-4 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="block">Số tiết mỗi tuần</label>
                </div>
            </div>

            <div class="col-md-4 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="block">Số tiết mỗi ngày</label>
                </div>
            </div>
        </div>
        @foreach ($setting_credit as $item)
            <div class="col-md-12 col-12 d-flex flex-wrap">
                <div class="col-md-4 col-12">
                    {{-- name class room --}}
                    <div class="d-flex flex-wrap align-items-center mb-2">
                        <div class="col-md-12 col-12 d-flex align-items-center">
                            <div class="col-md-8 col-12">
                                <input type="text" class="form-control" placeholder="" name="credit[{{ $item->quantity_credits }}]" value="{{ $item->quantity_credits }} Tín"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    {{-- name class room --}}
                    <div class="d-flex flex-wrap align-items-center mb-2">
                        <div class="col-md-12 col-12 d-flex align-items-center">
                            <div class="col-md-8 col-12">
                                <input type="number" class="form-control" id="subject_weekly_max[{{ $item->quantity_credits }}]" placeholder=""
                                    name="subject_weekly_max[{{ $item->quantity_credits }}]" value="{{ $item->subject_weekly_max }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    {{-- name class room --}}
                    <div class="d-flex flex-wrap align-items-center mb-2">
                        <div class="col-md-12 col-12 d-flex align-items-center">
                            <div class="col-md-8 col-12">
                                <input type="number" class="form-control" id="subject_day_max[{{ $item->quantity_credits }}]" placeholder=""
                                    name="subject_day_max[{{ $item->quantity_credits }}]" value="{{ $item->subject_day_max }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-12 d-flex mt-4">
            <div class="col-6 ps-2">
                <button type="submit" class="btn-dark-dark">Gửi</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {

            // click load staff_no
            $(document).on("click", "#auto-gen", function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('subject.radomNo') }}",
                    data: {},
                    success: function(data) {
                        $('input[name="paginate"]').val(data.paginate);
                    },
                });
            });
        });
    </script>
@endsection
