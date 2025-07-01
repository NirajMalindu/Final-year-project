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

        .search-description {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px 30px;
            background-color: #f9f9f9;
            border-left: 6px solid orange;
            border-radius: 8px;
            font-size: 16px;
            line-height: 1.6;
            color: #444;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .search-section {
            text-align: center;
            margin: 30px 0;
            animation: view 5s linear;
            animation-timeline:view();
            animation-range: entry 0% cover 25%;

        }

        @keyframes view {
            from{
                opacity:0;
                clip-path:inset(100% 0 100% 0);
            }
            to{
                opacity:1;
                clip-path:inset(0 0 0 0);
            }
        }




        
    /* Activity Card Styling */
        .activity-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 20px;
            position: relative;
            padding-left:70px;
            overflow: hidden;
        }

        .activity-card {
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

        .card-overlay {
            position: relative;
            width: 100%;
            padding: 16px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            box-sizing: border-box;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-overlay h3 {
            margin: 0;
            font-size: 22px;
        }

        .card-overlay .price {
            margin-top: 4px;
            color: #ffcc00;
            font-size: 14px;
        }

        .card-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .card-buttons .btn {
            flex: 1;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #ff7b00;
            color: white;
        }

        .btn-secondary {
            background-color: #ffffff10;
            color: #ff7b00;
            border: 1px solid #ff7b00;
        }

        .activity-card:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease-in-out;
        }

        .activity-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: white;
            border: none;
            color: rgb(6, 6, 6);
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            z-index: 10;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: opacity 0.2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-nav-btn:hover {
            opacity: 1;
        }

        #prev-btn {
            left: 10px;
        }

        #next-btn {
            right: 10px;
        }


/* activity card dots*/
        .carousel-dots {
            display: flex;
            gap: 8px;
            overflow: hidden;
            padding: 10px 30px;
            margin-top: 20px;
            justify-content: center;
            position: relative;
            scroll-behavior: smooth;
        }

        .carousel-dot {
            width: 10px;
            height: 10px;
            background-color: #bbb;
            border-radius: 50%;
            flex: 0 0 auto;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s, background-color 0.3s;
        }

        .carousel-dot.active {
            background-color: #ff7b00;
            opacity: 1;
        }

        .carousel-dot.fade {
            opacity: 0.1;
            pointer-events: none;
        }

        .carousel-dots::before,
        .carousel-dots::after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            width: 30px;
            z-index: 1;
            pointer-events: none;
        }

        .carousel-dots::before {
            left: 0;
            background: linear-gradient(to right, white, transparent);
        }

        .carousel-dots::after {
            right: 0;
            background: linear-gradient(to left, white, transparent);
        }
        /* complete (close)Activity Card Styling */





        h3 {
            margin: 0;
        }

        .destination-wrapper {
            padding: 40px 80px;
        }

        .destination-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            overflow: hidden;
        }






        /*gallery link part*/
        .gallery {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 100px;
            text-align: left;
            flex-wrap: wrap;
            margin-left:20px;
        }

            /* Left: Text content */
        .gallery-content {
            max-width: 400px;
            color: #fff;
         }

        .gallery-logo {
            width: 90px;
            margin-bottom: 30px;
            margin-left:40px;
        }

        .gallery h1 {
            font-size: 26px;
            font-weight: 400;
            margin-bottom: 20px;
            color: #040404;
        }

        .gallery p {
            font-size: 16px;
            line-height: 1.7;
            color:rgb(36, 33, 33);
            margin-bottom: 20px;
             
        }

        .gallery-button {
            background-color: #3e434a;
            border: none;
            color: white;
            padding: 12px 28px;
            font-size: 14px;
            letter-spacing: 1px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .gallery-button:hover {
            background-color: #4f565e;
        }

            /* Right: Floating images */
        .floating-images {
            position: relative;
            width: 500px;
            height: 300px;
            margin-right:140px;
        }

        .gallery-img {
            position: absolute;
            width: 170px;
            height: 270px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

            /* Rotated cards */
        .img1 { top: 20px; left: 50px; transform: rotate(-12deg); z-index: 1; }
        .img2 { top: 0px; left: 180px; transform: rotate(-5deg); z-index: 2; }
        .img3 { top: 40px; left: 310px; transform: rotate(2deg); z-index: 3; }
        .img4 { top: 60px; left: 440px; transform: rotate(6deg); z-index: 4; }

        .gallery-img:hover {
            transform: scale(1.05) rotate(0deg);
            z-index: 10;
        }

            /* Responsive */
        @media (max-width: 1024px) {
            .gallery {
                flex-direction: column;
                text-align: center;
                align-items:center;
                padding:60px 20px;
            }

            .gallery-content {
                margin-bottom: 60px;
                text-align: center;
                max-width:90%;

            }

            .floating-images {
                transform: scale(0.9);
                max-width:100%;
              }
        }


/*mobile version*/
        @media (max-width: 768px) {
            .floating-images {
                height: 400px;
                transform: scale(0.8);
            }

            .img {
                width: 190px;
                height: 240px;
            }

            .img1 { left: 10px; }
            .img2 { left: 90px; }
            .img3 { left: 170px; }
            .img4 { left: 250px; }
            .img5 { left: 330px; }
        }

        

        @media (max-width: 500px) {
            .floating-images {
                height: 350px;
                transform: scale(0.7);
            }

            .img {
                width: 180px;
                height: 210px;
            }

            .img1 { left: 0px; }
            .img2 { left: 70px; }
            .img3 { left: 140px; }
            .img4 { left: 210px; }
            .img5 { left: 280px; }
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

        



        /*show some information(sum of travelers,....) css part*/
        .stats-section {
            color: #fff;
            padding: 60px 20px;
            text-align: center;
        }

        .stats-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .stat-card {
            background:rgb(43, 43, 43);
            padding: 30px;
            border-radius: 12px;
            width: 200px;
            text-align: center;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease;
            animation: appear 5s linear;
            animation-timeline:view();
            animation-range: entry 0% cover 32%;

        }

        @keyframes appear {
            from{
                opacity:0;
                scale:0;
            }
            to{
                opacity:1;
                scale:1;
            }
        }

        
        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #f76b1c;
        }

        .stat-card h2 {
            font-size: 2.5rem;
            margin: 10px 0;
        }

        .stat-card p {
            font-size: 1rem;
            color: #aaa;
        }
        /*end of show some information(sum of travelers,....) css part*/





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


        /*about us button css code*/
        .read-more-button {
            display: flex;
            align-items: center;
            padding: 5px 14px;
            border: none;
            border-radius: 40px;
            background-color: #ff8000;
            color: white;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: 0.3s ease;
            margin-top: 14px;
        }

        .read-more-button .arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            margin-left: 6px;
            background-color: rgba(255, 255, 255, 0.15); /* slight background */
            border-radius: 50%;
        }

        .read-more-button .arrow::after {
            content: none; 
        }

        .read-more-button .arrow > span {
            font-size: 13px;
            line-height: 1;
        }

        .read-more-button:hover {
            transform: scale(1.05);
        }
        /*end of about us button css code*/







        /*contact us css part*/
        .contact-us{
            color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 100px 20px;
        }
        
        .container {
            max-width: 400px;
            padding: 20px;
            margin: 0;
            padding: 0;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .agent-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 30px;
        }

        .contact-h1 {
            font-size: 36px;
            margin: 0;
            line-height: 1.3;
        }

        .contact-p {
            font-size: 16px;
            color:rgb(45, 44, 44);
            margin: 20px 0;
        }
 
        .contact-button {
            background-color: #333a45;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            letter-spacing: 1px;
        }

        .contact-button:hover {
            background-color: #444d5b;
        }




        /*footer part css*/
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
    
    
    </style>




    <script>
        function showExtraSection() {
            const section = document.getElementById("extra-section");
            section.style.display = "block";
            section.scrollIntoView({ behavior: "smooth" });
        }

        //link about in nav bar
        function showAboutSection() {
            const section = document.getElementById("about-section");
            section.scrollIntoView({ behavior: "smooth" });
        }


        //notification script part
        function toggleNotificationDropdown() {
                const dropdown = document.getElementById('notificationDropdownMenu');
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }

            // Optional: Close dropdown on outside click
            window.addEventListener('click', function(e) {
                const bell = document.getElementById('notificationDropdown');
                const dropdown = document.getElementById('notificationDropdownMenu');
                if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
            //end
        


        //Activity scroll script part 
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('activity-container');
            const cards = document.querySelectorAll('.activity-card');
            const nextBtn = document.getElementById('next-btn');
            const prevBtn = document.getElementById('prev-btn');
            const dotsContainer = document.getElementById('carousel-dots');

            const cardWidth = 270;
            let currentIndex = 0;
            const maxVisibleDots = 4;

            function scrollToIndex(index) {
                index = Math.max(0, Math.min(index, cards.length - 1));
                container.scrollTo({
                    left: index * cardWidth,
                    behavior: 'smooth'
                });
                currentIndex = index;
                renderDots();
            }

            function renderDots() {
                dotsContainer.innerHTML = '';
                const total = cards.length;

                let start = currentIndex - Math.floor(maxVisibleDots / 2);
                let end = currentIndex + Math.floor(maxVisibleDots / 2);

                if (start < 0) {
                    end += -start;
                    start = 0;
                }
                if (end > total - 1) {
                    start -= (end - (total - 1));
                    end = total - 1;
                }

                start = Math.max(0, start);

                for (let i = start; i <= end && i < total; i++) {
                    const dot = document.createElement('span');
                    dot.classList.add('carousel-dot');
                    dot.setAttribute('data-index', i);
                    if (i === currentIndex) dot.classList.add('active');

                    // Fading for outermost dots
                    if ((i === start || i === end) && end - start + 1 === maxVisibleDots) {
                        dot.classList.add('fade');
                    }

                    dot.addEventListener('click', () => scrollToIndex(i));
                    dotsContainer.appendChild(dot);
                }
            }

            nextBtn.addEventListener('click', () => scrollToIndex(currentIndex + 1));
            prevBtn.addEventListener('click', () => scrollToIndex(currentIndex - 1));

            container.addEventListener('scroll', () => {
                const newIndex = Math.round(container.scrollLeft / cardWidth);
                if (newIndex !== currentIndex) {
                    currentIndex = newIndex;
                    renderDots();
                }
            });

            renderDots(); // Initialize
        });






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

        


        //footer will open register pae when click subscribe
        function openRegisterForm(event){
            event.preventDefault();
            window.location.href = "{{url('/register')}}";//route to register page
        } 


    </script>



</head>

<body>
<header class="header">
    <div class="logo">
        <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
        <span>ADAVI TRAILS</span>
    </div>

    <nav class="nav">
        <a href="#" class="active">HOME</a>
        <a onclick="showExtraSection()">JOURNEY</a>
        <a href="{{route('gallery')}}">GALLERY</a>
        @auth
        <a href="{{ route('itinerariesshow') }}">TOUR LIST</a>
        <a href="{{ route('booking.history') }}">BOOKING HISTORY</a>
        @endauth
        <a onclick="showAboutSection()">ABOUT US</a>
        <a href="{{route('contact')}}" class="{{request()->is('contact') ? 'active' : ''}}">CONTACT US</a>

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
        <p class="small-text">TIRED OF A BUSY LIFE ???</p><br>
        <h1 data-text="TAKE A RELAX TOUR....">TAKE A RELAX TOUR....</h1>
        <button onclick="showExtraSection()" class="get-started-btn">GET STARTED WITH US!</button>
    </div>
</section>


<div id="extra-section">
    <h2 style="text-align: center; margin-top: 50px; font-size: 36px; color: #333;" class="animate-on-scroll">Welcome to Adavi Trails</h2>
    <div class="search-description animate-on-scroll">
        <p>
            Our powerful search bar lets you quickly find activities, destinations, or attractions by simply typing in a name or location.
            Whether you're looking for a peaceful getaway or an adventure-packed spot, the search tool instantly filters and displays the most relevant options — complete with descriptions and images — to help you plan your next unforgettable journey with ease.
        </p>
    </div>





    <!-- Search Section -->
    <div class="search-section ">
        <form method="GET" action="{{ route('activities.search') }}">
            <!--Search box-->
            <input type="text" name="query" placeholder="Search by Name or Location"
                style="padding:10px; width:300px; border-radius:5px; border:1px solid #ccc;"
                value="{{ request('query') }}">
            <!--search button-->
            <button type="submit"
                    style="padding: 10px 20px; border:none; background-color:orange; color: white; border-radius:5px;">
                Search
            </button>
        </form>
    </div>
</div>





    <!--Activities section -->
<br><h2 style="text-align: center; margin-top: 60px;" id="journey">Popular Activities</h2>


<!-- Display activities or show message -->
@if($activities->isEmpty())
    <p style="text-align:center; color:gray; margin-top:30px;">
        No activities found for "{{ request('query') }}"
    </p>
@else
    <!-- Carousel Wrapper -->
    <div class="activity-wrapper animate-on-scroll" style="position: relative;">

        <!-- Left Scroll Button -->
        <button id="prev-btn" class="activity-nav-btn" style="left: 0;">&lt;</button>

        <!-- Activity Container -->
        <div class="activity-container" id="activity-container">
            @foreach($activities as $index => $activity)
                <div class="activity-card" data-index="{{ $index }}" style="background-image: url('{{ asset('storage/' . $activity->image) }}');">
                    <div class="card-overlay">
                        <h3>{{ $activity->name }}</h3>
                        <p class="price">Rs. {{ number_format($activity->cost, 2) }}</p>
                        <div class="card-buttons">
                            @auth
                            <a href="{{ url('/itinerary/create/' . $activity->id) }}">
                                <button class="btn btn-primary">Book Now</button>
                            </a>
                            @else
                            <a href="{{route('login')}}" class="submit-btn">
                                 <button class="btn btn-primary">Book Now</button>
                            </a>
                            @endauth
                            <a href="{{ url('/activities/' . $activity->id) }}">
                                <button class="btn btn-secondary">See More</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Right Scroll Button -->
        <button id="next-btn" class="activity-nav-btn" style="right: 0;">&gt;</button>

        <!-- Dot Indicators -->
        <div id="carousel-dots" class="carousel-dots">
        @foreach($activities as $index => $activity)
            <span class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
        @endforeach
    </div>


    </div>
@endif






<!--if user search a place or location , matching destination info will show-->
@if(request('query') && isset($destinations) && $destinations->isNotEmpty())
    <h3 style="text-align:center; margin-top: 50px; color: #333; font-size: 28px;">Matching Destinations</h3>
    <div class="destination-wrapper">
        <!--destination info card-->
        @foreach($destinations as $destination)
            <div class="destination-card">
                <div style="display: flex; flex-wrap: wrap;">
                    <!--Destination card image-->
                    <div style="flex: 1; min-width: 280px;">
                        <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}"
                             style="width: 90%; height: auto; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                    </div>
                    <div style="flex: 2; padding: 25px;">
                        <h2 style="color: #333; font-size: 26px; margin-bottom: 10px;">{{ $destination->name }}</h2>
                        <p style="color: #777; margin-bottom: 5px;"><strong>Location:</strong> {{ $destination->location }}</p>
                        <p style="color: #555; margin-bottom: 15px;">{{ $destination->description }}</p>

                       

                         <!-- Attraction part inside in destination -->
                        @if($destination->attractions->isNotEmpty())
                            <div>
                                <h4 style="color: #ff6600; margin-bottom: 10px;">Top Attractions:</h4>
                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                    @foreach($destination->attractions as $attraction)
                                        <div style="width: 220px; border: 1px solid #eee; border-radius: 8px; overflow: hidden; background-color: #f9f9f9;">
                                            <img src="{{ asset('storage/' . $attraction->image) }}" alt="{{ $attraction->name }}" style="width: 100%; height: 140px; object-fit: cover;">
                                            <div style="padding: 10px;">
                                                <h5 style="margin: 0 0 5px; font-size: 16px; color: #333;">{{ $attraction->name }}</h5>
                                                <p style="font-size: 14px; color: #666;">{{ \Illuminate\Support\Str::limit($attraction->description, 100) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p style="color: gray; margin-top: 15px;">No attractions available for this destination.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif



    <br><br><hr style="border:2px solid; color:rgb(12, 198, 245); width:70%; margin:40px auto;" class="animate-on-scroll">




    <!--link to gallery page-->
    <section class="gallery">
        <div class="gallery-content">
        <img src="{{ asset('images/Compass-Logo.png') }}" alt="Compass Logo" class="gallery-logo animate-on-scroll"><br><br>
        <h1 class="animate-on-scroll">🌿 Step into the Heart of Our Adventures! ✨</h1><br>
            <p class="animate-on-scroll">
                Words can only do so much — but pictures? <br>
                Every journey leaves behind traces — laughter in the wind,
                <br> footprints on trails, and memories frozen in time.<br>
                Dive into our gallery to explore the breathtaking views, <br>
                vibrant culture, and unforgettable experiences that define Adavi Trails.<br>
            </p><br>
            <a href="{{route('gallery')}}">
                <button class="gallery-button animate-on-scroll">Visit Our Gallery</button>
             </a>
        </div>

        <div class="floating-images">
        <img src="{{ asset('images/gallery1.jpg') }}" class="gallery-img img1" alt="template 1" />
        <img src="{{ asset('images/gallery2.jpg') }}" class="gallery-img img2" alt="template 2" />
        <img src="{{ asset('images/gallery3.jpg') }}" class="gallery-img img3" alt="template 3" />
        <img src="{{ asset('images/gallery4.jpg') }}" class="gallery-img img4" alt="template 4" />
        </div>
    </section>


    <hr style="border:2px solid; color:rgb(12, 198, 245); width:70%; margin:40px auto;" ><br>





    
<!--show some information(sum of traveler,guides,activities,reviews)--> 
<section class="stats-section animate-on-scroll">
    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h2>{{ $travelerCount }}</h2>
            <p>Members</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-user-tie"></i>
            <h2>{{ $guideCount }}</h2>
            <p>Guides</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-map-marked-alt"></i>
            <h2>{{ $activityCount }}</h2>
            <p>Activities</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-star"></i>
            <h2>{{ $reviewCount }}</h2>
            <p>Reviews</p>
        </div>
    </div>
</section>



    <!--About us part-->
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
            </div>

            <!--about us button-->
            <a href="{{route('about')}}">
                <button class="read-more-button animate-on-scroll">
                    READ MORE
                    <div class="arrow"><span>&#x276F;</span></div>
                </button>
            </a>
            </p>
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

    <br><br>



    <!--Contact us part-->
    <div class="contact-us ">
        <div class="container">
            <img src="{{ asset('images/contactlogo.jpg') }}" alt="Agent Photo" class="agent-photo animate-on-scroll" />
            <h1 class="contact-h1 animate-on-scroll">Contact our<br>agent.</h1><br>
            <p class="contact-p animate-on-scroll">Have questions, suggestions, or just want to say hello?
                <br> we're here to help and would love to hear from you!
            </p><br><br>
            <a href="{{route('contact')}}">
             <button class="gallery-button animate-on-scroll">GET STARTED NOW</button>
            </a>
        </div>
        <br><br>
    </div>
    <br><br><br>




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
                <li><a href="#">HOME</a></li>
                <li><a onclick="showExtraSection()">JOURNEY</a></li>
                <li><a href="#">GALLERY</a></li>
                            
            </ul>
            <ul>
                <li><a href="#">TOUR LIST</a></li>
                <li><a href="#">BOOKING HISTORY</a></li>
                <li><a onclick="showAboutSection()">ABOUT US</a></li>
                <li><a href="{{route('contact')}}">CONTACT US</a></li>
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