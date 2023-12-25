@extends('layouts.app')

@section('template_linked_css')
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/group.png') }}" class="global_icon" />
@endsection

@section('page_title')
    スタッフ設定
@endsection
@section('title-page')
    スタッフ設定
@endsection

@section('page_title_actions')
    <div>> スタッフ設定 > スタッフ登録・編集</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-end mb-2">
            <input type="checkbox" name="" id="checkbox" class="me-2"><label for="checkbox">自分が担当のものだけ表示</label>
        </div>
        <div class="row p-3 bg-white rounded-3 customer_table_container">
            <table class="table table-hover sortable">
                <thead>
                    <tr>
                        <th class="sort_table"> STT </th>
                        <th class="sort_table"> Name </th>
                        <th class="sorttable_nosort">phone</th>
                        <th class="sorttable_nosort">登録</th>
                        <th class="sorttable_nosort">登録</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < 15; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>s</td>
                            <td>案件</td>
                            <td>案件</td>
                            <td>案件</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer_scripts')

@endsection
