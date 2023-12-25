<?php

return [
    'page_title'    => '案件登録',
    'table'         => [
        'proposal_number'    => '案件番号',
        'kinds'              => '種別',
        'billing_address'       => '請求先（取引先）',
        'furigana'              => 'フリガナ',
        'project_name'          => '案件名（現場名）',
        'site_address'          => '現場住所',
        'order_date'            => '受注日',
        'manager'               => '担当者',
        'closing_date'                    => '締日',
        'weekday_unit_price_general'      => '平日単価（一般）',
        'weekday_unit_price_qualified'    => '平日単価（有資格）',
        'holidays_unit_price_general'     => '休日日単価（一般）',
        'holidays_unit_price_qualified'   => '休日単価（有資格）',
        'overtime_hourly_wage_general'    => '残業時給（一般）',
        'overtime_hourly_wage_qualified_person'   => '残業時給（有資格者）',
        'onsite_information'   => '現場情報',
    ],
    'create-new-project'    => '案件新規作成',
    'edit-project'  => '案件編集',
    'buttons' => [
        'back-to-projects' => '案件に戻る',
        'submit_project' => '保存',
        'submit_project_draft' => '未確定保存',
        'back-to-projects' => 'Back to projects',
        'lastmonth'     => '前月',
        'nextmonth'     => '翌月',
        'delete_project' => '<i class="fa fa-trash fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">削除</span>',
    ],

    'monthly-calendar-title' => '月間予定表',

    // Flash Messages
    'createSuccess' => '案件が正常に作成されました。',
    'updateSuccess'   => '案件が正常に更新されました。',
    'deleteSuccess'   => '案件削除が完了しました。',
    'deleteError' => '案件削除が失敗しました。',
];
