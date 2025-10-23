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
        $categories = ProductCategory::pluck('name', 'id');

        // Eager load branches as well
        $query = Product::with(['category', 'branches']);

        $products = $query
            ->where('is_featured', 1)
            ->get();

        // ✅ Attach WhatsApp number from related branch (first one)
        $products->each(function ($product) {
            $product->whatsapp_number = $product->branches->first()->whatsapp_number ?? null;
        });
        return view('frontend.index', compact('products'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    // public function products(Request $request)
    // {
    //     $categories = ProductCategory::pluck('name', 'id');

    //     $query = Product::with('category');

    //     if ($request->filled('category_id')) {
    //         $query->where('category_id', $request->category_id);
    //     }

    //     if ($request->filled('sort')) {
    //         switch ($request->sort) {
    //             case 'price-asc':
    //                 $query->orderBy('price', 'asc');
    //                 break;
    //             case 'price-desc':
    //                 $query->orderBy('price', 'desc');
    //                 break;
    //         }
    //     }

    //     $products = $query->get();

    //     return view('frontend.products', compact('products', 'categories'));
    // }

    public function products(Request $request)
    {
        $categories = ProductCategory::pluck('name', 'id');

        // 🔍 Start building query
        $query = Product::with(['category', 'branches']);

        // 🔍 Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🟡 Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 🟢 Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                // case 'popular':
                //     $query->orderBy('views', 'desc');
                //     break;
            }
        }

        $products = $query->get();

        // ✅ Attach WhatsApp number from related branch (first one)
        $products->each(function ($product) {
            $product->whatsapp_number = $product->branches->first()->whatsapp_number ?? null;
        });

        // 🟩 AJAX Response: Return only the product grid HTML
        if ($request->ajax()) {
            return view('frontend.partials.product_list', compact('products'))->render();
        }

        // 🟦 Normal full-page load
        return view('frontend.products', compact('products', 'categories'));
    }

    public function view($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Gallery images array
        $gallery = $product->gallery_images ?? [];

        return view('frontend.product_view', compact('product', 'gallery'));
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
