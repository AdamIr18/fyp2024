<!DOCTYPE html>
<html>
<head>
    <title>Update reserve</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Link the new CSS file -->
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}"> 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="{{ asset('uploads/images/ksalogo.jpg') }}" alt="Your Logo" width="60" height="60"> Kereta Sewa Abang</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index4') }}">Booking history</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4 d-flex align-items-center justify-content-center">
    <form action="{{ route('update-reserve', ['id' => $model->reserveID]) }}" method="POST" onsubmit="return confirmSaveConfirmation()" class="custom-border">
        @csrf
        <!-- Hidden input field for termCond (UPDATE WITHOUT AFFECTING TERM & COND)-->
        <input type="hidden" name="termCond" value="{{ $model->termCond }}">

        <label for="date">Date:</label>
        <input type="date" value="{{ $model->date }}" name="date">

        <br>

        <label for="startTime">Start time:</label>
        <input type="time" value="{{ $model->startTime }}" name="startTime" onchange="calculateTotalPrice()">

        <br>

        <label for="endTime">End time:</label>
        <input type="time" value="{{ $model->endTime }}" name="endTime" onchange="calculateTotalPrice()">

        <br>

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</div>
</body>
</html>

<script>
    function confirmSaveConfirmation() {
        return confirm("Do you want to save changes?");
    }
</script> 