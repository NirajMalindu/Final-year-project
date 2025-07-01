<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            background: url('{{ asset('images/background3.jpg') }}') no-repeat center center/cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .register-container { 
            background: rgba(255, 255, 255, 0.15);
            padding: 35px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            color: #fff;
            backdrop-filter: blur(10px);

            
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #ffffff;
            font-size: 1.8rem;
        }

        label {
            display: block;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"],
        select {
             width: 95%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ffffff;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            font-size: 1rem;
        }

        input::placeholder {
            color: #ddd;
        }

        
        input:focus,
        select:focus {
           outline: none;
            background: rgba(255, 255, 255, 0.4);
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        .actions a {
            font-size: 0.9rem;
            color: #ffffff;
            text-decoration: underline;
            transition: color 0.3s;
        }

        .actions a:hover {
            color:rgb(211, 209, 255);
        }

        button {
            background-color:rgb(22, 102, 95);
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4f46e5;
        }
    </style>
</head>

<body>

<div class="register-container">
    <h2>Register</h2>
    <hr><br>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        </div>

        <!-- Phone -->
        <div>
            <label for="phone">Phone</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required>
        </div>

        <!-- Profile Picture -->
        <div>
            <label for="profile_picture">Profile Picture</label>
            <input id="profile_picture" type="file" name="profile_picture" accept="image/*">
        </div>

        <!-- Role -->
        <div>
            <label for="role">Register As</label>
            <select id="role" name="role" required>
                <option value="traveler" {{ old('role') == 'traveler' ? 'selected' : '' }}>Traveler</option>
                <option value="guide" {{ old('role') == 'guide' ? 'selected' : '' }}>Guide</option>
            </select>
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <!-- Actions -->
        <div class="actions">
            <a href="{{ route('login') }}">Already registered?</a>
            <button type="submit">Register</button>
        </div>
    </form>
</div>

</body>
</html>