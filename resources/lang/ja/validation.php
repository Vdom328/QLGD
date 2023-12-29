<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'        => 'Vui lòng chấp nhận :attribute.',
    'active_url'      => ':attribute không phải là URL hợp lệ.',
    'after'           => ':attribute phải là ngày sau :date.',
    'after_or_equal'  => ':attribute phải là ngày sau hoặc bằng :date.',
    'alpha'           => ':attribute chỉ được chứa ký tự chữ cái.',
    'alpha_dash'      => ":attribute chỉ được chứa chữ cái, số ('A-Z', 'a-z', '0-9'), gạch ngang và gạch dưới ('-', '_').",
    'alpha_num'       => ":attribute chỉ được chứa chữ cái và số ('A-Z', 'a-z', '0-9').",
    'array'           => ':attribute phải là một mảng.',
    'before'          => ':attribute phải là ngày trước :date.',
    'before_or_equal' => ':attribute phải là ngày trước hoặc bằng :date.',
    'between'         => [
        'numeric' => ':attribute phải nằm trong khoảng từ :min đến :max.',
        'file'    => ':attribute phải có kích thước từ :min đến :max KB.',
        'string'  => ':attribute phải có từ :min đến :max ký tự.',
        'array'   => ':attribute phải có từ :min đến :max phần tử.',
    ],
    'boolean'        => ":attribute phải là 'true' hoặc 'false'.",
    'confirmed'      => ':attribute không khớp với xác nhận.',
    'date'           => ':attribute không phải là ngày hợp lệ.',
    'date_equals'    => ':attribute phải bằng ngày :date.',
    'date_format'    => ":attribute không khớp với định dạng ':format'.",
    'different'      => ':attribute và :other phải khác nhau.',
    'digits'         => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions'     => 'Kích thước hình ảnh :attribute không hợp lệ.',
    'distinct'       => ':attribute có giá trị trùng lặp.',
    'email'          => ':attribute phải là địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong các giá trị: :values',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => ':attribute phải là một tập tin.',
    'filled' => ':attribute là bắt buộc.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải lớn hơn :value ký tự.',
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải lớn hơn hoặc bằng :value ký tự.',
        'array' => ':attribute phải có :value phần tử trở lên.',
    ],
    'image' => ':attribute phải là một ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là một số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'string' => ':attribute phải ngắn hơn :value ký tự.',
        'array' => ':attribute phải có ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải ngắn hơn hoặc bằng :value ký tự.',
        'array' => ':attribute không được nhiều hơn :value phần tử.',
    ],
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được dài hơn :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max phần tử.',
    ],
    'mimes' => ':attribute phải là tập tin kiểu: :values.',
    'mimetypes' => ':attribute phải là tập tin kiểu: :values.',
    'min' => [
        'numeric' => ':attribute ít nhất phải là :min.',
        'file' => ':attribute ít nhất phải là :min kilobytes.',
        'string' => ':attribute ít nhất phải có :min ký tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => ':attribute phải được cung cấp.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => 'Là trường bắt buộc.',
    'required_if' => ':attribute là trường bắt buộc khi :other là :value.',
    'required_unless' => ':attribute là trường bắt buộc trừ khi :other thuộc :values.',
    'required_with' => ':attribute là trường bắt buộc khi :values có mặt.',
    'required_with_all' => ':attribute là trường bắt buộc khi tất cả :values có mặt.',
    'required_without' => ':attribute là trường bắt buộc khi :values không có mặt.',
    'required_without_all' => ':attribute là trường bắt buộc khi không có bất kỳ :values nào có mặt.',
    'same' => ':attribute và :other phải khớp với nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size kilobytes.',
        'string' => ':attribute phải chứa :size ký tự.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong số sau đây: :values',
    'string' => ':attribute phải là một chuỗi ký tự.',
    'timezone' => ':attribute phải thuộc một múi giờ hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => ':attribute tải lên không thành công.',
    'url' => 'Định dạng :attribute không đúng.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],
];
