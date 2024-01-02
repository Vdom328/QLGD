<?php

namespace App\Http\Controllers;

use App\Models\SettingCredits;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Settings::where('id', 1)->first();
        $setting_credit = SettingCredits::all();
        return view('pages.setting.index', compact('settings','setting_credit'));
    }

    /**
     * update a setting
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $settingsUpdate = [
                'time_slots' => $request->time_slots,
                'paginate' => $request->paginate
            ];

            Settings::where('id', 1)->update($settingsUpdate);

            for ($i = 1; $i <= 4; $i++) {
                $creditsUpdate = [
                    'quantity_credits' => $i,
                    'subject_weekly_max' => $request->subject_weekly_max[$i],
                    'subject_day_max' => $request->subject_day_max[$i],
                ];

                SettingCredits::where('id', $i)->update($creditsUpdate);
            }

            DB::commit();
            Session::flash('success', "Cập nhật thành công!");
            return redirect()->route('settings.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating settings: ' . $e->getMessage());
            Session::flash('error', "Đã xảy ra lỗi. Vui lòng thử lại!");
            return redirect()->back();
        }
    }
}
