<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Page Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link the new CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Additional styles for centering the iframe */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>

    <iframe height="600" width="600" src="/assets/{{ $data->file }}"></iframe>

</body>
</html>
