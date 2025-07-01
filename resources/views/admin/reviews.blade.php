<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Review Management</title>
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
            color: #065f46;
            margin-bottom: 25px;
        }
        .success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px 15px;
            border: 1px solid #6ee7b7;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        thead {
            background:rgb(221, 222, 224);
            color: black;
        }
        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            width:10%;
        }

        .comment-width{
            width:15%;
        }

        .action-width{
            width:15%;
        }
        
        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            color: white;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-approve { background-color: #10b981; }
        .btn-reject { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>

<div class="container">
    <h2>Review Management</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th>Reviewer</th>
            <th>Guide</th>
            <th>Rating</th>
            <th class="comment-width">Comment</th>
            <th>Status</th>
            <th>Submitted</th>
            <th class="action-width">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->guide->name }}</td>
                <td>{{ $review->rating }} / 5</td>
                <td>{{ $review->comment }}</td>
                <td>{{ ucfirst($review->status) }}</td>
                <td>{{ $review->created_at->format('Y-m-d') }}</td>
                <td>
                    @if($review->status == 'pending')
                        <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-reject">Reject</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this review?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>