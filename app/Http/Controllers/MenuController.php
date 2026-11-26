<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::with('kategori')
            ->when($request->filled('kategori'), fn ($q) => $q->where('kategori_id', $request->integer('kategori')))
            ->when($request->filled('q'), fn ($q) => $q->where('nama_menu', 'like', '%' . $request->string('q')->trim() . '%'))
            ->orderBy('nama_menu')
            ->paginate(9)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('public.menu.index', compact('menus', 'kategoris'));
    }

    public function show(Menu $menu)
    {
        $menu->load('kategori');

        return view('public.menu.show', compact('menu'));
    }
}
