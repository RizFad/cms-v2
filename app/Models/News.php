<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class News extends Model
{

    protected $table = 'beritas';

    protected $fillable = [
        'id_kategori',
        'gambar',
        'judul_berita',
        'berita'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'id_kategori');
    }

}