<!DOCTYPE html>
<html>

<head>
    <title>View vehicle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <style>
        body::-webkit-scrollbar {
            width: 0;
            /* WebKit (Safari, Chrome) */
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
        <div class="row">
            <div class="col-md-4">
                <label for="filterDate">Filter by Date:</label>
                <input type="text" class="form-control" id="filterDate" placeholder="Select date">
            </div>
            <div class="col-md-2">
                <br>
                <button class="btn btn-primary" id="filterButton">Filter</button>
            </div>
        </div>
        <br>
        <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
            <thead>
                <tr>
                    <th>Plate num.</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Booking date</th>
                    <th>Name</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Duration</th>
                    <th>Total price</th>
                    <th>View deposit</th>
                    <th>Download deposit</th>
                    <th>Status</th>
                    <th>Assign</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $value)
                <tr>
                    <td>{{ $value->vePlateNo }}</td>
                    <td>{{ $value->veBrand }}</td>
                    <td>{{ $value->veModel }}</td>
                    <td>{{ $value->reserve->date}}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->reserve->startTime }}</td>
                    <td>{{ $value->reserve->endTime }}</td>
                    <td>{{ ltrim($value->reserve->duration, '-') }}</td> <!-- REMOVE NEGATIVE VALUE -->
                    <td>
                        @php
                        $duration = new \DateTime($value->reserve->duration);
                        $hours = $duration->diff(new \DateTime('00:00:00'))->h;
                        $totalPrice = $value->vePrice * $hours;
                        @endphp

                        RM{{ number_format($totalPrice, 2) }}
                    </td>
                    <td><a href="{{url('/view',$value->bookID)}}" class="btn btn-primary">View</a></td>
                    <td><a href="{{url('/download',$value->file)}}" class="btn btn-success">Download</a></td>
                    <td>{{ $value->status_message ?: 'In Progress' }}</td>
                    <td>
                        <a class="btn btn-primary"
                            href="{{ action([App\Http\Controllers\BookController::class, 'show'], ['bookID' => $value->bookID]) }}">Next</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{-- untuk adjust sum of total price bawah column total price --}}
            <tfoot> 
                <tr>
                    <td colspan="8" align="right"><strong>Total Price:</strong></td>
                    <td id="totalPrice" colspan="5"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#filterDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            $('#filterButton').on('click', function () {
                var selectedDate = $('#filterDate').val();

                // Loop through each row in the table
                $('#dataTable tbody tr').each(function () {
                    var rowDate = $(this).find('td:eq(5)').text(); // Assuming 'created_at' is in the 6th column
                    if (rowDate === selectedDate) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Recalculate and update total price
                calculateTotalPrice();
            });

            // Initial total price calculation
            calculateTotalPrice();

            // Function to calculate and update total price
            function calculateTotalPrice() {
                var total = 0;

                // Loop through visible rows in the table
                $('#dataTable tbody tr:visible').each(function () {
                    var totalPriceCell = $(this).find('td:eq(8)'); // Assuming 'Total price' is in the 9th column
                    var totalPrice = parseFloat(totalPriceCell.text().replace('RM', '').replace(',', ''));
                    total += isNaN(totalPrice) ? 0 : totalPrice;
                });

                // Update the total price cell in the footer
                $('#totalPrice').text('RM' + total.toFixed(2));
            }
        });
    </script>

</body>

</html>