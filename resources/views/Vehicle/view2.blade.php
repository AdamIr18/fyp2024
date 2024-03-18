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

    @if(session('message'))
        <div class="alert alert-success mb-3">{{ session('message') }} </div>
    @endif
    <div class="card border mt-3">
        <div class="card-body">
            <h4>Booking Process (Booking Status Updates)</h4>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <form action="{{ route('books.updateStatus', ['bookID' => $book->bookID]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label>Update Your Booking Status</label>
                        <div class="input-group">
                            <select name="book_status" class="form-select">
                                <option value="">Select All Status</option>  
                                <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }} >In progress</option> 
                                <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }} >Pending</option> 
                                <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }} >Completed</option> 
                            </select>
                                <button type="submit" class="btn btn-primary text-white">Update</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <br/>
                    <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{ $book->status_message ?: 'in progress' }}</span></h4>

            </div>
        </div>
</body>
</html>