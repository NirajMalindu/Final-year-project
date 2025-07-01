<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gallery - ADAVI TRAILS</title>

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

    

        /* Tags Section */
        .tags-section {
            text-align: center;
            padding: 60px 20px 30px;
        }
        .tags-section h2 {
            font-size: 28px;
            margin-bottom: 30px;
        }
        .tags {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .tag {
            border: 2px solid #0b78c2;
            background-color: white;
            color: #0b78c2;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            user-select: none;
        }
        .tag:hover,
        .tag.active {
            background-color: #0b78c2;
            color: white;
        }

        /* Gallery */
        .gallery-section {
            display: none;
            padding: 40px 20px;
        }
        .gallery-section.active {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .gallery-item img {
            flex: 0 0 auto;
            width: 220px;
            height: 320px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            background-size: cover;
            background-position: center;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: flex-end;
        }
        
        .gallery-item h4 {
            margin-top: 10px;
            font-weight: normal;
            color: #444;
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

         /*gallery link animation*/
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

        function showGallery(tag, button) {
            const sections = document.querySelectorAll('.gallery-section');
            const buttons = document.querySelectorAll('.tag-btn');

            sections.forEach(sec => sec.classList.remove('active'));
            buttons.forEach(btn => btn.classList.remove('active'));

            document.getElementById('gallery-' + tag).classList.add('active');
            button.classList.add('active');
        }



     //gallery content scroll into view
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

  <!-- Header -->
  <header class="header">
    <div class="logo">
        <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
        <span>ADAVI TRAILS</span>
    </div>

    <nav class="nav">
        <a href="{{route('dashboard')}}">HOME</a>
        <a href="/dashboard#journey">JOURNEY</a>
        <a href="{{route('gallery')}}" class="{{request()->is('gallery') ? 'active' : ''}}">GALLERY</a>
        @auth
            <a href="{{ route('itinerariesshow') }}">TOUR LIST</a>
            <a  href="{{ route('booking.history') }}">BOOKING HISTORY</a>
        @endauth
        <a href="{{route('about')}}">ABOUT US</a>
        <a href="{{route('contact')}}" >CONTACT US</a>

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
        <h1>MEMORIES IN FRAMES</h1>
    </div>
</section>




  <!-- Tags Section -->
  <section class="tags-section animate-on-scroll">
    <h2>All images are responsive</h2>
    <div class="tags animate-on-scroll">
      <!-- All tag -->
      <button class="tag tag-btn active" onclick="showGallery('all', this)">All</button>

      @foreach($tags as $tag)
        <button class="tag tag-btn" onclick="showGallery('{{ $tag }}', this)">{{ ucfirst($tag) }}</button>
      @endforeach
    </div>
  </section>
<hr style="border:2px solid; color:rgb(12, 198, 245); width:70%; margin:40px auto;" class="animate-on-scroll">


  <!-- Galleries -->
  <section id="gallery-all" class="gallery-section active animate-on-scroll">
    @foreach($galleryAll as $item)
      <div class="gallery-item animate-on-scroll">
        <img src="{{ asset('uploads/gallery/' . $item->image) }}" alt="{{ $item->title }}"class="animate-on-scroll">
            <h4>{{ $item->title }}</h4>
        </img>
      </div>
    @endforeach
  </section>

  @foreach($tags as $tag)
    <section id="gallery-{{ $tag }}" class="gallery-section animate-on-scroll">
      @foreach($galleriesByTag[$tag] as $item)
        <div class="gallery-item animate-on-scroll">
            <img src="{{ asset('uploads/gallery/' . $item->image) }}" alt="{{ $item->title }}" class="animate-on-scroll">
             <h4>{{ $item->title }}</h4>
            </img>
        </div>
      @endforeach
    </section>
  @endforeach

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
                <li><a  href="{{route('dashboard')}}">HOME</a></li>
                <li><a href="/dashboard#journey">JOURNEY</a></li>
                <li><a href="{{route('gallery')}}">GALLERY</a></li>
                            
            </ul>
            <ul>
                <li><a href="{{ route('itinerariesshow') }}">TOUR LIST</a></li>
                <li><a  href="{{ route('booking.history') }}">BOOKING HISTORY</a></li>
                <li><a href="/dashboard#about-section">ABOUT US</a></li>
                <a href="{{route('contact')}}" class="{{request()->is('contact') ? 'active' : ''}}">CONTACT US</a>
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
