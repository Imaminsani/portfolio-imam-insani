<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'        => 'nullable|url|max:255',
        ]);

        $data = [
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'link'        => $request->link,
            'is_featured' => $request->boolean('is_featured'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/projects'), $filename);
            $data['image'] = 'projects/' . $filename;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan! 🎉');
    }

    public function show(Project $project)
    {
        return redirect()->route('admin.projects.edit', $project);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'        => 'nullable|url|max:255',
        ]);

        $data = [
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'link'        => $request->link,
            'is_featured' => $request->boolean('is_featured'),
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($project->image) {
                $oldPath = public_path('uploads/' . $project->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/projects'), $filename);
            $data['image'] = 'projects/' . $filename;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui! ✅');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            $path = public_path('uploads/' . $project->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
