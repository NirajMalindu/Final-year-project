<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Itinerary</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            background: url('{{ asset('images/login.png') }}') no-repeat center center/cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            max-width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #34495e;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 90%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 15px;
        }
        textarea {
            resize: vertical;
        }
        input[readonly] {
            background-color: #f9f9f9;
        }
        .submit-btn {
            display: block;
            margin: 30px auto 0;
            padding: 12px 30px;
            background-color:rgb(198, 135, 53);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            text-align:center;
            display:block;
            text-decoration:none;
        }
        .submit-btn:hover {
            background-color:rgb(208, 145, 36);
        }
    </style>
</head>
<body>



    <div class="container">
        <h2>Create Itinerary</h2>
    <hr><br>
        <!-- Display validation errors -->
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('itinerary.store') }}" method="POST">
            @csrf

            <input type="hidden" name="activity_id" value="{{ $activity->id }}">

            <label>Activity</label>
            <input type="text" value="{{ $activity->name }}" readonly>

            <label>Budget (LKR)</label>
            <input type="number" name="budget" value="{{ $activity->cost }}" readonly>

            <label>Title</label>
            <input type="text" name="title" placeholder="Enter itinerary title" required>

            <label>Description</label>
            <textarea name="description" rows="4" placeholder="Enter a brief description" required></textarea>

            <label>Start Date</label>
            <input type="date" name="start_date" required>

            

            @auth
                <button type="submit" class="submit-btn">Book your Tour</button>
            @else
                <a href="{{route('login')}}" class="submit-btn">
                    Login to Book your Tour
                </a>
            @endauth

        </form>
    </div>
</body>
</html>