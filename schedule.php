<!DOCTYPE html>
<html>
<head>
    <title>Train Schedule</title>
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

echo "<h2 style='text-align:center; color:#000;'>Train Details</h2>";

$cdquery = "SELECT * FROM train WHERE trainno='" . $_GET["trainno"] . "'";
$cdresult = mysqli_query($conn, $cdquery);

echo "
<table>
<thead>
    <tr>
        <td>Train No</td>
        <td>Train Name</td>
        <td>Starting Point</td>
        <td>Arrival Time</td>
        <td>Destination Point</td>
        <td>Departure Time</td>
        <td>Day</td>
        <td>Distance</td>
    </tr>
</thead>";

while ($cdrow = mysqli_fetch_array($cdresult)) {
    echo "
    <tr>
        <td>" . $cdrow['trainno'] . "</td>
        <td>" . $cdrow['tname'] . "</td>
        <td>" . $cdrow['sp'] . "</td>
        <td>" . $cdrow['st'] . "</td>
        <td>" . $cdrow['dp'] . "</td>
        <td>" . $cdrow['dt'] . "</td>
        <td>" . $cdrow['dd'] . "</td>
        <td>" . $cdrow['distance'] . "</td>
    </tr>";
}
echo "</table>";

echo "<h2 style='text-align:center; color:#000;'>Train Schedule</h2>";

$cdquery = "SELECT * FROM schedule WHERE trainno='" . $_GET["trainno"] . "' ORDER BY distance ASC";
$cdresult = mysqli_query($conn, $cdquery);

$stations = array();
$arrival = array();
$departure = array();
$distance = array();
$i = 0;

while ($cdrow = mysqli_fetch_array($cdresult)) {
    $stations[$i] = $cdrow["sname"];
    $arrival[$i] = $cdrow["arrival_time"];
    $departure[$i] = $cdrow["departure_time"];
    $distance[$i] = $cdrow["distance"];
    $i += 1;
}

echo "
<table>
<thead>
    <tr>
        <td>ID</td>
        <td>Starting Point</td>
        <td>Departure Time</td>
        <td>Destination Point</td>
        <td>Arrival Time</td>
        <td>Distance</td>
        <td>Seat Plan</td>
    </tr>
</thead>";

$temp = 0;
while ($temp < $i - 1) {
    echo "
    <tr>
        <td>" . ($temp + 1) . "</td>
        <td>" . $stations[$temp] . "</td>
        <td>" . $departure[$temp] . "</td>
        <td>" . $stations[$temp + 1] . "</td>
        <td>" . $arrival[$temp + 1] . "</td>
        <td>" . ($distance[$temp + 1] - $distance[$temp]) . "</td>
        <td>
            <a href='seat_plan.php?trainno=" . $_GET["trainno"] . "&sp=" . $stations[$temp] . "&dp=" . $stations[$temp + 1] . "'>
                <button>Seat Plan</button>
            </a>
        </td>
    </tr>";
    $temp += 1;
}
echo "</table>";
?>

<a href="show_trains.php" class="back-link">Go Back to Train Menu</a>
<a href="admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>