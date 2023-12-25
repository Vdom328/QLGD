@extends('layouts.app')

@section('template_linked_css')
@vite(['resources/css/analyze/style.css'])
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/th.png') }}" class="menu_icon icon-bxs-dashboard "  />
@endsection

@section('page_title')
    カテゴリ別分析
@endsection
@section('title-page')
    カテゴリ別分析
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap">
        <div class="col-md-6 col-12 ">
            > カテゴリ別分析
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
