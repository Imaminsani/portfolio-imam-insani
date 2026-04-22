<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'year'        => 'required|string|max:10',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['title', 'type', 'description', 'location', 'year']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/activities'), $filename);
            $data['image'] = 'activities/' . $filename;
        }

        Activity::create($data);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Kegiatan berhasil ditambahkan! 🎉');
    }

    public function show(Activity $activity)
    {
        return redirect()->route('admin.activities.edit', $activity);
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'year'        => 'required|string|max:10',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['title', 'type', 'description', 'location', 'year']);

        if ($request->hasFile('image')) {
            if ($activity->image) {
                $oldPath = public_path('uploads/' . $activity->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/activities'), $filename);
            $data['image'] = 'activities/' . $filename;
        }

        $activity->update($data);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Kegiatan berhasil diperbarui! ✅');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            $path = public_path('uploads/' . $activity->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
