@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css','resources/css/supplier/repon.css'])
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/building.png') }}"
class="menu_icon icon-bxs-dashboard menu_icon_bottom" />
@endsection

@section('page_title')
    取引先マスタ
@endsection
@section('title-page')
    取引先マスタ
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12">
            > 取引先マスタ
        </div>
        <div class="d-flex col-md-6 col-12  mt-md-0 mt-2 justify-content-end">
            @include('components.btn-create-new', ['url' => route('customer.create')])
        </div>
    </div>
@endsection

@section('content')
    <div id="project_information">
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
            <div class="col-12 border_bottom_search pb-2">絞り込み</div>
            <div class="mt-3 col-12 d-flex flex-wrap align-items-center">
                <div class="col-md-1 col-12 text-start text-md-end pe-md-2">社内担当者:</div>
                <div class="col-md-3 col-12">
                    <select name="staff_id" id="staff_id" class="form-select cursor-pointer">
                            <option value=""></option>
                        @foreach ( $staffs as  $staff)
                            <option value="{{ $staff->id }}" @if ($staff->id  == $staff_id) selected @endif>{{ $staff->profile->fullname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 col-12 text-start text-md-end pe-md-2">支払い条件:</div>
                <div class="col-md-3 col-12">
                    <select name="payment_terms" id="payment_terms" class="form-select cursor-pointer">
                        <option value=""></option>
                        @foreach ( $paymentTerms as  $paymentTerm)
                            <option value="{{ $paymentTerm->id }}" @if ( $payment_terms == $paymentTerm->id) selected @endif>{{ $paymentTerm->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-3 col-12 d-flex flex-wrap align-items-center">
                <div class="col-md-1 col-12 text-start text-md-end  pe-md-2">フリーワード:</div>
                <div class="col-md-9 col-12">
                    <input type="text" class="form-control" name="key_word" id="key_word" value="{{ $key }}">
                </div>
                <div class="col-md-2 col-12 mt-2 mt-md-0 d-flex align-items-center  justify-content-end"><button type="button"
                        class="btn-dark-dark" id="btn_filter">検　索</button></div>
            </div>
        </div>

        <div class="mt-3">
            <div class="col-12 d-flex justify-content-end mb-2">
                <input type="checkbox" name="filter_me" id="filter_me" class="me-2 cursor-pointer form-check-input"  @if ($filter_me == 'true') checked @endif><label for="filter_me" class="cursor-pointer">自分が担当のものだけ表示</label>
            </div>
            <div>

            </div>
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th class="sort_table"
                                @if ($column == 'code') data-direction="{{ $direction }}" @else data-direction="asc" @endif data-column="code">
                                取引先コード
                                <i class="ms-1 fas @if ($direction == '' || $column != 'code') fa-sort  @elseif ($direction == 'desc' && $column == 'code') fa-sort-up @else fa-sort-down @endif"></i>
                            </th>
                            <th class="sort_table"
                                @if ($column == 'name') data-direction="{{ $direction }}" @else data-direction="asc" @endif data-column="name">
                                取引先名
                                <i class="ms-1 fas @if ($direction == '' || $column != 'name' ) fa-sort @elseif ($direction == 'desc' && $column == 'name') fa-sort-up  @else fa-sort-down @endif"></i>
                            </th>
                            <th>
                                <div class="col-12 d-flex">
                                    <div class="col-4">取引先担当者</div>
                                    <div class="col-4">部署等</div>
                                    <div class="col-4">社内担当</div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="customer_table">
                        @foreach ($customers as $customer)
                            <tr data-id="{{ $customer->id }}" class="cursor-pointer">
                                <td>{{ $customer->code }}</td>
                                <td>{{ $customer->name }}</td>
                                <td class="p-0">
                                    @foreach ( $customer->customer_managers as $key => $item  )
                                        <div class="col-12 d-flex align-items-center @if ($key !== count($customer->customer_managers) - 1) border-bottom @endif">
                                            <div class="col-4 custom_table">{{ $item->name }}</div>
                                            <div class="col-4 custom_table"></div>
                                            <div class="col-4 custom_table">
                                                @if ($item->staff->profile->avatar)
                                                    <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $item->staff->profile->avatar) ?? '' }}" alt=""  width="35px" height="35px">
                                                @else
                                                    <img class="rounded-circle" src="{{ Avatar::create($item->staff->profile->fullname)->toBase64() }}" alt=""  width="35px" height="35px">
                                                @endif
                                                <label for="" class="ms-3">{{ $item->staff->profile->fullname }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $customers->links('pagination::custom') }}
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            // filter data
            let column = "{{ $column }}" ?? '';
            let direction = "{{ $direction }}" ?? '';
            $('.sort_table').on('click', function() {
                column = $(this).attr('data-column');
                direction = $(this).attr('data-direction');
                if (direction == 'asc') {
                    direction = 'desc';
                } else {
                    direction = 'asc';
                }
                filTer(column,direction);
            });

            $('#btn_filter').on('click', function() {
                filTer(column,direction);
            });

            $('#filter_me').on('change', function() {
                filTer(column,direction);
            });

            function filTer(column,direction)
            {
                var key = $('#key_word').val();
                var staff_id = $('#staff_id').val();
                var payment_terms = $('#payment_terms').val();
                var filter_me = $('#filter_me').prop('checked');
                window.location.href = "{{ route('customer.index') }}?column=" + column + "&direction=" + direction + "&key=" + key + "&staff_id=" + staff_id + "&filter_me=" + filter_me + "&payment_terms=" + payment_terms;
            }

            // // Add click event listener to each row
            $("#customer_table tr").click(function() {
                const customer_id = $(this).attr("data-id");
                if (customer_id) {
                    window.location.href = "{{ route('customer.getEdit') }}?id=" + customer_id ;
                }
            });

        });
    </script>
@endsection
