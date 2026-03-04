<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'berita' => 'required'
        ]);

        $gambarPath = null;

        if($request->gambar){

            $image = $request->gambar;

            if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {

                $image = substr($image, strpos($image, ',') + 1);
                $type = strtolower($type[1]);

                $image = base64_decode($image);

            } else {

                $image = base64_decode($image);
                $type = 'png';

            }

            $fileName = Str::random(20) . '.' . $type;

            Storage::disk('public')->put('news/'.$fileName, $image);

            $gambarPath = 'news/'.$fileName;
        }

        $news = News::create([
            'id_kategori' => $request->id_kategori,
            'judul_berita' => $request->judul_berita,
            'berita' => $request->berita,
            'gambar' => $gambarPath
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

        if($request->gambar){

            if($news->gambar){
                Storage::disk('public')->delete($news->gambar);
            }

            $image = $request->gambar;

            if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {

                $image = substr($image, strpos($image, ',') + 1);
                $type = strtolower($type[1]);

                $image = base64_decode($image);

            } else {

                $image = base64_decode($image);
                $type = 'png';

            }

            $fileName = Str::random(20) . '.' . $type;

            Storage::disk('public')->put('news/'.$fileName, $image);

            $news->gambar = 'news/'.$fileName;
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