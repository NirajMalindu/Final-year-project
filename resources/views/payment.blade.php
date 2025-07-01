<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm & Pay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn {
            background:rgb(210, 182, 43);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background:rgb(211, 157, 29);
        }

        .summary {
            background: #f8f9fa;
            padding: 10px 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Confirm & Pay</h2>
<hr><br><br>
    <div class="summary">
        <p><strong>Itinerary:</strong> {{ $itinerary->title }}</p>
        <p><strong>Start Date:</strong> {{ $itinerary->start_date }}</p>
        <p><strong>Activity:</strong> {{ $activity->name }}</p>
        <p><strong>Price:</strong> ${{ number_format($activity->cost, 2) }}</p>
    </div>

    <form action="{{ route('bookings.process', $itinerary->id) }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="date" value="{{ $itinerary->start_date }}">
        <input type="hidden" name="amount" value="{{ $activity->cost }}">
        <input type="hidden" name="activity_id" value="{{$activity->id}}">


        <label for="method">Payment Method:</label>
        <select name="method" required>
            <option value="card">Credit/Debit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank">Bank Transfer</option>
        </select>

        <label for="transaction_id">Transaction ID:</label>
        <input type="text" name="transaction_id" placeholder="Enter transaction ID">

        <button type="submit" class="btn">Pay Now</button>
    </form>
</div>
</body>
</html>