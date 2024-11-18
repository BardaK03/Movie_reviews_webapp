<!-- resources/views/movies/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->name }} - Movie Details</title>
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
</head>
<body>

  <header>
    <h1>{{ $movie->name }} - Movie Details</h1>
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

  <main class="movie-details">
    <div class="movie-card">
      <img src="{{ $movie->poster_url }}" alt="{{ $movie->name }} Poster" class="movie-poster">
      <div class="movie-info">
        <h2>{{ $movie->name }}</h2>
        <p><strong>Production:</strong> {{ $movie->production }}</p>
        <p><strong>Genre:</strong> {{ $movie->genre }}</p>
        <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
        <p><strong>Description:</strong> {{ $movie->description }}</p>
      </div>
    </div>
    @auth
    <<form action="{{ route('reviews.add', $movie->id) }}" method="POST">
    @csrf
    <label for="comment">Your Review:</label>
    <textarea name="comment" id="comment" required></textarea>

    <label for="rating">Rating:</label>
    <select name="rating" id="rating" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <button type="submit">Submit</button>
</form>

    @else
        <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
    @endauth
</section>
    <a href="{{ url('/') }}" class="back-button">Back to Movie List</a>
  </main>

</body>
</html>
