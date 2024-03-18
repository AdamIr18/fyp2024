<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

                    @if(auth()->guard('web')->check() && auth()->user()->email != 'admin123@gmail.com')
                    <!-- Your first content block goes here -->
                    @if(auth()->user()->status_message == 'completed') 
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        Hello, {{ auth()->user()->name }} ! {{ __("You're logged in") }}
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
                                    Hello, {{ auth()->user()->name }} ! {{ __("You're logged in") }}
                                </div>
                            </div>
                        </div> 
                    </div>
                    @endif
                </main>
            </div>
        </div>

        <!-- Include Bootstrap JS and any other necessary scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Add any other scripts your project needs -->
    </x-app-layout>
</body>

</html>