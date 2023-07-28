<x-movie-detail-layout>

    <header>
        <h1>Movie Information</h1>
    </header>
    <main>
        <table>
            <tr>
                <td class="py-2 px-2">Movie Title:</td>
                <td class="py-2 px-2"><b>{{ $movie->mov_title ?: 'NULL' }}</b></td>
            </tr>
            <tr>
                <td class="py-2 px-2">Year:</td>
                <td class="py-2 px-2">{{ $movie->mov_year ?: 'NULL' }}</td>
            </tr>
            <tr>
                <td class="py-2 px-2">Running Time:</td>
                <td class="py-2 px-2">{{ $movie->mov_time ?: 'NULL' }}</td>
            </tr>
            <tr>
                <td class="py-2 px-2">Directed By:</td>
                <td class="py-2 px-2">{{ $selectedMovieDirector ?: 'NULL' }}</td>
            </tr>
            <tr>
                <td class="py-2 px-2">Starring:</td>
                <td class="py-2 px-2">{{ $selectedMovieCast ?: 'NULL' }}</td>
            </tr>
            <tr>
                <td class="py-2 px-2">Genre:</td>
                <td class="py-2 px-2">{{ $selectedMovieGenre ?: 'NULL' }}</td>
            </tr>
            <tr>
                <td class="py-2 px-2">Rating:</td>
                <td class="py-2 px-2">{{ $selectedMovieReviewer ?: 'NULL' }}</td>
            </tr>
            <tr>
                <td class="py-2 px-2">Score:</td>
                <td class="py-2 px-2">{{ $selectedMovieScore ?: 'NULL' }}</td>
            </tr>
        </table>

        <form action="/">
            @csrf
            <button class="btn btn-info text-white borderless-cyan-btn my-3 btn-custom">Go Back to List</button>
        </form>
    </main>

</x-movie-detail-layout>
