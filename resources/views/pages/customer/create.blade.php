@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/building.png') }}" class="menu_icon icon-bxs-dashboard menu_icon_bottom" />
@endsection

@section('page_title')
    取引先マスタ
@endsection
@section('title-page')
    取引先マスタ
@endsection

@section('page_title_actions')
    <div>> 取引先マスタ > 取引先詳細</div>
@endsection

@section('content')
    <div class=" col-12 d-flex text-center mb-4">
        <div class="col-6 pe-2">
            <div id="companyInfoTab" class="col-12 p-2 bg-white rounded-pill cursor-pointer shadow-sm">企業情報
            </div>
        </div>
        <div class="col-6 ps-2">
            <div id="projectInfoTab" class="col-12 p-2 bg-white rounded-pill cursor-pointer shadow-sm">案件情報
            </div>
        </div>
    </div>
    @include('pages.customer.partials.company_information')
    @include('pages.customer.partials.project_information', [
        'projects' => $projects,
        'customers' => $customers,
        'categories' => $categories,
        'staffs' => $staffs,
        'suppliers' => $suppliers,
    ])
@endsection

@section('footer_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    @include('pages.customer.partials.script_create')
@endsection
