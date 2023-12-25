@extends('layouts.app')

@section('page_icon')
<img src="{{ asset('assets/images/icons/edit.png') }}" class="menu_icon icon-group" />
@endsection
@section('page_title')
取引先支払い案件設定
@endsection
@section('title-page')
取引先支払い案件設定
@endsection
@section('template_title')

@endsection

@section('template_linked_css')

@endsection

@section('page_title_actions')
<div class="col-12 d-flex">
        > 各種項目設定 > 取引先支払い案件設定
</div>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-sm-12">
            <form class="row p-3 bg-white shadow-sm rounded-3 customer_table_container" method="post" action="{{ route('customer.payment_terms.postRegister') }}">
                @csrf
                <input type="hidden" name="type" value="{{ Config::get('const.payment_terms.type.customer') }}">
                @include('pages.payment_terms.partials._create')
                {{-- submit --}}
                <div class="col-12 d-flex">
                    <div class="col-md-6 col-4 text-end me-4">
                        <a href="{{ route('customer.payment_terms') }}" type="button" class="btn-dark-dark">戻　る</a>
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
@endsection
