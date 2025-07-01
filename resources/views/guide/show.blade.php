<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guide Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-bug2vX4lDr5VW3I2x6nX9/9DEmYvOd8wA0guD9eGZ9VqMZ4Zx1xfnJCDVtfx/nWrTX9FUz7JER3D8fUZ+w97Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background: #f4f7f9;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card h2, .card h4 {
            margin-bottom: 15px;
        }

        .guide-info {
            text-align: center;
        }

        .guide-info img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn i { margin-right: 5px; }

        .btn-primary { background-color: #007bff; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger  { background-color: #dc3545; color: white; }

        #reviewForm {
            display: none;
            margin-top: 20px;
        }

        textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .review-box {
            display: flex;
            gap: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .review-box img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .review-content h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .review-content p {
            margin: 4px 0;
        }

        .action-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .alert {
            padding: 10px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-danger  { background-color: #f8d7da; color: #721c24; }

        .info-icon {
            margin-right: 6px;
            color: #007bff;
        }

    </style>


    <script>
        function toggleReviewForm() {
            const form = document.getElementById('reviewForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>



</head>
<body>

<div class="container">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-times-circle"></i> {{ session('error') }}</div>
    @endif

    {{-- Guide Info --}}
    <div class="card guide-info">
        <img src="{{ $guide->profile_picture ? asset('storage/' . $guide->profile_picture) : asset('images/default-user.png') }}" alt="Guide">
        <h2>{{ $guide->name }}</h2>
        <p><i class="fas fa-envelope info-icon"></i> {{ $guide->email }}</p>
        <p><i class="fas fa-phone info-icon"></i> {{ $guide->phone }}</p>
        <p><i class="fas fa-clock info-icon"></i> <strong>Availability:</strong> {{ $guide->guide->availability }}</p>
        <p><i class="fas fa-briefcase info-icon"></i> <strong>Experience:</strong> {{ $guide->guide->experience }} years</p>
        <p><i class="fas fa-align-left info-icon"></i> {{ $guide->guide->description }}</p>

        <button class="btn btn-primary" onclick="toggleReviewForm()">
            <i class="fas fa-pen"></i> Write a Review
        </button>
    </div>

    {{-- Review Form --}}
    <div class="card" id="reviewForm">
        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="guide_id" value="{{ $guide->id }}">
            <textarea name="comment" rows="4" placeholder="Write your review..." required></textarea>
            <select name="rating" required>
                <option value="">-- Select Rating --</option>
                <option value="1">1 ⭐</option>
                <option value="2">2 ⭐</option>
                <option value="3">3 ⭐</option>
                <option value="4">4 ⭐</option>
                <option value="5">5 ⭐</option>
            </select>
            <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> Submit Review</button>
        </form>
    </div>

    {{-- My Reviews --}}
    @php
        $myReviews = $guide->reviews->where('user_id', auth()->id());
    @endphp

    @if($myReviews->count())
        <div class="card">
            <h4><i class="fas fa-user-check"></i> Your Reviews</h4>
            @foreach($myReviews as $review)
                <div class="review-box">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default-user.png') }}" alt="You">
                    <div class="review-content">
                        <h5>You</h5>
                        <p>{{ $review->comment }}</p>
                        <p><i class="fas fa-star info-icon"></i> <strong>Rating:</strong> {{ $review->rating }} ⭐</p>
                        <p><strong>Status:</strong> {{ ucfirst($review->status) }}</p>
                        <div class="action-buttons">
                            <a class="btn btn-warning" href="{{ route('reviews.edit', $review->id) }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" onsubmit="return confirm('Are you sure to delete your review?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- All Reviews --}}
    <div class="card">
        <h4><i class="fas fa-comments"></i> All Reviews</h4>
        @forelse($guide->reviews as $review)
            @if($review->user)
                <div class="review-box">
                    <img src="{{ $review->user->profile_picture ? asset('storage/' . $review->user->profile_picture) : asset('images/default-user.png') }}" alt="User">
                    <div class="review-content">
                        <h5>{{ $review->user->name }}</h5>
                        <p>{{ $review->comment }}</p>
                        <p><i class="fas fa-star info-icon"></i> <strong>Rating:</strong> {{ $review->rating }} ⭐</p>
                        <p><strong>Status:</strong> {{ ucfirst($review->status) }}</p>
                    </div>
                </div>
            @endif
        @empty
            <p>No reviews yet.</p>
        @endforelse
    </div>

</div>



</body>
</html>