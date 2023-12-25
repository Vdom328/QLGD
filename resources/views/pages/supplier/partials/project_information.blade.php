<div id="project_information">
    <form id="form_filter" class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        <div class="col-12 border_bottom_search pb-2">仕入れ先</div>
        <div class="col-12 d-flex flex-wrap">
            <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-2 col-md-5 col-12 text-start text-md-end me-md-2">期間:</div>
                <div class="col-md-6 col-12">
                    <select name="" id="" class="form-select" disabled>
                    </select>
                </div>
            </div>
            <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                <div class="col-xl-3 col-md-5 col-12 text-md-end me-2">カテゴリ: </div>
                <div class="col-md-6 col-12">
                    <select name="category" class="form-select category">
                        <option value=""></option>
                        @foreach ($category as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                <div class="col-md-5 col-12 text-md-end me-2">仕入れ先担当者: </div>
                <div class="col-md-6 col-12">
                    <select name="supplier_manager_name" id="supplier_manager_name" class="form-select">
                        <option value=""></option>
                        @foreach ( $suppliers as $supplier )
                            @foreach ( $supplier->supplier_managers as $supplier_managers )
                                <option value="{{ $supplier_managers->id }}">{{ $supplier_managers->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                <div class="col-md-5 col-12 text-md-end me-2">社内担当者: </div>
                <div class="col-md-6 col-12">
                    <select name="supplier_manager_staff_id" class="form-select">
                        <option value=""></option>
                        @foreach ( $staffs as $staff )
                            <option value="{{ $staff->id }}">{{ $staff->profile->fullname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex flex-wrap">
            <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-2 col-md-5 col-12 text-start text-md-end me-md-2">状態:</div>
                <div class="col-md-6 col-12">
                    <select name="status_project"  class="form-select">
                        <option value=""></option>
                        @foreach ($status_project as $status )
                            <option value="{{ $status['value'] }}">{{ $status['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                <div class="col-xl-3 col-md-5 col-12 text-md-end me-2">仕入れ先: </div>
                <div class="col-md-6 col-12">
                    <select name="supplier_name" class="form-select" >
                        <option value=""></option>
                        @foreach ( $suppliers as $supplier )
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-5 mt-3 col-md-10 col-12 d-flex  flex-wrap align-items-center">
                <div class="col-md-3 col-12 text-md-end me-2">フリーワード: </div>
                <div class="col-md-7 col-12">
                    <input type="text" class="form-control" value="" name="key">
                </div>
            </div>
            <div class="col-1 mt-3 d-flex align-items-center"><button type="button" class="btn-dark-dark" id="btn_filter">検　索</button>
            </div>
        </div>
    </form>

    <div class="mt-3">
        <div class="col-12 d-flex justify-content-end mb-2">
            <input type="checkbox" name="filter_me" id="filter_me" class="me-2 cursor-pointer form-check-input"><label
                    for="filter_me" class="cursor-pointer">自分が担当のものだけ表示</label>
        </div>
        <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th data-column="case_number" data-direction="desc" class="sort_table"> 案件番号 <i
                            class="ms-1 fas fa-sort icon_sort"></i></th>
                        <th > 狀態 </th>
                        <th >カテゴリ</th>
                        <th data-column="name" data-direction="desc" class="sort_table"> 案件名 <i
                            class="ms-1 fas fa-sort icon_sort"></i></th>
                        <th data-column="supplier_name" data-direction="desc" class="sort_table"> 仕入れ先 <i
                            class="ms-1 fas fa-sort icon_sort"></i></th>
                        <th data-column="is_exprire_date" data-direction="desc" class="sort_table"> 送付状況 <i
                            class="ms-1 fas fa-sort icon_sort"></i></th>
                        <th >仕入れ先担当者</th>
                        <th >社内担当</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody id="list_project">
                    @include('pages.supplier.partials._list_project')
                </tbody>
            </table>
        </div>
        <div id="paginate">
            {{ $projects->links('pagination::custom') }}
        </div>
    </div>

</div>
