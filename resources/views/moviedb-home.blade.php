<x-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <h1 class="navbar-brand fs-3"><strong>Movie 'R' Us Movie Database</strong></h1>

            @if (session()->has('success'))
            <div class="alert alert-success text-center mx-auto">
                {{session('success')}}
            </div>
            @endif

            <div class="d-flex ml-auto">
                <div class="dropdown">
                    <button class="btn custom-logout dropdown-toggle" style="background-color: #f8f9fa; color: #6c757d; transition: all 0.3s ease;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome,&nbsp;<strong>{{ Auth::user()->username }}!&emsp;</strong>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/add-movie">Add Movie</a></li>
                      <li><form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Sign Out</button>
                    </form></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.querySelector('.custom-logout').addEventListener('mouseover', function() {
            this.style.backgroundColor = '#6c757d';
            this.style.color = '#fff';
        });

        document.querySelector('.custom-logout').addEventListener('mouseout', function() {
            this.style.backgroundColor = '#f8f9fa';
            this.style.color = '#6c757d';
        });
    </script>

    <main class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="header-row">
                    <th>Movie ID</th>
                    <th>Movie Title</th>
                    <th>Year Made</th>
                    <th>Length</th>
                    <th>Language</th>
                    <th>Date of Release</th>
                    <th>Country Released</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                @php
                    $rowColorClass = $loop->iteration % 2 === 0 ? 'even-row' : 'odd-row';
                @endphp
                    <tr class="{{ $rowColorClass }}">
                        <td>{{ $movie->mov_id }}</td>
                        <td>{{ $movie->mov_title }}</td>
                        <td>{{ $movie->mov_year }}</td>
                        <td>{{ $movie->mov_time }}</td>
                        <td>{{ $movie->mov_lang }}</td>
                        <td>{{ $movie->mov_dt_rel ?: 'NULL' }}</td>
                        <td>{{ $movie->mov_rel_country }}</td>
                        <td>
                            <div class="d-flex flex-column align-items-center">
                                <form action="/movie/detail/{{ $movie->mov_id }}">
                                    @csrf
                                    <button class="btn btn-info text-white borderless-cyan-btn btn-custom">Movie Details</button>
                                </form>
                                <div class="d-flex mt-1 gap-5">
                                    <form action="/movie/edit/{{ $movie->mov_id }}" class="mr-2" method="GET">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                    </form>
                                    <form action="/movie/delete/{{ $movie->mov_id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginator-container">
            {{ $movies->links() }}
        </div>

    </main>

</x-layout>
