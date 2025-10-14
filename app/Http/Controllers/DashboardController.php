<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index(Request $request)
    {
        $user = auth()->user();
        $roleSlug = $user->role->slug;

        // Case: customer role
        if ($roleSlug === 'customer') {
            // if ($user->customer->hide_dashboard == 0) {
            //     return view('admin.hide-dashboard');
            // }

            // Only this customer's records
            $customers = Customer::where('id', $user->customer->id)->get();
            $users = collect(); // no need to show other users
        }

        // Case: admin/superadmin
        else {
            $customers = Customer::all();
            $users = User::where('role_id', 2)->get();
        }

        // Date filter (common for all roles)
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate   = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());

        $period = new \DatePeriod(
            new \DateTime($startDate),
            new \DateInterval('P1D'),
            (new \DateTime($endDate))->modify('+1 day')
        );

        $dates = [];
        foreach ($period as $date) {
            $dates[$date->format('Y-m-d')] = 0; 
        }

        $documentsPerDay = [];

        $activeCount = 0;
        $inactiveCount = 0;
        $deletedCount = 0;

        return view('admin.dashboard', compact(
            'customers',
            'users',
            'documentsPerDay',
            'startDate',
            'endDate',
            'activeCount',
            'inactiveCount',
            'deletedCount',
        ));
    }

}
