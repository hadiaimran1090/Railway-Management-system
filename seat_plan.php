<!DOCTYPE html>
<html>
<head>
    <title>Train Details</title>
    <style>
        body {
            background-image: url('detail.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: rgb(194, 199, 202);
            color: #000;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        table thead {
            background-color: #073762;
            color: #fff;
            text-transform: uppercase;
        }

        table thead td {
            font-weight: bold;
            padding: 12px;
        }

        table tr td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        table tr:nth-child(even) {
            background-color: rgba(186, 245, 249, 0.8);
        }

        table tr:hover {
            background-color: rgba(10, 74, 203, 0.1);
        }

        button {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #062b4f;
        }

        .back-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            font-size: 20px;
            text-decoration: none;
            color: rgb(4, 26, 75);
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
require "db.php";

echo "
<h2 style='text-align:center; color:#000;'>Train Details</h2>
<table>
    <thead>
        <tr>
            <td>Train No</td>
            <td>Starting Point</td>
            <td>Destination Point</td>
        </tr>
    </thead>
    <tr>
        <td>".$_GET["trainno"]."</td>
        <td>".$_GET["sp"]."</td>
        <td>".$_GET["dp"]."</td>
    </tr>
</table>
";

echo "
<h2 style='text-align:center; color:#000;'>Train Class Details</h2>
<table>
    <thead>
        <tr>
            <td>Train Class</td>
            <td>Seats Left</td>
            <td>Fare Per Seat</td>
        </tr>
    </thead>
";

$cdquery = "SELECT classseats.class, classseats.seatsleft, classseats.fare FROM classseats WHERE classseats.trainno='" . $_GET["trainno"] . "' AND classseats.sp='" . $_GET["sp"] . "' AND classseats.dp='" . $_GET["dp"] . "'";
$cdresult = mysqli_query($conn, $cdquery);

while ($cdrow = mysqli_fetch_array($cdresult)) {
    echo "
    <tr>
        <td>" . $cdrow[0] . "</td>
        <td>" . $cdrow[1] . "</td>
        <td>" . $cdrow[2] . "</td>
    </tr>
    ";
}

echo "</table>";
?>

<a href="schedule.php?trainno=<?php echo $_GET['trainno']; ?>" class="back-link">Go Back to Schedule</a>
<a href="show_trains.php" class="back-link">Go Back to Train Menu</a>
<a href="admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>