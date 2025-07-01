<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forest Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: url('{{ asset('images/background3.jpg') }}') no-repeat center center/cover;
            height: 100vh;
            color: white;
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.15);
            padding: 35px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            color: #fff;
            backdrop-filter: blur(10px);

        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem;
            color: #ffffff;
        }

        label {
            font-size: 0.95rem;
            display: block;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            font-size: 1rem;
        }

        input::placeholder {
            color: #ddd;
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.4);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #16a34a, #22c55e);
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: linear-gradient(90deg, #15803d, #16a34a);
        }

        .signup-text {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .signup-text a {
            color: #bbf7d0;
            text-decoration: underline;
        }

        .error-box {
            background: rgba(255, 0, 0, 0.15);
            border-left: 5px solid #f87171;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #fee2e2;
        }

        .error-box ul {
            margin: 0;
            padding-left: 18px;
            list-style: disc;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email">

                <!-- Password -->
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">

                <!-- Remember Me -->
                <div class="options">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    <a href="{{ route('password.request') }}" style="color:#d1fae5;">Forgot Password?</a>
                </div>

                <button type="submit" class="submit-btn">Login</button>

                <p class="signup-text">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>