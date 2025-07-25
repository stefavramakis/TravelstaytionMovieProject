<?php


namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function react(Request $request, Movie $movie, $type)
    {
        if (!in_array($type, ['like', 'hate'])) {
            abort(400, 'Invalid reaction type.');
        }

        $reaction = $movie->reactions()
            ->updateOrCreate(
                ['user_id' => auth()->id()],
                ['type' => $type]
            );

        return back();
    }
}
