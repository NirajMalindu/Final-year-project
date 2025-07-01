<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Payment Management</title>
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
            color: #92400e;
            margin-bottom: 25px;
        }
        .success {
            background-color: #fef9c3;
            color: #713f12;
            padding: 10px 15px;
            border: 1px solid #fde68a;
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
        }
        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .btn-edit {
            background-color:rgb(229, 170, 50);
        }
        .btn-delete {
            background-color: #ef4444;
        }
        .btn:hover {
            opacity: 0.9;
        }
        form input, form select {
            margin-right: 10px;
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #d1d5db;
        }
        .edit-form {
            background-color: #fff7ed;
            padding: 10px;
            border-radius: 8px;
        }
    </style>

    <script>
    function toggleEditForm(paymentId) {
        const row = document.getElementById('edit-form-' + paymentId);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }
    </script>
    
</head>
<body>

<div class="container">
    <h2>Payment Management</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th>Booking ID</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Transaction ID</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->booking_id }}</td>
                <td>${{ number_format($payment->amount, 2) }}</td>
                <td>{{ ucfirst($payment->method) }}</td>
                <td>{{ $payment->transaction_id }}</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                <td>
                    <button class="btn btn-edit" onclick="toggleEditForm({{ $payment->id }})">Edit</button>
                    <form action="{{ route('admin.payments.delete', $payment->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this payment?')">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Hidden Edit Form Row -->
            <tr id="edit-form-{{ $payment->id }}" style="display: none;">
                <td colspan="6">
                    <div class="edit-form">
                        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                            @csrf
                            <label>Amount:</label>
                            <input type="number" name="amount" value="{{ $payment->amount }}" step="0.01" required>

                            <label>Method:</label>
                            <select name="method" required>
                                <option value="Card" {{ $payment->method == 'Card' ? 'selected' : '' }}>Card</option>
                                <option value="Cash" {{ $payment->method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Bank" {{ $payment->method == 'Bank' ? 'selected' : '' }}>Bank</option>
                            </select>

                            <label>Transaction ID:</label>
                            <input type="text" name="transaction_id" value="{{ $payment->transaction_id }}" required>

                            <button type="submit" class="btn btn-edit" style="background-color:#16a34a;">Save</button>
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