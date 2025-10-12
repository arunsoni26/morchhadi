<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Show index page.
     */
    public function index()
    {
        $branchTypes = Branch::select('branch_type')
            ->whereNotNull('branch_type')
            ->distinct()
            ->pluck('branch_type');

        return view('admin.branches.index', compact('branchTypes'));
    }

    /**
     * Return JSON list for DataTables.
     */
    public function list(Request $request)
    {
        $query = Branch::query();

        if ($request->type) {
            $query->where('branch_type', $request->type);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->owner_name) {
            $query->where('owner_name', 'like', "%{$request->owner_name}%");
        }
        if ($request->shop_name) {
            $query->where('shop_name', 'like', "%{$request->shop_name}%");
        }

        $branches = $query->get();

        return response()->json($branches);
    }

    /**
     * Return Add/Edit form HTML.
     */
    public function form(Request $request)
    {
        $branch = null;
        if ($request->branchId) {
            $branch = Branch::findOrFail($request->branchId);
        }

        return view('admin.branches.add-edit-form', compact('branch'));
    }

    /**
     * Save branch (create or update).
     */
    public function save(Request $request)
    {
        $rules = [
            'owner_name'             => 'required|string|max:255',
            'shop_name'        => 'required|string|max:255',
            'contact_person'   => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:255|unique:branches,email,' . $request->id,
            'phone_number'     => 'nullable|string|max:20',
            'whatsapp_number'  => 'nullable|string|max:20',
            'gst_number'       => 'nullable|string|max:50',
            'branch_type'      => 'nullable|string|max:100',
            'address'          => 'nullable|string|max:500',
            'city'            => 'nullable|string|max:100',
            'state'           => 'nullable|string|max:100',
            'pincode'         => 'nullable|string|max:10',
            'country'         => 'nullable|string|max:100',
            'latitude'        => 'nullable|string|max:50',
            'longitude'       => 'nullable|string|max:50',
            'link'           => 'nullable|string|max:255',
            'opening_time'   => 'nullable',
            'closing_time'   => 'nullable',
            'status'        => 'nullable|string|max:20',
            'remarks'       => 'nullable|string|max:500',
            'total_sales'   => 'nullable|numeric',
        ];

        $data = $request->validate($rules);

        DB::beginTransaction();
        try {
            if ($request->id) {
                $branch = Branch::findOrFail($request->id);
                $data['updated_by'] = Auth::id();
                $branch->update($data);
            } else {
                $data['created_by'] = Auth::id();
                $branch = Branch::create($data);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Branch saved successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Soft delete branch.
     */
    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->deleted_by = Auth::id();
        $branch->save();
        $branch->delete();

        return response()->json(['success' => true, 'message' => 'Branch deleted successfully.']);
    }
}
