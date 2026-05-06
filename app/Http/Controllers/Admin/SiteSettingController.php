<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function edit()
    {
        return view('admin.cms.settings.edit', [
            'settings' => SiteSetting::all(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_headline'    => ['required', 'string', 'max:255'],
            'hero_subheadline' => ['required', 'string', 'max:500'],
            'hero_image_file'  => ['nullable', 'image', 'max:4096'],
            'hero_image_url'   => ['nullable', 'url', 'max:500'],
            'about_badge'      => ['required', 'string', 'max:255'],
            'about_heading'    => ['required', 'string', 'max:255'],
            'about_text_1'     => ['required', 'string'],
            'about_text_2'     => ['required', 'string'],
            'about_text_3'     => ['required', 'string'],
            'phone'            => ['required', 'string', 'max:50'],
            'email'            => ['required', 'email', 'max:255'],
        ]);

        if ($request->hasFile('hero_image_file')) {
            $old = SiteSetting::get('hero_image');
            if ($old && ! str_starts_with($old, 'http')) {
                Storage::disk('public')->delete($old);
            }
            $data['hero_image'] = $request->file('hero_image_file')->store('hero', 'public');
        } elseif ($request->filled('hero_image_url')) {
            $data['hero_image'] = $request->input('hero_image_url');
        }

        unset($data['hero_image_file'], $data['hero_image_url']);

        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('status', 'settings-updated');
    }
}
