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
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Đã xảy ra lỗi.</h3>
        <span>
            Chúng tôi sẽ tiến hành khắc phục ngay lập tức. <br>
             Trong thời gian chờ đợi, bạn cũng có thể <a href="{{ Route('home') }}">quay lại trang tổng quan của mình</a>.
        </span>
    </div>
</div>
@endsection

@section('footer_scripts')
@endsection
