<?php
include('koneksi.php');
$query = mysqli_query($koneksi, "SELECT country, total_cases FROM covid_data ORDER BY total_cases DESC LIMIT 10");
$nama_negara = array(); $total_kasus = array();
while ($row = mysqli_fetch_array($query)) {
    $nama_negara[] = $row['country'];
    $total_kasus[] = $row['total_cases']; }
$max_value = max($total_kasus); $min_value = min($total_kasus);
$color_scale = array();
foreach ($total_kasus as $value) {
    $percentage = ($value - $min_value) / ($max_value - $min_value);
    $color = "rgba(255, ".(255 - $percentage * 255).", 0, 0.6)";
    $color_scale[] = $color; }
?>
<!DOCTYPE html>
<html>
<head> <title>Membuat Grafik Menggunakan Chart JS</title> <script type="text/javascript" src="Chart.js"></script>
</head>
<body>
    <div style="width: 800px; height: 800px">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nama_negara); ?>,
                datasets: [{
                    label: 'Total Kasus COVID-19',
                    data: <?php echo json_encode($total_kasus); ?>,
                    backgroundColor: <?php echo json_encode($color_scale); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
