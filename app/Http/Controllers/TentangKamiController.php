<?php

namespace App\Http\Controllers;

class TentangKamiController extends Controller
{
    public function index()
    {
        return view('public.tentang');
    }

    public function kontak()
    {
        return view('public.kontak');
    }
}
