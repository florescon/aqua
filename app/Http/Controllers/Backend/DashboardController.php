<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Subscription;
use App\Sale;
use App\Product;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $users = User::role('user')->get()->count();
        $payments = Subscription::all()->count();
        $sales = Sale::all()->count();
        $products = Product::all()->count();

        return view('backend.dashboard', compact('users', 'payments', 'sales', 'products'));
    }
}
