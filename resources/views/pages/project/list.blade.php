@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/project/list.css'])
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/notes.png') }}"
class="menu_icon icon-bxs-dashboard" />
@endsection

@section('page_title')
    案件一覧
@endsection
@section('title-page')
    案件一覧
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap">
        <div class="col-md-6 col-12 ">
            > 案件一覧
        </div>
    </div>
@endsection

@section('content')
    <div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded">
            <div class="col-12 border_bottom_search pb-2 ">絞り込み</div>
            <div class="row mt-3 col-12 d-flex flex-wrap align-items-center">
                <div class="col-lg-1 col-12">状態:</div>
                <div class="col-lg-11 col-12 group-status">
                    @foreach($statusValues as $status)
                        <button data-value="{{ $status['value'] }}"
                                class="me-2 custom_button mt-md-0 mt-2 button-status">
                            {{ $status['name'] }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center">
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-3 col-md-6 col-12 ">期間:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select cursor-pointer" name="" id="">
                            <option value="">全て</option>
                        </select>
                    </div>
                </div>
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">カテゴリ:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select cursor-pointer" name="category" id="category">
                            <option value="">全て</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">取引先:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select cursor-pointer" name="customer_id" id="customer_id">
                            <option value="">全て</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}"> {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">仕入れ先:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select cursor-pointer" name="supplier_id" id="supplier_id">
                            <option value="">全て</option>
                            @foreach($supplies as $supplier)
                                <option value="{{ $supplier->id }}"> {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center ">
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-4 col-12 ">社内担当者:</div>
                    <div class="col-md-8 col-12">
                        <select class="form-select cursor-pointer" name="staff_id" id="staff_id">
                            <option value="" selected>全て</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->profile->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-4 col-12 text-xxl-end pe-xxl-2">フリーワード:</div>
                    <div class="col-md-8 col-12">
                        <input type="text" id="keywords" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-12 mt-lg-0 mt-2 d-flex flex-wrap justify-content-end">
                    <button id="btn_filter" type="button" class="btn-dark-dark">検　索</button>
                </div>
                <div>
                    <input type="text" hidden id="filed_sort">
                    <input type="text" hidden id="type_sort">
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="col-12 d-flex justify-content-end mb-2">
                <input type="checkbox"
                       name="filter_me" id="filter_me"
                       class="me-2 cursor-pointer form-check-input">
                <label for="filter_me" class="cursor-pointer">自分が担当のものだけ表示</label>
            </div>
            <div class="show-table">
                <div class="row p-3 bg-white rounded-3 customer_table_container">
                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th>
                                案件番号<i class="ms-1 fas fa-sort sort" data-filed-sort="no"></i>
                            </th>
                            <th>親案件</th>
                            <th>状態<i class="ms-1 fas fa-sort sort" data-filed-sort="status"></i></th>
                            <th>カテゴリ<i class="ms-1 fas fa-sort sort" data-filed-sort="category_id"></i></th>
                            <th>案件名<i class="ms-1 fas fa-sort sort" data-filed-sort="name"></i></th>
                            <th>取引先名<i class="ms-1 fas fa-sort "></i></th>
                            <th>
                                登录日<i class="ms-1 fas fa-sort sort" data-filed-sort="order_date"></i>
                            </th>
                            <th>
                                納期<i class="ms-1 fas fa-sort sort" data-filed-sort="exprire_date"></i>
                            </th>
                            <th>社内担当</th>
                            <th>複製</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Pagination Js --}}

@endsection

@section('footer_scripts')
    @include('pages.project.partials.script_list')
@endsection
