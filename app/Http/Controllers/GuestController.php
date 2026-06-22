<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Package;

class GuestController extends Controller
{
    public function home()
    {
        $featuredPackages = Package::with('category')->latest()->take(6)->get();
        $categories = Category::withCount('packages')->get();
        return view('guest.home', compact('featuredPackages', 'categories'));
    }

    public function packages()
    {
        $search     = request('search');
        $categoryId = request('category');

        $packages = Package::with('category')
            ->when($search, fn($q) => $q->where('package_name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->paginate(9)
            ->withQueryString();

        $categories = Category::all();

        return view('guest.packages', compact('packages', 'categories', 'search', 'categoryId'));
    }

    public function packageDetail(Package $package)
    {
        $package->load('category');
        $related = Package::where('category_id', $package->category_id)
            ->where('id', '!=', $package->id)
            ->take(3)
            ->get();
        return view('guest.package-detail', compact('package', 'related'));
    }

    public function about()
    {
        return view('guest.about');
    }
}
