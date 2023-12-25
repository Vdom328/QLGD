@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css'])
@endsection

@section('page_icon')
    <img height="28" src="{{ asset('assets/images/icons/pencil-square.png') }}" class="menu_icon" />
@endsection

@section('page_title')
見積もり項目設定
@endsection
@section('title-page')
見積もり項目設定
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex align-items-center">
        <div class="col-6">
            > 各種項目設定 > 見積もり項目設定
        </div>
        <div class="d-flex col-6  justify-content-end">
            @include('components.btn-create-new', ['url' => route('product.create')])
        </div>
    </div>
@endsection

@section('content')
    <div id="project_information">
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
            <div class="col-12 border_bottom_search pb-2">絞り込み</div>
            <div class="mt-3 col-12 d-flex flex-wrap align-items-center">
                <div class=" col-md-1 col-12 text-start text-md-end pe-md-2">カテゴリ:</div>
                <div class="col-md-2 col-12">
                    <select name="category_id" id="category_id" class="form-select">
                        <option value=""></option>
                        @foreach ($categories as $cateogry)
                            <option value="{{ $cateogry->id }}" {{ old('category_id') == $cateogry->id ? 'selected' : '' }}>
                                {{ $cateogry->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 col-12 text-start text-md-end ps-md-2" style=" white-space: nowrap;">フリーワード:
                </div>
                <div class="col-md-6 col-12 ps-md-2">
                    <input type="text" class="form-control" id="key" name="key" value="">
                </div>
                <div class="col-md-2 col-3 d-flex align-items-center justify-content-around"><button id="btn_filter"
                        type="button" class="btn-dark-dark">検　索</button></div>
            </div>
        </div>

        <div class="mt-3">
            <div class="col-12 d-flex justify-content-end mb-2">
                <input class="cursor-pointer" type="checkbox" name="filter_me" id="filter_me"
                    @if ($filter_me == 'true') checked @endif class="me-2"><label for="filter_me"
                    class="ms-2 cursor-pointer">利用停止を表示しない</label>
            </div>
            <div>

            </div>
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th class="sort_table"
                                @if ($column == 'control_number') data-direction="{{ $direction }}" @else data-direction="asc" @endif
                                data-column="control_number">
                                管理番号
                                <i
                                    class="ms-1 fas @if ($direction == '' || $column != 'control_number') fa-sort  @elseif ($direction == 'desc' && $column == 'control_number') fa-sort-up @else fa-sort-down @endif"></i>
                            </th>
                            <th class="sort_table"
                                @if ($column == 'category_id') data-direction="{{ $direction }}" @else data-direction="asc" @endif
                                data-column="category_id">
                                カテゴリ
                                <i
                                    class="ms-1 fas @if ($direction == '' || $column != 'category_id') fa-sort  @elseif ($direction == 'desc' && $column == 'category_id') fa-sort-up @else fa-sort-down @endif"></i>
                            </th>
                            <th class="sort_table"
                                @if ($column == 'name') data-direction="{{ $direction }}" @else data-direction="asc" @endif
                                data-column="name">
                                商品名

                                <i
                                    class="ms-1 fas @if ($direction == '' || $column != 'name') fa-sort  @elseif ($direction == 'desc' && $column == 'name') fa-sort-up @else fa-sort-down @endif"></i>
                            </th>
                            <th class="sort_table"
                                @if ($column == 'model_number') data-direction="{{ $direction }}" @else data-direction="asc" @endif
                                data-column="model_number">
                                型番

                                <i
                                    class="ms-1 fas @if ($direction == '' || $column != 'model_number') fa-sort  @elseif ($direction == 'desc' && $column == 'model_number') fa-sort-up @else fa-sort-down @endif"></i>
                            </th>
                            <th>最安単価
                            </th>
                            <th class="sort_table"
                                @if ($column == 'name_supplier') data-direction="{{ $direction }}" @else data-direction="asc" @endif
                                data-column="name_supplier">最安仕入れ先 <i
                                    class="ms-1 fas @if ($direction == '' || $column != 'name_supplier') fa-sort  @elseif ($direction == 'desc' && $column == 'name_supplier') fa-sort-up @else fa-sort-down @endif"></i>
                            </th>
                            <th>状態</th>
                        </tr>
                    </thead>
                    <tbody id="product_table">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->control_number }}</td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td><a class="text-decoration-underline"
                                        href="{{ route('product.update', $product->id) }}">{{ $product->name }}
                                    </a>
                                </td>
                                <td>{{ $product->model_number }}</td>
                                <td>{{ optional($product->supplierAmounts->first())->price ?? '' }}</td>
                                <td><a href="">{{ optional($product->supplierAmounts->first()->supplier)->name ?? '' }}</a></td>
                                <td>{{ optional($product->supplierAmounts->first())->status == 1 ? '使用' : '利用停止' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links('pagination::custom') }}
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
                filTer(column, direction);
            });

            $('#btn_filter').on('click', function() {
                filTer(column, direction);
            });

            $('#filter_me').on('change', function() {
                filTer(column, direction);
            });

            function filTer(column, direction) {
                var key = $('#key').val();
                var category_id = $('#category_id').val();
                var filter_me = $('#filter_me').prop('checked');
                window.location.href = "{{ route('product.index') }}?column=" + column + "&direction=" +
                    direction + "&key=" + key + "&category_id=" + category_id + "&filter_me=" + filter_me;
            }
        });
    </script>
@endsection
