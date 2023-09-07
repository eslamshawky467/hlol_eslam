<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\Http\Requests\FQARequest;
use App\DataTables\SettingDataTable;
use App\Repositories\SettingRepository;
use App\Http\Requests\SettingAllRequest;

class FQAController extends Controller
{

    use WebResponce;
    private $settingsRepository;

    public function __construct(SettingRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }
    public function index(SettingDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax()->content();
        }
        return view('admin.settings.fqa.index');
    }
    public function createOrUpdate($id = null)
    {
        $setting = Setting::find($id);
        return view('admin.settings.fqa.create', compact('setting'));
    }

    public function delete(FQARequest $request)
    {
        try {
            $this->settingsRepository->Delete($request->setting_id);
            return $this->success("تم حذف العنصر بنجاح", 'settings.fqa.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "settings.fqa.index");

        }

    }
    public function DeleteAll(SettingAllRequest $request)
    {
        try {
            $this->settingsRepository->DeleteAll($request->settings_ids);
            return $this->success("تم حذف الاسئله بنجاح", 'settings.fqa.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "settings.fqa.index");

        }

    }
}
