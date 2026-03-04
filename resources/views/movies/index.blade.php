<!DOCTYPE html>
<html>
<head>
    <title>🎬 Movie App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #87CEFA, #E0F7FA);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar-custom {
            background: linear-gradient(90deg, #1E90FF, #87CEFA);
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.3rem;
        }
        .navbar .btn {
            font-size: 0.9rem;
            padding: 6px 12px;
        }

        /* Search form */
        .search-input {
            border-radius: 25px;
            padding: 10px 20px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #B0C4DE;
            transition: all 0.3s;
        }
        .search-input:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 8px rgba(30,144,255,0.3);
        }
        .btn-search {
            border-radius: 25px;
            background-color: #1E90FF;
            color: white;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-search:hover {
            background-color: #1C86EE;
            transform: translateY(-2px);
        }

        /* Movie card */
        .movie-card {
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }
        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .movie-card img {
            height: 350px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        .card-body h6 a {
            color: #1E3A8A;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .card-body h6 a:hover {
            color: #1C86EE;
        }
        .card-body p {
            font-size: 0.9rem;
            color: #555;
        }

        /* Favorite button */
        .btn-favorite {
            background-color: #FF6B6B;
            color: white;
            border-radius: 12px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-favorite:hover {
            background-color: #FF4C4C;
            transform: translateY(-2px);
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .movie-card img {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .search-input {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="#">🎬 Movie App</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <div class="ml-auto d-flex align-items-center">

            <!-- Favorite Button -->
            <a href="/favorites" class="btn btn-light btn-sm mr-2">⭐ {{ __('messages.favorite') }}</a>

            <!-- Language Dropdown -->
            <div class="dropdown mr-2">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="langDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                    <a class="dropdown-item" href="{{ route('setLocale', ['lang' => 'en']) }}">EN</a>
                    <a class="dropdown-item" href="{{ route('setLocale', ['lang' => 'id']) }}">ID</a>
                </div>
            </div>

            <!-- Logout button with SweetAlert2 -->
            <form id="logoutForm" method="POST" action="/logout">
                {{ csrf_field() }}
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmLogout()">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>

<div class="container mt-4">

    <h3 class="mb-4 text-center text-primary">{{ __('messages.movie_list') }}</h3>

    <!-- Search Form -->
    <form method="GET" class="d-flex justify-content-center mb-4">
        <input type="text" name="search" class="search-input mr-2" placeholder="{{ __('messages.search_placeholder') }}" required>
        <button type="submit" class="btn btn-search">Search</button>
    </form>

    <div class="row" id="movieContainer">
        @forelse($movies as $movie)
            <div class="col-md-3 col-sm-6 mb-4 movie-item">
                <div class="card movie-card h-100">

                    <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x445' }}" loading="lazy">

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">
                            <a href="/movies/{{ $movie['imdbID'] }}">
                                {{ $movie['Title'] }}
                            </a>
                        </h6>
                        <p class="mb-2">{{ $movie['Year'] }}</p>

                        <form method="POST" action="/favorites" class="mt-auto">
                            {{ csrf_field() }}
                            <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                            <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                            <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">

                            <button type="submit" class="btn btn-favorite btn-block btn-sm">
                                ❤️ {{ __('messages.favorite') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    {{ __('messages.no_movies_found') }}
                </div>
            </div>
        @endforelse
    </div>

</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    // SweetAlert2 Logout
    function confirmLogout() {
        Swal.fire({
            title: '{{ __("messages.logout_confirm_title") }}',
            text: '{{ __("messages.logout_confirm_text") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __("messages.yes_logout") }}',
            cancelButtonText: '{{ __("messages.cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        })
    }

    // Infinite Scroll
    let page = 1;
    let loading = false;
    let searchQuery = '{{ request("search") }}';

    function loadMoreMovies() {
        if (loading) return;
        loading = true;
        page++;

        $.get('/movies?search=' + searchQuery + '&page=' + page, function(data) {
            if (data.trim() !== '') {
                $('#movieContainer').append(data);
                loading = false;
            }
        });
    }

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            loadMoreMovies();
        }
    });
</script>

</body>
</html>