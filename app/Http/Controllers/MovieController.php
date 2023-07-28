<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Director;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateMovieRequest;

class MovieController extends Controller
{

    public function editMovie(CreateMovieRequest $request, $movie) {
        try {
            DB::beginTransaction();

            $movie = Movie::findOrFail($movie);

            $incomingFields = $request->validated();

            $movie->update($incomingFields['movie']);

            $movie->directors()->detach();
            $movie->actors()->detach();
            $movie->genres()->detach();
            $movie->reviewers()->detach();

            Director::firstOrCreate($incomingFields['director']);
            $director = Director::where($incomingFields['director'])->first();

            Actor::firstOrCreate($incomingFields['actor']);
            $actor = Actor::where($incomingFields['actor'])->first();

            Genre::firstOrCreate($incomingFields['genre']);
            $genre = Genre::where($incomingFields['genre'])->first();

            Reviewer::firstOrCreate($incomingFields['reviewer']);
            $reviewer = Reviewer::where($incomingFields['reviewer'])->first();

            $movie->directors()->attach($director->dir_id);
            $movie->actors()->attach($actor->act_id, ['role' => $incomingFields['role']]);
            $movie->genres()->attach($genre->gen_id);
            $movie->reviewers()->attach($reviewer->rev_id, ['rev_stars' => $incomingFields['rating']['rev_stars'], 'num_o_ratings' => 1]);

            DB::commit();

            return redirect('/')->with('success', 'Movie Information updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::erorr('Error updating movie: ' . $e->getMessage());
        }

    }

    public function showEditMoviePage(Movie $movie) {
        return view('edit-movie-form', ['movie' => $movie]);
    }

    public function deleteMovie($movie) {
        try {
            DB::beginTransaction();

            $movie = Movie::find($movie);

            $movie->actors()->detach();
            $movie->directors()->detach();
            $movie->genres()->detach();
            $movie->reviewers()->detach();

            $movie->delete();

            DB::commit();

            return redirect('/')->with('success', 'Movie deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting movie: ' . $e->getMessage());

            return back()->with('error', 'There was an error deleting the movie. Please try again.');
        }
    }

    public function createMovie(CreateMovieRequest $request) {
        try {
            DB::beginTransaction();

            $incomingFields = $request->validated();

            Director::firstOrCreate($incomingFields['director']);
            $director = Director::where($incomingFields['director'])->first();

            Actor::firstOrCreate($incomingFields['actor']);
            $actor = Actor::where($incomingFields['actor'])->first();

            Genre::firstOrCreate($incomingFields['genre']);
            $genre = Genre::where($incomingFields['genre'])->first();

            Reviewer::firstOrCreate($incomingFields['reviewer']);
            $reviewer = Reviewer::where($incomingFields['reviewer'])->first();

            $movie = Movie::create($incomingFields['movie']);
            $movie->directors()->attach($director->dir_id);
            $movie->actors()->attach($actor->act_id, ['role' => $incomingFields['role']]);
            $movie->genres()->attach($genre->gen_id);
            $movie->reviewers()->attach($reviewer->rev_id, ['rev_stars' => $incomingFields['rating']['rev_stars'], 'num_o_ratings' => 1]);

            DB::commit();

            return redirect('/')->with('success', 'Movie added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating movie: ' . $e->getMessage());

            return back()->with('error', 'There was an error creating the movie. Please try again.');
        }
    }

    public function showCreateMoviePage() {
        return view('add-movie-form');
    }

    public function showMovieDetails($movie) {
        $selectedMovie = Movie::find($movie);

        $selectedDirectorFullName = $selectedMovie->directors->map(function ($director) {
            return $director->dir_fname . ' ' . $director->dir_lname;
        });

        $selectedMovieCastAndRole = $selectedMovie->actors->map(function ($actor) {
            return $actor->act_fname . ' ' . $actor->act_lname . ' ' . '-' . ' ' . $actor->pivot->role;
        });

        $selectedMovieGenre = $selectedMovie->genres->map(function ($genre) {
            return $genre->gen_title;
        });

        $selectedMovieReviewer = $selectedMovie->reviewers->map(function ($reviewer) {
            return $reviewer->rev_name;
        });

        $selectedMovieScore = $selectedMovie->reviewers->map(function ($reviewer) {
            return $reviewer->pivot->rev_stars;
        });

        return view('movie-details', [
            'movie' => $selectedMovie,
            'selectedMovieDirector' => $selectedDirectorFullName->implode(', '),
            'selectedMovieCast' =>  $selectedMovieCastAndRole->implode(', '),
            'selectedMovieGenre' => $selectedMovieGenre->implode(', '),
            'selectedMovieReviewer' => $selectedMovieReviewer->implode(', '),
            'selectedMovieScore' => $selectedMovieScore->implode(', '),
        ]);
    }

    public function showMovieHomepage() {
        if(Auth::check()) {
            $movies = Movie::paginate(10);
            return view('moviedb-home', ['movies' => $movies]);
        } else {
            return view('auth.movie-login');
        }
    }

}
