<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year'   => 'required|string|max:10',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'   => 'nullable|url|max:255',
        ]);

        $data = $request->only(['title', 'issuer', 'year', 'link']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/certificates'), $filename);
            $data['image'] = 'certificates/' . $filename;
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil ditambahkan! 🎓');
    }

    public function show(Certificate $certificate)
    {
        return redirect()->route('admin.certificates.edit', $certificate);
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year'   => 'required|string|max:10',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'   => 'nullable|url|max:255',
        ]);

        $data = $request->only(['title', 'issuer', 'year', 'link']);

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                $oldPath = public_path('uploads/' . $certificate->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/certificates'), $filename);
            $data['image'] = 'certificates/' . $filename;
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil diperbarui! ✅');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image) {
            $path = public_path('uploads/' . $certificate->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil dihapus.');
    }
}
