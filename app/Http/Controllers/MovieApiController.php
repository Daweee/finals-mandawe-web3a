<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Director;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateMovieRequest;

class MovieApiController extends Controller
{

    public function editMovieApi(CreateMovieRequest $request, $movie) {
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

            return response()->json(['message' => 'Movie Information updated successfully!'], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error updating movie: ' . $e->getMessage());

            return response()->json(['message' => 'Error updating movie: ' . $e->getMessage()], 500);
        }
    }

    public function deleteMovieApi($movie) {
        try {
            DB::beginTransaction();

            $movie = Movie::find($movie);

            if(!$movie) {
                return response()->json(['message' => 'Movie not found'], 404);
            }

            $movie->actors()->detach();
            $movie->directors()->detach();
            $movie->genres()->detach();
            $movie->reviewers()->detach();

            $movie->delete();

            DB::commit();

            return response()->json(['message' => 'Movie deleted successfully!'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting movie: ' . $e->getMessage());

            return response()->json(['message' => 'Error deleting movie: ' . $e->getMessage()], 500);
        }
    }

    public function createMovieApi(CreateMovieRequest $request) {
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

            return response()->json(['message' => 'Movie added successfully!'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating movie: ' . $e->getMessage());

            return response()->json(['message' => 'Error creating movie: ' . $e->getMessage()], 500);
        }
    }

    public function showMovieDetailsApi($movie) {
        $selectedMovie = Movie::find($movie);

        if(!$selectedMovie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

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

        return response()->json([
            'movie' => $selectedMovie,
            'selectedMovieDirector' => $selectedDirectorFullName->implode(', '),
            'selectedMovieCast' =>  $selectedMovieCastAndRole->implode(', '),
            'selectedMovieGenre' => $selectedMovieGenre->implode(', '),
            'selectedMovieReviewer' => $selectedMovieReviewer->implode(', '),
            'selectedMovieScore' => $selectedMovieScore->implode(', '),
        ], 200);
    }

    public function showMoviesApi() {
        $movies = Movie::paginate(10);
        return response()->json($movies, 200);
    }

}

