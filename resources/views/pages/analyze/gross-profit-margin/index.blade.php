@extends('layouts.app')

@section('template_linked_css')
@vite(['resources/css/analyze/style.css'])
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/piggy-bank-solid.png') }}" class="menu_icon icon-bxs-dashboard" />
@endsection

@section('page_title')
入出金管理
@endsection
@section('title-page')
入出金管理
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap">
        <div class="col-md-6 col-12 ">
            > 入出金管理
        </div>
    </div>
@endsection

@section('content')
    <div>
        @include('pages.analyze.partials._form_search')

        {{--  --}}

        @include('pages.analyze.partials._data')
    </div>
@endsection

@section('footer_scripts')
@include('pages.analyze.partials._script')
@endsection
