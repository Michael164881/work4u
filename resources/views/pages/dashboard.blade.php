@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <style>
        .card-stats {
            transition: transform 0.3s ease-in-out;
        }

        .card-stats:hover:not(.no-hover) {
            transform: scale(1.05);
            cursor: pointer;
        }
    </style>

    <div class="content">
        <div class="row">
            <!-- Customer Statistics Card -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" onclick="window.location='/user'">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-02 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Customers</p>
                                    <p class="card-title">{{ $customerCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Freelancer Statistics Card -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" onclick="window.location='/user'">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-success">
                                    <i class="nc-icon nc-single-copy-04 text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Freelancers</p>
                                    <p class="card-title">{{ $freelancerCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commissions Statistics Card -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats no-hover">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-danger">
                                    <i class="nc-icon nc-layout-11 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Work/Job</p>
                                    <p class="card-title">{{ $workDescriptionCount + $jobRequestCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Cancellation Statistics Card -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" onclick="window.location='{{ url('icons.blade.php') }}'">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-danger">
                                    <i class="nc-icon nc-layout-11 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Bookings</p>
                                    <p class="card-title">{{ $bookingCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Simple Bar Chart -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Simple Statistic</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Recent Activities</h5>
                    </div>
                    <div class="card-body ">
                        <ul class="list-unstyled">
                            <li>
                                <p>User John Doe registered.</p>
                            </li>
                            <li>
                                <p>Project "Website Redesign" was updated.</p>
                            </li>
                            <li>
                                <p>Freelancer Jane Smith added a new skill.</p>
                            </li>
                            <!-- Add more activities as needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- User Management Table -->
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">User Management</h5>
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <td>User</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>jane@example.com</td>
                                    <td>Freelancer</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize charts and other components if needed
            

            // Bar Chart
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Customers', 'Freelancers', 'Pending Cancelation', 'Work', 'Job'],
                    datasets: [{
                        label: '# of Items',
                        data: [{{ $customerCount }}, {{ $freelancerCount }}, {{ $bookingCount }}, {{ $workDescriptionCount }}, {{ $jobRequestCount }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
