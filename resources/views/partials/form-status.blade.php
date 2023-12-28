@if (session('message'))
  <div class="alert alert-{{ Session::get('status') }} status-box alert-dismissable fade show" role="alert">
    <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;<span class="sr-only">Đóng</span></a>
    {{ session('message') }}
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success alert-dismissable fade show" role="alert">
    <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
    <h4><i class="icon fa fa-check fa-fw" aria-hidden="true"></i> Thành công !</h4>
    {{ session('success') }}
  </div>
@endif

@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
        <div class="alert alert-danger status-box alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;<span class="sr-only">Đóng</span></a>
            {{ session('message') }}
        </div>
    @endif
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissable fade show" role="alert">
    <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
    <h4>
      <i class="icon fa fa-warning fa-fw" aria-hidden="true"></i>
      Có lỗi !
    </h4>
    {{ session('error') }}
  </div>
@endif
