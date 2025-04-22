<div class="dahsboard mx-4">
    <section class="Stats">
        <div class="row">
            <!-- Total Users Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4">
                <div class="card py-5">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-4 "></i>
                        <h4 class="card-title">Total Users</h4>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Raffles Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4">
                <div class="card py-5">
                    <div class="card-body text-center">
                        <i class="fas fa-gift fa-2x mb-4 "></i> <!-- Changed icon -->
                        <h4 class="card-title">Active Raffles</h4>
                        <p class="card-text">57</p>
                    </div>
                </div>
            </div>

            <!-- Tickets Sold Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4">
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
    <section class="revenueSection my-5">
        <div class="inner">
            <h4 class="my-4 text-center">Revenue</h4>
            <div id="revenueChart"></div> <!-- This is the actual chart container -->
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
                    background: '#000',
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
@endpush
