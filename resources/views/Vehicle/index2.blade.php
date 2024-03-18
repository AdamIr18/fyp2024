<!DOCTYPE html>
<html>
<head>
    <title>View vehicle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body::-webkit-scrollbar {
            width: 0; /* WebKit (Safari, Chrome) */
        }
    </style>
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
                <a class="nav-link" href="{{ route('index4') }}">Booking history</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <br>
    <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
        <thead>
            <tr>
                <th>Plate num.</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Price/hour</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Total price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $value)
            <tr>
                <td>{{ $value->vePlateNo }}</td> 
                <td>{{ $value->veType }}</td>
                <td>{{ $value->veBrand }}</td>
                <td>{{ $value->veModel }}</td>
                <td>RM{{ $value->vePrice }}</td>
                <td>{{ $value->user->name }}</td>
                <td>{{ $value->reserve->duration }}</td>
                <td>
                    @php
                        $duration = new \DateTime($value->reserve->duration);
                        $hours = $duration->diff(new \DateTime('00:00:00'))->h;
                        $totalPrice = $value->vePrice * $hours;
                    @endphp

                    RM{{ number_format($totalPrice, 2) }}
                </td>
                <td>
                <button class="btn btn-primary"onclick="window.print()">Print detail</button>
                <form action="{{ route('delete-book',['id'=>$value->bookID]) }}" method="get">
                    @csrf
                    @method('delete') 
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel booking</button>
                </form> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>