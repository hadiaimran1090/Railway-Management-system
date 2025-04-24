<?php
session_start();

require "db.php";

$stations = $_SESSION["stations"] ?? [];
$temp = 0;
$flag = true;


$stmt = $conn->prepare("INSERT INTO classseats (trainno, sp, dp, doj, class, seatsleft, fare) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

while ($temp < $_SESSION["ns"]) {
    
    if (!isset($_SESSION["st" . $temp], $_SESSION["st" . ($temp + 1)])) {
        $temp += 1;
        continue; 
    }

    $trainno = $_SESSION["trainno"] ?? null;
    $sp = $_SESSION["st" . $temp];
    $dp = $_SESSION["st" . ($temp + 1)];
    $doj = $_SESSION["doj"] ?? null;

    
    if (!$trainno || !$sp || !$dp || !$doj) {
        $temp += 1;
        continue;
    }

    // AC1 class
    if (isset($_POST["s1" . $temp]) && $_POST["s1" . $temp] > 0 && isset($_POST["f1" . $temp])) {
        $class = 'AC1';
        $seatsleft = $_POST["s1" . $temp];
        $fare = $_POST["f1" . $temp];
        $stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);
        if (!$stmt->execute()) {
            $flag = false;
        }
    }

    // AC2 class
    if (isset($_POST["s2" . $temp]) && $_POST["s2" . $temp] > 0 && isset($_POST["f2" . $temp])) {
        $class = 'AC2';
        $seatsleft = $_POST["s2" . $temp];
        $fare = $_POST["f2" . $temp];
        $stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);
        if (!$stmt->execute()) {
            $flag = false;
        }
    }

    // AC3 class
    if (isset($_POST["s3" . $temp]) && $_POST["s3" . $temp] > 0 && isset($_POST["f3" . $temp])) {
        $class = 'AC3';
        $seatsleft = $_POST["s3" . $temp];
        $fare = $_POST["f3" . $temp];
        $stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);
        if (!$stmt->execute()) {
            $flag = false;
        }
    }

    // CC class
    if (isset($_POST["s4" . $temp]) && $_POST["s4" . $temp] > 0 && isset($_POST["f4" . $temp])) {
        $class = 'CC';
        $seatsleft = $_POST["s4" . $temp];
        $fare = $_POST["f4" . $temp];
        $stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);
        if (!$stmt->execute()) {
            $flag = false;
        }
    }

    // EC class
    if (isset($_POST["s5" . $temp]) && $_POST["s5" . $temp] > 0 && isset($_POST["f5" . $temp])) {
        $class = 'EC';
        $seatsleft = $_POST["s5" . $temp];
        $fare = $_POST["f5" . $temp];
        $stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);
        if (!$stmt->execute()) {
            $flag = false;
        }
    }

    // SL class
    if (isset($_POST["s6" . $temp]) && $_POST["s6" . $temp] > 0 && isset($_POST["f6" . $temp])) {
        $class = 'SL';
        $seatsleft = $_POST["s6" . $temp];
        $fare = $_POST["f6" . $temp];
        $stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);
        if (!$stmt->execute()) {
            $flag = false;
        }
    }

    $temp += 1;
}

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seat Arrangement</title>
    <style>
        body {
            background-image: url('detail.jpg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .message {
            font-size: 30px;
            color: #000;
            margin-top: 50px;
        }
        .back-link {
            display: inline-block;
            margin-top: 30px;
            font-size: 20px;
            text-decoration: none;
            color: rgb(16, 46, 112);
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="message">
    <?php
    if ($flag) {
        echo "New seat arrangement added successfully!";
    } else {
        echo "Error: Failed to insert seat arrangements. Please try again.";
    }
    ?>
</div>

<a href="http://localhost/railway/admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>
