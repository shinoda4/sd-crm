<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">CRM 数据分析</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2">

        {{-- 客户潜在订单数量统计 --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <h3 class="text-lg font-medium mb-2">客户潜在订单数量统计</h3>
            <canvas id="dealsChart" width="400" height="200"></canvas>
        </div>

        {{-- 潜在订单阶段分布 --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <h3 class="text-lg font-medium mb-2">潜在订单阶段分布</h3>
            <canvas id="dealsStageChart" width="400" height="200"></canvas>
        </div>

        {{-- 每个负责人潜在订单数量 --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <h3 class="text-lg font-medium mb-2">负责人潜在订单数量</h3>
            <canvas id="dealsOwnerChart" width="400" height="200"></canvas>
        </div>

        {{-- 活动类型分布 --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <h3 class="text-lg font-medium mb-2">活动类型分布</h3>
            <canvas id="activitiesChart" width="400" height="200"></canvas>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dealsChart = new Chart(document.getElementById('dealsChart').getContext('2d'), {
            type: 'bar', // 条形图
            data: {
                labels: @json($labels), // 客户名称
                datasets: [{
                    label: '潜在订单数量',
                    data: @json($data),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // 每隔 1 个单位
                        }
                    }
                }
            }
        });
        const dealsStageChart = new Chart(document.getElementById('dealsStageChart'), {
            type: 'pie',
            data: {
                labels: @json($dealsByStage->keys()),
                datasets: [{
                    data: @json($dealsByStage->values()),
                    backgroundColor: ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd']
                }]
            }
        });

        const dealsOwnerChart = new Chart(document.getElementById('dealsOwnerChart'), {
            type: 'bar',
            data: {
                labels: @json($dealsByOwner->keys()),
                datasets: [{
                    label: '潜在订单数量',
                    data: @json($dealsByOwner->values()),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true,  ticks: {
                            stepSize: 1 // 每隔 1 个单位
                        } } } }
        });

        const activitiesChart = new Chart(document.getElementById('activitiesChart'), {
            type: 'doughnut',
            data: {
                labels: @json($activitiesByType->keys()),
                datasets: [{
                    data: @json($activitiesByType->values()),
                    backgroundColor: ['#ff6384','#36a2eb','#ffcd56','#4bc0c0','#9966ff']
                }]
            }
        });
    </script>
</x-app-layout>
