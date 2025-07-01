<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Itinerary Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #dbeafe, #f0fdf4);
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
            background-color: #38bdf8;
            color: white;
        }

        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid;
            text-align: left;
            
        }

        th{
            background:rgb(221, 222, 224);
            color:black;

        }

        .budget-width { width:10%; }
        .action-width { width:20%; }

        input, select, textarea {
            padding: 6px 8px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            margin-bottom: 6px;
            width: 100%;
            height: 50px;
            box-sizing: border-box;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 5px;
        }

        .btn-edit {
            background-color: #3b82f6;
            color: white;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
            width: 60px;
        }

        .btn:hover { opacity: 0.95; }

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

            td[data-label="Actions"] {
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Itinerary Management</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.itineraries.index') }}" class="search-form">
        <input type="text" name="search" placeholder="Search traveler name..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Traveler</th>
            <th>Title</th>
            <th>Description</th>
            <th>Activity</th>
            <th>Start</th>
            <th class="budget-width">Budget</th>
            <th class="action-width">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($itineraries as $itinerary)
            <tr>
                <td data-label="Traveler">{{ $itinerary->user->name ?? 'Unknown' }}</td>
                <td data-label="Title">
                    <form action="{{ route('admin.itineraries.update', $itinerary->id) }}" method="POST" style="display:contents;">
                        @csrf
                        <input type="text" name="title" value="{{ $itinerary->title }}" required>
                </td>

                <td data-label="Description">
                        <textarea name="description" rows="2" required>{{ $itinerary->description }}</textarea>
                </td>

                <td data-label="Activity">
                        <select name="activity_id" required>
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}" {{ $itinerary->activity_id == $activity->id ? 'selected' : '' }}>
                                    {{ $activity->name }}
                                </option>
                            @endforeach
                        </select>
                </td>

                <td data-label="Start">
                        <input type="date" name="start_date" value="{{ $itinerary->start_date }}" required>
                </td>

                

                <td data-label="Budget">
                        <input type="number" name="budget" value="{{ $itinerary->budget }}" step="0.01" required>
                </td>

                <td data-label="Actions">
                        <div style="display: inline-flex; align-items: center; gap: 8px;">
                            <button type="submit" class="btn btn-edit">Update</button>
                    </form>
                            <form action="{{ route('admin.itineraries.delete', $itinerary->id) }}" method="GET" onsubmit="return confirm('Delete this itinerary?')">
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>