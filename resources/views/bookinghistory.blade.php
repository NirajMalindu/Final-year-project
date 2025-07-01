<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .title {
            text-align: center;
            font-size: 30px;
            color: #34495e;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .section {
            margin-bottom: 12px;
        }

        .label {
            font-weight: bold;
            color: #2c3e50;
            display: inline-block;
            width: 160px;
        }

        .value {
            color: #2d3436;
        }

        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            text-transform: capitalize;
        }

        .pending       { background-color: #f39c12; }
        .confirmed     { background-color: #3498db; }
        .completed     { background-color: #2ecc71; }
        .cancelled     { background-color: #e74c3c; }
        .successful    { background-color: #27ae60; }
        .failed        { background-color: #e74c3c; }
        .pending-payment { background-color: #f1c40f; }

        .see-info-btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 12px;
            font-size: 14px;
            transition: 0.3s;
        }

        .see-info-btn:hover {
            background-color: #21618c;
        }

        em {
            color: #7f8c8d;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .modal-custom {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content-custom {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .modal-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header-custom h5 {
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
    </style>



        
    <script>
        function openDateModal(bookingId, currentDate) {
            document.getElementById('dateModal').style.display = 'block';
            document.getElementById('new_date').value = currentDate;
            document.getElementById('changeDateForm').action = '/booking/change-date/' + bookingId;
        }

        function closeDateModal() {
            document.getElementById('dateModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.id === 'dateModal') {
                closeDateModal();
            }
        }
    </script>




</head>
<body>
<div class="container">
    <h2 class="title">My Booking History</h2>

    @if(session('success'))
        <p style="text-align: center; color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    @forelse ($bookings as $booking)
        <div class="card">
            <div class="section">
                <span class="label">Booking Date:</span>
                <span class="value">{{ $booking->date }}</span>
            </div>

            <div class="section">
                <span class="label">Activity:</span>
                <span class="value">{{ $booking->activity->name }}</span>
            </div>

            <div class="section">
                <span class="label">Created At:</span>
                <span class="value">{{ $booking->created_at->format('Y-m-d') }}</span>
            </div>

            <div class="section">
                <span class="label">Booking Status:</span>
                <span class="status {{ $booking->status }}">{{ $booking->status }}</span>
            </div>

            <hr>

            <div class="section">
                @if($booking->status !== 'cancelled')
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="see-info-btn" onclick="return confirm('Are you sure you want to cancel this booking?')">
                            Cancel Booking
                        </button>
                    </form>

                    <button class="see-info-btn" onclick="openDateModal({{ $booking->id }}, '{{ $booking->date }}')">
                        Change Date
                    </button>
                @else
                    <em>This booking is cancelled.</em>
                @endif
            </div>

            <hr>

            @if($booking->guide)
                <div class="section">
                    <span class="label">Guide:</span>
                    <span class="value">{{ $booking->guide->name }}</span>
                </div>

                <a href="{{ route('guide.show', $booking->guide->id) }}" class="see-info-btn">See Info</a>
            @else
                <div class="section"><em>No guide assigned yet.</em></div>
            @endif

            <hr>

            @if($booking->payment)
                <div class="section">
                    <span class="label">Payment Amount:</span>
                    <span class="value">LKR {{ number_format($booking->payment->amount, 2) }}</span>
                </div>
                <div class="section">
                    <span class="label">Payment Method:</span>
                    <span class="value">{{ ucfirst($booking->payment->method) }}</span>
                </div>
                <div class="section">
                    <span class="label">Transaction ID:</span>
                    <span class="value">{{ $booking->payment->transaction_id ?? 'N/A' }}</span>
                </div>
                <div class="section">
                    <span class="label">Payment Status:</span>
                    <span class="status {{ $booking->payment->status }}">{{ $booking->payment->status }}</span>
                </div>
            @else
                <div class="section">
                    <em>No payment information available.</em>
                </div>
            @endif
        </div>
    @empty
        <p style="text-align: center; color: #7f8c8d;">You have no bookings yet.</p>
    @endforelse
</div>

<!-- Change Date Modal -->
<div class="modal-custom" id="dateModal">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h5>Change Booking Date</h5>
            <button class="close-btn" onclick="closeDateModal()">&times;</button>
        </div>
        <form id="changeDateForm" method="POST">
            @csrf
            @method('PUT')
            <input type="date" name="new_date" id="new_date" required style="width: 100%; margin-top: 20px; padding: 10px; font-size: 16px;">
            <br><br>
            <button type="submit" class="see-info-btn" style="width: 100%;">Update Date</button>
        </form>
    </div>
</div>


</body>
</html>