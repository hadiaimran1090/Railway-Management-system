<!DOCTYPE html>
<html>
<head>
    <title>Booked Reservations</title>
    <style>
        body {
            background-image: url('detail.jpg');
            background-attachment: fixed; 
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover; 
            font-family: Arial, sans-serif;
            color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: rgba(71, 120, 185, 0.8); 
            color: black;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        }

        table thead {
            background-color: #073762;
            color: white;
            text-transform: uppercase;
        }

        table thead td {
            font-weight: bold;
            padding: 12px;
        }

        table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        table tr:nth-child(even) {
            background-color: rgba(10, 74, 203, 0.3);
        }

        table tr:hover {
            background-color: rgba(10, 74, 203, 0.1);
        }

        a {
            display: inline-block;
            text-align: center;
            margin: 20px auto;
            font-size: 20px;
            text-decoration: none;
            color: rgb(4, 26, 75);
            font-weight: bold;
            background-color: rgba(71, 120, 185, 0.8);
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #062b4f;
            color: white;
        }
    </style>
</head>
<body>

<?php
require "db.php";

$query = "SELECT * FROM resv WHERE status='BOOKED'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Booked Reservations</h2>";
    echo "<table>
            <thead>
                <tr>
                    <td>PNR</td>
                    <td>ID</td>
                    <td>Train No</td>
                    <td>Date of Journey</td>
                    <td>Fare</td>
                    <td>Train Class</td>
                    <td>Seats</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[5] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td>" . $row[8] . "</td>
                <td>" . $row[9] . "</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<h3>No Booked Reservations Found</h3>";
}

echo "<a href='http://localhost/railway/admin_login.php'>Go Back to Admin Menu</a>";

$conn->close();
?>

</body>
</html>