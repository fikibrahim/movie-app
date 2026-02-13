<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;



class FavoriteController extends Controller
{
    // Halaman list favorites
    public function index()
    {
        $favorites = Favorite::orderBy('created_at', 'desc')->get();

        return view('favorites.index', compact('favorites'));
    }

    // Tambah favorite
    public function store(Request $request)
    {
        $exists = Favorite::where('imdb_id', $request->imdb_id)->first();

        if ($exists) {
            return back()->with('error', 'Movie already in favorites!');
        }

        Favorite::create([
            'imdb_id' => $request->imdb_id,
            'title'   => $request->title,
            'poster'  => $request->poster
        ]);

        return back()->with('success', 'Movie added to favorites!');
    }


    // Hapus favorite
    public function destroy($id)
    {
        Favorite::find($id)->delete();

        return back()->with('success', 'Favorite removed!');
    }
}
