// ============================================
// IMLEX PREMIUM CINEMATIC MOVIE JS
// ============================================

// ===============================
// INJECT PREMIUM CSS
// ===============================

const style = document.createElement("style");
style.innerHTML = `
body.dark-theme {
    background-color: #0b0b0b;
    font-family: 'Poppins', sans-serif;
    color: #fff;
    overflow-x: hidden;
}

/* Movie Card */
.movie-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    background-color: #1c1c1c;
}

.movie-card img {
    height: 380px;
    width: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}

.movie-card:hover img {
    transform: scale(1.1);
}

.movie-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(229,9,20,0.4);
}

/* Overlay */
.movie-overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 20px;
    background: linear-gradient(to top, rgba(0,0,0,0.95), transparent);
    opacity: 0;
    transition: opacity .3s ease;
}

.movie-card:hover .movie-overlay {
    opacity: 1;
}

.overlay-title {
    font-weight: 600;
}

/* Buttons */
.btn-primary {
    background-color: #e50914;
    border: none;
}

.btn-primary:hover {
    background-color: #ff1e2d;
}

.btn-outline-success {
    border-color: #e50914;
    color: #e50914;
}

.btn-outline-success:hover {
    background-color: #e50914;
    color: #fff;
}

/* Loading */
.loading-text {
    color: #aaa;
}

/* Skeleton */
.skeleton-card {
    height: 380px;
    border-radius: 12px;
    background: linear-gradient(90deg, #1a1a1a 25%, #2a2a2a 50%, #1a1a1a 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% { background-position: 200% 0 }
    100% { background-position: -200% 0 }
}
`;
document.head.appendChild(style);

// ============================================
// MAIN LOGIC
// ============================================

let page = 1;
let searchQuery = "batman";
let loading = false;
let lastPageReached = false;

$(document).ready(function () {
    $("body").addClass("dark-theme");
    loadMovies();
});

// SEARCH
$("#search").on("keyup", function () {
    searchQuery = $(this).val().trim() || "batman";

    page = 1;
    lastPageReached = false;
    $("#movie-list").html("");

    loadMovies();
});

// INFINITE SCROLL
$(window).scroll(function () {
    if (
        $(window).scrollTop() + $(window).height() >=
        $(document).height() - 200
    ) {
        if (!loading && !lastPageReached) {
            page++;
            loadMovies();
        }
    }
});

// LOAD MOVIES
function loadMovies() {
    loading = true;
    $("#loading").show();

    $.ajax({
        url: "/movies",
        method: "GET",
        data: {
            search: searchQuery,
            page: page,
        },
        success: function (res) {
            $("#loading").hide();
            loading = false;

            if (res.Response === "False") {
                if (page === 1) {
                    $("#movie-list").html(`
                        <div class="col-12 text-center">
                            <h5>No movies found 😢</h5>
                            <p>Please try another keyword.</p>
                        </div>
                    `);
                }
                lastPageReached = true;
                return;
            }

            res.Search.forEach((movie) => {
                let posterUrl =
                    movie.Poster !== "N/A"
                        ? movie.Poster
                        : "https://via.placeholder.com/300x450?text=No+Poster";

                $("#movie-list").append(`
                    <div class="col-md-3 mb-4">
                        <div class="movie-card">
                            <img data-src="${posterUrl}"
                                 class="lazy"
                                 alt="${movie.Title}">

                            <div class="movie-overlay">
                                <h6 class="overlay-title">${movie.Title}</h6>
                                <p>${movie.Year}</p>

                                <a href="/movies/${movie.imdbID}"
                                   class="btn btn-primary btn-sm btn-block mb-2">
                                    View Detail
                                </a>

                                <button class="btn btn-outline-success btn-sm btn-block btn-favorite"
                                    data-id="${movie.imdbID}"
                                    data-title="${movie.Title}"
                                    data-year="${movie.Year}"
                                    data-poster="${posterUrl}">
                                    Add to Favorite
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            });

            lazyLoadImages();
        },
        error: function () {
            $("#loading").hide();
            loading = false;
            alert("Error fetching movies from OMDb API!");
        },
    });
}

// LAZY LOAD
function lazyLoadImages() {
    let lazyImages = document.querySelectorAll(".lazy");

    let observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                let img = entry.target;
                img.src = img.dataset.src;
                observer.unobserve(img);
            }
        });
    });

    lazyImages.forEach((img) => observer.observe(img));
}

// FAVORITE BUTTON
$(document).on("click", ".btn-favorite", function () {
    let imdbID = $(this).data("id");
    let title = $(this).data("title");
    let year = $(this).data("year");
    let poster = $(this).data("poster");

    $.ajax({
        url: "/favorite",
        method: "POST",
        data: {
            imdb_id: imdbID,
            title: title,
            year: year,
            poster: poster,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            $("#successToast").toast("show");

            setTimeout(function () {
                window.location.href = "/favorites";
            }, 2000);
        },
        error: function () {
            $("#errorToast").toast("show");
        },
    });
});

// Toast
function showToast(type) {
    const toast = document.getElementById(type + "Toast");

    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);
}
