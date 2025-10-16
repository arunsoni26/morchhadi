<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use App\Models\Branch;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('status', 1)->pluck('name', 'id');
        $brands = ProductBrand::where('status', 1)->pluck('name', 'id');

        return view('admin.products.index', compact('categories', 'brands'));
    }

    public function list(Request $request)
    {
        $query = Product::with(['category', 'brand'])
            ->select('id', 'name', 'slug', 'price', 'discount_price', 'stock_quantity', 'status', 'is_featured', 'category_id', 'brand_id');

        // 🔍 Filters
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->name) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        $products = $query->get();

        // Map to frontend-friendly structure (like your Customers module)
        $data = $products->map(function ($row, $index) {
            return [
                'productIndex' => $index+1,
                'name' => e($row->name),
                'sku' => $row->sku ?? '-',
                'category' => e(optional($row->category)->name ?? '-'),
                'brand' => e(optional($row->brand)->name ?? '-'),
                'price' => '₹' . number_format($row->price, 2),
                'discount_price' => $row->discount_price ? '₹' . number_format($row->discount_price, 2) : '-',
                'stock_quantity' => $row->stock_quantity,
                'featured_toggle' => '
                    <div class="form-check form-switch">
                        <input 
                            type="checkbox" 
                            class="form-check-input toggle-featured" 
                            data-id="'.$row->id.'" '.($row->is_featured ? 'checked' : '').'>
                    </div>
                ',
                'status_toggle' => '
                    <div class="form-check form-switch">
                        <input 
                            type="checkbox" 
                            class="form-check-input toggle-status" 
                            data-id="'.$row->id.'" '.($row->status ? 'checked' : '').'>
                    </div>
                ',
                'actions' => view('admin.products.partials.actions', compact('row'))->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function form(Request $request)
    {
        $product = null;
        $categories = ProductCategory::where('status', 1)->pluck('name', 'id');
        $brands = ProductBrand::where('status', 1)->pluck('name', 'id');
        $branches = Branch::where('status', 1)->pluck('shop_name', 'id');

        if ($request->id) {
            $product = Product::findOrFail($request->id);
        }

        return view('admin.products.partials.add-edit-form', compact('product', 'categories', 'brands', 'branches'));
    }

    /**
     * Save (create/update) — uses same style as your CustomerController (validation, DB transaction, S3 uploads).
     */
    public function save(Request $request)
    {
        $productId = $request->id;

        // Base validation: include all important fields
        $rules = [
            'name' => 'required|string|max:255',
            'sku' => ['nullable','string','max:100', $productId ? Rule::unique('products','sku')->ignore($productId) : 'unique:products,sku'],
            'category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'nullable|exists:product_brands,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'weight' => 'nullable|string|max:50',
            'flavor_notes' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120', // 5MB
            'gallery_images.*' => 'nullable|image|max:5120',
            'branch_ids' => 'nullable|array',
            'branch_ids.*' => 'exists:branches,id',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ];

        $request->validate($rules);

        DB::beginTransaction();
        try {
            // prepare data
            $data = $request->only([
                'name','sku','category_id','brand_id','price','discount_price','stock_quantity',
                'weight','flavor_notes','origin','short_description','description'
            ]);

            $data['slug'] = Str::slug($request->name);
            $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['updated_by'] = auth()->id();

            // Disk (match your customers -> used s3)
            $disk = 's3';

            // Image upload (main image)
            if ($request->hasFile('image')) {
                // If updating, remove old image
                if ($productId) {
                    $old = Product::find($productId);
                    if ($old && !empty($old->image)) {
                        Storage::disk($disk)->delete($old->image);
                    }
                }
                $data['image'] = $request->file('image')->store('products', $disk);
            }

            // Gallery images (store array paths as json)
            if ($request->hasFile('gallery_images')) {
                $galleryPaths = [];
                // if updating and existing gallery exists, keep them unless user removes (simple approach)
                if ($productId) {
                    $existing = Product::find($productId);
                    if ($existing && !empty($existing->gallery_images)) {
                        // keep existing images by default
                        $galleryPaths = is_array($existing->gallery_images) ? $existing->gallery_images : json_decode($existing->gallery_images, true) ?? [];
                    }
                }

                foreach ($request->file('gallery_images') as $file) {
                    $path = $file->store('morchhadi/products/gallery', $disk);
                    $galleryPaths[] = $path;
                }

                $data['gallery_images'] = json_encode($galleryPaths);
            }

            if ($productId) {
                $product = Product::findOrFail($productId);
                $product->fill($data);
                $product->save();
            } else {
                $data['created_by'] = auth()->id();
                $product = Product::create($data);
            }

            // Sync branches (simple sync of branch ids; pivot fields can be added later)
            $branchIds = $request->branch_ids ?? [];
            $product->branches()->sync($branchIds);

            DB::commit();

            return response()->json(['code' => 200, 'success' => true, 'message' => 'Product saved successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['code' => 500, 'success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function view(Request $request)
    {
        $product = Product::with(['category', 'brand', 'branches'])->findOrFail($request->id);
        return view('admin.products.partials.view', compact('product'));
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function toggleFeatured($id)
    {
        $product = Product::findOrFail($id);
        $product->is_featured = !$product->is_featured;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        // Optionally delete images from disk if you want:
        // Storage::disk('s3')->delete($product->image);
        $product->delete();
        return response()->json(['success' => true]);
    }
}
