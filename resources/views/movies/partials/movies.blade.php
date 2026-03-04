@foreach($movies as $movie)
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
@endforeach