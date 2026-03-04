<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $category = Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category berhasil dibuat',
            'data' => $category
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'status' => false,
                'message' => 'Category tidak ditemukan'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'status' => false,
                'message' => 'Category tidak ditemukan'
            ]);
        }

        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category berhasil diupdate',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'status' => false,
                'message' => 'Category tidak ditemukan'
            ]);
        }

        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category berhasil dihapus'
        ]);
    }
}