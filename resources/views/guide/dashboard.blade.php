<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adavi Trails</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        

         body, html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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



        /*notification css*/
        .notification-wrapper {
            position: relative;
            margin-left: 15px;
            display:inline-block;
            text-decoration: none;
            color:white;
        }

        .notification-badge {
            position: absolute;
            top: -12px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 80px;
            right: 10px;
            background-color: white;
            color: black;
            width: 250px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            z-index: 9999;
            padding: 10px;
        }

        .notification-item {
            padding: 5px;
            font-size: 12px;
        }

        .notification-item:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }


        .hero {
            height: 100vh;
            background: url('{{ asset('images/background3.jpg') }}') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        .hero-content .small-text {
            font-size: 18px;
            margin-bottom: 10px;
            color: #eee;
            animation:fadeInUp 1s ease-out forwards;
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

        .get-started-btn {
            padding: 12px 24px;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            animation:fadeInUp 1s ease-out forwards;
        }

        .get-started-btn:hover {
            background-color: #e65c00;
        }




       
        .container {
            padding: 2rem;
            animation: fadeIn 1.2s ease-in-out;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .card {
            background-color: #ffffff;
            padding: 1.8rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
            color: #1e293b;
        }

        .card p {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0f172a;
        }

        ul {
            padding-left: 1rem;
        }

        li {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #374151;
        }

        /* Footer Styling */
        .footer {
            background-color: #111;
            color: #fff;
            padding-top: 10px;
        }

        .footer-top {
            height: 40px;
            background: url('wave-line.svg') no-repeat center top;
            background-size: cover;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            padding: 40px 60px;
            flex-wrap: wrap;
            gap: 40px;
        }

        .footer-left {
            max-width: 300px;
        }

        .footer-left .logo {
            width: 40px;
            height: auto;
            margin-bottom: 10px;
        }

        .footer-left .tagline {
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .social-icons a {
            color: white;
            margin-right: 15px;
            font-size: 18px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #ff4d4d;
        }

        .footer-links {
            display: flex;
            gap: 60px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            margin-bottom: 10px;
        }

        .footer-links a {
            text-decoration: none;
            color: white;
            font-size: 14px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #ff4d4d;
        }

        .footer-signup {
            max-width: 300px;
        }

        .footer-signup h4 {
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .footer-signup p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .footer-signup form {
            display: flex;
        }

        .footer-signup input {
            padding: 10px;
            flex: 1;
            border: none;
            outline: none;
            border-radius: 2px 0 0 2px;
        }

        .footer-signup button {
            padding: 10px 16px;
            background-color: #e60000;
            color: white;
            border: none;
            border-radius: 0 2px 2px 0;
            cursor: pointer;
        }

        .footer-bottom {
            background-color: #000;
            padding: 20px 60px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            color: #ccc;
        }

        .footer-bottom a {
            color: #ccc;
            text-decoration: underline;
            margin: 0 5px;
        }

        /*on scroll animation css*/
         .animate-on-scroll {
            opacity: 0;
            transform: translateY(80px);
            transition: all 0.8s ease-out;
            will-change:opacity,transform;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>




    <script>

        function showExtraSection() {
            const section = document.getElementById("extra-section");
            section.style.display = "block";
            section.scrollIntoView({ behavior: "smooth" });
        }



        //on scroll animation
         document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll('.animate-on-scroll');

        function handleScroll() {
            const triggerBottom = window.innerHeight * 0.90;

            elements.forEach(el => {
                const rect = el.getBoundingClientRect();

                if (rect.top < triggerBottom && rect.bottom > 0) {
                    el.classList.add('visible');
                } else {
                    el.classList.remove('visible');
                }
            });
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // initial check
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
                <a href="{{route('guide.dashboard')}}" class="{{request()->is('guide/dashboard') ? 'active' : ''}}">Home</a>
                <a href="{{route('guide.bookings')}}">Bookings</a>
                <a href="{{route('guide.reviews')}}">Reviews</a>
                <a href="{{route('guidecontact')}}">Contact</a>
                <a href="{{route('guideabout')}}">About</a>

            @auth
                <a href="{{ route('profile.edit') }}" title="Profile">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default-user.png') }}" class="profile-icon" alt="Profile">
                </a>
            @endauth

             <!--notification part-->
            @auth
                <!-- Notification Bell Icon -->
            
                    <a href="#" id="notificationDropdown" class="notification-wrapper" onclick="toggleNotificationDropdown()" style="position: relative;">
                        <i class="fa fa-bell" style="color:white; font-size: 20px; position: relative;">
                            @if($unreadNotificationsCount > 0)
                                <span class="notification-badge">{{ $unreadNotificationsCount }}</span>
                            @endif
                        </i>
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="notification-dropdown" id="notificationDropdownMenu">
                        @forelse($notifications as $notification)
                            <div class="notification-item">
                                <strong>{{ $notification->title }}</strong><br>
                                <small>{{ Str::limit($notification->message, 50) }}</small><br>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                <hr>
                            </div>
                        @empty
                            <div class="notification-item text-muted">No new notifications</div>
                        @endforelse
                    </div>
                
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


    <!--intro section -->
<section class="hero">
    <div class="hero-content">
        <p class="small-text">ARE YOU FREE ???</p><br>
        <h1 data-text="GET YOUR TOUR....">GET YOUR TOUR....</h1>
        <button onclick="showExtraSection()" class="get-started-btn"> START NOW!</button>
    </div>
</section>




<section id="extra-section">
    <div class="container">
        <h2 style="margin-bottom: 1.5rem; font-size: 2rem;" class="animate-on-scroll">Your Overview</h2>

        <div class="grid">
            <div class="card animate-on-scroll">
                <h3>Total Trips</h3>
                <p>{{ $totalTrips }}</p>
            </div>

            <div class="card animate-on-scroll">
                <h3>Upcoming Bookings</h3>
                <p>{{ $upcomingBookings->count() }}</p>
            </div>

            <div class="card animate-on-scroll">
                <h3>Reviews</h3>
                <p>{{ $pendingReviews }}</p>
            </div>

            <div class="card animate-on-scroll">
                <h3>Average Rating</h3>
                <p>{{ number_format($averageRating, 1) ?? 'N/A' }} / 5</p>
            </div>
        </div>
    </section>

        <h3 style=" margin: 3rem 2rem; font-size: 1.5rem;" class="animate-on-scroll">Next 5 Upcoming Bookings</h3>
        <ul style="margin: 3rem 2rem;" class="animate-on-scroll">
            @forelse($upcomingBookings as $booking)
                <li>{{ $booking->date }} - {{ $booking->user->name ?? 'Traveler' }}</li>
            @empty
                <li>No upcoming bookings</li>
            @endforelse
        </ul>
    </div>




    <!--footer coding part-->
<footer class="footer">
    <div class="footer-top"></div>

    <div class="footer-content">
        <div class="footer-left animate-on-scroll">
            <img src="{{ asset('images/logo.PNG') }}" alt="Logo" class="logo" />
            <p class="tagline">
            Your trusted travel partner for unforgettable experiences worldwide.<br><strong>ADAVI TRAILS</strong>.
            </p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="footer-links animate-on-scroll">

            <ul>
                <li><a href="{{route('guide.dashboard')}}" class="{{request()->is('guide/dashboard') ? 'active' : ''}}">Home</a></li>
                <li><a href="#">Bookings</a></li>
                <li><a href="{{route('guide.reviews')}}">Reviews</a></li>
                            
            </ul>

            <ul>
                <li> <a href="{{route('guidecontact')}}">Contact</a></li>
                <li><a href="{{route('guideabout')}}">About</a></li>
                 @auth
                    <li>  <a href="{{ route('profile.edit') }}" title="Profile">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default-user.png') }}" class="profile-icon" alt="Profile"> </a>
                    </li>
                @endauth
            </ul>

        </div>


        <div class="footer-signup animate-on-scroll">
            <h4>SIGN UP FOR OFFERS</h4>
            <p>Be the first to know about exclusive deals and travel package, and advance notice on everything we do.</p>
            <form onsubmit="openRegisterForm(event)">
                <input type="email" placeholder="Email" required />
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 Adavi Trails<a href="#">Privacy Policies</a> <a href="#">Cookie Policies</a></p>
        <p>Created by Niraj Malindu</p>
        <p>1100, Gampaha, Sri lanka</p>
    </div>
</footer>
 </body>
</html> 