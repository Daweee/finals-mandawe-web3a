<x-layout>

    <main class="vh-100 d-flex justify-content-center align-items-center" style="background-color: #e9ecef;">
        <div class="w-25 p-4 bg-white rounded shadow">
            <h1 class="text-center mb-4">Register to MovieDB</h1>
            <form method="POST" action="/register">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <div class="col-sm-max">
                        <input type="text" name="username" class="form-control" id="name" value="{{old('username')}}" placeholder="Place your name">
                        @error('username')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <div class="col-sm-max">
                        <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" placeholder="Place your email">
                        @error('email')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <div class="col-sm-max">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Place your password">
                        @error('password')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password:</label>
                    <div class="col-sm-max">
                        <input type="password" name="password_confirmation" class="form-control" id=confirm-password" placeholder="Confirm your password">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <p class="text-center mt-3 text-muted">
                    Already have an account? <a href="/" style="color: rgb(0, 26, 255);">Login</a> here.
                </p>
            </form>
        </div>
    </main>

</x-layout>
