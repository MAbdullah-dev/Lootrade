<div class="dahsboard mx-4">
    <section class="Stats">
        <div class="row">
            <!-- Total Users Section -->
            <div class="col-12 col-md-6 col-xl-4 mb-4">
                <div class="card py-5">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-4 "></i>
                        <h4 class="card-title">Total Users</h4>
                        <p class="card-text">1,245</p>
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
        let chart = null;

        function initializeChart() {
            // Destroy existing chart instance if it exists
            if (chart && typeof chart.destroy === 'function') {
                chart.destroy();
            }

            // Check if the chart container exists
            const chartContainer = document.querySelector("#revenueChart");
            if (!chartContainer) {
                console.error("Chart container #revenueChart not found in DOM");
                return;
            }

            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Revenue',
                    data: [1500, 2400, 1800]
                }],
                xaxis: {
                    categories: ['Total Users', 'Active Raffles', 'Tickets Sold']
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

            // Initialize the chart
            chart = new ApexCharts(chartContainer, options);
            chart.render();
        }

        // Initial page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeChart();
        });

        // Livewire navigation event
        window.addEventListener('livewire:navigated', function() {
            // Small delay to ensure DOM is fully updated
            setTimeout(() => {
                initializeChart();
            }, 50);
        });

        // Fallback for Livewire updates (if not using wire:navigate exclusively)
        document.addEventListener('livewire:update', function() {
            initializeChart();
        });
    </script>
@endpush
