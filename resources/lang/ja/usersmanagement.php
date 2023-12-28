<?php

return [

    // Titles
    'showing-all-users'     => 'Hiển thị tất cả người dùng',
    'users-menu-alt'        => 'Hiển thị menu quản lý người dùng',
    'create-new-user'       => 'Tạo người dùng mới',
    'show-deleted-users'    => 'Hiển thị người dùng đã xóa',
    'editing-user'          => 'Chỉnh sửa người dùng :name',
    'showing-user'          => 'Đang hiển thị người dùng :name',
    'showing-user-title'    => 'Thông tin của :name',
    'no-records'            => 'Không tìm thấy hồ sơ nào',

    // Flash Messages
    'createSuccess'   => 'Người dùng đã được tạo thành công.',
    'updateSuccess'   => 'Người dùng đã được cập nhật thành công.',
    'deleteSuccess'   => 'Người dùng đã được xóa thành công.',
    'deleteSelfError' => 'Bạn không thể tự xóa chính mình!',

    // Show User Tab
    'viewProfile'            => 'Xem hồ sơ',
    'editUser'               => 'Chỉnh sửa người dùng',
    'deleteUser'             => 'Xóa người dùng',
    'usersBackBtn'           => 'Quay lại Người Dùng',
    'usersPanelTitle'        => 'Thông tin người dùng',
    'labelUserName'          => 'Tên người dùng:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'Tên:',
    'labelLastName'          => 'Họ:',
    'labelRole'              => 'Vai trò:',
    'labelStatus'            => 'Trạng thái:',
    'labelAccessLevel'       => 'Mức độ truy cập',
    'labelPermissions'       => 'Quyền hạn:',
    'labelCreatedAt'         => 'Được tạo vào:',
    'labelUpdatedAt'         => 'Cập nhật vào:',
    'labelIpEmail'           => 'IP đăng ký Email:',
    'labelIpConfirm'         => 'IP xác nhận:',
    'labelIpSocial'          => 'IP đăng ký Socialite:',
    'labelIpAdmin'           => 'IP đăng ký Admin:',
    'labelIpUpdate'          => 'IP cập nhật cuối cùng:',
    'labelDeletedAt'         => 'Đã xóa vào',
    'labelIpDeleted'         => 'IP đã xóa:',
    'usersDeletedPanelTitle' => 'Thông tin người dùng đã xóa',
    'usersBackDelBtn'        => 'Quay lại Người Dùng đã xóa',

    'successRestore'    => 'Người dùng đã được phục hồi thành công.',
    'successDestroy'    => 'Hồ sơ người dùng đã được hủy hoàn toàn thành công.',
    'errorUserNotFound' => 'Không tìm thấy người dùng.',

    'labelUserLevel'  => 'Cấp độ',
    'labelUserLevels' => 'Các cấp độ',

    'users-table' => [
        'caption'   => '{1} tổng cộng :userscount người dùng|[2,*] tổng số :userscount người dùng',
        'id'        => 'STT',
        'name'      => 'Tên đăng nhập',
        'fname'     => 'Tên',
        'lname'     => 'Họ',
        'fullname'  => 'Tên đầy đủ',
        'email'     => 'Email',
        'role'      => 'Vai trò',
        'created'   => 'Đã tạo',
        'pwd'       => 'Mật khẩu',
        'actions'   => 'Hành động',
        'updated'   => 'Cập nhật',
    ],

    'buttons' => [
        'create-new'    => 'Người dùng mới',
        'delete'        => '<i class="fa fa-trash fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Xóa</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Hiển thị</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Chỉnh sửa</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Quay lại Người Dùng</span>',
        'back-to-user'  => 'Quay lại  <span class="hidden-xs">Người Dùng</span>',
        'delete-user'   => '<i class="fa fa-trash fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Xóa</span><span class="hidden-xs"> Người Dùng</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Chỉnh sửa</span><span class="hidden-xs"> Người Dùng</span>',
    ],

    'tooltips' => [
        'delete'        => 'Xóa',
        'show'          => 'Hiển thị',
        'edit'          => 'Chỉnh sửa',
        'create-new'    => 'Tạo Người Dùng Mới',
        'back-users'    => 'Quay lại Người Dùng',
        'email-user'    => 'Email :user',
        'submit-search' => 'Gửi tìm kiếm Người Dùng',
        'clear-search'  => 'Xóa kết quả tìm kiếm',
    ],

    'messages' => [
        'userNameTaken'          => 'Tên người dùng đã được sử dụng',
        'userNameRequired'       => 'Yêu cầu phải có tên người dùng',
        'fNameRequired'          => 'Yêu cầu phải có tên',
        'lNameRequired'          => 'Yêu cầu phải có họ',
        'emailRequired'          => 'Yêu cầu phải có email',
        'emailInvalid'           => 'Email không hợp lệ',
        'passwordRequired'       => 'Yêu cầu nhập mật khẩu',
        'PasswordMin'            => 'Mật khẩu phải có ít nhất 6 ký tự',
        'PasswordMax'            => 'Mật khẩu có độ dài tối đa là 20 ký tự',
        'captchaRequire'         => 'Yêu cầu phải có captcha',
        'CaptchaWrong'           => 'Captcha sai, vui lòng thử lại.',
        'roleRequired'           => 'Yêu cầu phải có vai trò người dùng.',
        'user-creation-success'  => 'Tạo người dùng thành công!',
        'update-user-success'    => 'Cập nhật người dùng thành công!',
        'delete-success'         => 'Xóa người dùng thành công!',
        'cannot-delete-yourself' => 'Bạn không thể tự xóa bản thân mình!',
    ],

    'show-user' => [
        'id'                => 'ID Người Dùng',
        'name'              => 'Tên Người Dùng',
        'email'             => '<span class="hidden-xs">Email</span> Người Dùng',
        'role'              => 'Vai Trò Người Dùng',
        'created'           => 'Tạo lúc <span class="hidden-xs">vào</span>',
        'updated'           => 'Cập nhật lúc <span class="hidden-xs">vào</span>',
        'labelRole'         => 'Vai Trò Người Dùng',
        'labelAccessLevel'  => '<span class="hidden-xs">Mức độ truy cập</span> Người Dùng|<span class="hidden-xs">Mức độ truy cập</span> Người Dùng',
    ],

    'search'  => [
        'title'             => 'Hiển thị kết quả tìm kiếm',
        'found-footer'      => ' Hồ sơ tìm thấy',
        'no-results'        => 'Không có kết quả',
        'search-users-ph'   => 'Tìm kiếm Người Dùng',
    ],

    'modals' => [
        'delete_user_message' => 'Are you sure you want to delete :user?',
    ],
];
