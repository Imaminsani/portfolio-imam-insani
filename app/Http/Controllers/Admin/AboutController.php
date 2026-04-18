<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first() ?? new About();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first() ?? new About();

        $request->validate([
            'name' => 'required|string|max:255',
            'hero_title' => 'required|string',
            'hero_subtitle' => 'required|string',
            'about_eyebrow' => 'required|string',
            'about_title' => 'required|string',
            'about_description' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'github_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        $data = $request->except('profile_image');

        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists and is not the default profile.png
            if ($about->profile_image && $about->profile_image !== 'profile.png') {
                Storage::disk('public')->delete($about->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profile', 'public');
        }

        $about->fill($data)->save();

        return redirect()->route('admin.about.edit')->with('success', 'Bio Anda berhasil diperbarui!');
    }
}
