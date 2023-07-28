<x-layout>

    <main class="vh-100 d-flex justify-content-center align-items-center" style="background-color: #e9ecef;">
        <div class="w-25 p-4 bg-white rounded shadow">
            <h1 class="text-center mb-4">Welcome to MovieDB</h1>
            <form method="POST" action="/login">
                @csrf

                <div class="mb-3">
                    <label for="email" class="col-form-label">Email:</label>
                    <div class="col-sm-max">
                        <input type="email" name="login-email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="col-form-label">Password:</label>
                    <div class="col-sm-max">
                        <input type="password" name="login-password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>

                @if (session()->has('failure'))
                    <div class="d-flex justify-content-center">
                        <small class="error-message">
                            {{session('failure')}}
                        </small>
                    </div>
                @endif

                <div class="d-flex justify-content-end">
                    <form action="/login" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>

                <p class="text-center mt-3 text-muted">
                    Don't have an account yet? <a href="/register" style="color: rgb(0, 26, 255);">Sign up</a> here.
                </p>
            </form>
        </div>
    </main>

</x-layout>
