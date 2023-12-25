@extends('layouts.app')

@section('template_title')
    @yield('form_template_title')
@endsection

@section('template_linked_css_up')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('template_linked_css')
    @yield('template_linked_css')
@endsection

@section('page_icon')
    @yield('template_linked_css')
@endsection
@section('page_title')
    @yield('page_title')
@endsection

@section('content')
    @yield('form_content')
@endsection

@section('footer_scripts')
    @include('scripts.datepicker')
    @include('modals.modal-save')

    @include('scripts.save-modal-script')
    @include('scripts.check-changed')

    @yield('form_footer_scripts')
@endsection