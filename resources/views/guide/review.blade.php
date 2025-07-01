<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Guide Reviews</title>
  <style>


  * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            color: #333;
        }

        .header {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 22px;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav a:hover,
        .nav a.active {
            color: orange;
        }

        .auth-buttons button {
            margin-left: 10px;
            padding: 8px 15px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .signup {
            background-color: orange;
            color: white;
        }

        .login {
            background-color: #ff8000;
            color: white;
        }

        .profile-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            vertical-align: middle;
            margin-left: 15px;
        }

          .hero {
            height: 50vh;
            background: url('{{ asset('images/background2.jpg') }}') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        

        /*text animation part when page load*/
        @keyframes fadeInUp  {
            from{
                opacity:0;
                transform:translateY(40px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }


        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
            animation:fadeInUp 1s ease-out forwards;
            position:relative;
            color: #ffffff;
            letter-spacing:1px;
            overflow:hidden;
        }
        .hero-content h1::before{
            position:absolute;
            content:attr(data-text);
            top:0;
            left:0;
            white-space:nowrap;
            width:0;
            color: rgba(0,237,245,1);
            border-right: 2px solid rgba(0,237,245,1);
            overflow: hidden;
            animation:animate 7s linear infinite;
        }
        
        /*animation part h1*/
        @keyframes animate {
            0%,10%,100%{
                width:0;
            }
            70%,90%{
                width:100%;
            }
        }



   


    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 20px 40px;
    }

    .card-row {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .card {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      flex: 1;
      min-width: 280px;
    }

    .card h2 {
      font-size: 36px;
      margin: 0 0 10px;
      color: #222;
    }

    .card p {
      font-size: 14px;
      color: #666;
    }

    .stars {
      font-size: 20px;
      color: #fbc02d;
      margin-top: 5px;
    }

    .graph-card .label {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }

    .bar-row {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      font-size: 14px;
    }

    .bar-label {
      width: 60px;
      color: #444;
    }

    .bar {
      flex: 1;
      height: 10px;
      background: #e0e0e0;
      margin: 0 10px;
      border-radius: 5px;
      overflow: hidden;
    }

    .bar-fill {
      height: 100%;
      background: #0096a0;
    }

    .bar-count {
      width: 30px;
      text-align: right;
      color: #444;
    }

    .sort-container {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    select {
      padding: 8px 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .review-card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .review-card img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
    }

    .review-content {
      flex-grow: 1;
    }

    .review-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }

    .name {
      font-weight: 600;
      font-size: 16px;
      color: #222;
    }

    .date {
      font-size: 13px;
      color: #888;
    }

    .comment-stars {
      color: #fbc02d;
      font-size: 16px;
      margin-bottom: 6px;
    }

    .comment {
      font-size: 15px;
      color: #444;
      margin-bottom: 10px;
    }

    .actions {
      font-size: 13px;
      color: #007bff;
    }

    .actions span {
      margin-right: 15px;
      cursor: pointer;
    }

   



  </style>


    <script>
        document.getElementById('sort').addEventListener('change', function () {
            const order = this.value;
            const container = document.querySelector('.container');
            const cards = Array.from(document.querySelectorAll('.review-card'));

            cards.sort((a, b) => {
                const dateA = parseInt(a.dataset.date);
                const dateB = parseInt(b.dataset.date);

                return order === 'oldest' ? dateA - dateB : dateB - dateA;
            });

            // Remove and re-append sorted cards
            cards.forEach(card => container.appendChild(card));
        });


        
    </script>


</head>
<body>



<header class="header">
    <div class="logo">
        <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
        <span>ADAVI TRAILS</span>
    </div>

    <nav class="nav">
            <a href="{{route('guide.dashboard')}}">Home</a>
            <a href="{{route('guide.bookings')}}">Bookings</a>
            <a href="{{route('guide.reviews')}}" class="{{request()->is('guide/reviews') ? 'active' : ''}}">Reviews</a>
            <a href="{{route('guidecontact')}}">Contact</a>
            <a href="{{route('guideabout')}}">About</a>

        @auth
            <a href="{{ route('profile.edit') }}" title="Profile">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default-user.png') }}" class="profile-icon" alt="Profile">
            </a>
        @endauth
    </nav>

    <div class="auth-buttons">
        @guest
            <a href="{{ route('register') }}"><button class="signup">SIGNUP</button></a>
            <a href="{{ route('login') }}"><button class="login">LOGIN</button></a>
        @else
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="login">LOG OUT</button>
            </form>
        @endguest
    </div>
</header>


<section class="hero">
    <div class="hero-content">
        <h1> YOUR REVIEWS</h1>
    </div>
</section>

<br><br><br>



  <div class="container">
    <div class="card-row">
      <!-- total reviews card-->
      <div class="card">
        <h2>{{ $totalReviews }}</h2>
        <p>Total Reviews</p>
      </div>

      <!-- average rating card-->
      <div class="card">
        <h2>{{ number_format($averageRating, 1) }}</h2>
        <p>Average Rating</p>
        <div class="stars">
          @for ($i = 1; $i <= 5; $i++)
            @if ($i <= round($averageRating)) ★
            @else ☆
            @endif
          @endfor
        </div>
      </div>

      <!-- overall rating of total reviews , showing by graph card-->
      <div class="card graph-card">
        <div class="label">
          Overall rating of {{ $totalReviews }} 1st-party reviews
        </div>
        @php $total = $totalReviews ?: 1; @endphp
        @for ($i = 5; $i >= 1; $i--)
          @php
            $count = $ratingCounts[$i] ?? 0;
            $percent = ($count / $total) * 100;
          @endphp
          <div class="bar-row">
            <div class="bar-label">{{ $i }} Stars</div>
            <div class="bar">
              <div class="bar-fill" style="width: {{ $percent }}%"></div>
            </div>
            <div class="bar-count">{{ $count }}</div>
          </div>
        @endfor
      </div>
    </div>




    <div class="sort-container">
      <label for="sort">Sort by: </label>&nbsp;
      <select id="sort">
        <option value="newest">Newest First</option>
        <option value="oldest">Oldest First</option>
      </select>
    </div>


    

    @foreach($reviews as $review)
  <div class="review-card" data-date="{{ $review->created_at->timestamp }}">
    <img src="{{ asset('storage/' . $review->user->profile_picture) }}" alt="User" />
      <div class="review-content">
        <div class="review-header">
          <div class="name">{{ $review->user->name }}</div>
          <div class="date">{{ $review->created_at->format('d M Y') }}</div>
        </div>
        <div class="comment-stars">
          @for($i = 1; $i <= 5; $i++)
            @if($i <= $review->rating) ★
            @else ☆
            @endif
          @endfor
        </div>
        <div class="comment">
          {{ $review->comment }}
        </div>
        <div class="actions">
          <span>Public Comment</span>
          <span>Direct Message</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  
</body>
</html>
