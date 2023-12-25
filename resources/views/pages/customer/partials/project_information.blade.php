<div id="project_information">
    <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        <div class="col-12 border_bottom_search pb-2">仕入れ先</div>
        <form id="form-search">
            @csrf
            <div class="col-12 d-flex flex-wrap">
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-xl-2 col-md-5 col-12 text-start text-md-end me-md-2">期間:</div>
                    <div class="col-md-6 col-12">
                        <select disabled name="" id="" class="form-select">
                            <option value=""></option>
                            <option value="">áda</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-xl-3 col-md-5 col-12 text-md-end me-2">カテゴリ: </div>
                    <div class="col-md-6 col-12">
                        <select name="category" id="" class="form-select">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-md-5 col-12 text-md-end me-2">仕入れ先担当者: </div>
                    <div class="col-md-6 col-12">
                        <select disabled name="" id="" class="form-select">
                            <option value=""></option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-md-5 col-12 text-md-end me-2">社内担当者: </div>
                    <div class="col-md-6 col-12">
                        <select name="staff" id="" class="form-select">
                            <option value=""></option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff') == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->profile->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-wrap">
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex flex-wrap align-items-center">
                    <div class="col-xl-2 col-md-5 col-12 text-start text-md-end me-md-2">状態:</div>
                    <div class="col-md-6 col-12">
                        <select name="status" id="" class="form-select">
                            <option value=""></option>
                            <option value="1">見積もり待ち</option>
                            <option value="2">見積もり済み</option>
                            <option value="3">受注</option>
                            <option value="4">失注（手動）</option>
                            <option value="5">発注済み</option>
                            <option value="6">納品済み</option>
                            <option value="7">請求済み</option>
                            <option value="8">支払い済み</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 col-md-6 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-xl-3 col-md-5 col-12 text-md-end me-2">仕入れ先: </div>
                    <div class="col-md-6 col-12">
                        <select disabled name="supplier" id="" class="form-select">
                            <option value=""></option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-5 mt-3 col-md-10 col-12 d-flex  flex-wrap align-items-center">
                    <div class="col-md-3 col-12 text-md-end me-2">フリーワード: </div>
                    <div class="col-md-7 col-12">
                        <input type="text" name="free_input" class="form-control">
                    </div>
                </div>
                <div class="col-1 mt-3 d-flex align-items-center"><button id="btn-submit-form" type="button"
                        class="btn-dark-dark">検　索</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-3">
        <div class="col-12 d-flex justify-content-end mb-2">
            <input type="checkbox" name="" id="filter_project" class="me-2 cursor-pointer"><label
                class="cursor-pointer" for="filter_project">自分が担当のものだけ表示</label>
        </div>
        <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
            <table class="table table-hover sortable">
                <thead>
                    <tr>
                        <th data-column="case_number" data-direction="desc" class="sort_table"> 案件番号 <i class="ms-1 fas fa-sort"></i></th>
                        <th class="sorttable_nosort"> 狀態 </th>
                        <th class="sorttable_nosort">カテゴリ</th>
                        <th data-column="name" data-direction="desc" class="sort_table">案件名<i class="ms-1 fas fa-sort"></i></th>
                        <th class="sorttable_nosort">仕入れ先 </th>
                        <th class="sorttable_nosort">取引先担当者</th>
                        <th class="sorttable_nosort">社内担当</th>
                        <th class="sorttable_nosort"></th>
                        <th class="sorttable_nosort"></th>
                    </tr>
                </thead>
                <tbody id="projects_table">
                    @include('pages.customer.partials._table_project', ['projects' => $projects])
                </tbody>
            </table>
            <div id="project_paginate">
                {{ $projects->links('pagination::custom') }}
            </div>
        </div>
    </div>
</div>
