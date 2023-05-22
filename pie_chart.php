<?php
include('koneksi.php');

$query = mysqli_query($koneksi, "SELECT country, total_cases FROM covid_data");
$negara = array();
$total_cases = array();
$background_colors = array();
$border_colors = array();

$colors = array(
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
);

$border_colors = array(
    'rgba(240, 15, 255, 0.75',
    'rgba(250, 174, 215, 0.75)',
    'rgba(0, 15, 255, 0.75)',
    'rgba(127, 255, 212, 0.75)',
    'rgba(229, 82, 42, 0.75)',
    'rgba(222, 235, 135, 0.75)',
    'rgba(30, 233, 255, 0.75)',
    'rgba(119, 120, 153, 0.75)',
    'rgba(220, 197, 92, 0.75)',
    'rgba(124, 207, 0, 0.75)'
);

$color_count = count($colors);

$i = 0;
while ($row = mysqli_fetch_array($query)) {
    $negara[] = $row['country'];
    $total_cases[] = $row['total_cases'];
    $background_colors[] = $colors[$i % $color_count];
    $border_colors[] = $border_colors[$i % $color_count];
    $i++;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pie Chart</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>

<body>
    <div id="canvas-holder" style="width: 50%">
        <canvas id="chart-area"></canvas>
    </div>
    <script>
        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: <?php echo json_encode($total_cases); ?>,
                    backgroundColor: <?php echo json_encode($background_colors); ?>,
                    borderColor: <?php echo json_encode($border_colors); ?>,
                    label: 'Total Cases'
                }],
                labels: <?php echo json_encode($negara); ?>
            },
            options: {
                responsive: true
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };
    </script>
</body>

</html>
