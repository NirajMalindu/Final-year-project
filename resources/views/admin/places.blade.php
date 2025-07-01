<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Places Management</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #4a7c59;
        }

        .container {
            display: flex;
            gap: 30px;
            justify-content: space-between;
        }

        .section {
            flex: 1;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            overflow-y: auto;
            max-height: 600px;
        }

        .card {
            background:rgb(248, 248, 238);
            border: 1px solid #cde6d0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
        }

        .card h4 {
            margin: 0;
            color: #357960;
        }

        .card p {
            margin: 8px 0;
            color: #555;
        }

        img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 8px;
            margin-top: 10px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
            background-color:rgb(229, 170, 50);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(219, 156, 30);
        }

        .actions {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .actions a {
            margin-left: 10px;
            text-decoration: none;
            color: #d9534f;
            font-weight: bold;
        }

        .actions a.edit {
            color: #337ab7;
        }

    </style>

    <script>
        function toggleEditForm(id) {
            const form = document.getElementById(id);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
    
</head>
<body>

<h2>Destination & Attraction Management</h2>

<div class="container">

    <!-- Destinations -->
    <div class="section">
        <h3>Add Destination</h3>
        <form action="{{ route('admin.storeDestination') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Destination Name" required>
            <input type="text" name="location" placeholder="Location" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="file" name="image">
            <button type="submit">Add Destination</button>
        </form>

        <hr>

        <h3>All Destinations</h3>
        @foreach($destinations as $destination)
            <div class="card">
                <h4>{{ $destination->name }}</h4>
                <p><strong>Location:</strong> {{ $destination->location }}</p>
                <p>{{ $destination->description }}</p>
                @if($destination->image)
                    <img src="{{ asset('storage/' . $destination->image) }}" alt="Image">
                @endif
                <div class="actions">
                    <button onclick="toggleEditForm('dest-{{ $destination->id }}')">Edit</button>
                    <a href="{{ route('admin.destroyDestination', $destination->id) }}">Delete</a>
                </div>

                <!-- Hidden Edit Form -->
                <form id="dest-{{ $destination->id }}" action="{{ route('admin.updateDestination', $destination->id) }}" method="POST" enctype="multipart/form-data" style="display: none; margin-top: 15px;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $destination->name }}" required>
                    <input type="text" name="location" value="{{ $destination->location }}" required>
                    <textarea name="description" required>{{ $destination->description }}</textarea>
                    <input type="file" name="image">
                    <button type="submit">Update</button>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Attractions -->
    <div class="section">
        <h3>Add Attraction</h3>
        <form action="{{ route('admin.storeAttraction') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <select name="destination_id" required>
                <option value="">-- Select Destination --</option>
                @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                @endforeach
            </select>
            <input type="text" name="name" placeholder="Attraction Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="file" name="image">
            <button type="submit">Add Attraction</button>
        </form>

        <hr>

        <h3>All Attractions</h3>
        @foreach($attractions as $attraction)
            <div class="card">
                <h4>{{ $attraction->name }}</h4>
                <p><strong>Destination:</strong> {{ $attraction->destination->name }}</p>
                <p>{{ $attraction->description }}</p>
                @if($attraction->image)
                    <img src="{{ asset('storage/' . $attraction->image) }}" alt="Image">
                @endif
                <div class="actions">
                    <button onclick="toggleEditForm('attr-{{ $attraction->id }}')">Edit</button>
                    <a href="{{ route('admin.destroyAttraction', $attraction->id) }}">Delete</a>
                </div>

                <!-- Hidden Edit Form -->
                <form id="attr-{{ $attraction->id }}" action="{{ route('admin.updateAttraction', $attraction->id) }}" method="POST" enctype="multipart/form-data" style="display: none; margin-top: 15px;">
                    @csrf
                    @method('PUT')
                    <select name="destination_id" required>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ $attraction->destination_id == $destination->id ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="name" value="{{ $attraction->name }}" required>
                    <textarea name="description" required>{{ $attraction->description }}</textarea>
                    <input type="file" name="image">
                    <button type="submit">Update</button>
                </form>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>