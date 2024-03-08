<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';
    protected $fillable = ['id_user', 'id_buku','tglPinjam','tglKembali','status'];

    public function Book()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function getUsrname()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
