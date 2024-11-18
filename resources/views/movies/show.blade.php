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
    
    <h3>Reviews</h3>
    @foreach($movie->reviews as $review)
    <div class="review">
        <p><strong>User:</strong> {{ $review->user->name }}</p>
        <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
        <p><strong>Comment:</strong> {{ $review->comment }}</p>

        @auth
            @if(auth()->id() == $review->user_id) <!-- Check if the logged-in user is the author -->
                <!-- Edit Review Form -->
                <button class="btn btn-warning" onclick="toggleEditForm({{ $review->id }})">Edit</button>

                <!-- Edit Form (Hidden by default) -->
                <div id="edit-form-{{ $review->id }}" class="edit-form" style="display:none;">
                    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" class="form-control" rows="5" required>{{ $review->comment }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <select name="rating" class="form-control" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Review</button>
                    </form>
                    
                    <!-- Delete Review Form -->
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Review</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
@endforeach


    @auth
        <h3>Add a Review</h3>
        <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comment">Your Review:</label>
                <textarea name="comment" id="comment" required class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" required class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
    @endauth

    <a href="{{ url('/') }}" class="back-button">Back to Movie List</a>
  </main>

  <script>
    // Toggle visibility of the edit form for the specific review
    function toggleEditForm(reviewId) {
        const editForm = document.getElementById('edit-form-' + reviewId);
        if (editForm.style.display === 'none' || editForm.style.display === '') {
            editForm.style.display = 'block';
        } else {
            editForm.style.display = 'none';
        }
    }
  </script>

</body>
</html>
