@extends('layouts.app')

@section('page_icon')
<img src="{{asset('assets/images/icons/bxs-dashboard.png')}}" class="global_icon" />
@endsection
@section('page_title')
    404
@endsection

@section('template_linked_css')
@vite('resources/css/errors/error.css')
@endsection

@section('content')
<div class="error-page">
    <h2 class="headline text-warning me-md-0 me-md-3"> 404</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> お探しのページはありません</h3>
        <span>
            申し訳ございませんが、指定のページは削除されたか、移動された可能性があります。<br>
            その間、<a href="{{ route('home') }}">ダッシュボードに戻る</a>こともできます。
        </span>
    </div>
</div>
@endsection

@section('footer_scripts')
@endsection