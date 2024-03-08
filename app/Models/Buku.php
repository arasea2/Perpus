<?php

namespace App\Models;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = ['judul', 'penulis', 'penerbit', 'tahun', 'image', 'dstock'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku', 'id');
    }

    public function stockTersedia()
    {
        $stock = $this->peminjamans()
                        ->whereIn('status', ['dipinjam', 'diajukan'])
                        ->count();

        return $this->dstock - $stock;
    }
    
}
