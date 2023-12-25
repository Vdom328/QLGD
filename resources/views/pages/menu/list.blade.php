@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css'])
@endsection

@section('page_icon')
    <img height="28" src="{{ asset('assets/images/icons/pencil-square.png') }}" class="menu_icon" />
@endsection

@section('page_title')
各種項目設定

@endsection
@section('title-page')
各種項目設定

@endsection

@section('page_title_actions')
    <div class="col-12 d-flex align-items-center">
        <div class="col-6">
            > 各種項目設定

        </div>

    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 mb-4">
        <a href="#">
            <div class="bg-white rounded shadow-sm p-3 d-flex">
                <div class="ps-4">
                    <img width="40" height="40" src="{{ asset('assets/images/icons/pencil-square.png') }}" alt="">
                </div>
                <div class="ps-4 pt-2">
                    案件状況設定
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <a href="{{ route('customer.payment_terms') }}">
            <div class="bg-white rounded shadow-sm p-3 d-flex">
                <div class="ps-4">
                    <img width="40" height="40" src="{{ asset('assets/images/icons/pencil-square.png') }}" alt="">
                </div>
                <div class="ps-4 pt-2">
                    取引先支払い案件設定
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <a href="{{ route('supplier.payment_terms') }}">
            <div class="bg-white rounded shadow-sm p-3 d-flex">
                <div class="ps-4">
                    <img width="40" height="40" src="{{ asset('assets/images/icons/pencil-square.png') }}" alt="">
                </div>
                <div class="ps-4 pt-2">
                    仕入れ先支払い案件設定
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6 mb-4">
        <a href="{{ route('product.index') }}">
            <div class="bg-white rounded shadow-sm p-3 d-flex">
                <div class="ps-4">
                    <img width="40" height="40" src="{{ asset('assets/images/icons/pencil-square.png') }}" alt="">
                </div>
                <div class="ps-4 pt-2">
                    見積もり項目設定
                </div>
            </div>
        </a>
    </div>
</div>

@endsection

@section('footer_scripts')
@endsection
