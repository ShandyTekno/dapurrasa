<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalKategori' => Kategori::count(),
            'totalMenu' => Menu::count(),
            'menuTerbaru' => Menu::with('kategori')->latest()->take(5)->get(),
        ]);
    }
}
