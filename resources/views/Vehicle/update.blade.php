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
<form action="{{ route('update-vehicle', ['id' => $model->veID]) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmSaveConfirmation()" class="custom-border">
    @csrf 
    <label for="vePlateNo">
        Plate num:
    </label>
    <input type="text" value="{{ $model->vePlateNo }}" name="vePlateNo" required>

    <br>

    <label for="veType">Type:</label>
    <input type="radio" id="Car" name="veType" value="Car" {{ $model->veType === 'Car' ? 'checked' : '' }} onclick="showOrHideAttributes()" required>
    <label for="Car">Car</label>
    <input type="radio" id="Motorcycle" name="veType" value="Motorcycle" {{ $model->veType === 'Motorcycle' ? 'checked' : '' }} onclick="showOrHideAttributes()">
    <label for="Motorcycle">Motorcycle</label>  

    <br>

    <label for="veBrand">
        Brand:
    </label>
    <input type="text" value="{{ $model->veBrand }}" name="veBrand" required>

    <br>

    <label for="veModel">
        Model:
    </label>
    <input type="text" value="{{ $model->veModel }}" name="veModel" required> 

    <br>

    <label for="veImg">
        Front image:
    </label>
    <input type="file" name="veImg">

    <br>

    <label for="veImg2">
        Back image:
    </label>
    <input type="file" name="veImg2">

    <br>

    <div id="interiorImage" style="display: {{ $model->veType === 'Car' ? 'block' : 'none' }}">
        <label for="veImg3">
            Interior image:
        </label>
        <input type="file" name="veImg3">
    </div>
 
    <br>

    <label for="vePrice">
        Price/hour: RM
    </label>
    <input type="text" value="{{ $model->vePrice }}" name="vePrice" required> 

    <br>

    <div id="carSeat" style="display: {{ $model->veType === 'Car' ? 'block' : 'none' }}">
        <label for="carSeat">Seat:</label>
        <input type="radio" id="4seater" name="carSeat" value="4-seater" {{ $model->carSeat === '4-seater' ? 'checked' : '' }}>
        <label for="4seater">4-seater</label>
        <input type="radio" id="6seater" name="carSeat" value="6-seater" {{ $model->carSeat === '6-seater' ? 'checked' : '' }}>
        <label for="6seater">6-seater</label>
    </div>

    <br>

    <label for="condition">
        Condition: 
    </label>
    <select id="condition" name="condition" required>
        <option value="" disabled>Select the current vehicle condition</option>
        <option value="Good" {{ $model->condition === 'Good' ? 'selected' : '' }}>Good</option>
        <option value="Poor" {{ $model->condition === 'Poor' ? 'selected' : '' }}>Poor</option> 
    </select>

    <br>
    
    <label for="availability">
        Availability:
    </label>
    <select id="availability" name="availability" required>
        <option value="" disabled>Select the vehicle availability</option>
        <option value="Yes" {{ $model->availability === 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ $model->availability === 'No' ? 'selected' : '' }}>No</option> 
    </select>

    <br>
    
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>
</div>
<script>
    // Function to show or hide attributes based on the selected vehicle type
    function showOrHideAttributes() {
        var interiorImage = document.getElementById("interiorImage");
        var carSeat = document.getElementById("carSeat");
        var carRadio = document.getElementById("Car");

        if (carRadio.checked) {
            interiorImage.style.display = "block";
            carSeat.style.display = "block";
        } else {
            interiorImage.style.display = "none";
            carSeat.style.display = "none";
        }
    }

    // Call the function initially to set the correct display state
    showOrHideAttributes();

    function confirmSaveConfirmation() {
        return confirm("Do you want to save changes?");
    }
</script>

</body>
</html>
