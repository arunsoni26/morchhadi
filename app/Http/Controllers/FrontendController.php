<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $products = Product::with('category')
            ->where('is_featured', 1)
            ->get();
        return view('frontend.index', compact('products'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function products(Request $request)
    {
        $categories = ProductCategory::pluck('name', 'id');

        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        $products = $query->get();

        return view('frontend.products', compact('products', 'categories'));
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function shops()
    {
        $branches = Branch::where('status', 1)->get();

        return view('frontend.shops', compact('branches'));
    }
}
