@extends('layouts.app')

@section('page_icon')
<img src="{{asset('assets/images/icons/bxs-dashboard.png')}}" class="global_icon" />
@endsection
@section('page_title')
    500
@endsection

@section('template_linked_css')
@vite('resources/css/errors/error.css')
@endsection

@section('content')
<div class="error-page">
    <h2 class="headline text-danger me-md-0 me-md-3"> 500</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> 何か問題が発生しました。</h3>
        <span>
            すぐに修正に取り組みます 。<br>
            その間、<a href="{{ route('home') }}">ダッシュボードに戻る</a>こともできます。
        </span>
    </div>
</div>
@endsection

@section('footer_scripts')
@endsection