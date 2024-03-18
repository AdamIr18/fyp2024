<!-- OWNER -->

@if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
<!DOCTYPE html>
<html lang="en">
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
@if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
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
@endif

@if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
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
@endif

<div class="container">
    <br>
    <div class="form-group">
        <label for="filter">Filter :</label>
        <input type="text" class="form-control" id="filter" placeholder="Enter Plate Number, Type, Brand, Model, Price, Condition, or Availability">
    </div>

    <p>Click the header to sort :</p>

    <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Plate num.</th>
                <th onclick="sortTable(1)">Type</th>
                <th onclick="sortTable(2)">Brand</th>
                <th onclick="sortTable(3)">Model</th>
                <th onclick="sortTable(4)">Image</th>
                <th onclick="sortTable(5)">Price/hour</th>
                <th onclick="sortTable(6)">Condition</th>
                <th onclick="sortTable(7)">Availability</th>
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
                        <td><img src="{{ asset('uploads/vehicle/front/'.$value->veImg) }}" width="150"></td>
                        <td>RM{{ $value->vePrice }}</td>
                        <td>{{ $value->condition }}</td>
                        <td>{{ $value->availability }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('view-vehicle',['id'=>$value->veID]) }}">More info</a>
                            
                            @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com') 
                            <a class="btn btn-primary" href="{{ route('updateformAv-vehicle',['id'=>$value->veID]) }}">Book</a>
                            @endif
        
                            @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
                            <a class="btn btn-primary" href="{{ route('updateform-vehicle',['id'=>$value->veID]) }}">Update</a>
                            @endif
        
                            @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
                            <form action="{{ route('delete-vehicle',['id'=>$value->veID]) }}" method="get">
                                @csrf
                                @method('delete') 
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form> 
                            @endif
                        </td>
                    </tr>
            @endforeach 
        </tbody>        
    </table>
</div>

<script>
    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("dataTable");
        switching = true;

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    $(document).ready(function () {
        $('#filter').keyup(function () {
            var filterValue = $(this).val().toLowerCase();

            $('#dataTable tbody tr').each(function () {
                var vePlateNo = $(this).find('td:first').text().toLowerCase();
                var veType = $(this).find('td:eq(1)').text().toLowerCase();
                var veBrand = $(this).find('td:eq(2)').text().toLowerCase();
                var veModel = $(this).find('td:eq(3)').text().toLowerCase();
                var vePrice = $(this).find('td:eq(4)').text().toLowerCase();
                var condition = $(this).find('td:eq(5)').text().toLowerCase();
                var availability = $(this).find('td:eq(6)').text().toLowerCase();

                if (vePlateNo.includes(filterValue) || veType.includes(filterValue) || veBrand.includes(filterValue) || veModel.includes(filterValue) || vePrice.includes(filterValue) || condition.includes(filterValue) || availability.includes(filterValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    }); 

    function confirmSaveConfirmation() {
        return confirm("Do you want to proceed?");
    }
</script>

</body>
</html>
@endif

<!-- VEHICLE RENTER -->

@if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com') 
<!DOCTYPE html>
<html lang="en">
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
@if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
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
@endif

@if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
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
@endif

<div class="container">
    <br>
    <div class="form-group">
        <label for="filter">Filter :</label>
        <input type="text" class="form-control" id="filter" placeholder="Enter Plate Number, Type, Brand, Model, Price, Condition, or Availability">
    </div>

    <p>Click the header to sort :</p>

    <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Plate num.</th>
                <th onclick="sortTable(1)">Type</th>
                <th onclick="sortTable(2)">Brand</th>
                <th onclick="sortTable(3)">Model</th>
                <th onclick="sortTable(4)">Image</th>
                <th onclick="sortTable(5)">Price/hour</th>
                <th onclick="sortTable(6)">Condition</th>
                <th onclick="sortTable(7)">Availability</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $value)
                @if ($value->availability == 'Yes' && $value->condition == 'Good')
                    <tr>
                        <td>{{ $value->vePlateNo }}</td>
                        <td>{{ $value->veType }}</td>
                        <td>{{ $value->veBrand }}</td> 
                        <td>{{ $value->veModel }}</td>
                        <td><img src="{{ asset('uploads/vehicle/front/'.$value->veImg) }}" width="150"></td>
                        <td>RM{{ $value->vePrice }}</td>
                        <td>{{ $value->condition }}</td>
                        <td>{{ $value->availability }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('view-vehicle',['id'=>$value->veID]) }}">More info</a>
                            
                            @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com') 
                            <a class="btn btn-primary" href="{{ route('updateformAv-vehicle',['id'=>$value->veID]) }}">Book</a>
                            @endif
        
                            @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
                            <a class="btn btn-primary" href="{{ route('updateform-vehicle',['id'=>$value->veID]) }}">Update</a>
                            @endif
        
                            @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
                            <form action="{{ route('delete-vehicle',['id'=>$value->veID]) }}" method="get">
                                @csrf
                                @method('delete') 
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form> 
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach 
        </tbody>        
    </table>
</div>

<script>
    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("dataTable");
        switching = true;

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    $(document).ready(function () {
        $('#filter').keyup(function () {
            var filterValue = $(this).val().toLowerCase();

            $('#dataTable tbody tr').each(function () {
                var vePlateNo = $(this).find('td:first').text().toLowerCase();
                var veType = $(this).find('td:eq(1)').text().toLowerCase();
                var veBrand = $(this).find('td:eq(2)').text().toLowerCase();
                var veModel = $(this).find('td:eq(3)').text().toLowerCase();
                var vePrice = $(this).find('td:eq(4)').text().toLowerCase();
                var condition = $(this).find('td:eq(5)').text().toLowerCase();
                var availability = $(this).find('td:eq(6)').text().toLowerCase();

                if (vePlateNo.includes(filterValue) || veType.includes(filterValue) || veBrand.includes(filterValue) || veModel.includes(filterValue) || vePrice.includes(filterValue) || condition.includes(filterValue) || availability.includes(filterValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    }); 

    function confirmSaveConfirmation() {
        return confirm("Do you want to proceed?");
    }
</script>

</body>
</html>
@endif