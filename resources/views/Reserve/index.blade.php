<!DOCTYPE html>
<html>
<head>
    <title>View Rerseve</title>
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
                <a class="nav-link" href="{{ route('index4') }}">Booking history</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <br>
    <a class="btn btn-primary" href="{{ route('index-vehicle') }}">Choose Vehicle</a> <!-- Added Create Vehicle Button -->
    <br><br>
    <div class="form-group">
        <label for="filter">Filter :</label>
        <input type="text" class="form-control" id="filter" placeholder="Enter Date, Start Time, End Time, Term and Condition, Price per Car or Total Price">
    </div>

<p>Click the header to sort :</p>

<table class="table table-bordered" id="dataTable" width="" cellspacing="0">
    <thead>
        <tr>
            <th onclick="sortTable(0)">Date</th>
            <th onclick="sortTable(1)">Start time</th> 
            <th onclick="sortTable(2)">End time</th>
            <th onclick="sortTable(3)">Term and condition</th> 
            <th>Name</th>
            {{-- <th onclick="sortTable(4)">Price per car</th>
            <th onclick="sortTable(5)">Total Price</th> --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $model as $value )
        <tr>
            <td>{{  $value->date }}</td>
            <td>{{  $value->startTime }}</td>
            <td>{{  $value->endTime }}</td>
            <td>{{  $value->termCond }}</td>
            {{-- <td>{{  $value->price }}</td>
            <td>RM{{  $value->total_price}}</td>  --}}
            <td>{{ $value->user->name }}</td>
            <td><a class="btn btn-primary" href="{{ route('updateform-reserve',['id'=>$value->reserveID]) }}">Update</a></td>
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
                var date = $(this).find('td:first').text().toLowerCase();
                var startTime = $(this).find('td:eq(1)').text().toLowerCase();
                var endTime = $(this).find('td:eq(2)').text().toLowerCase();
                var termCond = $(this).find('td:eq(3)').text().toLowerCase();
                var price = $(this).find('td:eq(4)').text().toLowerCase();
                var total_price = $(this).find('td:eq(5)').text().toLowerCase();

                if (date.includes(filterValue) || startTime.includes(filterValue) || endTime.includes(filterValue) || termCond.includes(filterValue) || price.includes(filterValue) || total_price.includes(filterValue)) {
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