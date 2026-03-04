<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = [];

        if ($request->search) {
            $apiKey = config('services.omdb.key');
            $url = "http://www.omdbapi.com/?apikey={$apiKey}&s={$request->search}";

            $response = json_decode(file_get_contents($url), true);

            if (isset($response['Search'])) {
                $movies = $response['Search'];
            }
        }

        return view('movies.index', compact('movies'));
    }

    public function show($imdbID)
    {
        $apiKey = config('services.omdb.key');
        $url = "http://www.omdbapi.com/?apikey={$apiKey}&i={$imdbID}";

        $movie = json_decode(file_get_contents($url), true);

        return view('movies.show', compact('movie'));
    }
}