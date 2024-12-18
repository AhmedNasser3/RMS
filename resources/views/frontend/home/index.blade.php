@extends('admin.master')

@section('adminContent')
<div class="home">
    <!-- Dashboard -->
    <div class="dashboard">
        <!-- Menu -->
        <div class="menu flex-c">
            <!-- محتوى القائمة هنا -->
        </div>
        <!-- End Menu -->

        <div class="content">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Head -->
                <div class="flex head">
                    <h1>Good Morning 👋</h1>
                    <div class="flex box time-period" onclick="toggleTimePeriodMenu()">
                        <span id="selected-period">{{ $timePeriod }} - {{ $dateCondition }}</span>
                        <ion-icon id="angle-icon" class="angle" name="caret-down-outline"></ion-icon>
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="time-period-menu" class="hidden dropdown">
                        <div class="dropdown-item" onclick="changeTimePeriod('Daily')" >Daily</div>
                        <div class="dropdown-item" onclick="changeTimePeriod('Weekly')">Weekly</div>
                        <div class="dropdown-item" onclick="changeTimePeriod('Monthly')">Monthly</div>
                        <div class="dropdown-item" onclick="changeTimePeriod('Yearly')">Yearly</div>
                    </div>

                    <div class="flex box">
                        <ion-icon name="search-outline"></ion-icon>
                    </div>
                </div>
                <!-- End Head -->

                <!-- Date Filters -->
                <div class="date-filters">
                    <form method="GET" action="{{ route('home.page') }}">
                        <div class="flex">
                            <input type="date" class="calender_timer" name="start_date" value="{{ $startDate }}" />
                            <input type="date" name="end_date" class="calender_timer" value="{{ $endDate }}" />
                            <!-- تعديل زر الفلتر ليصبح أصغر -->
                            <button type="submit" class="btn small-btn" style="color: white">Filter</button>
                        </div>
                    </form>
                </div>

                <!-- Time Period Stats Bar -->
                <div class="time-period-stats">
                    <div class="flex time-period-bar">
                        <span class="time-period-item" onclick="changeTimePeriod('Daily')">Daily</span>
                        <span class="time-period-item" onclick="changeTimePeriod('Weekly')">Weekly</span>
                        <span class="time-period-item" onclick="changeTimePeriod('Monthly')">Monthly</span>
                        <span class="time-period-item" onclick="changeTimePeriod('Yearly')">Yearly</span>
                    </div>
                </div>

                <!-- Stats -->
                <div class="flex stats">
                    <!-- Wages Chart -->
                    <div class="stats box sales">
                        <h2 class="heading">Wages</h2>
                        <canvas id="sales"></canvas>
                    </div>
                    <div class="box_price">
                        <div class="box_price_title">
                            <h2>مرتبات</h2>
                            <h4>الاجمالي : <span style="color: white;">100</span></h4>
                        </div>
                    </div>
                </div>
                <!-- Stats -->
                <div class="flex stats">
                    <!-- Payments Chart -->
                    <div class="stats box sales">
                        <h2 class="heading">Payments</h2>
                        <canvas id="payments"></canvas>
                    </div>
                    <div class="box_price">
                        <div class="box_price_title">
                            <h2>المدفوعات</h2>
                            <h4>الاجمالي : <span style="color: white;">{{ $totalPayments }}</span></h4>
                        </div>
                    </div>
                </div>

                <!-- Display Time Period Stats -->
                <div id="timePeriodStats">
                    <!-- Stats Table or Content will be dynamically updated here -->
                </div>

            </div>
            <!-- End Main Content -->
        </div>
    </div>
    <!-- End Dashboard -->



</div>


<!-- Include JS Files -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sales = document.getElementById("sales");

        const monthlyWages = @json($monthlyWages);
        const periodLabels = @json($monthlyWages->pluck('period'));
        const wageData = @json($monthlyWages->pluck('total_wages'));

        new Chart(sales, {
            type: "bar", // Bar chart for wages (Sales)
            data: {
                labels: periodLabels,
                datasets: [{
                    label: "Wages",
                    data: wageData,
                    backgroundColor: ["rgba(54, 162, 235, 0.7)"],
                    hoverBackgroundColor: "rgba(54, 162, 235, 1)",
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, labels: { font: { size: 14 } } },
                },
                scales: {
                    x: { title: { display: true, text: "Time Period" } },
                    y: { title: { display: true, text: "Total Wages" } },
                },
            },
        });

        const timePeriodMenu = document.getElementById("time-period-menu");
        const selectedPeriod = document.getElementById("selected-period");

        function toggleTimePeriodMenu() {
            timePeriodMenu.classList.toggle("hidden");
        }

        function changeTimePeriod(period) {
            selectedPeriod.textContent = period;
            timePeriodMenu.classList.add("hidden");

            const url = new URL(window.location.href);
            url.searchParams.set('period', period);

            // Update the table or stats according to the period selected
            updateTimePeriodStats(period);

            window.location.href = url.toString();
        }

        function updateTimePeriodStats(period) {
            const timePeriodStatsDiv = document.getElementById('timePeriodStats');

            // Clear the existing stats
            timePeriodStatsDiv.innerHTML = '';

            switch (period) {
                case 'Daily':
                    timePeriodStatsDiv.innerHTML = '<p>Daily Stats will be shown here.</p>';
                    break;
                case 'Weekly':
                    timePeriodStatsDiv.innerHTML = '<p>Weekly Stats will be shown here.</p>';
                    break;
                case 'Monthly':
                    timePeriodStatsDiv.innerHTML = '<p>Monthly Stats will be shown here.</p>';
                    break;
                case 'Yearly':
                    timePeriodStatsDiv.innerHTML = '<p>Yearly Stats will be shown here.</p>';
                    break;
                default:
                    timePeriodStatsDiv.innerHTML = '<p>Invalid period selected.</p>';
            }
        }
    </script>

    {{--  payments  --}}

<!-- Add some custom CSS for the new elements -->
<style>
    .btn.small-btn {
        padding: 5px 10px;
        font-size: 12px;
    }

    .time-period-stats .time-period-bar {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
    }

    .time-period-item {
        padding: 10px 0 0 0 ;
        margin-left: 10px;
        cursor: pointer;
        font-weight: bold;
        color: white
    }

    .time-period-item:hover {
        color: #724563;
    }
</style>
@endsection

