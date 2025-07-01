<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity Management</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f8ff;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #005b96;
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .form-box, .table-box {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            width:98%;
            box-shadow: 0 4px 10px rgba(0, 91, 150, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
            width: 50%;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"], input[type="number"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color:rgb(229, 170, 50);
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(219, 156, 30);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background:rgb(221, 222, 224);
            color: #003366;
        }
        .action-th{
            width:15%;
        }
        .action-btn {
            margin-right: 5px;
            padding: 6px 10px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
        }

        .edit-btn {
            color: #fff;
            background-color:rgb(229, 170, 50);

        }

        .delete-btn {
            background-color: #d63031;
            color: #fff;
        }
         .delete-btn:hover {
            background-color:rgb(227, 98, 98);;
        }

        img {
            max-width: 100px;
            border-radius: 5px;
        }
    </style>

    <script>
        function toggleEdit(id) {
            const form = document.getElementById('editForm' + id);
            form.style.display = form.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
</head>
<body>
<div class="container">
    <h2>Activity Management</h2>

    @if(session('success'))
        <p style="color: green;"><strong>{{ session('success') }}</strong></p>
    @endif

    <!-- Add Activity Form -->
    <div class="form-box">
        <h3>Add New Activity</h3>
        <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Activity Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required></textarea>
            </div>
            <div class="form-group">
                <label>Location</label>
                <textarea name="location" required></textarea>
            </div>
            <div class="form-group">
                <label>Cost (USD)</label>
                <input type="number" name="cost" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image">
            </div>
            <button type="submit">Add Activity</button>
        </form>
    </div>

    <!-- Activity Table -->
    <div class="table-box">
        <h3>All Activities</h3>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Cost</th>
                <th>Image</th>
                <th class="action-th">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->name }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->location }}</td>
                    <td>${{ number_format($activity->cost, 2) }}</td>
                    <td>
                        @if($activity->image)
                            <img src="{{ asset('storage/' . $activity->image) }}" alt="Activity Image">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <button class="action-btn edit-btn" onclick="toggleEdit({{ $activity->id }})">Edit</button>

                        <form action="{{ route('admin.activities.delete', $activity->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Form -->
                <tr id="editForm{{ $activity->id }}" style="display: none;">
                    <td colspan="5">
                        <form action="{{ route('admin.activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $activity->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" required>{{ $activity->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="name" value="{{ $activity->location }}" required>
                            </div>
                            <div class="form-group">
                                <label>Cost (USD)</label>
                                <input type="number" name="cost" value="{{ $activity->cost }}" required>
                            </div>
                            <div class="form-group">
                                <label>Replace Image (optional)</label>
                                <input type="file" name="image">
                            </div>
                            <button type="submit">Update Activity</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>