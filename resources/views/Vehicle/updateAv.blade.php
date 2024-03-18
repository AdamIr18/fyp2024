<!DOCTYPE html>
<html>
<head> 
    <title>Update vehicle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .container {
            width: 55%;
            height: auto;
            max-height: 80vh; /* Adjust as needed */
            min-width: 300px; /* Adjust as needed */
            border-radius: 15px; /* Rounded corners */
            overflow: hidden; /* Hide overflow content */
        }
        .justify-text {
            text-align: justify;
        }
    </style>
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
<div class="container mt-4">
    <div class="d-flex align-items-center justify-content-center">
        <form action="{{ route('updateAv-vehicle', ['id' => $model->veID]) }}" method="POST" enctype="multipart/form-data" onsubmit="return showSuccessMessage()" class="custom-border text-center">
            @csrf 
            <input type="hidden" name="vePlateNo" value="{{ $model->vePlateNo }}">
            <input type="hidden" name="veType" value="{{ $model->veType }}">
            <input type="hidden" name="veBrand" value="{{ $model->veBrand }}">
            <input type="hidden" name="veModel" value="{{ $model->veModel }}">
            <input type="hidden" name="veImg" value="{{ $model->veImg }}">
            <input type="hidden" name="veImg2" value="{{ $model->veImg2 }}">
            @if ($model->veType === 'Car')
                <input type="hidden" name="veImg3" value="{{ $model->veImg3 }}">
                <input type="hidden" name="carSeat" value="{{ $model->carSeat }}">
            @endif
            <input type="hidden" name="vePrice" value="{{ $model->vePrice }}">
            <input type="hidden" name="condition" value="{{ $model->condition }}">

            <p class="justify-text">You have read, understood and agreed to our rental agreement and policy? Once you have rented this vehicle, it is no longer available to other users until the end of your rental period. Do you agree to rent this vehicle?</p>
            
            <input type="radio" id="availability_no" name="availability" value="No">
            <label for="availability_no">Yes</label><br>
            <input type="radio" id="availability_yes" name="availability" value="Yes">
            <label for="availability_yes">No</label><br>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>

<!-- Modal for Disagree -->
<div class="modal fade" id="disagreeModal" tabindex="-1" role="dialog" aria-labelledby="disagreeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="disagreeModalLabel">Warning: Disagree to Rent a Vehicle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          You must agree before renting a vehicle.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
<script>
    function showSuccessMessage() {
        var agreement = document.querySelector('input[name="availability"]:checked').value;

        if (agreement === "Yes") {
            $('#disagreeModal').modal('show'); // Show the modal
            return false; // Prevent form submission
        }

        // If agreed, you can enable or show the next steps here

        alert("New booking has been placed!");
        return true; // Allow form submission
    }
</script>
</body>
</html>