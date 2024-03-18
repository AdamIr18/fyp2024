<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
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
                <a class="nav-link" href="{{ route('createform-vehicle') }}">Add vehicle</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index-vehicle') }}">Manage vehicle</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index-renter') }}">View renter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index3') }}">View booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userChart') }}">Renter statistic</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bookChart') }}">Booking statistic</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4 d-flex align-items-center justify-content-center">
    <form action="{{ route('submit-create-vehicle') }}" method="POST" enctype="multipart/form-data" onsubmit="showSuccessMessage()" class="custom-border">
        @csrf 
        <label for="">
            Plate num:
        </label>
        <input type="text" name="vePlateNo" required>

        <br>

        <label for="veType">Type:</label>
        <input type="radio" id="Car" name="veType" value="Car" onclick="showAttribute()" required>
        <label for="Car">Car</label>
        <input type="radio" id="Motorcycle" name="veType" value="Motorcycle" onclick="hideAttribute()">
        <label for="Motorcycle">Motorcycle</label>

        <br>

        <label for="">
            Brand:
        </label>
        <input type="text" name="veBrand" required>

        <br>

        <label for="">
            Model:
        </label>
        <input type="text" name="veModel" required>

        <br>

        <label for="">
            Front image:
        </label>
        <input type="file" name="veImg" required>

        <br>

        <label for="">
            Back image:
        </label>
        <input type="file" name="veImg2" required>

        <br>

        <div id="interiorImage" style="display: none;">
            <label for="veImg3">
                Interior image:
            </label>
            <input type="file" name="veImg3">
        </div>

        <br>
        
        <label for="">
            Price/hour: RM
        </label>
        <input type="number" name="vePrice" required min="0.01" value="0" step="any" required>

        <br>
        
        <div id="carSeat" style="display: none;">
            <label for="carSeat">Seat:</label>
            <input type="radio" id="4seater" name="carSeat" value="4-seater">
            <label for="4seater">4-seater</label>
            <input type="radio" id="6seater" name="carSeat" value="6-seater">
            <label for="6seater">6-seater</label>
        </div>

        <br>

        <label for="condition">
            Condition:
        </label>
        <select id="condition" name="condition" required>
            <option value="" disabled selected>Select the current vehicle condition</option>
            <option value="Good">Good</option>
            <option value="Poor">Poor</option> 
        </select>

        <br>
        
        <label for="availability">
            Availability:
        </label>
        <select id="availability" name="availability" required>
            <option value="" disabled selected>Select the vehicle availability</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option> 
        </select>

        <br><br>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>
</body>
</html>

<script>
    function showAttribute() {
        var interiorImage = document.getElementById("interiorImage");
        interiorImage.style.display = "block";
        var carSeat = document.getElementById("carSeat");
        carSeat.style.display = "block";
    }
    
    function hideAttribute() {
        var interiorImage = document.getElementById("interiorImage");
        interiorImage.style.display = "none";
        var carSeat = document.getElementById("carSeat");
        carSeat.style.display = "none";
    }
    
    function showSuccessMessage() {
            alert("New vehicle registered!");
    }
</script>
