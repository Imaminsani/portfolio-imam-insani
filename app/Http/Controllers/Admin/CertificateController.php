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
            $data['image'] = $request->file('image')->store('certificates', 'public');
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
                Storage::disk('public')->delete($certificate->image);
            }
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil diperbarui! ✅');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil dihapus.');
    }
}
