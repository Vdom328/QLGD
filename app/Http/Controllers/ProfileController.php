<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\IProfileService;
use App\Classes\Services\Interfaces\IRoleService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private $profileService, $roleService, $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        IProfileService $profileService,
        IRoleService $roleService,
        IUserService $userService
    )
    {
        $this->profileService = $profileService;
        $this->roleService = $roleService;
        $this->userService = $userService;
    }

    /**
     * get blade profile index
     * @param int $id
     * @return mixed
     */
    public function index($id)
    {
        $roles = $this->roleService->getListRole();
        $user = $this->userService->finById($id);
        return view('pages.profile.list', compact('roles','user'));
    }

    /**
     * update profile by user_id
     * @param request
     * @return
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $update = $this->profileService->updateProfileOrCreateProfile($request->all());
        if ($update == false) {
            Session::flash('error', "Một lỗi đã xảy ra. Vui lòng thử lại !");
            return redirect()->back();
        }
        Session::flash('success', "Bạn đã chỉnh sửa thành công hồ sơ của mình !");
        return redirect()->route('profile.index', $request->id);
    }


    public function radomStaffNo(){
        $staff_no = $this->profileService->radomStaffNo();
        return response()->json([
            'staff_no' => $staff_no,
        ]);
    }
}
