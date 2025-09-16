<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Experience Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12 px-6">

 <div class="row mt-6">
    <div class="col-lg-6 connectedSortable">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 flex items-center justify-between mb-6 hover:shadow-xl transition">
            <div>
                <h2 class="text-gray-600 dark:text-gray-300 text-sm font-medium">
                    Total Project
                </h2>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">
                    {{ $totalProjects }}
                </p>
            </div>
            <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded-full">
                <i class="fas fa-folder-open text-blue-600 dark:text-blue-300 text-2xl"></i>
            </div>
        </div>
    </div>
</div>


          
    <div class="row">

    <!-- Yearly Chart -->
    <div class="col-lg-6 connectedSortable">
        <div class="card mb-4 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-calendar-alt text-blue-500"></i>
                Projects by Year
            </h3>
            <canvas id="yearlyChart" class="h-56 w-full"></canvas>
        </div>
    </div>
   

      <!-- Amount per Year -->
    <div class="col-lg-6 connectedSortable">
        <div class="card mb-4 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-dollar-sign text-orange-500"></i>
                Total Amount per Year
            </h3>
            <canvas id="amountChart" class="h-56 w-full"></canvas>
        </div>
    </div>
</div>

<div class="row mt-4">
    
 <!-- Category Chart -->
    <div class="col-lg-6 connectedSortable">
        <div class="card mb-4 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-layer-group text-indigo-500"></i>
                Projects by Category
            </h3>
            <canvas id="categoryChart" class="h-56 w-full"></canvas>
        </div>
    </div>

     <!-- Status Chart -->
    <div class="col-lg-6 connectedSortable">
        <div class="card mb-4 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-tasks text-green-500"></i>
                Projects by Status
            </h3>
          <canvas id="statusChart" style="width:450px; height:450px; margin:auto;"></canvas>
        </div>
    </div>
</div>

</div>






    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Category chart
        const categoryLabels = @json($categoryCounts->pluck('category'));
        const categoryData = @json($categoryCounts->pluck('total'));

        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: 'Projects',
                    data: categoryData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Status chart
        const statusLabels = @json($statusCounts->pluck('status'));
        const statusData = @json($statusCounts->pluck('total'));

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Yearly chart
        const yearlyLabels = @json($yearlyCounts->pluck('year'));
        const yearlyData = @json($yearlyCounts->pluck('total'));

        new Chart(document.getElementById('yearlyChart'), {
            type: 'line',
            data: {
                labels: yearlyLabels,
                datasets: [{
                    label: 'Projects',
                    data: yearlyData,
                    borderColor: 'rgba(99, 102, 241, 1)',
                    backgroundColor: 'rgba(99, 102, 241, 0.3)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });

        // Amount per year
        @if(isset($amountPerYear))
        const amountLabels = @json($amountPerYear->pluck('year'));
        const amountData = @json($amountPerYear->pluck('total_amount'));

        new Chart(document.getElementById('amountChart'), {
            type: 'bar',
            data: {
                labels: amountLabels,
                datasets: [{
                    label: 'Total Amount',
                    data: amountData,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
        @endif
    </script>
</x-app-layout>
