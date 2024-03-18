<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reserve Now</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Style for the term and condition box */
        #termAndCondition {
          width: 100%;
          padding: 10px;
          border: 2px solid #ccc;
          border-radius: 8px;
          box-sizing: border-box;
          margin-bottom: 15px;
          font-family: 'Arial', sans-serif;
        }
    
        /* Style for the radio buttons */
        input[type="radio"] {
          margin-right: 5px;
        }
    
        /* Style for the labels */
        label {
          margin-right: 15px;
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

<div class="container mt-4 d-flex align-items-center justify-content-center">
    <form action="{{ route('submit-create-reserve') }}" method="POST" onsubmit="return showSuccessMessage()" class="custom-border" id="reservationForm">
        @csrf 
        <label for="date">Date:</label>
        <input type="date" name="date" id="date"> 

        <br>

        <label for="startTime">Start time:</label>
        <input type="time" name="startTime" id="startTime" onchange="calculateTotalPrice()">

        <br>

        <label for="endTime">End time:</label>
        <input type="time" name="endTime" id="endTime" onchange="calculateTotalPrice()">

        <br>
         
        <label for="termCond">Term and condition:</label>
        <input type="radio" id="Agree" name="termCond" value="Agree" required>
        <label for="Agree">Agree</label>
        <input type="radio" id="Disagree" name="termCond" value="Disagree">
        <label for="Disagree">Disagree</label>
    
        <!-- Styled term and condition box -->
        <textarea id="termAndCondition" name="termAndCondition" rows="4" placeholder="By renting a vehicle from us, you agree to our terms and conditions. The rental period starts upon pickup and ends upon return, with any extensions pre-approved. You're responsible for the vehicle's condition, and any damages incurred will be charged. Non-compliance may result in additional fees."></textarea>
    
        <br>
  
        <button type="submit" id="submitButton">Submit</button>
        <button type="reset">Reset</button>
    </form>
</div>

<!-- Modal for Disagree -->
<div class="modal fade" id="disagreeModal" tabindex="-1" role="dialog" aria-labelledby="disagreeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="disagreeModalLabel">Warning: Disagree to Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You must agree to the terms and conditions before renting a vehicle.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    function showSuccessMessage() {
        var agreement = document.querySelector('input[name="termCond"]:checked').value;

        if (agreement === "Disagree") {
            $('#disagreeModal').modal('show'); // Show the modal
            return false; // Prevent form submission
        }

        // If agreed, you can enable or show the next steps here

        alert("New reservation has been placed!");
        return true; // Allow form submission
    }
</script>

</body>
</html>