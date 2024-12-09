<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $categories = Category::count();
        $users = User::count();
        $roles = Role::count();
        $brands = Brand::count();


        if (Auth::user()->role->name == 'User') {
            return redirect()->route('product.index');
        } else {
            return view('dashboard', compact('categories', 'product', 'users', 'roles', 'brands'));
        }
    }
}
