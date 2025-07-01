<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Booking Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #fefce8, #f0fdf4);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 93%;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #0f766e;
            margin-bottom: 25px;
        }

        .success {
            background-color: #dcfce7;
            color: #166534;
            padding: 10px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        form.search-form {
            display: flex;
            justify-content: right;
            margin-bottom: 20px;
            margin-right: 20px;
        }

        form.search-form input {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #94a3b8;
            width: 300px;
            height: 40px;
        }

        form.search-form button {
            margin-left: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background-color:rgb(229, 170, 50);
            color: white;
            cursor: pointer;
            height: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto;
        }

        thead {
            color: black;
            background:rgb(221, 222, 224);

        }

        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .btn {
            padding: 8px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 4px;
        }

        .btn-edit { background-color: #3b82f6; color: white; }
        .btn-confirm { background-color: #10b981; color: white; }
        .btn-cancel { background-color: #f59e0b; color: white; }
        .btn-delete { background-color: #ef4444; color: white; }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending { background-color: #fef08a; color: #92400e; }
        .status-confirmed { background-color: #bbf7d0; color: #065f46; }
        .status-completed { background-color: #dbeafe; color: #1e3a8a; }
        .status-cancelled { background-color: #fecaca; color: #7f1d1d; }

        input, select {
            padding: 6px 8px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            width: 100%;
            height: 40px;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            table thead { display: none; }
            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f0fdf4;
                padding: 12px;
            }

            table td {
                padding: 8px 10px;
                text-align: right;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 50%;
                padding-right: 10px;
                font-weight: bold;
                text-align: left;
                color: #0f766e;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Booking Management</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.bookings.index') }}" class="search-form">
        <input type="text" name="search" placeholder="Search traveler name..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Traveler</th>
            <th>Guide</th>
            <th>Booking ID</th>
            <th>Booked Activity</th>
            <th>Date</th>
            <th>Status</th>
            <th>Update</th>
            <th>Actions</th>
        </tr>
        </thead>
       <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        <td data-label="Traveler">{{ $booking->user->name ?? 'Unknown' }}</td>

                        <td data-label="Guide">
                            <select name="guide_id" required>
                                <option value="">Select Guide</option>
                                @foreach($approvedGuides as $guide)
                                    <option value="{{ $guide->user_id }}"
                                        {{ $booking->guide_id == $guide->user_id ? 'selected' : '' }}>
                                        {{ $guide->user->name ?? 'Unknown' }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td data-label="Booking ID">{{ $booking->id }}</td>

                        <td data-label="Booked Activity">{{ $booking->activity->name }}</td>
                        
                        <td data-label="Date">
                            <input type="date" name="date" value="{{ $booking->date }}" required>
                        </td>

                        <td data-label="Status">
                            <select name="status">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>

                        <td data-label="Update">
                            <button type="submit" class="btn btn-edit">Update</button>
                        </td>

                        <td data-label="Actions">
                            <a href="{{ route('admin.bookings.confirm', $booking->id) }}" class="btn btn-confirm" onclick="return confirm('Confirm this booking?')">Confirm</a>
                            <a href="{{ route('admin.bookings.cancel', $booking->id) }}" class="btn btn-cancel" onclick="return confirm('Cancel this booking?')">Cancel</a>
                            <a href="{{ route('admin.bookings.delete', $booking->id) }}" class="btn btn-delete" onclick="return confirm('Delete this booking?')">Delete</a>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>