<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = ['kategori_id', 'nama_menu', 'harga', 'deskripsi', 'foto'];

    protected $casts = ['harga' => 'integer'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getFotoUrlAttribute(): string
    {
        return $this->foto
            ? asset('storage/' . ltrim($this->foto, '/'))
            : asset('images/placeholder.svg');
    }
}
