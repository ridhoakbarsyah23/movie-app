<!DOCTYPE html>
<html>
<head>
    <title>Favorite Movies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #87CEFA, #E0F7FA);
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar-custom {
            background: linear-gradient(90deg, #1E90FF, #87CEFA);
        }
        .navbar-brand {
            font-weight: 600;
        }
        .navbar .btn {
            font-size: 0.9rem;
            padding: 6px 12px;
        }

        /* Favorite card */
        .favorite-card {
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }
        .favorite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .favorite-card img {
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .favorite-card img:hover {
            transform: scale(1.05);
        }
        .card-body h6 {
            color: #1E3A8A;
            font-weight: 600;
        }
        .card-body p {
            color: #555;
        }

        /* Delete button */
        .btn-delete {
            background-color: #FF6B6B;
            color: white;
            border-radius: 12px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-delete:hover {
            background-color: #FF4C4C;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .favorite-card img {
                height: 250px;
            }
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
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card favorite-card h-100">

                    <img src="{{ $fav->poster != 'N/A' ? $fav->poster : 'https://via.placeholder.com/300x445' }}"
                         class="card-img-top">

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $fav->title }}</h6>
                        <p class="text-muted">{{ $fav->year }}</p>

                        <form method="POST" action="/favorites/{{ $fav->id }}" class="mt-auto delete-form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="button" class="btn btn-delete btn-sm btn-block" onclick="confirmDelete(this)">
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

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Movie ini akan dihapus dari favorit!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        })
    }
</script>

</body>
</html>