<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::all();
        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        Favorite::create([
            'imdb_id' => $request->imdb_id,
            'title' => $request->title,
            'year' => $request->year,
            'poster' => $request->poster,
        ]);

        return back();
    }

    public function destroy($id)
    {
        Favorite::destroy($id);
        return back();
    }
}