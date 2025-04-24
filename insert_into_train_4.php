<html>
<body style="
    background-image: url(enquiry.webp);
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;

">

<?php
session_start();
require "db.php";

$sql = "INSERT INTO train (tname, sp, st, dp, dt, dd, distance) VALUES ('" . $_SESSION["tname"] . "','" . $_SESSION["sp"] . "','" . $_SESSION["st"] . "','" . $_SESSION["dp"] . "','" . $_SESSION["dt"] . "','" . $_SESSION["dd"] . "','" . $_SESSION["ds"] . "')";

if ($conn->query($sql) === TRUE) {
    $message = "New Train record created successfully";
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
}

$cdquery = "SELECT trainno FROM train WHERE tname='" . $_SESSION["tname"] . "' AND sp='" . $_SESSION["sp"] . "' AND dp='" . $_SESSION["dp"] . "'";
$cdresult = mysqli_query($conn, $cdquery);
$cdrow = mysqli_fetch_array($cdresult);
$trainno = $cdrow['trainno'];

$sql = "INSERT INTO schedule (trainno, sname, arrival_time, departure_time, distance) VALUES ('" . $trainno . "','" . $_SESSION["sp"] . "','" . $_SESSION["st"] . "','" . $_SESSION["st"] . "','0')";
$flag = ($conn->query($sql));
$temp = 1;
while ($temp <= $_SESSION["ns"]) {
    $sql = "INSERT INTO schedule (trainno, sname, arrival_time, departure_time, distance) VALUES ('" . $trainno . "','" . $_POST["stn" . $temp] . "','" . $_POST["st" . $temp] . "','" . $_POST["dt" . $temp] . "','" . $_POST["ds" . $temp] . "')";
    $flag = ($conn->query($sql));
    $temp += 1;
}
$sql = "INSERT INTO schedule (trainno, sname, arrival_time, departure_time, distance) VALUES ('" . $trainno . "','" . $_SESSION["dp"] . "','" . $_SESSION["dt"] . "','" . $_SESSION["dt"] . "','" . $_SESSION["ds"] . "')";
$flag = ($conn->query($sql));

if ($flag === TRUE) {
    $scheduleMessage = "New schedule added successfully";
} else {
    $scheduleMessage = "Error: " . $sql . "<br>" . $conn->error;
}
?>

<div style="
    background-color: rgba(255, 255, 255, 0.8);
    border: 2px solid #ccc;
    padding: 20px;
    text-align: center;
    width: 220px;
    margin: auto;
    font-size: 18px;
    color: #333;
">
    <p><?php echo $message; ?></p>
    <p><?php echo $scheduleMessage; ?></p>
    <br>
    <a href="http://localhost/railway/admin_login.php" style="
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    ">Go Back to Admin Menu!!!</a>
</div>

</body>
</html>
