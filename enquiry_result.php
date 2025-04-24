<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('enquiry.webp'); /* Replace with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #fff; /* Light text color for better readability */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 30px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8);
            color: #000; /* Dark text for table */
            border-radius: 10px;
            overflow: hidden;
        }
        table thead {
            background-color: #444;
            color: #fff;
        }
        table thead td {
            padding: 10px;
            font-weight: bold;
        }
        table tr {
            border-bottom: 1px solid #ccc;
        }
        table tr td {
            padding: 10px;
            text-align: center;
        }
        form {
            width: 60%;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            color: #000;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"] {
            background-color:rgb(63, 124, 178);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        form input[type="submit"]:hover {
            background-color:rgb(12, 88, 158);
        }
        a {
            color:white;
            text-decoration: bold;
            display: inline-block;
            margin: 10px 0;
            text-align: center;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
session_start();
require "db.php";

// Check if the POST variables are set before accessing them
if (isset($_POST["doj"]) && isset($_POST["sp"]) && isset($_POST["dp"])) {
    $doj = $_POST["doj"];
    $_SESSION["doj"] = $doj;

    $sp = $_POST["sp"];
    $_SESSION["sp"] = $sp;

    $dp = $_POST["dp"];
    $_SESSION["dp"] = $dp;

    $query = mysqli_query($conn, "
        SELECT 
            t.trainno, t.tname, c.sp, s1.departure_time, c.dp, 
            s2.arrival_time, t.dd, c.class, c.fare, c.seatsleft 
        FROM 
            train AS t, classseats AS c, schedule AS s1, schedule AS s2 
        WHERE 
            s1.trainno = t.trainno 
            AND s2.trainno = t.trainno 
            AND s1.sname = '".$sp."' 
            AND s2.sname = '".$dp."' 
            AND t.trainno = c.trainno 
            AND c.sp = '".$sp."' 
            AND c.dp = '".$dp."' 
            AND c.doj = '".$doj."'
    ");

    echo "<table>
        <thead>
            <tr>
                <td>Train No</td>
                <td>Train Name</td>
                <td>Starting Point</td>
                <td>Arrival Time</td>
                <td>Destination Point</td>
                <td>Departure Time</td>
                <td>Day</td>
                <td>Train Class</td>
                <td>Fare</td>
                <td>Seats Left</td>
            </tr>
        </thead>
        <tbody>";

    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>
            <td>".$row[0]."</td>
            <td>".$row[1]."</td>
            <td>".$row[2]."</td>
            <td>".$row[3]."</td>
            <td>".$row[4]."</td>
            <td>".$row[5]."</td>
            <td>".$row[6]."</td>
            <td>".$row[7]."</td>
            <td>".$row[8]."</td>
            <td>".$row[9]."</td>
        </tr>";
    }

    echo "</tbody></table>";

    if (mysqli_num_rows($query) == 0) {
        echo "<p style='text-align: center;color:blue;'>No such train found. Please check the inputs and try again.</p>";
    }
} else {
    // Handle missing POST data
    echo "<p style='text-align: center; color: blue;'>Error: Missing required form inputs. Please go back and fill out all required fields.</p>";
}
?>
<div>
    <p style="text-align: center;color: blue;">If you wish to proceed with booking, fill in the following details:</p>
    <form action="resvn.php" method="post">
        <label for="mno">Registered Mobile No:</label>
        <input type="text" name="mno" id="mno" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label for="tno">Enter Train No:</label>
        <input type="text" name="tno" id="tno" required>
        
        <label for="class">Enter Class:</label>
        <input type="text" name="class" id="class" required>
        
        <label for="nos">No. of Seats:</label>
        <input type="text" name="nos" id="nos" required>
        
        <input type="submit" value="Proceed with Booking">
    </form>
</div>
<div style="text-align: center;">
    <a href="http://localhost/railway/enquiry.php">More Enquiry</a><br>
    <a href="http://localhost/railway/index.htm">Go to Home Page!!!</a>
</div>
<?php
$conn->close();
?>
</body>
</html>
