<div class="dahsboard mx-4" role="main" aria-label="Admin Dashboard">
    <style>
        .card {
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
        }
    </style>
    <div class="row mt-5">
        <!-- 1. New Users -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>New Users - Last 7 Days</h5>
                <canvas id="newUsersChart" height="200"></canvas>
            </div>
        </div>

        <!-- 2. Daily Active Users -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>Daily Active Users</h5>
                <canvas id="activeUsersChart" height="200"></canvas>
            </div>
        </div>

        <!-- 3. Raffles by Status -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>Raffles by Status</h5>
                <canvas id="raffleStatusChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- 4. Average Login Frequency -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>Average Login Frequency</h5>
                <canvas id="loginFrequencyChart" height="200"></canvas>
            </div>
        </div>

        <!-- 5. Tickets Earned vs Used -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>Tickets Earned vs Used</h5>
                <canvas id="ticketsChart" height="200"></canvas>
            </div>
        </div>

        <!-- 6. Top Active Users -->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>Top Active Users</h5>
                <canvas id="topUsersChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- 7. Raffle Participation -->
        <div class="col-md-12 mb-4">
            <div class="card bg-dark text-white p-3">
                <h5>Total Raffle Participation</h5>
                <canvas id="raffleParticipationChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dates = @json($dates);
        const newUsers = @json($newUsersChartData);
        const activeUsers = @json($activeUsersChartData);
        const raffleStatus = @json($raffleStatusData);
        const loginFrequency = @json($loginFrequencyChartData);
        const ticketsEarned = @json($ticketsEarnedChartData);
        const ticketsUsed = @json($ticketsUsedChartData);
        const topUsernames = @json($topUsernames);
        const topUserPlayCounts = @json($topUserPlayCounts);
        const raffleParticipation = @json($raffleParticipationChartData);

        // All chart code stays the same
        new Chart(document.getElementById('newUsersChart'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'New Users',
                    data: newUsers,
                    borderColor: '#4dff4d',
                    backgroundColor: 'rgba(77, 255, 77, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
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

        new Chart(document.getElementById('activeUsersChart'), {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Daily Active Users',
                    data: activeUsers,
                    backgroundColor: '#00ccff',
                    borderRadius: 5
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

        new Chart(document.getElementById('raffleStatusChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(raffleStatus),
                datasets: [{
                    label: 'Raffle Status',
                    data: Object.values(raffleStatus),
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336']
                }]
            }
        });

        new Chart(document.getElementById('loginFrequencyChart'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Login Frequency (%)',
                    data: loginFrequency,
                    borderColor: '#ffcc00',
                    backgroundColor: 'rgba(255, 204, 0, 0.2)',
                    fill: true,
                    tension: 0.3
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

        new Chart(document.getElementById('ticketsChart'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                        label: 'Tickets Earned',
                        data: ticketsEarned,
                        borderColor: '#00e676',
                        backgroundColor: 'rgba(0, 230, 118, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Tickets Used',
                        data: ticketsUsed,
                        borderColor: '#ff1744',
                        backgroundColor: 'rgba(255, 23, 68, 0.2)',
                        fill: true
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('topUsersChart'), {
            type: 'bar',
            data: {
                labels: topUsernames,
                datasets: [{
                    label: 'Ticket Plays',
                    data: topUserPlayCounts,
                    backgroundColor: '#42a5f5'
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('raffleParticipationChart'), {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Raffle Entries',
                    data: raffleParticipation,
                    borderColor: '#9c27b0',
                    backgroundColor: 'rgba(156, 39, 176, 0.2)',
                    fill: true,
                    tension: 0.3
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
    </script>
@endpush

{{-- <div class="dahsboard mx-4" role="main" aria-label="Admin Dashboard">
    <h1 class="visually-hidden">Admin Dashboard Overview</h1>
    <section class="Stats">
        <div class="row">
            <!-- Total Users Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4" aria-label="Total Users">
                <div class="card py-5">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-4 "></i>
                        <h4 class="card-title">Total Users</h4>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Raffles Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4" aria-label="Active Raffles">
                <div class="card py-5">
                    <div class="card-body text-center">
                        <i class="fas fa-gift fa-2x mb-4 "></i> <!-- Changed icon -->
                        <h4 class="card-title">Active Raffles</h4>
                        <p class="card-text">57</p>
                    </div>
                </div>
            </div>

            <!-- Tickets Sold Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4" aria-label="Tickets Sold">
                <div class="card py-5">
                    <div class="card-body text-center">
                        <i class="fas fa-ticket fa-2x mb-4 "></i>
                        <h4 class="card-title">Tickets Sold</h4>
                        <p class="card-text">3,890</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="revenueSection my-5" aria-label="Monthly Revenue Chart">
        <div class="inner">
            <h4 class="my-4 text-center gradient">Revenue</h4>
            <div id="revenueChart" role="img" aria-label="Bar chart showing monthly revenue trends" tabindex="0">
            </div>
        </div>
    </section>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function initializeChart() {
            const chartContainer = document.querySelector("#revenueChart");

            if (!chartContainer) {
                console.error("Chart container #revenueChart not found in DOM");
                return;
            }

            // If chart is already rendered on the DOM, destroy it
            if (chartContainer.chartInstance && typeof chartContainer.chartInstance.destroy === 'function') {
                chartContainer.chartInstance.destroy();
            }

            const options = {
                chart: {
                    type: 'bar',
                    height: 350,
                    // background: '#1F0B46',
                    foreColor: '#fff'
                },
                series: [{
                    name: 'Revenue',
                    data: @json(array_values($monthlyRevenue))
                }],
                xaxis: {
                    categories: @json($monthLabels)
                },
                colors: ['#007bff'],
                title: {
                    text: 'Static Revenue Data (USD)',
                    align: 'left'
                },
                dataLabels: {
                    enabled: true
                }
            };

            const newChart = new ApexCharts(chartContainer, options);
            newChart.render();

            // Store the chart instance on the DOM element
            chartContainer.chartInstance = newChart;
        }

        document.addEventListener('DOMContentLoaded', initializeChart);

        window.addEventListener('livewire:navigated', () => {
            setTimeout(initializeChart, 100);
        });

        document.addEventListener('livewire:update', () => {
            setTimeout(initializeChart, 100);
        });
    </script>
@endpush --}}
