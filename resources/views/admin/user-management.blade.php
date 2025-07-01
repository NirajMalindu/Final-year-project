<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #f3f9f9;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }
        .container {
            width: 95%;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background:rgb(221, 222, 224);
            color: black;
        }
        .experi-descrip-th {
            width: 16%;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-approve { background-color: #2ecc71; }
        .btn-reject { background-color: #e74c3c; }
        .btn-suspend { background-color: #f39c12; }
        .btn-edit { background-color: #2980b9; }
        .btn-delete { background-color: #c0392b; }
        .btn-search {
            background-color:rgb(229, 170, 50);
            color: white;
            padding: 8px 16px;
            margin-left: 10px;
            border-radius: 25px;
            border: none;
            font-size: 14px;
        }
        .search-form {
            margin-bottom: 30px;
            text-align: right;
        }
        .search-bar {
            padding: 8px 14px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
            transition: 0.3s ease;
        }
        .search-bar:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52,152,219,0.5);
        }
        .section-title {
            margin-top: 44px;
        }
    </style>

    <script>
        function toggleEditForm(id) {
            const form = document.getElementById('edit-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.user.search') }}" class="search-form">
            <input type="text" name="search" class="search-bar" placeholder="Search by name or email..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-search">Search</button>
        </form>

        <!-- Guide Section -->
        <h2 >Guide Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Availability</th>
                    <th class="experi-descrip-th">Experience</th>
                    <th class="experi-descrip-th">Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guides as $guideUser)
                    <tr>
                    <td>{{ $guideUser->name }}</td>
                    <td>{{ $guideUser->email }}</td>
                    <td>{{ $guideUser->phone }}</td>

                            @if ($guideUser->role === 'guide')
                                @if ($guideUser->guide)
                                    <td>{{ $guideUser->guide->status ?? 'No value here' }}</td>
                                    <td>
                                        {{
                                            $guideUser->guide->availability == '1' ? 'Available' : 
                                            ($guideUser->guide->availability == '0' ? 'Not Available' : 'No value here')
                                        }}
                                    </td>
                                    <td>{{ $guideUser->guide->experience ?? 'No value here' }}</td>
                                    <td>{{ $guideUser->guide->description ?? 'No value here' }}</td>
                                @else
                                    <td colspan="4">No guide details available</td>
                                @endif
                            @else
                                <td colspan="4">Not a guide</td>
                            @endif
                                        

                            <td>
                                @if ($guideUser->guide && $guideUser->guide->status == 'pending')
                                    <form method="POST" action="{{ route('admin.guide.approve', $guideUser->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-approve">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.guide.reject', $guideUser->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-reject">Reject</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.guide.delete', $guideUser->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>

                                @if ($guideUser->guide)
                                    <button type="button" class="btn btn-edit" onclick="toggleEditForm({{ $guideUser->id }})">Edit</button>

                                    <div id="edit-form-{{ $guideUser->id }}" style="display:none; margin-top: 10px;">
                                        <form method="POST" action="{{ route('admin.guide.update', $guideUser->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div>
                                                <label for="availability">Availability:</label>
                                                <select name="availability" required>
                                                    <option value="1" {{ $guideUser->guide->availability == '1' ? 'selected' : '' }}>Available</option>
                                                    <option value="0" {{ $guideUser->guide->availability == '0' ? 'selected' : '' }}>Not Available</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="experience">Experience:</label>
                                                <textarea name="experience" required>{{ $guideUser->guide->experience ?? '' }}</textarea>
                                            </div>

                                            <div>
                                                <label for="description">Description:</label>
                                                <textarea name="description" required>{{ $guideUser->guide->description ?? '' }}</textarea>
                                            </div>

                                            <button type="submit" class="btn btn-approve">Update</button>
                                        </form>
                                    </div>
                                @endif
                            </td>


                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Traveler Section -->
        <h2 class="section-title">Traveler Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th><th>Email</th><th>Phone</th><th>Status</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($travelers as $traveler)
                    <tr>
                        <td>{{ $traveler->name }}</td>
                        <td>{{ $traveler->email }}</td>
                        <td>{{ $traveler->phone }}</td>
                        <td>{{ $traveler->is_suspended ? 'Suspended' : 'Active' }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.traveler.suspend', $traveler->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-suspend">
                                    {{ $traveler->is_suspended ? 'Activate' : 'Suspend' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.traveler.delete', $traveler->id) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>