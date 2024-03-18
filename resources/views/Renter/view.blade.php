<!DOCTYPE html>
<html>
<head>
    <title>View renter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle image clicks to open in a modal
            $('.img-clickable').click(function() {
                var imgUrl = $(this).attr('src');
                $('#imageModal').find('.modal-body img').attr('src', imgUrl);
                $('#imageModal').modal('show');
            });
        });
    </script>
</head>
<body>

<!-- Link the new CSS file -->
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
                <tbody>
                    <p class="text-center"><small>Here's the full information of the vehicle renter :</small></p>
                    <tr>
                        <th>Name</th>
                        <td>{{  $model->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{  $model->email }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{  $model->gender }}</td>
                    </tr>
                    <tr>
                        <th>IC</th>
                        <td>{{  $model->renterIC }}</td> 
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{  $model->address }}</td> 
                    </tr>
                    <tr>
                        <th>Student no.</th>
                        <td>{{  $model->studNo }}</td> 
                    </tr>
                    <tr>
                        <th>License no.</th>
                        <td>{{  $model->licenseNo }}</td>
                    </tr>
                    <tr>
                        <th>Phone no.</th>
                        <td>{{  $model->phoneNo }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
                <tbody>
                    <p class="text-center"><small>Click the image for full view</small></p>
                    <tr>
                        <th>IC Image (front)</th>
                        <td><img src="{{ asset('uploads/renter/ic1/'.$model->icImg) }}" class="img-clickable" width="200"></td>
                    </tr>
                    <tr>
                        <th>IC Image (back)</th>
                        <td><img src="{{ asset('uploads/renter/ic2/'.$model->icImg2) }}" class="img-clickable" width="200"></td>
                    </tr>
                    <tr>
                        <th>License Image (front)</th>
                        <td><img src="{{ asset('uploads/renter/lic1/'.$model->licImg) }}" class="img-clickable" width="200"></td>
                    </tr>
                    <tr>
                        <th>License Image (back)</th>
                        <td><img src="{{ asset('uploads/renter/lic2/'.$model->licImg2) }}" class="img-clickable" width="200"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- UNTUK OPEN IMAGE -->
<div class="modal" id="imageModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <img src="" class="img-fluid" alt="Modal Image">
            </div>

        </div>
    </div>
</div>
<div class="text-center mt-3">
    <a class="btn btn-primary" href="{{ action([App\Http\Controllers\Auth\RegisteredUserController::class, 'show'], ['id' => $model->id]) }}">Next</a>
</div>
<br><br>
</body>
</html>
