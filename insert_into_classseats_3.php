<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Details</title>
    <style>
        body {
            background-image: url('detail.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.9);
            color: #000;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        table th, table td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #073762;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: rgba(186, 245, 249, 0.8);
        }

        table tr:hover {
            background-color: rgba(10, 74, 203, 0.1);
        }

        form {
            width: 90%;
            margin: 20px auto;
            background-color: rgba(62, 159, 220, 0.7);
            padding: 20px;
            border-radius: 8px;
            color: #fff;
        }

        form fieldset {
            border: none;
        }

        form legend {
            font-size: 1.5em;
            color: #fff;
        }

        form input[type="text"], form input[type="date"], form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            background-color:rgb(48, 126, 190);
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
			display: block;
			margin: 20px auto;
        }

        form input[type="submit"]:hover {
            background-color: #062b4f;
        }

        .train-details-header {
            text-align: center;
            font-size: 2.5em;
            color: black;
            margin-top: 20px;
        }

        .admin-menu {
            text-align: center;
            margin: 20px;
        }

        .admin-menu a {
            color: rgb(8, 66, 114);
            text-decoration: none;
            font-size: 1.2em;
        }

        .admin-menu a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="train-details-header">Train Journey Details</div>

<?php
session_start();
require "db.php";

if (isset($_POST["tno"])) {
    $trainno = $_POST["tno"];
    $_SESSION["trainno"] = $trainno;
    $doj = $_POST["doj"];
    $_SESSION["doj"] = $doj;

    // Fetch train details
    $cdquery = "SELECT * FROM train WHERE trainno='" . $trainno . "'";
    $cdresult = mysqli_query($conn, $cdquery);
    $cdrow = mysqli_fetch_array($cdresult);

    echo "<table>
    <thead>
        <tr>
            <th>Train No</th>
            <th>Train Name</th>
            <th>Starting Point</th>
            <th>Starting Time</th>
            <th>Destination Point</th>
            <th>Destination Time</th>
            <th>Day of Arrival</th>
            <th>Distance</th>
            <th>Date of Journey</th>
        </tr>
    </thead>
    <tr>
        <td>{$cdrow['trainno']}</td>
        <td>{$cdrow['tname']}</td>
        <td>{$cdrow['sp']}</td>
        <td>{$cdrow['st']}</td>
        <td>{$cdrow['dp']}</td>
        <td>{$cdrow['dt']}</td>
        <td>{$cdrow['dd']}</td>
        <td>{$cdrow['distance']}</td>
        <td>{$doj}</td>
    </tr>
    </table>";

    // Fetch station details
    $cdquery = "SELECT sname FROM schedule WHERE trainno='" . $trainno . "' ORDER BY distance ASC";
    $cdresult = mysqli_query($conn, $cdquery);
    $stations = array();
    $i = 0;
    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $stations[$i] = $cdrow["sname"];
        $i++;
    }

    $_SESSION["ns"] = $i - 1;
    $_SESSION["stations"] = $stations;

    echo "<form action='insert_into_classseats_4.php' method='post'>
    <table>
    <thead>
        <tr>
            <th>Starting Point</th>
            <th>Destination Point</th>
            <th>AC1 Seats</th>
            <th>AC1 Fare</th>
            <th>AC2 Seats</th>
            <th>AC2 Fare</th>
            <th>AC3 Seats</th>
            <th>AC3 Fare</th>
            <th>CC Seats</th>
            <th>CC Fare</th>
            <th>EC Seats</th>
            <th>EC Fare</th>
            <th>SL Seats</th>
            <th>SL Fare</th>
        </tr>
    </thead>";

    $temp = 0;
    while ($temp < $_SESSION["ns"]) {
        echo "<tr>
            <td>{$stations[$temp]}</td>
            <td>{$stations[$temp + 1]}</td>
            <td><input type='text' name='s1{$temp}' value='0' required></td>
            <td><input type='text' name='f1{$temp}' value='0' required></td>
            <td><input type='text' name='s2{$temp}' value='0' required></td>
            <td><input type='text' name='f2{$temp}' value='0' required></td>
            <td><input type='text' name='s3{$temp}' value='0' required></td>
            <td><input type='text' name='f3{$temp}' value='0' required></td>
            <td><input type='text' name='s4{$temp}' value='0' required></td>
            <td><input type='text' name='f4{$temp}' value='0' required></td>
            <td><input type='text' name='s5{$temp}' value='0' required></td>
            <td><input type='text' name='f5{$temp}' value='0' required></td>
            <td><input type='text' name='s6{$temp}' value='0' required></td>
            <td><input type='text' name='f6{$temp}' value='0' required></td>
        </tr>";
        $temp++;
    }

    echo "</table><input type='submit' value='Submit'></form>";
} else {
    echo "<form action='insert_into_classseats_3.php' method='post'>
        <fieldset>
            <legend>Enter Train Details</legend>
            <table>
                <thead>
                    <tr>
                        <th>Select Train</th>
                        <th>Date of Journey</th>
                    </tr>
                </thead>
                <tr>
                    <td><select id='tno' name='tno' required>";

    $query = "SELECT * FROM train";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo "<option value='{$row['trainno']}'>{$row['tname']} starting at {$row['sp']}</option>";
    }

    echo "</select></td>
                    <td><input type='date' name='doj' required></td>
                </tr>
            </table>
            <input type='submit' value='Enter Train Details'>
        </fieldset>
    </form>";
}
?>

<div class="admin-menu">
    <a href="http://localhost/railway/admin_login.php">Go Back to Admin Menu</a>
</div>

</body>
</html>