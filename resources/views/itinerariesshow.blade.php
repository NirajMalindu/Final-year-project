<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Itineraries</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 28px;
            color: #333;
        }

        .btn {
            background-color: #d9883d;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn:hover {
            background-color:rgb(202, 105, 44);
        }

        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .card h4 {
            margin: 0 0 10px;
            color: #444;
        }

        .card p {
            margin: 0 0 8px;
            color: #555;
        }

        .card small {
            color: #888;
        }

        .btn-group {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .edit-form {
            display: none;
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .edit-form input,
        .edit-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .no-itineraries {
            text-align: center;
            color: #888;
            padding: 50px 0;
            font-size: 16px;
        }
    </style>


<!-- ✅ JavaScript placed after the HTML content -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const form = document.getElementById(edit-form-${id});
                if (form) {
                    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
                }
            });
        });
    });
</script>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>My Itineraries</h2>
    </div>

    @if($itineraries->isEmpty())
        <div class="no-itineraries">
            You have no itineraries yet. Click "Create Itinerary" to get started!
        </div>
    @else
        @foreach($itineraries as $itinerary)
            <div class="card">
                <h4>{{ $itinerary->title }}</h4>
                <p>{{ Str::limit($itinerary->description, 120) }}</p>
                <p><strong>Activity:</strong> {{ $itinerary->activity->name ?? 'N/A' }}</p>
                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($itinerary->start_date)->format('F d, Y') }}</p>
                <p><strong>Budget:</strong> ${{ number_format($itinerary->budget, 2) }}</p>
                <small>Created on {{ $itinerary->created_at->format('d M Y') }}</small>

                <div class="btn-group">
                    <a href="{{ route('bookings.pay', $itinerary->id) }}" class="btn">Book Now</a>
                    <button type="button" class="btn edit-btn" data-id="{{ $itinerary->id }}">Edit</button>
                    <form action="{{ route('user.itineraries.destroy', $itinerary->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn" onclick="return confirm('Are you sure to delete this itinerary?')">Delete</button>
                    </form>
                </div>

                <!-- Hidden Edit Form -->
                <form class="edit-form" id="edit-form-{{ $itinerary->id }}" action="{{ route('user.itineraries.update', $itinerary->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" value="{{ $itinerary->title }}" placeholder="Title" required>
                    <textarea name="description" rows="3" required>{{ $itinerary->description }}</textarea>
                    <input type="date" name="start_date" value="{{ $itinerary->start_date }}" required>
                    <input type="number" step="0.01" name="budget" value="{{ $itinerary->budget }}" required>
                    <button type="submit" class="btn">Update</button>
                </form>
            </div>
        @endforeach
    @endif
</div>



</body>
</html>