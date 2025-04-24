<!DOCTYPE html>
<html>
<head>
    <title >Train Details</title>
    <style>
        body {
            background-image: url('detail.jpg');
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
            width: 60%;
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

        table thead th {
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

        button {
            background-color: rgba(71, 120, 185, 0.8);
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #062b4f;
        }

        input[type="text"], input[type="time"], select {
            width: 95%;
            max-width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 2px solid rgba(71, 120, 185, 0.8);
            border-radius: 4px;
            margin: 5px 0;
            box-sizing: border-box;
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
session_start();
require "db.php";


if (isset($_POST["ns"])) {
    $ns = $_POST["ns"];
} else {
    $ns = 0; 
}

if(isset($_POST["ns"])) {

    $tname = $_POST["tname"];
    $_SESSION["tname"] = $tname;
    $sp = $_POST["sp"];
    $_SESSION["sp"] = $sp;
    $st = $_POST["st"];
    $_SESSION["st"] = $st;
    $dp = $_POST["dp"];
    $_SESSION["dp"] = $dp;
    $dt = $_POST["dt"];
    $_SESSION["dt"] = $dt;
    $dd = $_POST["dd"];
    $_SESSION["dd"] = $dd;
    $_SESSION["ns"] = $ns;
    $ds = $_POST["ds"];
    $_SESSION["ds"] = $ds;

    echo "<h2>Train Details Summary</h2>";

    echo "<table>
            <thead>
                <tr>
                    <th>Train Name</th>
                    <th>Starting Point</th>
                    <th>Starting Time</th>
                    <th>Destination Point</th>
                    <th>Destination Time</th>
                    <th>Day of Arrival</th>
                    <th>No. of Stations</th>
                    <th>Distance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$tname."</td>
                    <td>".$sp."</td>
                    <td>".$st."</td>
                    <td>".$dp."</td>
                    <td>".$dt."</td>
                    <td>".$dd."</td>
                    <td>".$ns."</td>
                    <td>".$ds."</td>
                </tr>
            </tbody>
          </table>";

    echo "<h3>Intermediate Stations</h3>";

    echo "<table>
            <thead>
                <tr>
                    <th>Station</th>
                    <th>Arrival Time</th>
                    <th>Departure Time</th>
                    <th>Distance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$sp."</td>
                    <td>".$st."</td>
                    <td>".$st."</td>
                    <td>0</td>
                </tr>";

    echo "<form action=\"insert_into_train_4.php\" method=\"post\">";
    $temp = 1;
    while ($temp <= $ns) {
        echo "<tr>
                <td>
                    <select id=\"stn".$temp."\" name=\"stn".$temp."\" required>
                    <option value=\"\">Select Station</option>";
        
        $cdquery = "SELECT sname FROM station";
        $cdresult = mysqli_query($conn, $cdquery);
        while ($cdrow = mysqli_fetch_array($cdresult)) {
            $cdTitle = $cdrow['sname'];
            echo "<option value=\"$cdTitle\">$cdTitle</option>";
        }

        echo "</select>
                </td>
                <td><input type=\"time\" name=\"st".$temp."\" required></td>
                <td><input type=\"time\" name=\"dt".$temp."\" required></td>
                <td><input type=\"text\" name=\"ds".$temp."\" required></td>
              </tr>";
        $temp += 1;
    }

    echo "<tr><td>".$dp."</td><td>".$dt."</td><td>".$dt."</td><td>".$ds."</td></tr></tbody></table>";
    echo "<div style='text-align:center;'>
            <button type='submit'>Submit Train Details</button>
          </div>";
} else if ($ns == 0) {
    echo "<form action=\"insert_into_train_3.php\" method=\"post\">\n            <h1>Enter Train Details</h1>\n            <table>\n                <tr><td>Train Name</td><td><input type=\"text\" name=\"tname\" required></td></tr>\n                <tr><td>Starting Point</td><td>\n                    <select id=\"sp\" name=\"sp\" required>";

    $cdquery = "SELECT sname FROM station";
    $cdresult = mysqli_query($conn, $cdquery);
    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $cdTitle = $cdrow['sname'];
        echo "<option value=\"$cdTitle\">$cdTitle</option>";
    }

    echo "</select></td></tr>\n          <tr><td>Starting Time</td><td><input type=\"time\" name=\"st\" required></td></tr>\n          <tr><td>Destination Point</td><td>\n            <select id=\"dp\" name=\"dp\" required>";

    $cdquery = "SELECT sname FROM station";
    $cdresult = mysqli_query($conn, $cdquery);
    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $cdTitle = $cdrow['sname'];
        echo "<option value=\"$cdTitle\">$cdTitle</option>";
    }

    echo "</select></td></tr>\n    <tr><td>Destination Time</td><td><input type=\"time\" name=\"dt\" required></td></tr>\n          <tr><td>Distance</td><td><input type=\"text\" name=\"ds\" required></td></tr>\n          <tr><td>No. of Intermediate Stations</td><td><input type=\"text\" name=\"ns\" required></td></tr>\n 
             <tr><td>Day of Arrival</td><td><input type=\"text\" name=\"dd\" required></td></tr>\n        </table>\n        <div style='text-align:center;'>\n            <button type='submit'>Enter Train Details</button>\n        </div>";
}

echo "<br><a href=\"http://localhost/railway/admin_login.php\" class='back-link'>Go Back to Admin Menu</a>";