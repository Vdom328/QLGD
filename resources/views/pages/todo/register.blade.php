@extends('layouts.app')

@section('template_linked_css')
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/create_todo.jpg') }}" class="menu_icon icon-group" />
@endsection

@section('page_title')
    ToDo登録
@endsection
@section('title-page')
    ToDo登録
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap">
        <div class="col-md-6 col-12 ">
            > ToDo一覧 > ToDo登録
        </div>
    </div>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-sm-12">
            <form class="row p-3 bg-white rounded-3 shadow-sm" method="post" action="{{ route('todo.createTodo') }}" id="todo_form"
                enctype="multipart/form-data">
                @csrf
                <div class="col-12 p-md-5 p-2 d-flex flex-wrap row">
                    <div class="col-12 ">
                        {{-- type and project --}}
                        <div class="row col-12">
                            <div class="col-md-4 col-12">
                                <select class="form-select" name="type" id="type">
                                    @foreach (\App\Classes\Enum\TodoTypeEnum::cases() as $case)
                                        <option value="{{ $case->value }}"
                                            @if (old('type') == $case->value) selected @endif>{{ $case->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-12 mt-md-0 mt-2 d-flex flex-wrap  align-items-center">
                                <div class="col-5 text-end">案件番号:</div>
                                <div class="col-7 ps-lg-5 d-flex">
                                    <p class="mb-0" id="project_name"></p>
                                    <input type="hidden" value="" name="project_id" id="project_id">
                                    <button type="button" class="btn-dark-dark ms-3 " id="list_project">保　存</button>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <p class="w-100 error" id="error_type">{{ $errors->first('type') }}</p>
                        </div>
                        {{-- title --}}
                        <div class=" row col-12 ">
                            <div class="col-12">
                                <input type="text" class="form-control " placeholder="件名" name="title"
                                    value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class=" row col-12 ">
                            <div class="col-12">
                                <p class="w-100 error" id="error_title">{{ $errors->first('title') }}</p>
                            </div>
                        </div>
                        {{-- content  --}}
                        <div class=" row col-12 ">
                            <div class="col-12">
                                <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="ToDo登録"> {{ old('content') }}</textarea>
                            </div>
                        </div>
                        <div class=" row col-12 ">
                            <div class="col-12">
                                <p class="w-100 error" id="error_content">{{ $errors->first('content') }}</p>
                            </div>
                        </div>
                        {{-- status and deadline and manager and registrar --}}
                        <div class=" row col-12 d-flex flex-wrap align-items-center">
                            <div class="row col-lg-2 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-12 col-md-6 col-12 pe-0">
                                    <select class="form-select" name="" disabled>
                                        <option value="{{ $status->value }}">{{ $status->label() }}</option>
                                    </select>
                                    <input type="hidden" name="status" id="status" value="{{ $status->value }}">
                                </div>
                            </div>
                            <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-5 col-md-6 col-12 text-xl-end">期限日:</div>
                                <div class="col-lg-7 col-md-6 col-12 pe-0">
                                    <input type="text" class="form-control datepicker" name="expired_date"
                                        value="{{ old('expired_date') }}">
                                </div>
                            </div>
                            <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-5 col-md-6 col-12 text-xl-end">担当者:</div>
                                <div class="col-lg-7 col-md-6 col-12 pe-0">
                                    <select class="form-select" name="manager_id" id="manager_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if (old('manager_id') == $user->id) selected @endif>
                                                {{ $user->profile->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-5 col-md-6 col-12 text-xl-end">登錄者:</div>
                                <div class="col-lg-7 col-md-6 col-12 pe-0">
                                    <select class="form-select" name="registrar_id" id="registrar_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if ($user->id == Auth::user()->id) selected @endif
                                                @if (old('registrar_id') == $user->id) selected @endif>
                                                {{ $user->profile->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" row  col-12 d-flex flex-wrap align-items-center">
                            <div class="row col-lg-2 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-12 col-md-6 col-12 pe-0">
                                    <p class="w-100 error" id="error_status">{{ $errors->first('status') }}</p>
                                </div>
                            </div>
                            <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-5 col-md-6 col-12 text-xl-end"></div>
                                <div class="col-lg-7 col-md-6 col-12 pe-0">
                                    <p class="w-100 error" id="error_expired_date">{{ $errors->first('expired_date') }}</p>
                                </div>
                            </div>
                            <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-5 col-md-6 col-12 text-xl-end"></div>
                                <div class="col-lg-7 col-md-6 col-12 pe-0">
                                    <p class="w-100 error" id="error_manager_id">{{ $errors->first('manager_id') }}</p>
                                </div>
                            </div>
                            <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center pe-0">
                                <div class="col-lg-5 col-md-6 col-12 text-xl-end"></div>
                                <div class="col-lg-7 col-md-6 col-12 pe-0">
                                    <p class="w-100 error" id="error_registrar_id">{{ $errors->first('registrar_id') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- todo_attachments --}}
                        <div class="col-12 d-flex align-items-center">
                            <div>添付ㄧㄡイ儿: </div>
                            <input type="file" name="attachments[]" multiple
                                accept=".pdf, .doc, .docx, .jpg, .jpeg, .png" hidden class="attachments" value="">
                            <div class="ms-4">
                                <button type="button" id="todo_attachments"
                                    class="btn-grey btn_staff_no  cursor-pointer">選
                                    択</button>
                            </div>
                        </div>
                        <div class="col-12 d-flex align-items-center mt-2 flex-wrap">
                            <div class="col-lg-1 col-12"></div>
                            <div id="selectedFiles" class="ps-lg-3 col-lg-11 col-12"></div>
                        </div>
                        {{--  --}}
                    </div>
                </div>

                {{-- submit --}}
                <div class="col-12 d-flex">
                    <div class="col-md-6 col-4 text-end me-4">
                        <a href="{{ route('todo.index') }}" type="button" class="btn-dark-dark">戻　る</a>
                    </div>
                    <div class="col-md-6 col-4 ps-4">
                        <button type="submit" class="btn-dark-dark">保　存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer_scripts')
@include('pages.todo.partials.script')
@endsection
