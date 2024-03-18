<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        #sidebar {
            background-color: rgb(58, 58, 58) !important;
            color: white; /* Text color for better readability */
        }
        /* Hover effect for sidebar links */
        #sidebar a.nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>

<body>
    <x-app-layout>
        <div class="container-fluid">
            <div class="row">
                <!-- SIDEBAR -->
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <!-- Sidebar content goes here -->
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
                            <br>
                            <li class="nav-item mb-4">
                                @if(auth()->guard('web')->check() && auth()->user()->status_message == 'completed')
                                <a class="nav-link" href="{{ route('createform-reserve') }}">
                                    Reserve Now
                                </a>
                                @endif
                            </li>
                            <li class="nav-item mb-4">
                                @if(auth()->guard('web')->check() && auth()->user()->status_message == 'completed')
                                <a class="nav-link" href="{{ route('index4') }}">
                                    Booking History
                                </a>
                                @endif
                            </li>
                            <li class="nav-item mb-4">
                                @if(auth()->guard('web')->check() && auth()->user()->status_message == 'completed')
                                <a class="nav-link" href="{{ route('vehicleChart') }}">
                                    Most Rented Vehicle
                                </a>
                                @endif
                            </li>
                            @endif
                            @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
                            <br>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('createform-vehicle') }}">
                                    Add Vehicle
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('index-vehicle') }}">
                                    Manage Vehicle
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('index-renter') }}">
                                    View Renter
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('index3') }}">
                                    View Booking
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('userChart') }}">
                                    Vehicle Renter Statistic
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('bookChart') }}">
                                    Booking Statistic
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="nav-link" href="{{ route('vehicleChart') }}">
                                    Most Rented Vehicle Statistic
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </nav>

                <!-- MAIN CONTENT -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <x-slot name="header">
                        @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com')
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Admin Dashboard') }}
                        </h2>
                        @endif
                        @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('User Dashboard') }}
                        </h2>
                        @endif
                    </x-slot>

                    {{-- @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
                    <!-- Your first content block goes here -->
                    @if(auth()->user()->status_message == 'completed') 
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        {{ __("You're logged in!") }}
                                    </div> 
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        {{ __("Wait for owner verification") }}
                                    </div> 
                                </div>
                            </div>
                        </div>
                    @endif
                    @endif

                    @if(auth()->guard('web')->check() && auth()->user()->email == 'admin123@gmail.com') 
                    <!-- Your admin content goes here -->
                    <div class="py-12"> 
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900"> 
                                    {{ __("You're logged in!") }}
                                </div>
                            </div>
                        </div> 
                    </div>
                    @endif --}}

                    <!-- Chart Section -->
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <h1>Most Rented Vehicle Statistic</h1>
                                    <div style="width: 900px; margin: auto;">
                                        <canvas id="charts"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End of your content -->

                </main>
            </div>
        </div>

        <!-- Include Bootstrap JS and any other necessary scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Add any other scripts your project needs -->

        <!-- Chart Script -->
        <script>
            var ctx = document.getElementById('charts').getContext('2d');
            var userChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!}
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Vehicle Model'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Users'
                            }
                        }
                    }
                }
            });
        </script>
    </x-app-layout>
</body>

</html>