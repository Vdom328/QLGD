@extends('layouts.app')

@section('template_linked_css')
@vite(['resources/css/project/list.css'])
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/calculator.png') }}">
@endsection

@section('page_title')
 見積もり書一覧
@endsection
@section('title-page')
 見積もり書一覧
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            >  見積もり書一覧
        </div>
    </div>
@endsection

@section('content')
    <div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
            <div class="col-12 border_bottom_search pb-2 ">絞り込み</div>
            <div class="row mt-3 col-12 d-flex flex-wrap align-items-center">
                <div class="col-lg-1 col-12">状態:</div>
                <div class="col-lg-11 col-12">
                    <button class="me-2 custom_button mt-md-0 mt-2">見積もり済み</button>
                    <button class="me-2 custom_button mt-md-0 mt-2">受注</button>
                    <button class="me-2 custom_button mt-md-0 mt-2">失注</button>
                    <button class="me-2 custom_button mt-md-0 mt-2">発注待ち</button>
                    <button class="me-2 custom_button mt-md-0 mt-2">納品待ち</button>
                    <button class="me-2 custom_button mt-md-0 mt-2 active">納品済み</button>
                    <button class="me-2 custom_button mt-md-0 mt-2 ">請求待ち</button>
                    <button class="me-2 custom_button mt-md-0 mt-2">請求済み</button>
                    <button class="me-2 custom_button mt-md-0 mt-2">入金済み</button>
                </div>
            </div>
            <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center" >
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-3 col-md-6 col-12 ">期間:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select" name="" id=""></select>
                    </div>
                </div>
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">カテゴリ:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select" name="" id=""></select>
                    </div>
                </div>
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">取引先: </div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select" name="" id=""></select>
                    </div>
                </div>
                <div class="row col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">仕入れ先: </div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select" name="" id=""></select>
                    </div>
                </div>
            </div>
            <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center " >
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-4 col-12 ">社内担当者:</div>
                    <div class="col-md-8 col-12">
                        <select class="form-select" name="" id=""></select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-4 col-12 text-xxl-end pe-xxl-2">フリーワード:</div>
                    <div class="col-md-8 col-12">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-12 mt-lg-0 mt-2 d-flex flex-wrap justify-content-end">
                    <button id="btn_filter" type="button" class="btn-dark-dark">検　索</button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="col-12 d-flex justify-content-end mb-2">
                <input type="checkbox" name="filter_me" id="filter_me" class="me-2 cursor-pointer form-check-input"><label for="filter_me" class="cursor-pointer">自分が担当のものだけ表示</label>
            </div>
            <div>

            </div>
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th >案件番号<i class="ms-1 fas fa-sort "></i></th>
                            <th>カテゴリ<i class="ms-1 fas fa-sort "></i></th>
                            <th>案件名 <i class="ms-1 fas fa-sort "></i></th>
                            <th>金額<i class="ms-1 fas fa-sort "></i></th>
                            <th>取引先名<i class="ms-1 fas fa-sort "></i></th>
                            <th>状態<i class="ms-1 fas fa-sort "></i></th>
                            <th>作成日<i class="ms-1 fas fa-sort "></i></th>
                            <th>社内担当</th>
                            <th>見積もり書</th>
                        </tr>
                    </thead>
                    <tbody >
                        @for ($i = 0; $i < 9; $i++)
                            <tr>
                                <td>0000{{ $i }}</td>
                                <td>案件番号</td>
                                <td><a href="">案件番号</a></td>
                                <td>123,233,233</td>
                                <td>
                                    <a href="">案件番号</a>
                                </td>
                                <td>
                                    案件番号
                                </td>
                                <td>2023/10/20 23:33</td>
                                <td><img class="rounded-circle" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt=""  width="35px" height="35px"></td>
                                <td><button type="button" class="btn-dark-dark text-nowrap">見積もり書出力</button></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

@endsection
