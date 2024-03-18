<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body::-webkit-scrollbar {
            width: 0; /* WebKit (Safari, Chrome) */
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 10;
            flex-direction: column; /* Align content vertically */
            background-image: url('uploads/images/ksaFront.jpg'); /* Add the path to your image */
            background-size: cover;
            background-position: center;
            color: #ffffff; /* Set text color to white or any readable color */
            font-family: 'Roboto', sans-serif; /* Set font-family */
        }
        .button {
            display: inline-block;
            padding: 18px 80px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            margin-right: 20px; /* ADJUST JARAK ANTARA BUTTON */
        }
        .button-primary {
            color: #fff;
            background-color: #3490dc;
            border: 2px solid #3490dc;
        }
        .button-primary:hover {
            background-color: #2779bd;
        }
        .center-text {
            margin-top: 20px; /* Add margin for separation */
            font-size: 60px; /* Adjust font size as needed */
            font-weight: bold;
            margin-right: 220px; /* ADJUST BAWA KE KIRI */
            font-family: 'Roboto', sans-serif; /* Set font-family */
        }
    </style>
</head>
<body class="antialiased">
    <div class="text-center">
        <div class="center-text">
            <p>Welcome to Kereta Sewa Abang</p>
        </div>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="button button-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="button button-primary">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button button-primary">Register now</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
