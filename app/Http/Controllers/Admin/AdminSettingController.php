<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminSettingController extends Controller
{
    public function index(): View
    {
        $groups = ['business', 'social', 'seo'];

        $settingsByGroup = [];
        foreach ($groups as $group) {
            $settingsByGroup[$group] = Setting::where('group', $group)
                ->orderBy('key')
                ->get()
                ->pluck('value', 'key')
                ->toArray();
        }

        return view('admin.settings.index', [
            'pageTitle' => 'Settings',
            'settingsByGroup' => $settingsByGroup,
            'groups' => $groups,
        ]);
    }

    public function edit(string $group): View
    {
        $settings = Setting::where('group', $group)
            ->orderBy('key')
            ->get()
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.settings.form', [
            'pageTitle' => ucfirst($group) . ' Settings',
            'group' => $group,
            'settings' => $settings,
        ]);
    }

    public function update(UpdateSettingRequest $request, string $group): RedirectResponse
    {
        $data = $request->validated();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => $group,
                    'type' => 'text',
                ]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', ucfirst($group) . ' settings updated successfully.');
    }
}
