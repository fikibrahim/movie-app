<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IMLEX | Premium Movies</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>


<body class="dark-theme">

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-transparent px-5 position-absolute w-100">
        <a class="navbar-brand text-danger font-weight-bold">IMLEX</a>

        <div class="ml-auto">
            <a href="/favorites" class="btn btn-outline-light btn-sm mr-2">Favorites</a>
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-banner">
        <div class="hero-content text-center">
            <h1 class="hero-title">Watch Something Incredible Tonight</h1>
            <p class="hero-subtitle">Stream unlimited movies in cinematic quality.</p>

            <input type="text" id="search" class="form-control search-input" placeholder="Search movies...">
        </div>
    </section>

    <!-- Movie Grid -->
    <div class="container-fluid px-5 mt-5">
        <div class="row" id="movie-list"></div>

        <!-- Skeleton Loading -->
        <div class="row" id="skeleton" style="display:none;">
            <div class="col-md-3 mb-4" v-for="i in 8">
                <div class="skeleton-card"></div>
            </div>
        </div>

        <div class="text-center mt-4" id="loading" style="display:none;">
            <div class="spinner-border text-danger"></div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-wrapper">
        <div id="successToast" class="custom-toast success">
            <span>✅ Movie added to Favorite!</span>
        </div>

        <div id="errorToast" class="custom-toast error">
            <span>❌ Failed add favorite (maybe already added)</span>
        </div>
    </div>


    <script src="{{ asset('js/movie.js') }}"></script>
</body>

</html>
