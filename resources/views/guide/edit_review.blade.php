<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 40px; }
        .box { background: white; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
        .btn { background: #3498db; color: white; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background: #2980b9; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Edit Your Review</h2>
        <form method="POST" action="{{ route('reviews.update', $review->id) }}">
            @csrf
            @method('PUT')

            <label for="rating">Rating (1 to 5):</label><br>
            <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}" required><br><br>

            <label for="comment">Comment:</label><br>
            <textarea name="comment" required>{{ $review->comment }}</textarea><br>

            <button type="submit" class="btn">Update Review</button>
        </form>
    </div>
</body>
</html>