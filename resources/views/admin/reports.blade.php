<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report & Analysis</title>
    <style>
        body {
            background: #f0fdf4;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        h2 {
            color:rgb(6, 13, 14);
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            margin: 5px;
            cursor: pointer;
            color: white;
        }
        .btn-success { background-color: #06d6a0; }
        .btn-primary { background-color: #118ab2; }
        .btn-info { background-color: #00b4d8; }
        .btn-warning { background-color: #f4a261; }
        .btn-outline-primary {
            background: white;
            color: #118ab2;
            border: 1px solid #118ab2;
        }
        .btn-outline-primary:hover {
            background: #118ab2;
            color: white;
        }
        .btn-delete {
            background-color: #e63946;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        table thead {
            background:rgb(221, 222, 224);
        }
        table th, table td {
            border: 1px solid #d9d9d9;
            padding: 10px;
            text-align: left;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Report & Analysis</h2>

    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    <!-- Report Generation Buttons -->
    <div>
        <form action="{{ route('admin.reports.generate') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="type" value="booking">
            <button class="btn btn-success" type="submit">Generate Booking Report</button>
        </form>

        <form action="{{ route('admin.reports.generate') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="type" value="guide">
            <button class="btn btn-primary" type="submit">Generate Guide Report</button>
        </form>

        <form action="{{ route('admin.reports.generate') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="type" value="user">
            <button class="btn btn-info" type="submit">Generate User Report</button>
        </form>

        <form action="{{ route('admin.reports.generate') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="type" value="payment">
            <button class="btn btn-warning" type="submit">Generate Payment Report</button>
        </form>
    </div>

    
    <!-- Report History Table -->
    <div>
        <h3 style="margin-top: 40px;">Report History</h3>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Generated At</th>
                    <th>Download</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>{{ ucfirst($report->type) }}</td>
                        <td>{{ $report->generated_at }}</td>
                        <td>
                            <a href="{{ route('admin.reports.download', $report->id) }}" class="btn btn-outline-primary">Download</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No reports found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>