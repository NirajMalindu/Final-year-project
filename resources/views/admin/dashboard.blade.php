<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Styles -->
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f8;
            display: flex;
        }

        .sidebar {
            width: 300px;
            background:rgb(65, 66, 69);
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
        }

        .sidebar .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #ecf0f1;
        }

        .sidebar .profile h2 {
            font-size: 23px;
            margin: 0;
            color:white;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ecf0f1;
            padding: 12px;
            text-decoration: none;
            margin-bottom: 8px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background:rgb(116, 120, 131);
        }

        .sidebar i {
            width: 20px;
            text-align: center;
        }

        .sidebar form.logout-form {
            margin-top: 20px;
            text-align: center;
        }

        .sidebar form.logout-form button {
            background-color: #c0392b;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 15px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .summary-cards {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .card {
            background-color: #ffffff;
            border-left: 6px solid rgb(65, 66, 69);
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            flex: 1 1 18%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            position: relative;
        }

        .card i {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 22px;
            color: #bdc3c7;
        }

        .card h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #2980b9;
        }

        .summary-graph {
            background-color: #ffffff;
            padding: 30px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .summary-graph h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .tables-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            flex: 1 1 30%;
            overflow-x: auto;
        }

        .table-container h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        table th {
            background-color: #f0f3f5;
            color: #34495e;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                left: -200px;
                top: 0;
                transition: 0.3s;
                z-index: 999;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .toggle-btn {
                position: fixed;
                top: 15px;
                left: 15px;
                background-color: #2980b9;
                color: white;
                border: none;
                padding: 10px 15px;
                font-size: 16px;
                cursor: pointer;
                z-index: 1000;
                border-radius: 5px;
            }
        }

            /*admin dashboard scroll into view*/
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
</head>
<body>

<!-- Toggle button -->
<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="profile animate-on-scroll">
         <a href="{{ route('profile.edit') }}" title="Profile">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default-user.png') }}" class="profile-icon" alt="Profile">
            </a>
        <h2>{{ $user->name }}</h2>
    </div>
        <div  class="animate-on-scroll">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('admin.user.management') }}"><i class="fas fa-users"></i> User Management</a>
            <a href="{{ route('admin.places') }}"><i class="fas fa-map-marked-alt"></i> Attraction & Destination</a>
            <a href="{{ route('admin.activities') }}"><i class="fas fa-running"></i> Activity Management</a>
            <a href="{{ route('admin.itineraries.index') }}"><i class="fas fa-route"></i> Itinerary Management</a>
            <a href="{{ route('admin.bookings.index') }}"><i class="fas fa-book"></i> Booking Management</a>
            <a href="{{ route('admin.payments.index') }}"><i class="fas fa-credit-card"></i> Payment Management</a>
            <a href="{{ route('admin.gallery.index') }}"><i class="fas fa-image"></i> Gallery Management</a>
            <a href="{{ route('admin.reviews.index') }}"><i class="fas fa-star"></i> Review Management</a>
            <a href="{{ route('admin.notifications') }}"><i class="fas fa-bell"></i> Notification Management</a>
            <a href="{{ route('admin.reports.index') }}"><i class="fas fa-chart-line"></i> Reports & Analytics</a>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2 class="animate-on-scroll">Your Overview</h2>

    <div class="summary-cards ">
        <div class="card animate-on-scroll"><i class="fas fa-book"></i><h3>Total Bookings</h3><p>{{ $totalBookings }}+</p></div>
        <div class="card animate-on-scroll"><i class="fas fa-credit-card"></i><h3>Total Payments</h3><p>{{ $totalPayments }}+</p></div>
        <div class="card animate-on-scroll"><i class="fas fa-coins"></i><h3>Sum of Payments</h3><p>Rs. {{ number_format($sumOfPayments, 2) }}</p></div>
        <div class="card animate-on-scroll"><i class="fas fa-user"></i><h3>Total Travelers</h3><p>{{ $totalTravelers }}+</p></div>
        <div class="card animate-on-scroll"><i class="fas fa-user-tie"></i><h3>Total Guides</h3><p>{{ $totalGuides }}+</p></div>
    </div>

    <hr style="border:2px solid; color:rgb(130, 132, 132); width:70%; margin:40px auto;" class="animate-on-scroll"><br>


    <div class="summary-graph animate-on-scroll">
        <h3 >Traveler & Guide Summary</h3>
        <canvas id="summaryChart"></canvas>
    </div>

    <div class="tables-section animate-on-scroll">
        <div class="table-container">
            <h3>Pending Bookings</h3>
            <table>
                <thead><tr><th>ID</th><th>User</th><th>Date</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($pendingBookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <h3>Most Added Activities In Itineraries</h3>
            <table>
                <thead><tr><th>ID</th><th>Activity</th><th>Itinerary Count</th></tr></thead>
                <tbody>
                @foreach($mostAddedActivities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->Itineraries_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <h3>Top Users with Most Bookings</h3>
            <table>
                <thead><tr><th>ID</th><th>Name</th><th>Bookings</th></tr></thead>
                <tbody>
                @foreach($topUsers as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->bookings_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart Script -->
<script>
    const ctx = document.getElementById('summaryChart').getContext('2d');
    const summaryChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Travelers Registered',
                    data: @json($travelerData),
                    borderColor: '#2980b9',
                    backgroundColor: 'rgba(41, 128, 185, 0.2)',
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Guides Registered',
                    data: @json($guideData),
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39, 174, 96, 0.2)',
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: { mode: 'index', intersect: false },
                legend: {
                    position: 'top',
                    labels: { usePointStyle: true, boxWidth: 10 }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('show');
    }


    //admin dashboard scroll into view
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
</body>
</html>