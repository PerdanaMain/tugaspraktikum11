<?php
include("koneksi.php");
$sql = mysqli_query($conn,"SELECT * FROM tb_covid");
while ($row = mysqli_fetch_array($sql)) {
    $sql2 = mysqli_query($conn,"SELECT * FROM tb_covid WHERE id='".$row["id"]."'");
    $row = $sql2->fetch_array();
    $total_kasus[]  = $row["total_cases"];
    $kasus_baru[]   = $row["new_cases"];
    $total_mati[]   = $row["total_death"];
    $mati_baru[]    = $row["new_death"];
    $sembuh[]       = $row["recover"];
    $sembuh_baru[]  = $row["new_recover"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script type="text/javascript" src="chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-light bg-light mb-4">
            <span class="navbar-brand mb-0 h1"> Data Covid 19</span>
        </nav>
      
            <!-- diagram garis akan kita tampilkan disini -->
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(
            ctx,{
                type:'pie',
                data:{
                    labels:[
                        "India",
                        "South Korea",
                        "Turkey",
                        "Vietnam",
                        "Japan",
                        "Iran",
                        "Indonesia",
                        "Malaysia",
                        "Thailand",
                        "Israel"
                    ],
                    datasets:[
                        {
                            label: 'Total Kasus Covid',
                            data: 
                                <?php echo json_encode($total_kasus); ?>
                            ,
                            backgroundColor: [
                            'rgb(255, 99, 132)',
                            ],
                            hoverOffset: 4
                        },
                        {
                            label: 'Jumlah kasus Baru Covid',
                            data: 
                                <?php echo json_encode($kasus_baru); ?>
                            ,
                            backgroundColor: [
                            'rgb(9, 53, 135, 0.5)',
                            ],
                            hoverOffset: 4
                        },
                        {
                            label: 'Total Kematian Covid',
                            data: 
                                <?php echo json_encode($total_mati); ?>
                            ,
                            backgroundColor: [
                            'rgb(54, 162, 235, 0.5)',
                            ],
                            hoverOffset: 4
                        },
                        {
                            label: 'Jumlah Kematian Baru Covid',
                            data: 
                                <?php echo json_encode($mati_baru); ?>
                            ,
                            backgroundColor: [
                            'rgb(17, 191, 083, 0.5)',
                            ],
                            hoverOffset: 4
                        },
                        {
                            label: 'Total Kasus Sembuh ',
                            data: 
                                <?php echo json_encode($sembuh); ?>
                            ,
                            backgroundColor: [
                            'rgb(227, 188, 32, 0.5)',
                            ],
                            hoverOffset: 4
                        },
                        {
                            label: 'Jumlah Kasus Sembuh Baru',
                            data: 
                                <?php echo json_encode($sembuh_baru); ?>
                            ,
                            backgroundColor: [
                            'rgb(227, 188, 32, 0.5)',
                            ],
                            hoverOffset: 4
                        }
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Pie Chart'
                        }
                    }
                }
            }
        );
    </script>
</body>
</html>