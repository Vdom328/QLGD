@extends('layouts.app')
@section('template_linked_css')
<style>
    * {
        margin:0;
        padding: 0;
    }
    h1{
        margin-top: -100px;
        margin-bottom: 20px;
        color: #facf5a;
        text-align: center;
        font-family: 'Raleway';
        font-size: 90px;
        font-weight: 800;
    }
    h2{
        color: #000000;
        text-align: center;
        font-family: 'Raleway';
        font-size: 30px;
        text-transform: uppercase;
    }
    h4{text-align: center;color: #000000;}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mt-5 ">
            <h1 class="mt-5 ">403 Forbidden!</h1>
            <h2>アクセスしようとしたページは表示できませんでした。</h2>
            <h4>このエラーは、表示するページへのアクセス許可がなかったことを意味します。</h4>
        </div>
    </div>
</div>
@endsection