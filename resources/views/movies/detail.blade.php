<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $movie['Title'] ?? 'Movie Detail' }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/movie-detail.css') }}">
</head>

<body>

    <div class="container mt-5">

        <!-- Header -->
        <div class="detail-header">
            <div>
                <h1 class="header-title">🎬 Movie Detail</h1>
                <p class="header-subtitle">Explore complete movie information</p>
            </div>

            <a href="/movies" class="btn btn-back">
                ⬅ Back
            </a>
        </div>


        @if (!$movie || $movie['Response'] == 'False')
            <div class="alert alert-danger text-center mt-4">
                <h5>Movie not found 😢</h5>
                <p>Please go back and try another movie.</p>
            </div>
        @else
            <div class="card movie-card shadow-lg">

                <div class="row no-gutters">

                    <!-- Poster -->
                    <div class="col-md-4 poster-wrapper">
                        @if ($movie['Poster'] != 'N/A')
                            <img src="{{ $movie['Poster'] }}" class="poster-img" alt="{{ $movie['Title'] }}">
                        @else
                            <img src="https://via.placeholder.com/300x450?text=No+Poster" class="poster-img"
                                alt="No Poster">
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="col-md-8 p-4">

                        <h2 class="movie-title">
                            {{ $movie['Title'] }}
                        </h2>

                        <p class="movie-meta">
                            {{ $movie['Year'] }} • {{ $movie['Rated'] }} • {{ $movie['Runtime'] }}
                        </p>

                        <div class="rating-box">
                            ⭐ IMDB: <strong>{{ $movie['imdbRating'] }}</strong>/10
                            ({{ $movie['imdbVotes'] }} votes)
                        </div>

                        <hr>

                        <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
                        <p><strong>Director:</strong> {{ $movie['Director'] }}</p>
                        <p><strong>Writer:</strong> {{ $movie['Writer'] }}</p>
                        <p><strong>Actors:</strong> {{ $movie['Actors'] }}</p>

                        <hr>

                        <h5>📖 Plot</h5>
                        <p class="plot-text">{{ $movie['Plot'] }}</p>

                        <hr>

                        <!-- Favorite Button -->
                        <form method="POST" action="/favorite">
                            @csrf

                            <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                            <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">

                            <button type="submit" class="btn btn-success btn-lg btn-block mt-3">
                                ⭐ Add to Favorite
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        @endif

    </div>

    <!-- Toast Notification -->
    <div class="toast-wrapper">

        @if (session('success'))
            <div class="custom-toast success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="custom-toast error">
                ❌ {{ session('error') }}
            </div>
        @endif

    </div>


    <script src="{{ asset('js/movie-detail.js') }}"></script>
</body>

</html>
