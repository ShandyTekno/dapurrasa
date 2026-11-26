<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->latest()->paginate(10);

        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.form', [
            'menu' => new Menu(),
            'kategoris' => Kategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function store(MenuRequest $request)
    {
        $data = $request->validated();
        unset($data['foto']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if ($file->isValid()) {
                $path = $file->store('menus', 'public');
                if (! $path) {
                    return back()->withInput()->with('error', 'Gagal menyimpan foto ke direktori storage.');
                }
                $data['foto'] = $path;
            } else {
                return back()->withInput()->with('error', 'Upload foto tidak valid: ' . $file->getErrorMessage());
            }
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.form', [
            'menu' => $menu,
            'kategoris' => Kategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $data = $request->validated();
        unset($data['foto']);
        $fotoLama = $menu->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if ($file->isValid()) {
                $path = $file->store('menus', 'public');
                if (! $path) {
                    return back()->withInput()->with('error', 'Gagal menyimpan foto baru ke storage. Foto lama dipertahankan.');
                }
                $data['foto'] = $path;
            } else {
                return back()->withInput()->with('error', 'Upload foto tidak valid: ' . $file->getErrorMessage());
            }
        }

        $menu->update($data);

        if (isset($data['foto']) && $fotoLama && $fotoLama !== $data['foto']) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $foto = $menu->foto;
        $menu->delete();

        if ($foto) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
