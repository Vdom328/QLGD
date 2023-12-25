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
<div class="col-12 d-flex flex-wrap align-items-center">
    <div class="col-md-6 col-12">
        > 各種項目設定 > 取引先支払い案件設定
    </div>
    <div class="d-flex col-md-6 col-12  mt-md-0 mt-2 justify-content-end">
        @include('components.btn-create-new', ['url' => route('customer.payment_terms.register')])
    </div>
</div>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="row p-3 bg-white shadow-sm rounded-3 customer_table_container">
                <table class="table table-hover">
                    @include('pages.payment_terms.partials._list',compact('data'))
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
@endsection
