<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us</title>
  <style>

        /*nav css*/
        * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      line-height: 1.6;
      background-color: #ffffff;
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
        /*end of nav css*/



     /*About us css part*/
        .about-section {
        display: flex;
        justify-content: space-between;
        padding: 60px 80px;
        gap: 40px;
        background: linear-gradient(-45deg, #fdfcfb, #e2ebf0, #dbece6, #f3e5f5);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        }
        
        /*change about us background color*/
        @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
        }

        .about-left {
        flex: 1;
        }

        .about-left h2 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 20px;
        }

        .about-left h3 {
        font-size: 20px;
        margin-bottom: 20px;
        color: #444;
        line-height: 1.4;
        }

        .about-left p {
        font-size: 14px;
        color: #666;
        margin-bottom: 16px;
        line-height: 1.6;
        }

        .about-right {
        display: flex;
        align-items: center;
        gap: 30px;
        }

        .image-column {
        display: flex;
        align-items: flex-end;
        gap: 13px;
        }

        .img {
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        object-fit: cover;
        transition: all 0.5s ease;
        }

        .short {
        height: 350px;
        width: 127px;
        }

        .tall {
        height: 400px;
        width: 145px;
        }

        .dots {
        display: flex;
        flex-direction: column;
        gap: 10px;
        }

        

        @keyframes pulse {
            0% { background-color:rgb(86, 211, 249); }
            50% { background-color: rgb(35, 149, 184); }
            100% { background-color: rgb(26, 102, 125); }
        }

        .dots span {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color:  #bbb;
            border-radius: 50%;
            margin: 0 5px;
            transition: background-color 0.4s ease;
            cursor: pointer;
        }

        .dots span:hover {
            background-color:rgb(230, 135, 26);
        }

        .dots span.active {
            animation: pulse 1s infinite;
        }


        @media (max-width: 768px) {
        .about-section {
            flex-direction: column;
            padding: 40px 20px;
        }

        .about-right {
            flex-direction: column;
            gap: 20px;
        }

        .image-column {
            justify-content: center;
        }
        }


  </style>

  <script>


 //About us page image animation
         document.addEventListener("DOMContentLoaded", function () {
            const images = [
                ["about1.jpg", "about2.jpg", "about3.jpg"],
                ["about4.jpg", "about5.jpg", "about6.jpg"],
                ["about7.jpg", "about8.jpg", "about9.jpg"],
                ["about10.jpg", "about11.jpg", "about12.jpg"],
                ["about13.jpg", "about14.jpg", "about15.jpg"]
            ];

            let current = 0;
            const img1 = document.getElementById("img1");
            const img2 = document.getElementById("img2");
            const img3 = document.getElementById("img3");
            const dots = document.querySelectorAll(".dots span");

            function showSlide(index) {
                current = index;
                img1.src = "/storage/" + images[index][0];
                img2.src = "/storage/" + images[index][1];
                img3.src = "/storage/" + images[index][2];

                dots.forEach(dot => dot.classList.remove("active"));
                dots[index].classList.add("active");
            }

            function autoSlide() {
                current = (current + 1) % images.length;
                showSlide(current);
            }

            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                    showSlide(index);
                });
            });

            showSlide(0); // Show the first set on page load
            setInterval(autoSlide, 4500); // Auto slide every 4 seconds
        });
        //finish About us page image animation 

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
            <a href="{{route('guide.reviews')}}">Reviews</a>
            <a href="{{route('guidecontact')}}">Contact</a>
            <a href="{{route('guideabout')}}"  class="{{request()->is('guideabout') ? 'active' : ''}}">About</a>

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
        <h1>WHO ARE WE</h1>
    </div>
</section>






 <div class="about-section animate-on-scroll" id="about-section">
        <div class="about-left">
            <h2 class="animate-on-scroll">About Us</h2>
            <h3 class="animate-on-scroll">Discover the Wild with <br>Adavi Trails!</h3>
            <p class="animate-on-scroll">At Adavi Trails, we believe in creating unforgettable journeys that bring you closer to the heart of nature.</p> 
            <p class="animate-on-scroll">Our mission is to guide you through the untouched beauty of Sri Lanka’s wild landscapes, hidden forests, 
                and cultural treasures. Whether you’re a solo explorer or a group of adventure seekers, we offer curated 
                experiences that blend outdoor thrills with authentic local encounters. With a passionate team of nature 
                lovers and travel experts, Adavi Trails is more than a travel service — it’s your gateway to discover the 
                stories, secrets, and spirit of the wild.
            </p>
            <div class="animate-on-scroll">
                <p>Every trail we offer is crafted with care — from lush rain forests and misty mountain paths to serene 
                    riversides and ancient villages. Safety, sustainability, and respect for local communities are at 
                    the core of everything we do. As you journey with us, you’re not just exploring new destinations; 
                    you’re becoming part of a movement that celebrates eco-conscious travel and meaningful connections. 
                </p>
                <p>Let Adavi Trails lead you off the beaten path and into the soul of adventure.
            </div></p>
        </div>

        <div class="about-right animate-on-scroll">
            <div class="image-column">
                <img id="img1" src="img1.jpg" class="img short animate-on-scroll" alt="Image 1">
                <img id="img2" src="img2.jpg" class="img tall animate-on-scroll" alt="Image 2">
                <img id="img3" src="img3.jpg" class="img short animate-on-scroll" alt="Image 3">
            </div>

            <div class="dots" id="dotContainer">
                <span class="dot active" onclick="showSlide(0)"></span>
                <span class="dot" onclick="showSlide(1)"></span>
                <span class="dot" onclick="showSlide(2)"></span>
                <span class="dot" onclick="showSlide(3)"></span>
                <span class="dot" onclick="showSlide(4)"></span>
            </div>
        </div>
    </div>

</body>
</html>