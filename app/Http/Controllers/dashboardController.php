<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function index()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $citiesCount = City::count();
        $adminsCount = Admin::count();
        $categories = Category::with('user')->get();

        return view('cms.dashboard',[
            'usersCount' => $usersCount,
            'categoriesCount' => $categoriesCount,
            'citiesCount' => $citiesCount,
            'adminsCount' => $adminsCount,
            'categories' => $categories
        ]);
    }

}
