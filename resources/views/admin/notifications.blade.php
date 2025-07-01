<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Notification Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f0f9ff, #ecfdf5);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 95%;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        h2 {
            color:rgb(17, 18, 18);
            text-align: center;
            margin-bottom: 25px;
        }
        form {
            margin-bottom: 30px;
            padding: 20px;
            background:rgb(248, 248, 238);
            border: 1px solid #bbf7d0;
            border-radius: 8px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #d1fae5;
            border-radius: 6px;
            font-size: 15px;
        }
        .btn {
            background-color:rgb(229, 170, 50);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover {
            background-color:rgb(250, 199, 97);
        }
        .success {
            background:rgb(248, 248, 238);
            color: #166534;
            padding: 10px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        thead {
            background:rgb(221, 222, 224);
            color: black;
        }
        .btn-delete {
            background-color: #ef4444;
            padding: 6px 12px;
            color: white;
            border: none;
            border-radius: 6px;
        }
        .btn-delete:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Notification Management</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.notifications.store') }}" method="POST">
        @csrf
        <label for="user_id">Select User</label>
        <select name="user_id" required>
            <option value="">-- Choose a user --</option>
            @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
            @endforeach
        </select>

        <label for="title">Notification Title</label>
        <input type="text" name="title" required>

        <label for="message">Message</label>
        <textarea name="message" rows="4" required></textarea>

        <button type="submit" class="btn">Send Notification</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>User</th>
            <th>Title</th>
            <th>Message</th>
            <th>Status</th>
            <th>Sent At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->user->name }}</td>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->message }}</td>
                <td>{{ $notification->is_read ? 'Read' : 'Unread' }}</td>
                <td>{{ $notification->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.notifications.delete', $notification->id) }}"
                       onclick="return confirm('Delete this notification?');"
                       class="btn-delete">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>