<!DOCTYPE html>
<html>
<head>
    <title>Update vehicle</title>
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
<form action="{{ route('submit-create-aftervehicle') }}" method="POST" enctype="multipart/form-data" onsubmit="showSuccessMessage()" class="custom-border">
    @csrf 
    <label for="">
        Plate num:
    </label>
    <input type="text" value="{{ $model->vePlateNo }}" name="vePlateNo" required readonly>

    <br>

    <label for="veType">Type:</label>
    <input type="radio" id="Car" name="veType" value="Car" {{ $model->veType === 'Car' ? 'checked' : '' }} disabled>
    <label for="Car">Car</label>
    <input type="radio" id="Motorcycle" name="veType" value="Motorcycle" {{ $model->veType === 'Motorcycle' ? 'checked' : '' }} disabled>
    <label for="Motorcycle">Motorcycle</label>

    <!-- Hidden input to store the selected value -->
    <input type="hidden" name="veType" value="{{ $model->veType }}">

    <br>

    <label for="">
        Brand:
    </label>
    <input type="text" value="{{ $model->veBrand }}" name="veBrand" required readonly>

    <br>

    <label for="">
        Model:
    </label>
    <input type="text" value="{{ $model->veModel }}" name="veModel" required readonly> 

    <br>

    <label for="">
        Price:
    </label>
    <input type="text" value="{{ $model->vePrice }}" name="vePrice" required readonly>  

    <br>

    <label for="">
        Upload your deposit payment here:
    </label>
    <br>
    <input type="file" name="file" required>

    <br><br>
    
    <button type="submit" onclick="return confirm('Are you sure to book this vehicle?')">Confirm</button>
    <button type="reset">Reset</button>
</form>
</div>
</body>
</html>

<script>
    function showSuccessMessage() {
            alert("Booking successful!");
    }
</script>
