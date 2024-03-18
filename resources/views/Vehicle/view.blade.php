<!DOCTYPE html>
<html>
<head>
    <title>View vehicle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                    <tr>
                        <th>Plate num.</th>
                        <td>{{  $model->vePlateNo }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{  $model->veType }}</td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td>{{  $model->veBrand }}</td>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <td>{{  $model->veModel }}</td> 
                    </tr>
                    <tr>
                        <th>Front Image</th>
                        <td><img src="{{ asset('uploads/vehicle/front/'.$model->veImg) }}" width="150"></td>
                    </tr>
                    <tr>
                        <th>Back Image</th>
                        <td><img src="{{ asset('uploads/vehicle/back/'.$model->veImg2) }}" width="150"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
                <tbody>
                    @if ($model->veType != 'Motorcycle')
                    <tr>
                        <th>Interior Image</th>
                        <td><img src="{{ asset('uploads/vehicle/interior/'.$model->veImg3) }}" width="150"></td>
                    </tr>
                    @endif
                    <tr>
                        <th>Price/hour</th>
                        <td>RM{{  $model->vePrice }}</td>
                    </tr>
                    @if ($model->veType != 'Motorcycle')
                    <tr>
                        <th>Number of seats</th>
                        <td>{{  $model->carSeat }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Condition</th>
                        <td>{{  $model->condition }}</td>
                    </tr>
                    <tr>
                        <th>Availability</th>
                        <td>{{  $model->availability }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center mt-3">
        @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
        <a class="btn btn-primary" href="{{ route('updateformAv-vehicle',['id'=>$model->veID]) }}">Book Now</a>
        @endif 
    </div>
</div>

</body>
</html>
