<!DOCTYPE html>
<html>
<head>
    <title>Manage Trains</title>
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

        .add-train {
            width: 50%;
            margin: 20px auto;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            background-color: rgba(20, 20, 20, 0.8);
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }

        .add-train label {
            color: #fff;
            font-size: 16px;
            margin-right: 10px;
        }

        .add-train input[type="text"] {
            width: 70%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .add-train input[type="submit"] {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .add-train input[type="submit"]:hover {
            background-color: #062b4f;
        }

        .back-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            font-size: 22px; /* Increased font size */
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

$cdquery = "SELECT * FROM train";
$cdresult = mysqli_query($conn, $cdquery);

echo "<table>";
echo "<thead><tr><td>Train No</td><td>Train Name</td><td>Starting Point</td><td>Arrival Time</td><td>Destination Point</td><td>Departure Time</td><td>Day</td><td>Distance</td><td>Schedule</td></tr></thead>";

while ($cdrow = mysqli_fetch_array($cdresult)) {
    echo "<tr><td>" . $cdrow['trainno'] . "</td>
              <td>" . $cdrow['tname'] . "</td>
              <td>" . $cdrow['sp'] . "</td>
              <td>" . $cdrow['st'] . "</td>
              <td>" . $cdrow['dp'] . "</td>
              <td>" . $cdrow['dt'] . "</td>
              <td>" . $cdrow['dd'] . "</td>
              <td>" . $cdrow['distance'] . "</td>
              <td><a href='schedule.php?trainno=" . $cdrow['trainno'] . "'><button>Schedule</button></a></td></tr>";
}
echo "</table>";
?>

<div class="add-train">
    <form action="insert_into_train_3.php" method="post">
        <label for="trainname">Add Train:</label>
        <input type="text" id="trainname" name="trainname" placeholder="Enter new train name" required>
        <input type="submit" value="Add">
    </form>
</div>

<a href="admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>
