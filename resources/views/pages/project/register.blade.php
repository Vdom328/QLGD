@extends('layouts.app')

@section('page_icon')
    <img src="{{ asset('assets/images/icons/note-solid.png') }}"
         class="menu_icon icon-bxs-dashboard"/>
@endsection
@section('page_title')
    {!! trans('project.page_title') !!}
@endsection
@section('title-page')
    {!! trans('project.page_title') !!}
@endsection

@section('template_linked_css')
    @vite(['resources/css/project/register.css'])
@endsection

@section('page_title_actions')
    <div>> スタッフ設定</div>
@endsection

@section('content')
    <div>
        <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert"></div>
        <div id="error-alert" class="alert alert-danger fade show d-none"></div>
        <form id="formProject">
            @csrf
            <input type="text" hidden name="id" @if (!empty($project) && empty(request('copyProjectId'))) value="{{ $project->id }}" @endif>
            {{--Select select top--}}
            <div
                class="select-top row d-flex pt-3 pb-4 flex-wrap bg-white rounded shadow-sm p-3 justify-content-between">
                {{-- Select category --}}
                <div class="col-12 col-lg-4 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                    <div class="text-md-end col-xxl-3">案件カテゴリ</div>
                    <div class="col-6 ms-5">
                        <select name="category_id" id="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if ((!empty($project) && $project->category_id == $category->id) || !empty($categorySelect) && $categorySelect->id === $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="position-absolute error mb-3"></div>
                    </div>
                </div>
                {{-- End select category --}}

                @if (!empty($categorySelect) && $categorySelect->name === 'QB倉庫保管')
                    {{-- Select contractors, show when change category: QB倉庫保管--}}
                    <div
                        class="group-contractors col-12 col-lg-4 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                        <div class="text-md-end ">受注社</div>
                        <div class="col-6 ms-5">
                            <select name="company_id" id="company_id" class="form-select">
                                <option value="">選択してください</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                            @if (!empty($project) && $project->company_id == $company->id) selected @endif>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="position-absolute error mb-3"></div>
                        </div>
                    </div>
                    {{-- End select contractors --}}
                @endif

                {{-- Button  --}}
                <div class="group-one-line col-12 col-xxl-4 d-flex flex-wrap mt-4 mt-xxl-0 justify-content-xxl-end">
                    <button type="button" class="btn-dark-dark mx-2 show-projects-href">過去案件から作成
                    </button>
                    <button type="button" class="btn-dark-dark mx-2">CSVから作成</button>
                </div>
                {{-- End button  --}}
            </div>
            {{--End select top--}}

            <div class="row mt-3 bg-white rounded  mb-5">
                {{--Form--}}
                <div class="mt-3">

                    {{--Form 1--}}

                    {{--no , parent_id--}}
                    <div class="row mb-4">
                        {{--no--}}
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">案件番号</div>
                            <div class="col-4 mx-5">
                                <input type="number" autocomplete="off" class="form-control" id="no" name="no"
                                       @if (!empty($project)) value="{{ $project->no }}" @endif>
                                <div class="position-absolute error"></div>
                            </div>
                            <div class="col-1">
                                <div class="btn-dark-dark mx-2 cursor-pointer" id="automatic-no">自動</div>
                            </div>
                        </div>
                        {{--parent_id--}}
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">親案件</div>
                            <div class="col-4 mx-5">
                                <input type="text" autocomplete="off" class="form-control" hidden="" id="parent_id"
                                       name="parent_id"
                                       @if (!empty($project) && $project->parentProject) value="{{ $project->parent_id }}" @endif>
                                <input type="text" autocomplete="off" class="form-control" disabled id="parent_name" name=""
                                       @if (!empty($project) && $project->parentProject) value="{{ $project->parentProject->name }}" @endif>
                                <div class="position-absolute error"></div>
                            </div>
                            <div class="col-1">
                                <div class="btn-dark-dark mx-2 cursor-pointer show-projects-parent" data-toggle="modal"
                                     data-target="#showProject">検索
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end no , parent_id--}}

                    {{--case_number--}}
                    <div class="row mb-4">
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">顧客側案件番号</div>
                            <div class="col-4 mx-5">
                                <input type="text" class="form-control" autocomplete="off" id="case_number" name="case_number"
                                       @if (!empty($project)) value="{{ $project->case_number }}" @endif>
                            </div>
                        </div>
                    </div>
                    {{--end case_number--}}

                    {{--name--}}
                    <div class="row mb-4">
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">案件名</div>
                            <div class="col-4 mx-5">
                                <input type="text" autocomplete="off" class="form-control" id="name" name="name"
                                       @if (!empty($project)) value="{{ $project->name }}" @endif>
                                <div class="position-absolute error"></div>
                            </div>
                        </div>
                    </div>
                    {{--end name--}}

                    {{--status--}}
                    <div class="row mb-4">
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">状況</div>
                            <div class="col-4 mx-5">
                                <select name="status" id="status" class="form-select cursor-pointer">
                                    <option value="">選択してください</option>
                                    @foreach($statusValues as $status)
                                        <option value="{{ $status['value'] }}"
                                                @if (!empty($project) && $project->status === $status['value']) selected @endif>
                                            {{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                                <div class="position-absolute error"></div>
                            </div>
                        </div>
                    </div>
                    {{--end status--}}

                    {{--staff_id--}}
                    <div class="row mb-4">
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">社内担当</div>
                            <div class="col-4 mx-5">
                                <select name="staff_id" id="staff_id" class="form-select cursor-pointer">
                                    <option value="">選択してください</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{ $staff->id }}"
                                                @if (!empty($project) && $project->staff_id === $staff->id) selected @endif>
                                            {{ $staff->profile->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--end staff_id--}}

                    {{--customer_id, customer_manager_id--}}
                    <div class="row mb-4 input-special">
                        {{--customer_id--}}
                        <div class="group-input col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">取引先</div>
                            <div class="col-6 mx-5">
                                <input type="text" class="form-control" id="customer_id" hidden
                                       name="customer_id"
                                       @if (!empty($project)) value="{{ $project->customer_id }}" @endif>
                                <input type="text" class="form-control" id="customer_name" disabled
                                       @if (!empty($project) && $project->customer) value="{{ $project->customer->name }}" @endif>
                            </div>
                            <div class="col-1">
                                <div class="btn-dark-dark mx-2 cursor-pointer customer-show">検索</div>
                            </div>
                        </div>
                        {{--customer_manager_id--}}
                        <div class="group-input col-12 col-lg-6 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2">取引先担当者</div>
                            <div class="col-6 ms-5">
                                <input type="text"  class="form-control" id="customer_manager_id" hidden
                                       name="customer_manager_id"
                                       @if (!empty($project)) value="{{ $project->customer_manager_id }}" @endif>
                                <input type="text" class="form-control" id="customer_manager_name"
                                       name="customer_manager_name" disabled
                                       @if (!empty($project) && $project->customerManager) value="{{ $project->customerManager->name }}" @endif>
                            </div>
                        </div>
                    </div>
                    {{--end customer_id, customer_manager_id--}}

                    {{--exprire_date, check box is_exprire_date--}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{--exprire_date--}}
                            <div class="text-md-end col-2 col-lg-1">納品日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="exprire_date" name="exprire_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->exprire_date)->format('Y/m/d') }}" @endif>
                                <div class="position-absolute error"></div>
                            </div>
                            <div>
                                <label>
                                    <i class="far fa-calendar-alt mx-4 "></i>
                                </label>
                            </div>
                            {{--check box is_exprire_date--}}
                            <div class="text-lg-start text-center col-8 mt-3 mt-lg-0 col-lg-4">
                                <input type="checkbox" name="is_exprire_date" id="is_exprire_date" class="form-check-input"
                                       @if (!empty($project) && (int)$project->is_exprire_date == \App\Classes\Enum\ProjectIsExprireDateEnum::ON->value) checked @endif>
                                <label for="is_exprire_date">納品日確定チェック </label>
                            </div>
                        </div>
                    </div>
                    {{--end exprire_date, check box is_exprire_date--}}

                    {{--payment_terms_setting--}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">支払い案件</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <select name="payment_terms_setting_id" id="payment_terms_setting_id"
                                        class="form-select">
                                    <option value="">選択してください</option>
                                    @foreach($paymentTerms as $paymentTerm)
                                        <option value="{{ $paymentTerm->id }}"
                                                @if(!empty($project) && $paymentTerms->id === $project->payment_terms_setting_id) selected @endif>
                                            {{ $paymentTerm->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--end payment_terms_setting--}}

                    {{--delivery_location--}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">受け渡し場所</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="delivery_location" name="delivery_location"
                                       @if (!empty($project)) value="{{ $project->delivery_location }}" @endif>
                            </div>
                        </div>
                    </div>
                    {{--end delivery_location--}}

                    {{--project_related_files --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex">
                            <div class="text-md-end col-2 col-lg-1">関連ファイル</div>
                            <div class="col-10 d-flex">
                                <div
                                    class="group-related-files @if (!empty($project) && $project->relatedFiles->count() > 0)col-4 ms-5 @endif">
                                    @if (!empty($project) && $project->relatedFiles->count() > 0)
                                        @foreach($project->relatedFiles as $relatedFile)
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="col-12 input-container-related d-none">
                                                    <input autocomplete="off" type="text" name="related_files[]"
                                                           value="{{ $relatedFile->url }}"
                                                           class="form-control input-related-file">
                                                    <i class="fa-solid fa-square-check fa-lg cursor-pointer done-related"></i>
                                                    <i class="fa-solid fa-square-xmark fa-lg cursor-pointer cancel-related"></i>
                                                </div>
                                                <a href="{{ $relatedFile->url }}" target="_blank"
                                                   class="href-related-file">{{ $relatedFile->url }}</a>
                                                <i class="fa-regular fa-pen-to-square fa-lg ms-3 cursor-pointer edit-related-file"></i>
                                                <i class="fa-solid fa-square-xmark ms-1 fa-lg cursor-pointer remove-related-file"></i>
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
                                <div class="round-button ms-5 add-related-file cursor-pointer">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end project_related_files --}}

                    @if(empty($categorySelect) || $categorySelect->name !== 'QB倉庫保管')
                        {{--inspection_fee--}}
                        <div class="row mb-4">
                            <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                                <div class="text-md-end col-2 col-lg-1">立会検食費</div>
                                <div class="ms-5 col-10">
                                    <input type="number" autocomplete="off" class="form-control" id="inspection_fee" name="inspection_fee"
                                           @if (!empty($project)) value="{{ $project->inspection_fee }}" @endif>
                                </div>
                            </div>
                        </div>
                        {{--end inspection_fee--}}
                    @endif

                    @if(!empty($categorySelect) && $categorySelect->name === 'QB倉庫保管' || empty($categorySelect) || $categorySelect->name === 'QB')
                        {{--spares--}}
                        <div class="row mb-4">
                            <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                                <div class="text-md-end col-2 col-lg-1">付属品</div>
                                <div class="ms-5 col-10">
                                    <input type="text" class="form-control" autocomplete="off" id="spares" name="spares"
                                           @if (!empty($project)) value="{{ $project->spares }}" @endif>
                                </div>
                            </div>
                        </div>
                        {{--end spares--}}
                    @endif

                    @if(empty($categorySelect) ||  !empty($categorySelect) && $categorySelect->name === 'QB')
                        {{--accessories--}}
                        <div class="row mb-4">
                            <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                                <div class="text-md-end col-2 col-lg-1">付属品</div>
                                <div class="ms-5 col-10">
                                    <input type="text" class="form-control" autocomplete="off" id="accessories" name="accessories"
                                           @if (!empty($project)) value="{{ $project->accessories }}" @endif>
                                </div>
                            </div>
                        </div>
                        {{--end accessories--}}
                    @endif

                    {{--top_special_notes 1->5 --}}
                    {{-- top_special_notes 1 --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">上部特記事項1</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="top_special_notes_1"
                                       name="top_special_notes_1"
                                       @if (!empty($project)) value="{{ $project->top_special_notes_1 }}" @endif>
                            </div>
                        </div>
                    </div>

                    {{-- top_special_notes 2 --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">上部特記事項2</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="top_special_notes_2"
                                       name="top_special_notes_2"
                                       @if (!empty($project)) value="{{ $project->top_special_notes_2 }}" @endif>
                            </div>
                        </div>
                    </div>

                    {{-- top_special_notes 3 --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">上部特記事項3</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="top_special_notes_3"
                                       name="top_special_notes_3"
                                       @if (!empty($project)) value="{{ $project->top_special_notes_3 }}" @endif>
                            </div>
                        </div>
                    </div>

                    {{-- top_special_notes 4 --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">上部特記事項4</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="top_special_notes_4"
                                       name="top_special_notes_4"
                                       @if (!empty($project)) value="{{ $project->top_special_notes_4 }}" @endif>
                            </div>
                        </div>
                    </div>

                    {{-- top_special_notes 5 --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">上部特記事項5</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="top_special_notes_5"
                                       name="top_special_notes_5"
                                       @if (!empty($project)) value="{{ $project->top_special_notes_5 }}" @endif>
                            </div>
                        </div>
                    </div>
                    {{--end top_special_notes 1->5 --}}

                    {{--shipping_address--}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">送付先アドレス</div>
                            <div class="col-6 col-lg-5 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="shipping_address" name="shipping_address"
                                       @if (!empty($project)) value="{{ $project->shipping_address }}" @endif>
                            </div>
                        </div>
                    </div>
                    {{--end shipping_address--}}

                    {{--notices--}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">特記事項</div>
                            <div class="col-10 col-lg-10 ms-5">
                                <textarea class="form-control" name="notices" id="notices" rows="3">@if (!empty($project)){{ $project->notices }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    {{--end notices--}}

                    {{--memo--}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">メモ</div>
                            <div class="col-10 col-lg-10 ms-5">
                                <textarea class="form-control" name="memo" id="memo" rows="3">@if (!empty($project)){{ $project->memo }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    {{--end memo--}}

                    {{--End Form 1--}}

                    {{--Form 2--}}
                    @include('pages.project.partials.estimate_items', [
                        'project' => !empty($project) ? $project : null,
                        'supplier' => $supplier,
                        'categorySelect' => $categorySelect ?? null,
                        'calculateTotalEst' => $calculateTotalEst
                    ])
                    {{--End Form 2--}}

                    <div class="p-3 mb-2">
                        <hr>
                    </div>


                    {{--Form 3--}}

                    {{-- receipt_order_date (required) , completion_date(null) --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{-- receipt_order_date --}}
                            <div class="text-md-end col-2 col-lg-1">受注日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="receipt_order_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->receipt_order_date)->format('Y/m/d') }}" @endif
                                       name="receipt_order_date">
                                <div class="position-absolute error"></div>
                            </div>
                            <div class="col-3 col-lg-1">
                                <label><i class="far fa-calendar-alt mx-4"></i></label>
                            </div>

                            {{-- completion_date(null) --}}
                            <div class="text-md-end col-2 mt-4 mt-lg-0 col-lg-1">完了予定日</div>
                            <div class="col-6 col-lg-3 mt-4 mt-lg-0 ms-5">
                                <input type="text" autocomplete="off" class="form-control readonly-input datepicker" readonly id="completion_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->completion_date)->format('Y/m/d') }}" @endif
                                       name="completion_date">
                            </div>
                            <div class="mt-4 mt-lg-0">
                                <label><i class="far fa-calendar-alt mx-4"
                                          style="line-height: 34px; vertical-align: middle;"></i></label>
                            </div>
                        </div>
                    </div>

                    {{-- ? ,is_ordered --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{-- order_date --}}
                            <div class="text-md-end col-2 col-lg-1">発注日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="order_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->order_date)->format('Y/m/d') }}" @endif
                                       name="order_date">
                            </div>
                            <div><label><i class="far fa-calendar-alt mx-4"></i></label></div>

                            {{-- is_ordered --}}
                            <div class="text-lg-start text-center col-8 mt-3 mt-lg-0 col-lg-4">
                                <input type="checkbox" autocomplete="off" id="is_ordered" name="is_ordered" class="form-check-input"
                                       @if (!empty($project) && (int)$project->is_ordered == \App\Classes\Enum\ProjectIsExprireDateEnum::ON->value) checked @endif>
                                <label for="is_ordered">発注済み </label>
                            </div>
                        </div>
                    </div>

                    {{-- scheduled_billing_date, is_invoice_issued --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{-- scheduled_billing_date --}}
                            <div class="text-md-end col-2 col-lg-1">請求予定日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="scheduled_billing_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->scheduled_billing_date)->format('Y/m/d') }}" @endif
                                       name="scheduled_billing_date">
                            </div>
                            <div><label><i class="far fa-calendar-alt mx-4"></i></label></div>

                            {{-- is_invoice_issued --}}
                            <div class="text-lg-start text-center col-8 mt-3 mt-lg-0 col-lg-4">
                                <input type="checkbox" autocomplete="off" id="is_invoice_issued" name="is_invoice_issued"
                                       @if (!empty($project) && (int)$project->is_invoice_issued == \App\Classes\Enum\ProjectIsExprireDateEnum::ON->value) checked @endif
                                       class="form-check-input">
                                <label for="is_invoice_issued">請求書発行済み </label>
                            </div>
                        </div>
                    </div>

                    {{-- planned_deposit_date, is_payment_confirmed --}}
                    <div class="row mb-4">
                        {{-- planned_deposit_date --}}
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">入金予定日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="planned_deposit_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->planned_deposit_date)->format('Y/m/d') }}" @endif
                                       name="planned_deposit_date">
                            </div>
                            <div><label><i class="far fa-calendar-alt mx-4"></i></label></div>

                            {{-- is_payment_confirmed --}}
                            <div class="text-lg-start text-center col-8 mt-3 mt-lg-0 col-lg-4">
                                <input type="checkbox" id="is_payment_confirmed" name="is_payment_confirmed"
                                       @if (!empty($project) && (int)$project->is_payment_confirmed == \App\Classes\Enum\ProjectIsExprireDateEnum::ON->value) checked @endif
                                       class="form-check-input">
                                <label for="is_payment_confirmed">入金確認済み</label>
                            </div>
                        </div>
                    </div>

                    {{-- delivery_contact_date, confirmed_delivery_date_contact_date --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{-- delivery_contact_date --}}
                            <div class="text-md-end col-2 col-lg-1">搬入連絡日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="delivery_contact_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->delivery_contact_date)->format('Y/m/d') }}" @endif
                                       name="delivery_contact_date">
                            </div>
                            <div class="col-3 col-lg-1">
                                <label><i class="far fa-calendar-alt mx-4"></i></label>
                            </div>

                            {{-- confirmed_delivery_date_contact_date --}}
                            <div class="text-md-end col-2 mt-4 mt-lg-0 col-lg-1">搬入連絡日</div>
                            <div class="col-6 col-lg-3 mt-4 mt-lg-0 ms-5">
                                <input type="text" autocomplete="off" class="form-control readonly-input datepicker" readonly id="confirmed_delivery_date_contact_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->confirmed_delivery_date_contact_date)->format('Y/m/d') }}" @endif
                                       name="confirmed_delivery_date_contact_date">
                            </div>
                            <div class="mt-4 mt-lg-0">
                                <label><i class="far fa-calendar-alt mx-4"></i></label>
                            </div>
                        </div>
                    </div>

                    {{-- vehicle_type_and_size --}}
                    <div class="row mb-4">
                        {{-- vehicle_type_and_size --}}
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">車種とサイズ</div>
                            <div class="col-6 col-lg-10 ms-5">
                                <input type="text" autocomplete="off" class="form-control readonly-input datepicker" readonly id="vehicle_type_and_size"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->vehicle_type_and_size)->format('Y/m/d') }}" @endif
                                       name="vehicle_type_and_size">
                            </div>

                        </div>
                    </div>

                    {{-- driver_information, is_driver_information_sent --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{-- driver_information --}}
                            <div class="text-md-end col-2 col-lg-1">ドライバー情報</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="driver_information"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->driver_information)->format('Y/m/d') }}" @endif
                                       name="driver_information">
                            </div>
                            <div><label><i class="far fa-calendar-alt mx-4"></i></label></div>

                            {{-- is_driver_information_sent --}}
                            <div class="text-lg-start text-center col-8 mt-3 mt-lg-0 col-lg-4">
                                <input type="checkbox" class="form-check-input" name="is_driver_information_sent"
                                       @if (!empty($project) && (int)$project->is_driver_information_sent == \App\Classes\Enum\ProjectIsExprireDateEnum::ON->value) checked @endif
                                       id="is_driver_information_sent">
                                <label for="is_driver_information_sent">ドライバー情報送付済み</label>
                            </div>
                        </div>
                    </div>

                    {{-- qr_number --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">QR番号</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control" id="qr_number"
                                       @if (!empty($project)) value="{{ $project->qr_number }}" @endif
                                       name="qr_number">
                            </div>
                        </div>
                    </div>

                    {{-- et_payment_date, is_et_payment_date_sent --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            {{-- et_payment_date --}}
                            <div class="text-md-end col-2 col-lg-1">E→T支払い日</div>
                            <div class="col-6 col-lg-3 ms-5">
                                <input type="text" autocomplete="off" class="form-control datepicker" id="et_payment_date"
                                       @if (!empty($project)) value="{{ \Carbon\Carbon::parse($project->et_payment_date)->format('Y/m/d') }}" @endif
                                       name="et_payment_date">
                            </div>
                            <div><label><i class="far fa-calendar-alt mx-4"></i></label></div>

                            {{-- is_et_payment_date_sent --}}
                            <div class="text-lg-start text-center col-8 mt-3 mt-lg-0 col-lg-4">
                                <input type="checkbox" name="is_et_payment_date_sent" id="is_et_payment_date_sent"
                                       @if (!empty($project) && (int)$project->is_et_payment_date_sent == \App\Classes\Enum\ProjectIsExprireDateEnum::ON->value) checked @endif
                                       class="form-check-input">
                                <label for="is_et_payment_date_sent">ドライバー情報送付済み</label>
                            </div>
                        </div>
                    </div>

                    {{-- estimate_notes --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">見積り書備考</div>
                            <div class="col-10 col-lg-10 ms-5">
                                <textarea class="form-control" name="estimate_notes" id="estimate_notes"
                                          rows="3">@if (!empty($project)){{ $project->estimate_notes }}@endif</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- purchase_order_notes --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">発注書備考</div>
                            <div class="col-10 col-lg-10 ms-5">
                                <textarea class="form-control" name="purchase_order_notes" id="purchase_order_notes"
                                          rows="3">@if (!empty($project)){{ $project->purchase_order_notes }}@endif</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- invoice_notes --}}
                    <div class="row mb-4">
                        <div class="col-12 mt-4 mt-lg-0 flex-wrap d-flex align-items-center">
                            <div class="text-md-end col-2 col-lg-1">請求書備考</div>
                            <div class="col-10 col-lg-10 ms-5">
                                <textarea class="form-control" name="invoice_notes" id="invoice_notes"
                                          rows="3">@if (!empty($project)){{ $project->invoice_notes }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    {{--End Form 3--}}

                </div>
                {{--End Form--}}

                {{--Button Submit--}}
                <div class="col-12 d-flex mt-3 mb-3">
                    <div
                        class="col-md-6 col-4 d-flex align-items-center @if(!empty($project) && empty(request('copyProjectId'))) justify-content-between @else justify-content-end @endif pe-4 ps-5">
                        @if(!empty($project) && empty(request('copyProjectId')))
                            <x-button type="button" id="btn-del" class="btn-danger btn-block"
                                      :text="trans('common.btn.delete')"
                                      attrs="data-bs-toggle=modal data-bs-target=#confirmDelete"
                                      dataTitle="{{trans('顧客の削除')}}" dataMessage="{{trans('この顧客を削除しますか?')}}"/>
                        @endif
                        <a href="{{ route('project.index') }}" class="btn-dark-dark">戻　る</a>
                    </div>
                    <div class="col-md-6 col-4 ps-4 d-flex align-items-center">
                        <button type="submit" class="btn-dark-dark">保　存</button>
                    </div>
                </div>
                {{--End Button Submit--}}

                {{--Show List--}}
                <div>
                    @include('pages.project.partials.nav_tab')
                </div>
                {{--End Show List--}}
            </div>
        </form>
    </div>

@endsection
@section('footer_scripts')
    @include('scripts.datepicker')
    @include('modals.modal-delete-form', ['url' => ''])
    @include('scripts.delete-modal-form-script')
    @include('pages.project.partials.script_register')
    @include('pages.project.modal.modal-show-projects')
    @include('pages.project.modal.modal-show-products')
@endsection


