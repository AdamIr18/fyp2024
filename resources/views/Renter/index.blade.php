<!DOCTYPE html>
<html>
<head>
    <title>View renter</title>
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
    <div class="form-group">
        <label for="filter">Filter :</label>
        <input type="text" class="form-control" id="filter" placeholder="Enter Name, Gender, IC, Address, Student no. or Phone no.">
    </div>

    <p>Click the header to sort :</p>

    <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Name</th>
                <th onclick="sortTable(1)">Gender</th>
                <th onclick="sortTable(2)">IC</th>
                <th onclick="sortTable(3)">Address</th>
                <th onclick="sortTable(4)">Student no.</th>
                <th onclick="sortTable(5)">Phone no.</th>
                <th>Status</th>
                <th>More information</th> 
                <th>Assign</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $model as $value )
            @if ($value->email != 'admin123@gmail.com') <!-- Check if email is not 'admin123@gmail.com' -->
            <tr>
                <td>{{  $value->name }}</td>
                <td>{{  $value->gender }}</td>
                <td>{{  $value->renterIC }}</td>
                <td>{{  $value->address }}</td>
                <td>{{  $value->studNo }}</td> 
                <td>{{  $value->phoneNo }}</td>
                <td>{{ $value->status_message ?: 'In Progress' }}</td>
                <td>
                    <a class="btn btn-primary text-sm" href="{{ route('view-renter',['id'=>$value->id]) }}">View</a>
                </td>                
                <td>
                    <a class="btn btn-primary"
                        href="{{ action([App\Http\Controllers\Auth\RegisteredUserController::class, 'show'], ['id' => $value->id]) }}">Next</a>
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
                var name = $(this).find('td:first').text().toLowerCase();
                var gender = $(this).find('td:eq(1)').text().toLowerCase();
                var renterIC = $(this).find('td:eq(2)').text().toLowerCase();
                var address = $(this).find('td:eq(3)').text().toLowerCase();
                var studNo = $(this).find('td:eq(4)').text().toLowerCase();
                var phoneNo = $(this).find('td:eq(5)').text().toLowerCase();

                if (name.includes(filterValue) || gender.includes(filterValue) || renterIC.includes(filterValue) || address.includes(filterValue) || studNo.includes(filterValue) || phoneNo.includes(filterValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

</body>
</html>