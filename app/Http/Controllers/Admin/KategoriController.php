<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Database\QueryException;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('menus')->orderBy('nama_kategori')->paginate(10);

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.form', ['kategori' => new Kategori()]);
    }

    public function store(KategoriRequest $request)
    {
        Kategori::create($request->validated());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.form', compact('kategori'));
    }

    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $kategori->update($request->validated());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->menus()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh menu.');
        }

        try {
            $kategori->delete();
        } catch (QueryException $e) {
            report($e);

            return back()->with('error', 'Kategori gagal dihapus.');
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
