<!DOCTYPE html>
<html>
<head>
    <title>Favorite Movie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .favorite-card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .favorite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="#">⭐ Favorite Movies</a>
    <div class="ml-auto">
        <a href="/movies" class="btn btn-light btn-sm">
            ⬅ Back to Movies
        </a>
    </div>
</nav>

<div class="container mt-4">

    <div class="row">
        @forelse($favorites as $fav)
            <div class="col-md-3 mb-4">
                <div class="card favorite-card h-100">

                    <img src="{{ $fav->poster != 'N/A' ? $fav->poster : 'https://via.placeholder.com/300x445' }}"
                         class="card-img-top"
                         style="height:350px; object-fit:cover;">

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">
                            {{ $fav->title }}
                        </h6>

                        <p class="text-muted">{{ $fav->year }}</p>

                        <form method="POST" action="/favorites/{{ $fav->id }}" class="mt-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-delete btn-sm btn-block">
                                🗑 Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada movie favorit.
                </div>
            </div>
        @endforelse
    </div>

</div>

</body>
</html>