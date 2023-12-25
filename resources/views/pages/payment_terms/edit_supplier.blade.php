@extends('layouts.app')

@section('page_icon')
<img src="{{ asset('assets/images/icons/edit.png') }}" class="menu_icon icon-group" />
@endsection
@section('page_title')
仕入れ先支払い案件設定
@endsection
@section('title-page')
仕入れ先支払い案件設定
@endsection
@section('template_title')

@endsection

@section('template_linked_css')

@endsection



@section('page_title_actions')
<div class="col-12 d-flex">
        > 各種項目設定 > 仕入れ先支払い案件設定
</div>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-sm-12">
            <form class="row p-3 bg-white shadow-sm rounded-3 customer_table_container" method="post" action="{{ route('payment_terms.saveUpdate', $data->id) }}">
                <input type="hidden" name="type" value="{{ Config::get('const.payment_terms.type.supplier') }}">
                @csrf
                @include('pages.payment_terms.partials._edit')
                {{-- submit --}}
                <div class="col-12 d-flex flex-wrap">
                    <div class="col-xl-2 col-12 ps-md-4">
                        <x-button type="button" id="btn-del" class="btn-danger btn-block" :text="trans('common.btn.delete')" attrs="data-bs-toggle=modal data-bs-target=#confirmDelete"
                        dataTitle="{{trans('支払い期間を削除する')}}" dataMessage="{{trans('この支払い条件を削除しますか??')}}"/>
                    </div>
                    <div class="col-xl-10 col-12 d-flex justify-content-center">
                        <div class="col-md-5 col-4 d-flex align-items-center justify-content-end  pe-4 ps-5">
                            <a href="{{ route('supplier.payment_terms') }}" class="btn-dark-dark ">戻　る</a>
                        </div>
                        <div class="col-md-7 col-4 ps-4 d-flex align-items-center">
                            <button type="submit" class="btn-dark-dark">保　存</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer_scripts')
{{-- delete --}}
@include('modals.modal-delete-form', ['url' => route('payment_terms.delete', $data->id)])
@include('scripts.delete-modal-form-script')
{{-- end delete --}}
@endsection
