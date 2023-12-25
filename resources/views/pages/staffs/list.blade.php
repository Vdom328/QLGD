@extends('layouts.app')

@section('page_icon')
    <img style="width: 21.5px !important; height: 21.5px;" src="{{ asset('assets/images/icons/administrator-solid.png') }}" class="menu_icon icon-group" />
@endsection
@section('page_title')
    スタッフ設定
@endsection
@section('title-page')
    スタッフ設定
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
    <div>> スタッフ設定</div>
@endsection

@section('content')
    <div class="d-flex col-12 mt-2 align-items-center">
        <div class="col-6 mt-3">
            <input id="filter-staff" type="checkbox" class=" cursor-pointer"> <label for="filter-staff" class=" cursor-pointer">無効なスタッフを非表示</label>
        </div>
        <div class="d-flex col-6  justify-content-end">
            @include('components.btn-create-new', ['url' => route('staffs.create')])
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th >
                                {!! trans('staffsmanagement.table.staff_no') !!}
                                <span class="sort-icon"  @if ($column == 'staff_no') data-direction="{{ $direction }}" @else data-direction="asc" @endif data-column="staff_no">
                                    <i class="ms-1 fas @if ($direction == '' || $column != 'staff_no') fa-sort  @elseif ($direction == 'desc' && $column == 'staff_no') fa-sort-up @else fa-sort-down @endif"></i>
                                </span>
                            </th>
                            <th></th>
                            <th >
                                {!! trans('staffsmanagement.table.name') !!}
                                <span class="sort-icon" @if ($column == 'name') data-direction="{{ $direction }}" @else data-direction="asc" @endif  data-column="name">
                                    <i class="ms-1 fas @if ($direction == '' || $column != 'name') fa-sort  @elseif ($direction == 'desc' && $column == 'name') fa-sort-up @else fa-sort-down @endif"></i>
                                </span>
                            </th>
                            <th >
                                {!! trans('staffsmanagement.table.email') !!}
                                <span class="sort-icon" @if ($column == 'email') data-direction="{{ $direction }}" @else data-direction="asc" @endif  data-column="email">
                                    <i class="ms-1 fas @if ($direction == '' || $column != 'email') fa-sort  @elseif ($direction == 'desc' && $column == 'email') fa-sort-up @else fa-sort-down @endif"></i>
                                </span>
                            </th>
                            <th >
                                {!! trans('staffsmanagement.table.role') !!}
                                <span class="sort-icon" @if ($column == 'level') data-direction="{{ $direction }}" @else data-direction="asc" @endif  data-column="level">
                                    <i class="ms-1 fas @if ($direction == '' || $column != 'level') fa-sort  @elseif ($direction == 'desc' && $column == 'level') fa-sort-up @else fa-sort-down @endif"></i>
                                </span>
                            </th>
                            <th >
                                {!! trans('staffsmanagement.table.created_at') !!}
                                <span class="sort-icon" @if ($column == 'created_at') data-direction="{{ $direction }}" @else data-direction="asc" @endif  data-column="created_at">
                                    <i class="ms-1 fas @if ($direction == '' || $column != 'created_at') fa-sort  @elseif ($direction == 'desc' && $column == 'created_at') fa-sort-up @else fa-sort-down @endif"></i>
                                </span>
                            </th>
                            <th >
                                {!! trans('staffsmanagement.table.status') !!}
                                <span class="sort-icon" @if ($column == 'status') data-direction="{{ $direction }}" @else data-direction="asc" @endif  data-column="status">
                                    <i class="ms-1 fas @if ($direction == '' || $column != 'status') fa-sort  @elseif ($direction == 'desc' && $column == 'status') fa-sort-up @else fa-sort-down @endif"></i>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="staffs_table">
                        @include('pages.staffs.partials._list', compact('staffs'))
                    </tbody>
                </table>
            </div>
                {{ $staffs->links('pagination::custom') }}
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $("#filter-staff").change(function() {
                if ($(this).is(":checked")) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('staffs.filter') }}",
                        data: {
                            status: 1
                        },
                        success: function(data) {
                            $("#staffs_table").html(data.resultcontainer);
                        },
                    });
                } else {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('staffs.filter') }}",
                        data: {
                            status: 0
                        },
                        success: function(data) {
                            $("#staffs_table").html(data.resultcontainer);
                        },
                    });
                }
            });

            $('.sort-icon').on('click', function() {
                let column = $(this).attr('data-column');
                let direction = $(this).attr('data-direction');
                if (direction == 'asc') {
                    direction = 'desc';
                } else {
                    direction = 'asc';
                }
                window.location.href = "{{ route('staffs') }}?column=" + column + "&direction=" + direction ;
            });
        });
    </script>
@endsection
