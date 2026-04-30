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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('activities', 'uploads');
        }

        Activity::create($data);

        return redirect()->route('admin.activities.index')->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($activity->image) {
                Storage::disk('uploads')->delete($activity->image);
            }
            $data['image'] = $request->file('image')->store('activities', 'uploads');
        }

        $activity->update($data);

        return redirect()->route('admin.activities.index')->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            Storage::disk('uploads')->delete($activity->image);
        }
        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Aktivitas berhasil dihapus.');
    }
}
