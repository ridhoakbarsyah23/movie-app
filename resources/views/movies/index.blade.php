<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .movie-card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .navbar-custom {
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .btn-favorite {
            background-color: #ff4757;
            color: white;
        }

        .btn-favorite:hover {
            background-color: #e84118;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="#">🎬 Movie App</a>
    <div class="ml-auto">
        <a href="/favorites" class="btn btn-light btn-sm mr-2">⭐ Favorite</a>
        <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">

    <h3 class="mb-4">List Movie</h3>

    <!-- Search Form -->
    <form method="GET" class="form-inline mb-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search movie..." required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="row">
        @forelse($movies as $movie)
            <div class="col-md-3 mb-4">
                <div class="card movie-card h-100">

                    <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x445' }}"
                         class="card-img-top"
                         style="height:350px; object-fit:cover;">

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">
                            <a href="/movies/{{ $movie['imdbID'] }}">
                                {{ $movie['Title'] }}
                            </a>
                        </h6>

                        <p class="text-muted mb-2">{{ $movie['Year'] }}</p>

                        <form method="POST" action="/favorites" class="mt-auto">
                            {{ csrf_field() }}
                            <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                            <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                            <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">

                            <button type="submit" class="btn btn-favorite btn-sm btn-block">
                                ❤️ Add Favorite
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Silahkan cari movie dengan kata kunci di atas.
                </div>
            </div>
        @endforelse
    </div>

</div>

</body>
</html>