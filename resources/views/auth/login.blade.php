<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Movie App</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <div class="login-header text-center">
                <h2>🎬 Movie App</h2>
                <p>Welcome back! Please login to continue</p>
            </div>

            {{-- Error Message --}}
            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control custom-input" placeholder="Enter username"
                        required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control custom-input"
                        placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-login btn-block mt-3">
                    Login
                </button>
            </form>

            <div class="login-footer text-center">
                <small>Movie Catalog Application</small>
            </div>

        </div>

    </div>

</body>

</html>
