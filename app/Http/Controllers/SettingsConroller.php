<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Repositories\SettingRepository;

class SettingsConroller extends Controller
{
    use WebResponce;
    private $settingsRepository;

    public function __construct(SettingRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }
    public function TechnicalSupport()
    {
        $setting = Setting::where('type', '=', 'technical')->first();

        return view('admin.settings.technical', compact('setting'));
    }
    public function AboutUs()
    {
        $setting = Setting::where('type', '=', 'about-us')->first();

        return view('admin.settings.about-us', compact('setting'));
    }

    public function store(SettingsRequest $request)
    {
        try {
            $this->settingsRepository->StoreNew($request);

            return redirect()->back()->with('success', "تم اضافه العنصر بنجاح");
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "settings.About.Us");

        }
    }

    public function delete($id)
    {
        try {
            $this->settingsRepository->Delete($id);

            return redirect()->back()->with('success', "تم اضافه العنصر بنجاح");
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "settings.About.Us");

        }
    }
}