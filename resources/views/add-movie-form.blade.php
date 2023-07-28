<x-layout>

    <header style="background-color: #e9ecef;">
        <form action="/">
            @csrf
            <button type="submit" class="btn btn-primary m-10">Back</button>
        </form>

    </header>

    <main class="vh-100 d-flex justify-content-center align-items-center" style="background-color: #e9ecef;">
        <div class="w-75 p-4 bg-white rounded shadow">
            <form method="POST" action="/add-movie">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-3">MOVIE:</h2>
                        <div class="mb-3">
                            <label for="mov_title" class="col-form-label">Movie Title:</label>
                            <div class="col-sm-max">
                                <input type="text" name="movie[mov_title]" class="form-control" id="mov_title" value="{{old('movie.mov_title')}}" placeholder="Enter Movie Title">
                                @error('movie.mov_title')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mov_year" class="form-label">Year Made:</label>
                            <div class="col-sm-max">
                                <input type="text" name="movie[mov_year]" class="form-control" id="mov_year" value="{{old('movie.mov_year')}}" placeholder="Enter Year Made">
                                @error('movie.mov_year')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mov_time" class="form-label">Length:</label>
                            <div class="col-sm-max">
                                <input type="text" name="movie[mov_time]" class="form-control" id="mov_time" value="{{old('movie.mov_time')}}" placeholder="Enter Length">
                                @error('movie.mov_time')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mov_lang" class="form-label">Language:</label>
                            <div class="col-sm-max">
                                <input type="text" name="movie[mov_lang]" class="form-control" id="mov_lang" value="{{old('movie.mov_lang')}}" placeholder="Enter Language">
                                @error('movie.mov_lang')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mov_dt_rel" class="form-label">Date of Release:</label>
                            <div class="col-sm-max">
                                <input type="date" name="movie[mov_dt_rel]" class="form-control" id="mov_dt_rel" placeholder="Enter Date of Release">
                                @error('movie.mov_dt_rel')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mov_rel_country" class="form-label">Country Released:</label>
                            <div class="col-sm-max">
                                <input type="text" name="movie[mov_rel_country]" class="form-control" id="mov_rel_country" value="{{old('movie.mov_rel_country')}}" placeholder="Enter Country Released">
                                @error('movie.mov_rel_country')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h2 class="mb-3">MOVIE INFORMATION:</h2>
                        <div class="mb-3">
                            <label for="director_fname" class="form-label">Director's first name:</label>
                            <input type="text" name="director[dir_fname]" class="form-control" id="director_fname" value="{{old('director.dir_fname')}}" placeholder="Enter Director">
                            @error('director.dir_fname')
                                <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='mb-3'>
                            <label for="director_lname" class="form-label">Director's last name:</label>
                            <input type="text" name="director[dir_lname]" class="form-control" id="director_lname" value="{{old('director.dir_lname')}}" placeholder="Enter Director">
                            @error('director.dir_lname')
                                <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <label for="actor_fname" class="col-form-label">Actor's first name:</label>
                                <input type="text" name="actor[act_fname]" class="form-control" id="actor_fname" value="{{old('actor.act_fname')}}" placeholder="Enter Actor's first name">
                                @error('actor.act_fname')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="actor_lname" class="col-form-label">Actor's last name:</label>
                                <input type="text" name="actor[act_lname]" class="form-control" id="actor_lname" value="{{old('actor.act_lname')}}" placeholder="Enter Actor's last name">
                                @error('actor.act_lname')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-auto mb-2">
                                <span>as</span>
                            </div>
                            <div class="col">
                                <input type="text" name="role" class="form-control" id="character" value="{{old('role')}}" placeholder="Enter Role">
                                @error('role')
                                    <small class="error-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="actor_gender" class="form-label">Actor's Gender:</label>
                            <select class="form-control" id="actor_gender" name="actor[act_gender]">
                                <option value="">Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            @error('actor.act_gender')
                                <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre:</label>
                            <input type="text" name="genre[gen_title]" class="form-control" id="genre" value="{{old('genre.gen_title')}}" placeholder="Enter Genre">
                            @error('genre.gen_title')
                                <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating:</label>
                            <input type="text" name="reviewer[rev_name]" class="form-control" id="rating" value="{{old('reviewer.rev_name')}}" placeholder="Enter Rating">
                            @error('reviewer.rev_name')
                                <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="score" class="form-label">Score:</label>
                            <input type="text" name="rating[rev_stars]" class="form-control" id="score" value="{{old('rating.rev_stars')}}" placeholder="Enter Score">
                            @error('rating.rev_stars')
                                <small class="error-message">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary">Add Movie</button>
                </div>
            </form>
        </div>
    </main>

</x-layout>
