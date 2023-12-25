@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/piggy-bank-solid.png') }}"
        class="menu_icon icon-bxs-dashboard menu_icon_bottom" />
@endsection

@section('page_title')
    入出金管理
@endsection
@section('title-page')
    入出金管理
@endsection

@section('page_title_actions')
    <div>> 入出金管理
    </div>
@endsection

@section('content')
    <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        <div class="col-12 border_bottom_search pb-2">絞り込み
        </div>
        <form id="form-search">
            @csrf
            <div class="col-12 d-flex flex-wrap">
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-xl-2 col-md-5 col-12 text-start text-md-end me-md-2">期間：
                    </div>
                    <div class="col-md-6 col-12">
                        <select  name="" id="" class="form-select">
                            <option value=""></option>
                            <option value="">áda</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-xl-3 col-md-5 col-12 text-md-end me-2">カテゴリ：
                    </div>
                    <div class="col-md-6 col-12">
                        <select name="category" id="" class="form-select">
                            <option value=""></option>
                            {{-- @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-md-5 col-12 text-md-end me-2">取引先：
                    </div>
                    <div class="col-md-6 col-12">
                        <select  name="" id="" class="form-select">
                            <option value=""></option>
                            {{-- @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-md-5 col-12 text-md-end me-2">仕入れ先：
                    </div>
                    <div class="col-md-6 col-12">
                        <select name="staff" id="" class="form-select">
                            <option value=""></option>
                            {{-- @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff') == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->profile->fullname }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-wrap">
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-xl-2 col-md-5 col-12 text-start text-md-end me-md-2">状態：
                    </div>
                    <div class="col-md-6 col-12">
                        <select name="status" id="" class="form-select">
                            <option value=""></option>

                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-xl-3 col-md-5 col-12 text-md-end me-2">社内担当者：
                    </div>
                    <div class="col-md-6 col-12">
                        <select  name="supplier" id="" class="form-select">
                            <option value=""></option>
                            {{-- @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-xl-5 mt-3 col-md-10 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-md-3 col-12 text-md-end me-2">フリーワード：
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" name="free_input" class="form-control">
                    </div>
                </div>
                <div class="col-1 mt-3 d-flex align-items-center"><button id="btn-submit-form" type="button"
                        class="btn-dark-dark">検　索
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-3">
        <div class="col-12 d-flex justify-content-end mb-2">
            <input type="checkbox" name="" id="filter_project" class="me-2 cursor-pointer"><label
                class="cursor-pointer" for="filter_project">未入金があるもののみ表示
            </label>
        </div>
        <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
            <table class="table table-hover sortable">
                <thead>
                    <tr>
                        <th class="sort_table"> 案件番号
                            <i class="ms-1 fas fa-sort"></i>
                        </th>
                        <th class="sort_table"> 案件名<i class="ms-1 fas fa-sort"></i>
                        </th>
                        <th class="sort_table">取引先名<i class="ms-1 fas fa-sort"></i>
                        </th>
                        <th data-column="name" data-direction="desc" class="sort_table">仕入れ先
                            <i class="ms-1 fas fa-sort"></i>
                        </th>
                        <th class="sorttable_nosort">エンブルー入金
                        </th>
                        <th class="sorttable_nosort">TERAS入金
                        </th>
                        <th class="sorttable_nosort">TERAS支払
                        </th>
                        <th class="sorttable_nosort">社内担当</th>
                    </tr>
                </thead>
                <tbody id="projects_table">
                    @for ($i = 1; $i < 10; $i++)
                        <tr>
                            <td><img src="{{ asset('assets/images/icons/fire.png') }}" alt="" width="25px">0000{{ $i }}</td>
                            <td>
                                <a href="" class="text-decoration-underline">xxxxxxxxxxxxxxxx</a>
                            </td>
                            <td>
                                <a href="" class="text-decoration-underline">xxxxxxxxxxxxxxxx</a>
                            </td>
                            <td>
                                <a href="" class="text-decoration-underline">xxxxxxxxxxxxxxxx</a>
                            </td>
                            <td><button type="button" class="btn-grey">2022/02/22</button></td>
                            <td><button type="button" class="btn-grey">2022/02/22</button></td>
                            <td><button type="button" class="btn-white">2022/02/22</button></td>
                            <td>
                                <img src="{{ Avatar::create(Auth::user()->profile->fullname)->toBase64() }}"
                                    alt="" width="35px" height="35px">
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <div id="project_paginate">

            </div>
        </div>
    </div>
@endsection
