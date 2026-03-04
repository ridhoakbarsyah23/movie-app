<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie['Title'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #87CEFA, #E0F7FA);
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
        }

        .movie-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .movie-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #ffffff;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        /* Poster */
        .movie-poster {
            border-radius: 20px 0 0 20px;
            object-fit: cover;
            height: 100%;
            transition: transform 0.3s;
        }

        .movie-poster:hover {
            transform: scale(1.05);
        }

        /* Card body */
        .card-body h2 {
            font-weight: 700;
            color: #1E3A8A;
        }

        .card-body p {
            font-size: 0.95rem;
            color: #555;
        }

        /* Buttons */
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

        .btn-back {
            background-color: #1E90FF;
            color: white;
            border-radius: 12px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-back:hover {
            background-color: #1C86EE;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .movie-card {
                flex-direction: column;
            }
            .movie-poster {
                border-radius: 20px 20px 0 0;
                height: 400px;
            }
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
                <div class="card-body d-flex flex-column">

                    <h2 class="card-title mb-3">{{ $movie['Title'] }}</h2>

                    <p><strong>📅 Year:</strong> {{ $movie['Year'] }}</p>
                    <p><strong>🎭 Genre:</strong> {{ $movie['Genre'] }}</p>
                    <p><strong>📝 Plot:</strong></p>
                    <p class="text-muted">{{ $movie['Plot'] }}</p>

                    <hr>

                    <div class="mt-auto d-flex flex-wrap">
                        <form method="POST" action="/favorites" class="mr-2 mb-2">
                            {{ csrf_field() }}
                            <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                            <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                            <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">

                            <button type="submit" class="btn btn-favorite">
                                ❤️ Add to Favorite
                            </button>
                        </form>

                        <a href="/movies" class="btn btn-back mb-2">
                            ⬅ Back
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>