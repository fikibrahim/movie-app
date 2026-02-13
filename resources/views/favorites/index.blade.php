<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Favorite Movies</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/favorite.css') }}">
</head>

<body>

    <div class="container mt-5">

        <!-- Header -->
        <div class="favorite-header">
            <div>
                <h1 class="header-title">⭐ My Favorite Movies</h1>
                <p class="header-subtitle">Your personal movie collection</p>
            </div>

            <a href="/movies" class="btn btn-back">
                ⬅ Back to Movies
            </a>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Empty State -->
        @if ($favorites->count() == 0)

            <div class="empty-state text-center">
                <h3>No Favorite Movies Yet 😢</h3>
                <p>Start adding movies you love to see them here.</p>

                <a href="/movies" class="btn btn-warning mt-3">
                    🎬 Browse Movies
                </a>
            </div>
        @else
            <div class="row mt-4">
                @foreach ($favorites as $fav)
                    <div class="col-md-3 mb-4">
                        <div class="card fav-card shadow-lg">

                            <!-- Poster -->
                            <div class="poster-wrapper">
                                @if ($fav->poster && $fav->poster != 'N/A')
                                    <img src="{{ $fav->poster }}" class="poster-img" alt="{{ $fav->title }}">
                                @else
                                    <img src="https://via.placeholder.com/300x450?text=No+Poster" class="poster-img"
                                        alt="No Poster">
                                @endif
                            </div>

                            <div class="card-body text-center">

                                <h6 class="movie-title">
                                    {{ $fav->title }}
                                </h6>

                                <a href="/movies/{{ $fav->imdb_id }}"
                                    class="btn btn-outline-warning btn-sm btn-block mt-3">
                                    🎬 View Detail
                                </a>

                                <form method="POST" action="/favorite/{{ $fav->id }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm btn-block mt-2">
                                        ❌ Remove
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </div>

</body>

</html>
