<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>🎬 Movie App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #87CEFA, #E0F7FA);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #1E90FF, #87CEFA);
        }

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
        }

        .search-input {
            border-radius: 25px;
            padding: 10px 20px;
            max-width: 300px;
        }

        .btn-search {
            border-radius: 25px;
            background-color: #1E90FF;
            color: white;
        }

        #loading {
            display: none;
        }

        .lang-btn {
            border-radius: 20px;
            font-size: 13px;
            padding: 4px 12px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <a class="navbar-brand font-weight-bold" href="#">🎬 Movie App</a>

    <div class="ml-auto d-flex align-items-center">

        <!-- LANGUAGE SWITCHER -->
        <div class="mr-3">
            <a href="/lang/en"
               class="btn btn-sm lang-btn {{ app()->getLocale() == 'en' ? 'btn-primary' : 'btn-light' }}">
                <span class="fi fi-us mr-1"></span> EN
            </a>

            <a href="/lang/id"
               class="btn btn-sm lang-btn {{ app()->getLocale() == 'id' ? 'btn-primary' : 'btn-light' }}">
                <span class="fi fi-id mr-1"></span> ID
            </a>
        </div>

        <!-- FAVORITES -->
        <a href="/favorites" class="btn btn-light btn-sm rounded-pill mr-2">
            <i class="bi bi-star-fill text-warning mr-1"></i>
            {{ __('messages.favorite') }}
        </a>

        <!-- LOGOUT -->
        <form id="logoutForm" method="POST" action="/logout" class="ml-1">
    @csrf
    <button type="button"
            class="btn btn-outline-light btn-sm rounded-pill px-3"
            onclick="confirmLogout()">
        <i class="bi bi-box-arrow-right mr-1"></i>
        Logout
    </button>
</form>

    </div>
</nav>

<div class="container mt-4">

    <h3 class="mb-4 text-center text-primary font-weight-bold">
        {{ __('messages.movie_list') }}
    </h3>

    <!-- SEARCH -->
    <form method="GET" class="d-flex justify-content-center mb-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control search-input mr-2"
               placeholder="{{ __('messages.search_placeholder') }}"
               required>

        <button type="submit" class="btn btn-search">
            {{ __('messages.search') }}
        </button>
    </form>

    <!-- MOVIE LIST -->
    <div class="row" id="movieContainer">
        @include('partials.movie_items')
    </div>

    <!-- LOADING -->
    <div class="text-center my-4" id="loading">
        <div class="spinner-border text-primary"></div>
    </div>

</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
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

    // INFINITE SCROLL
    let page = 1;
    let loading = false;
    let hasMore = true;
    let searchQuery = '{{ request("search") }}';

    function loadMoreMovies() {
        if (loading || !hasMore || !searchQuery) return;

        loading = true;
        page++;

        $('#loading').show();

        $.ajax({
            url: '/movies',
            method: 'GET',
            data: {
                search: searchQuery,
                page: page
            },
            success: function(response) {
                if (!response || response.trim() === '') {
                    hasMore = false;
                    $('#loading').hide();
                    return;
                }

                $('#movieContainer').append(response);
                loading = false;
                $('#loading').hide();
            },
            error: function() {
                loading = false;
                $('#loading').hide();
            }
        });
    }

    let scrollTimeout;

    $(window).on('scroll', function() {
        clearTimeout(scrollTimeout);

        scrollTimeout = setTimeout(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 150) {
                loadMoreMovies();
            }
        }, 200);
    });
</script>

</body>
</html>
