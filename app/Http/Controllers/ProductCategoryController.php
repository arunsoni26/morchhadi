<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('admin.products.categories.index');
    }

    public function list(Request $request)
    {
        $query = ProductCategory::select('id', 'name', 'slug', 'description', 'status');

        if ($request->name) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        $products = $query->get();

        // Map to frontend-friendly structure (like your Customers module)
        $data = $products->map(function ($row, $index) {
            return [
                'categoryIndex' => $index + 1,
                'name' => e($row->name),
                'slug' => e($row->slug),
                'description' => e($row->description),
                'status_toggle' => '
                    <div class="form-check form-switch">
                        <input 
                            type="checkbox" 
                            class="form-check-input toggle-status" 
                            data-id="'.$row->id.'" '.($row->status ? 'checked' : '').'>
                    </div>
                ',
                'actions' => view('admin.products.categories.partials.actions', compact('row'))->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function form(Request $request)
    {
        $productCategory = null;
        if ($request->id) {
            $productCategory = ProductCategory::findOrFail($request->id);
        }

        return view('admin.products.categories.partials.add-edit-form', compact('productCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        $category = ProductCategory::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json(['success' => true, 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'category' => $category]);
    }

    public function destroy($id)
    {
        ProductCategory::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function toggleStatus($id)
    {
        $product = ProductCategory::findOrFail($id);
        $product->status = !$product->status;
        $product->save();
        return response()->json(['success' => true]);
    }
}
