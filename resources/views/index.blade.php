<!-- resources/views/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Reviews</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

  <header>
    <h1>Movie Reviews</h1>
    <nav>
      @if (Route::has('login'))
        @auth
          <a href="{{ url('/dashboard') }}" class="nav-link">My Account</a>
        @else
          <a href="{{ route('login') }}" class="nav-link">Log in</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-link">Register</a>
          @endif
        @endauth
      @endif
    </nav>
  </header>

  <main>
    <div class="movie-list" id="movieList">
      @foreach ($movies as $movie)
        <a href="{{ route('movies.show', ['id' => $movie->id]) }}" class="movie-card">
          <img src="{{ $movie->poster_url ?? 'https://via.placeholder.com/200x300?text=No+Image' }}" alt="{{ $movie->name }} Poster">
          <div class="movie-info">
            <h3 class="movie-title">{{ $movie->name }}</h3>
            <p class="movie-description">{{ $movie->description }}</p>
          </div>
        </a> 
      @endforeach
    </div>
  </main>

</body>
</html>
