<?php

namespace App\Http\Controllers;

use App\Classes\Enum\RoleUserEnum;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function sendResponse($resource, $success = true, $message = null): \Illuminate\Http\JsonResponse
    {
        $res = [
            'data' => $resource,
            'success' => $success,
            'message' => $message,
        ];
        return $this->jsonResponse($res);
    }
    protected function jsonResponse($data, $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, $status);
    }

    public function indexx()
    {
        $user = Auth()->user();
        if ($user->level() == RoleUserEnum::ADMIN->value) {
            return redirect()->route('staffs');
        }else{
            return redirect()->route('scheduleUser.index');
        }
    }
}
