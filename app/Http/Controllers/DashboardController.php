<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;


class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $orderCount = Order::count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        return view('dashboard.index', compact('userCount', 'orderCount', 'productCount', 'categoryCount'));
    }

    public function users()
    {
        $users = User::all();
        return view('dashboard.partials.users', compact('users'));
    }
    public function orders()
    {
        $orders = Order::with('user')->get();
        return view('dashboard.partials.orders', compact('orders'));
    }
    public function products()
    {
        $products = Product::with('category')->get();
        return view('dashboard.partials.products', compact('products'));
    }
    public function categories()
    {
        $categories = Category::all();
        return view('dashboard.partials.categories', compact('categories'));    

    }
}
