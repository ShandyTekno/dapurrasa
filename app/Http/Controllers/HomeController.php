<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->latest()->take(6)->get();

        return view('public.home', compact('menus'));
    }
}
