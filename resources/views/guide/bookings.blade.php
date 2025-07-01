<!DOCTYPE html>
<html>
<head>
    <title>Guide Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            padding: 0 20px;
        }

        .booking-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .profile-pic {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ccc;
        }

        .booking-details {
            flex: 1;
        }

        .booking-details h4 {
            margin: 0;
            font-size: 18px;
        }

        .booking-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .status {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 5px;
            color: white;
        }

        .pending { background-color: orange; }
        .confirmed { background-color: green; }
        .completed { background-color: blue; }
        .cancelled { background-color: red; }

        .no-bookings {
            text-align: center;
            font-size: 16px;
            color: #666;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<h2>My Assigned Bookings</h2>

<div class="card-container">
    @forelse($bookings as $booking)
        @php $user = $booking->user; @endphp
        <div class="booking-card">
            <img src="{{ $user && $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                 class="profile-pic" alt="Profile Picture">

            <div class="booking-details">
                <h4>{{ $user->name ?? 'Traveler not found' }}</h4>
                <p><strong>Booking ID:</strong> {{ $booking->id ?? 'N/A' }}</p>
                <p><strong>Booked Activity:</strong> {{$booking->activity->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $booking->date }}</p>
                <p><strong>Status:</strong> <span class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></p>
            </div>
        </div>
    @empty
        <div class="no-bookings">No bookings assigned to you.</div>
    @endforelse
</div>

</body>
</html>