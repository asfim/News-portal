<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update the website settings.
     */
    public function update(Request $request)
    {
        $rules = [
            'website_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'telegram' => 'nullable|url',
            'google_analytics_id' => 'nullable|string|max:100',
            'facebook_pixel_id' => 'nullable|string|max:100',
            'default_seo_title' => 'nullable|string|max:255',
            'default_seo_description' => 'nullable|string',
            'footer_copyright' => 'nullable|string',
            
            // Toggles
            'breaking_news_status' => 'nullable|string',
            'comments_status' => 'nullable|string',
            'registration_status' => 'nullable|string',

            // Files
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
            'default_seo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $validated = $request->validate($rules);

        // Update Text Fields
        $textFields = [
            'website_name', 'phone', 'email', 'address', 'facebook', 'youtube',
            'instagram', 'twitter', 'telegram', 'google_analytics_id', 'facebook_pixel_id',
            'default_seo_title', 'default_seo_description', 'footer_copyright'
        ];

        foreach ($textFields as $field) {
            Setting::set($field, $request->input($field));
        }

        // Toggles status (convert check to string/boolean)
        Setting::set('breaking_news_status', $request->has('breaking_news_status') ? '1' : '0');
        Setting::set('comments_status', $request->has('comments_status') ? '1' : '0');
        Setting::set('registration_status', $request->has('registration_status') ? '1' : '0');

        // Handles File Uploads
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            Setting::set('logo', '/storage/' . $path);
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', '/storage/' . $path);
        }

        if ($request->hasFile('default_seo_image')) {
            $path = $request->file('default_seo_image')->store('settings', 'public');
            Setting::set('default_seo_image', '/storage/' . $path);
        }

        return redirect()->back()->with('success', 'Website settings updated successfully.');
    }
}
