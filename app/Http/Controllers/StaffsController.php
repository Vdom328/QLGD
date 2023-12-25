<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\IProfileService;
use App\Classes\Services\Interfaces\IRoleService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffsController extends Controller
{
    protected $userService, $roleService, $profileService;

    public function __construct(
        IUserService $userService,
        IProfileService $profileService,
        IRoleService $roleService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->profileService = $profileService;
    }

    public function getListStaffs(request $request)
    {
        $attr = $this->userService->getListStaffs($request->all());

        $staffs = $attr['staffs'];
        $column = $attr['column'];
        $direction = $attr['direction'];
        $staffs->appends(['column' => $column, 'direction' => $direction]);
        return view('pages.staffs.list',compact('staffs','direction','column'));
        // return view('staffsmanagement.list', compact('staffs'));
    }

    /**
     * Filter staff based on status and return the result as JSON.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterStaffs(Request $request)
    {
        $data = $request->input('status');

        $staffs = $this->userService->filterStaffs($data);

        $resultcontainer = view('pages.staffs.partials._list', compact('staffs'))->render();

        return response()->json([
            'resultcontainer' => $resultcontainer,
        ]);
    }

    /**
     * Display the create staff page and pass the list of roles.
     *
     * @return \Illuminate\View\View
     */
    public function createStaff()
    {
        $roles = $this->roleService->getListRole();

        return view('pages.staffs.create', compact('roles'));
    }

    /**
     * Save a new staff record based on the StaffRequest data.
     *
     * @param StaffRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCreateStaff(StaffRequest $request)
    {
        $update = $this->profileService->updateProfileOrCreateProfile($request->all());
        if ($update == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "追加しました。");
        return redirect()->route('staffs');
    }

    /**
     * Get the blade profile index for a staff by ID.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function updateStaff($id)
    {
        $roles = $this->roleService->getListRole();

        $user = $this->userService->finById($id);

        return view('pages.staffs.update', compact('roles', 'user'));
    }

    /**
     * Update a staff's profile based on UpdateStaffRequest data.
     *
     * @param UpdateStaffRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUpdateStaff(UpdateStaffRequest $request)
    {
        $update = $this->profileService->updateProfileOrCreateProfile($request->all());
        if ($update == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "プロファイルを正常に編集しました !");
        return redirect()->route('staffs');
    }

    /**
     * Sort staffs by the given column and direction.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the column and direction to sort by.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the sorted staffs and a container element to update.
     */
    public function sortStaffs(Request $request)
    {
        $column = $request->input('column');

        $direction = $request->input('direction');

        $staffs = $this->userService->sortStaffs($column, $direction);

        $resultcontainer = view('pages.staffs.partials._list', compact('staffs'))->render();

        return response()->json([
            'resultcontainer' => $resultcontainer,
        ]);
    }
}
