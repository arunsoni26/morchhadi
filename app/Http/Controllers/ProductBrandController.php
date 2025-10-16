<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductBrand;

class ProductBrandController extends Controller
{
    public function index()
    {
        return view('admin.products.brands.index');
    }

    public function list(Request $request)
    {
        $query = ProductBrand::select('id', 'name', 'slug', 'description', 'status');

        if ($request->name) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        $brands = $query->get();

        // Map to frontend-friendly structure (like your Customers module)
        $data = $brands->map(function ($row, $index) {
            return [
                'brandIndex' => $index + 1,
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
                'actions' => view('admin.products.brands.partials.actions', compact('row'))->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function form(Request $request)
    {
        $productBrand = null;
        if ($request->id) {
            $productBrand = ProductBrand::findOrFail($request->id);
        }

        return view('admin.products.brands.partials.add-edit-form', compact('productBrand'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        $brand = ProductBrand::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json(['success' => true, 'brand' => $brand]);
    }

    public function update(Request $request, $id)
    {
        $brand = ProductBrand::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $id,
        ]);

        $brand->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'brand' => $brand]);
    }

    public function destroy($id)
    {
        ProductBrand::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function toggleStatus($id)
    {
        $brand = ProductBrand::findOrFail($id);
        $brand->status = !$brand->status;
        $brand->save();
        return response()->json(['success' => true]);
    }
}
