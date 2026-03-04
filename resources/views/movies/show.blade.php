<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie['Title'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .movie-container {
            margin-top: 50px;
        }

        .movie-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .movie-poster {
            border-radius: 15px 0 0 15px;
            object-fit: cover;
            height: 100%;
        }

        .btn-favorite {
            background-color: #ff4757;
            color: white;
        }

        .btn-favorite:hover {
            background-color: #e84118;
        }

        .back-link {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container movie-container">
    <div class="card movie-card">
        <div class="row no-gutters">

            <!-- Poster -->
            <div class="col-md-4">
                <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x445' }}"
                     class="img-fluid movie-poster">
            </div>

            <!-- Detail -->
            <div class="col-md-8">
                <div class="card-body">

                    <h2 class="card-title mb-3">{{ $movie['Title'] }}</h2>

                    <p><strong>📅 Year:</strong> {{ $movie['Year'] }}</p>
                    <p><strong>🎭 Genre:</strong> {{ $movie['Genre'] }}</p>
                    <p><strong>📝 Plot:</strong></p>
                    <p class="text-muted">{{ $movie['Plot'] }}</p>

                    <hr>

                    <form method="POST" action="/favorites">
                        {{ csrf_field() }}
                        <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                        <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                        <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                        <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">

                        <button type="submit" class="btn btn-favorite">
                            ❤️ Add to Favorite
                        </button>

                        <a href="/movies" class="btn btn-secondary ml-2">
                            ⬅ Back
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>