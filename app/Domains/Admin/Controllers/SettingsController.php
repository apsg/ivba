<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Admin\Helpers\SettingsHelper;
use App\Domains\Admin\Models\Setting;
use App\Domains\Admin\Requests\SetSettingRequest;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $list = SettingsHelper::LIST;
        $settings = Setting::getAll(array_keys($list));

        return view('admin.settings.index')
            ->with(compact('list', 'settings') + [
                    'bool' => SettingsHelper::BOOL,
                ]);
    }

    public function set(SetSettingRequest $request)
    {
        Setting::set($request->input('key'), $request->input('value'));
        flash('Zapisano');

        return back();
    }

    public function destroy(SetSettingRequest $request)
    {
        Setting::where('key', $request->input('key'))->delete();
        flash('Zresetowano');

        return back();
    }
}
