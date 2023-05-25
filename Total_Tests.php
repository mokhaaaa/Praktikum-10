<!DOCTYPE html>
<html>
<head>
    <title>Total Tests Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="display: flex; justify-content: space-around; align-items: center; margin-top: 50px;">
        <div style="width: 500px; height: 500px;">
            <h2>Bar Chart - Total Tests</h2>
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <div style="display: flex; justify-content: space-around; align-items: center; margin-top: -80px;">
        <div style="width: 500px; height: 500px;">
            <h2>Line Chart - Total Tests</h2>
            <canvas id="lineChart"></canvas>
        </div>
    </div>
    <div style="display: flex; justify-content: space-around; align-items: center; margin-top: -100px;">
        <div style="width: 400px; height: 400px;">
            <h2>Pie Chart - Total Tests</h2>
            <canvas id="pieChart"></canvas>
        </div>
    </div>
    <div style="display: flex; justify-content: space-around; align-items: center; margin-top: 80px;">
        <div style="width: 400px; height: 400px;">
            <h2>Donut Chart - Total Tests</h2>
            <canvas id="donutChart"></canvas>
        </div>
    </div>
    <script>
        <?php
        // Koneksi ke database
        include('koneksi.php');

        // Query untuk mengambil data penjualan
        $sql = "SELECT country, total_tests FROM covid_data";
        $result = $koneksi->query($sql);

        $negara = array();
        $total_tests = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $negara[] = $row["country"];
                $total_tests[] = $row["total_tests"];
            }
        }

        // Tutup koneksi
        $koneksi->close();
        ?>

        var ctx1 = document.getElementById("barChart").getContext('2d');
        var barChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    label: 'Total Tests',
                    data: <?php echo json_encode($total_tests); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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

        var ctx2 = document.getElementById("pieChart").getContext('2d');
        var pieChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    data: <?php echo json_encode($total_tests); ?>,
                    backgroundColor: [
                        'rgba(240, 15, 255, 1.0)',
                        'rgba(250, 174, 215, 1.0)',
                        'rgba(0, 15, 255, 1.0)',
                        'rgba(127, 255, 212, 1.0)',
                        'rgba(229, 82, 42, 1.0)',
                        'rgba(222, 235, 135, 1.0)',
                        'rgba(30, 233, 255, 1.0)',
                        'rgba(119, 120, 153, 1.0)',
                        'rgba(220, 197, 92, 1.0)',
                        'rgba(124, 207, 0, 1.0)'
                    ],
                    borderColor: [
                        'rgba(240, 15, 255, 0.75)',
                        'rgba(250, 174, 215, 0.75)',
                        'rgba(0, 15, 255, 0.75)',
                        'rgba(127,255, 212, 0, 0.75)',
                        'rgba(229, 82, 42, 0.75)',
                        'rgba(222, 235, 135, 0.75)',
                        'rgba(30, 233, 255, 0.75)',
                        'rgba(119, 120, 153, 0.75)',
                        'rgba(220, 197, 92, 0.75)',
                        'rgba(124, 207, 0, 0.75)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        var ctx3 = document.getElementById("lineChart").getContext('2d');
        var lineChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    label: 'Total Tests',
                    data: <?php echo json_encode($total_tests); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
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

        var ctx4 = document.getElementById("donutChart").getContext('2d');
        var donutChart = new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    data: <?php echo json_encode($total_tests); ?>,
                    backgroundColor: [
                        'rgba(240, 15, 255, 1.0)',
                        'rgba(250, 174, 215, 1.0)',
                        'rgba(0, 15, 255, 1.0)',
                        'rgba(127, 255, 212, 1.0)',
                        'rgba(229, 82, 42, 1.0)',
                        'rgba(222, 235, 135, 1.0)',
                        'rgba(30, 233, 255, 1.0)',
                        'rgba(119, 120, 153, 1.0)',
                        'rgba(220, 197, 92, 1.0)',
                        'rgba(124, 207, 0, 1.0)'
                    ],
                    borderColor: [
                        'rgba(240, 15, 255, 0.75)',
                        'rgba(250, 174, 215, 0.75)',
                        'rgba(240, 15, 255, 0.75)',
                        'rgba(127, 255, 212, 0.75)',
                        'rgba(229, 82, 42, 0.75)',
                        'rgba(222, 235, 135, 0.75)',
                        'rgba(30, 233, 255, 0.75)',
                        'rgba(119, 120, 153, 0.75)',
                        'rgba(220, 197, 92, 0.75)',
                        'rgba(124, 207, 0, 0.75)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>

