<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('category')
            ->when(request('search'), fn($q) => $q->where('package_name', 'like', '%' . request('search') . '%'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.packages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'package_name' => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'category_id.required'  => 'Kategori wajib dipilih.',
            'package_name.required' => 'Nama paket wajib diisi.',
            'description.required'  => 'Deskripsi wajib diisi.',
            'price.required'        => 'Harga wajib diisi.',
            'price.numeric'         => 'Harga harus berupa angka.',
            'image.image'           => 'File harus berupa gambar.',
            'image.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file       = $request->file('image');
            $filename   = 'pkg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/packages', $filename);
            $data['image'] = $filename;
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket catering berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        $categories = Category::all();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'package_name' => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['image', '_method', '_token']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($package->image) {
                Storage::delete('public/packages/' . $package->image);
            }
            $file       = $request->file('image');
            $filename   = 'pkg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/packages', $filename);
            $data['image'] = $filename;
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket catering berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::delete('public/packages/' . $package->image);
        }
        $package->delete();

        return back()->with('success', 'Paket catering berhasil dihapus.');
    }
}
