<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::with('category')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $news
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_kategori' => 'required',
            'judul_berita' => 'required',
            'berita' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $gambar = null;

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $gambar = $file->store('news','public');
        }

        $news = News::create([
            'id_kategori' => $request->id_kategori,
            'judul_berita' => $request->judul_berita,
            'berita' => $request->berita,
            'gambar' => $gambar
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil dibuat',
            'data' => $news
        ]);
    }


    public function show($id)
    {

        $news = News::with('category')->find($id);

        if(!$news){
            return response()->json([
                'status' => false,
                'message' => 'Berita tidak ditemukan'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $news
        ]);
    }

    public function update(Request $request, $id)
    {

        $news = News::find($id);

        if(!$news){
            return response()->json([
                'status' => false,
                'message' => 'Berita tidak ditemukan'
            ]);
        }

        $request->validate([
            'id_kategori' => 'required',
            'judul_berita' => 'required',
            'berita' => 'required'
        ]);

        if($request->hasFile('gambar')){

            if($news->gambar){
                Storage::disk('public')->delete($news->gambar);
            }

            $file = $request->file('gambar');
            $gambar = $file->store('news','public');

            $news->gambar = $gambar;
        }

        $news->id_kategori = $request->id_kategori;
        $news->judul_berita = $request->judul_berita;
        $news->berita = $request->berita;
        $news->save();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil diupdate',
            'data' => $news
        ]);
    }


    public function destroy($id)
    {

        $news = News::find($id);

        if(!$news){
            return response()->json([
                'status' => false,
                'message' => 'Berita tidak ditemukan'
            ]);
        }

        if($news->gambar){
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil dihapus'
        ]);
    }

}