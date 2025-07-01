<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | Adavi Trails</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .form-section, .info-section {
            flex: 1 1 450px;
        }

        .form-section h2,
        .info-section h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }

        .form-section p {
            font-size: 15px;
            margin-bottom: 25px;
            color: #666;
        }

        .form-section form input,
        .form-section form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
        }

        .form-section form button {
            background-color: #f27045;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-section form button:hover {
            background-color: #e15e30;
        }

        .info-section p {
            font-size: 15px;
            margin-bottom: 20px;
            color: #555;
        }

        .contact-person {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .contact-person img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .contact-person span {
            font-size: 15px;
            color: #333;
        }

        .social {
            margin-top: 30px;
        }

        .social div {
            margin-bottom: 15px;
            font-size: 15px;
        }

        .social i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            header h1 {
                font-size: 36px;
            }
        }


        /*footer part css*/
        .footer {
            background-color: #111;
            color: #fff;
            font-family: Arial, sans-serif;
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


    </style>
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
            <a href="{{route('guide.reviews')}}">Reviews</a>
            <a href="{{route('guidecontact')}}" class="{{request()->is('guidecontact') ? 'active' : ''}}">Contact</a>
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
        <h1>Contact us</h1>
    </div>
</section>




    <div class="container">
        <!-- Left side form -->
        <div class="form-section">
            <h2>Reach out to us!</h2>
            <p>Got a question? Want to partner with us? Suggestions? Just say hi!</p>
            <form action="#" method="POST">
                <input type="text" name="first_name" placeholder="First name" required>
                <input type="text" name="last_name" placeholder="Last name" required>
                <input type="email" name="email" placeholder="Your Email Address" required>
                <input type="text" name="phone" placeholder="Phone Number">
                <textarea name="message" rows="5" placeholder="Message" required></textarea>
                <button type="submit">SUBMIT</button>
            </form>
        </div>

        <!-- Right side info -->
        <div class="info-section">
            <h2>Customer Care</h2>
            <p>Need help or have a question? Reach out to our awesome team below:</p>
            
            <div class="contact-person">
                <img src="{{ asset('images/contactlogo.jpg') }}" alt="malindu">
                <span>Niraj Malindu<br><small>Customer Care • +94 781400000</small></span>
            </div>

            <div class="contact-person">
                <img src="{{ asset('images/contactlogo.jpg') }}" alt="dinidu">
                <span>Dinidu Priyasad<br><small>Customer Care Lead • +94 69846390</small></span>
            </div>

            <br><br>
            <h3>Other way to connect</h3>
           <div class="social">
                <div><strong>📘 Facebook:</strong> Like us to get updates and content.</div>
                <div><strong>🐦 Twitter:</strong> Follow us @adavitrails for insights & tips.</div>
                <div><strong> ▶ YouTube:</strong> Subscribe for travel vlogs @adavitrails</div>
                <div><strong>🎵 TikTok:</strong> Catch our latest clips @adavitrails</div>
            </div>
        </div>
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
                <li><a href="{{route('guide.dashboard')}}">Home</a></li>
                <li><a href="#">Bookings</a></li>
                <li><a href="{{route('guide.reviews')}}">Reviews</a></li>
                            
            </ul>
            
            <ul>
                <li> <a href="{{route('guidecontact')}}" class="{{request()->is('guidecontact') ? 'active' : ''}}">Contact</a></li>
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