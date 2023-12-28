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
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Trang bạn đang tìm kiếm không tồn tại</h3>
        <span>
            Chúng tôi xin lỗi nhưng trang bạn chỉ định có thể đã bị xóa hoặc di chuyển. <br>
             Trong thời gian chờ đợi, bạn cũng có thể <a href="{{ Route('home') }}">quay lại trang tổng quan của mình</a>.
        </span>
    </div>
</div>
@endsection

@section('footer_scripts')
@endsection
