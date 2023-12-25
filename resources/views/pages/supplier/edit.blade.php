@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/bxs-purchase-tag-alt.png') }}" class="menu_icon icon-bxs-dashboard" />
@endsection

@section('page_title')
    仕入れ先マスタ
@endsection
@section('title-page')
    仕入れ先マスタ
@endsection

@section('page_title_actions')
    <div>> 仕入れ先マスタ> 仕入れ先編集</div>
@endsection

@section('content')
    <div class=" col-12 d-flex text-center mb-4">
        <div class="col-6 pe-2">
            <div id="companyInfoTab" class="col-12 p-2 bg-white rounded-pill cursor-pointer shadow-sm">企業情報</div>
        </div>
        <div class="col-6 ps-2">
            <div id="projectInfoTab" class="col-12 p-2 bg-white rounded-pill cursor-pointer shadow-sm">案件情報</div>
        </div>
    </div>
    @include('pages.supplier.partials.company_infor_edit')
    @include('pages.supplier.partials.project_information')
@endsection

@section('footer_scripts')
{{-- delete --}}
@include('modals.modal-delete-form', ['url' => route('supplier.delete', $supplier->id)])
@include('scripts.delete-modal-form-script')
{{-- end delete --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@include('pages.supplier.partials.script_create')
@include('pages.supplier.partials._script_listProject')
@endsection
