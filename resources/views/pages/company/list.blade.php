@extends('layouts.app')

@section('page_icon')
<img src="{{ asset('assets/images/icons/view-week.png') }}" class="menu_icon icon-bxs-dashboard menu_icon_top" />
@endsection
@section('page_title')
自社情報設定
@endsection
@section('title-page')
自社情報設定
@endsection
@section('template_title')
    {!! trans('staffsmanagement.showing-all-staffs') !!}
@endsection

@section('template_linked_css')
    <style type="text/css" media="screen">
        .staffs-table {
            border: 0;
        }

        .staffs-table tr td:first-child {
            padding-left: 15px;
        }

        .staffs-table tr td:last-child {
            padding-right: 15px;
        }

        .staffs-table.table-responsive,
        .staffs-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('page_title')
    {!! trans('staffsmanagement.list-title') !!}
@endsection

@section('page_title_actions')
    <div>> 自社情報設定</div>
@endsection

@section('content')
    <div class="d-flex col-12 mt-2">
        <div class="col-6 mt-3">
        </div>
        <div class="d-flex col-6  justify-content-end">
            @include('components.btn-create-new', ['url' => route('company.create')])
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover">
                    <tbody>
                        @foreach ($companies as $item)
                        <tr class="rowlink" data-action="">
                            <td><a class="ms-5" style="text-decoration: underline !important" href="{{ route('company.update', $item->id) }}">{{ $item->name }}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="pagination  mt-3">
                    {{ $companies->links('pagination::custom') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
