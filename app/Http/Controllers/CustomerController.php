<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $groups = [];
        return view('admin.customers.index', compact('groups'));
    }

    public function list(Request $request)
    {
        $query = Customer::with('group') // Eager load group relation
            ->select('id', 'name', 'email', 'mobile', 'whatsapp_number', 'status');

        // Filters
        // if ($request->group_id) {
        //     $query->where('group_id', $request->group_id);
        // }
        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }
        if ($request->email) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }
        if ($request->name) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        $customers = $query->get();

        // Format Data
        $data = $customers->map(function ($row) {
            return [
                'name' => $row->name,
                'email' => $row->email,
                'mobile' => $row->mobile ?? '-',
                'whatsapp_number' => $row->whatsapp_number ?? '-',
                // 'client_type_status' => ucfirst($row->client_type_status),
                // 'group' => $row->group->name ?? '-',

                'status_toggle' => '
                    <div class="form-check form-switch">
                        <input 
                            type="checkbox"
                            class="form-check-input toggle-status"
                            data-id="' . $row->id . '" ' . ($row->status ? 'checked' : '') . '>
                    </div>
                ',

                // 'dashboard_toggle' => '
                //     <div class="form-check form-switch">
                //         <input 
                //             type="checkbox"
                //             class="form-check-input toggle-dashboard"
                //             data-id="'.$row->id.'" '.($row->hide_dashboard ? 'checked' : '').'>
                //     </div>
                // ',

                'actions' => view('admin.customers.partials.actions', compact('row'))->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function toggleStatus($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = !$customer->status;
        $customer->save();
        return response()->json(['success' => true]);
    }

    public function toggleDashboard($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->hide_dashboard = !$customer->hide_dashboard;
        $customer->save();
        return response()->json(['success' => true]);
    }

    public function form(Request $request)
    {
        $groups = [];
        $customer = $request->customerId ? Customer::findOrFail($request->customerId) : null;
        return view('admin.customers.partials.add-edit-form', compact('customer', 'groups'));
    }

    public function save(Request $request)
    {
        $customerId = $request->id;

        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'mobile' => 'required|string|max:20',
            'email' => [
                $customerId ? 'nullable' : 'required',
                'email',
                'max:255',
                $customerId
                    ? Rule::unique('users', 'email')->ignore(optional(Customer::find($customerId))->user_id)
                    : Rule::unique('users', 'email'),
            ],
            'password' => $customerId ? 'nullable|min:6|confirmed' : 'required|min:6|confirmed',
            'house_no' => 'nullable|string|max:255',
            'locality' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'dob' => 'required|date',
        ];

        $request->validate($rules);

        DB::beginTransaction();

        try {
            // =======================
            // Save to Users Table
            // =======================
            $customerDetails = Customer::find($customerId);
            if ($customerDetails && isset($customerDetails->user_id)) {
                $user = User::find($customerDetails->user_id);
            } else {
                $user = new User();
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->role_id = 3;
            $user->save();

            // =======================
            // Save to Customers Table
            // =======================
            if ($customerId) {
                $customer = Customer::findOrFail($customerId);
            } else {
                $customer = new Customer();
                $customer->user_id = $user->id;
            }

            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->mobile = $request->mobile;
            $customer->whatsapp_number = $request->whatsapp_number;

            $customer->email = $request->email;
            $customer->dob = $request->dob;
            $customer->city = $request->city;
            $customer->mobile_no = $request->mobile_no;
            $customer->updated_by = auth()->id();

            // New address fields
            $customer->house_no = $request->house_no;
            $customer->locality = $request->locality;
            $customer->landmark = $request->landmark;
            $customer->state = $request->state;
            $customer->pincode = $request->pincode;
            $customer->country = $request->country;
            $customer->shipping_address = $request->shipping_address;
            $customer->billing_address = $request->billing_address;

            if ($request->filled('password')) {
                $customer->password = $request->password; // store plain if you're doing that (or hash if needed)
            }

            // =======================
            // Handle File Uploads
            // =======================
            // $disk = 's3'; // or 'local'
            // $base = "customers_details/{$user->id}";

            // if ($request->hasFile('pan_doc')) {
            //     if (!empty($customer->pan_doc)) {
            //         Storage::disk($disk)->delete($customer->pan_doc);
            //     }
            //     $customer->pan_doc = $request->file('pan_doc')->store("$base/pan", $disk);
            // }

            // if ($request->hasFile('gst_doc')) {
            //     if (!empty($customer->gst_doc)) {
            //         Storage::disk($disk)->delete($customer->gst_doc);
            //     }
            //     $customer->gst_doc = $request->file('gst_doc')->store("$base/gst", $disk);
            // }

            // if ($request->hasFile('aadhar_doc')) {
            //     if (!empty($customer->aadhar_doc)) {
            //         Storage::disk($disk)->delete($customer->aadhar_doc);
            //     }
            //     $customer->aadhar_doc = $request->file('aadhar_doc')->store("$base/aadhar", $disk);
            // }

            $customer->save();

            DB::commit();

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Customer saved successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function view(Request $request)
    {
        $customer = Customer::findOrFail($request->custId);
        $user = User::where('id', $customer->user_id)->first();
        return view('admin.customers.partials.view', compact('customer', 'user'));
    }

    public function downloadCustomers(Request $request)
    {
        $customers = Customer::all();
        return view('admin.customers.downloads.customer-list', compact('customers'));
    }
}
