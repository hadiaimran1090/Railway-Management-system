<html>
<head>
    <style>
        body {
            background-image: url(admin.jpg);
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif; 
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .message-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
        }
        .message-box h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .message-box p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
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

        $pname = $_POST["pname"];
        $page = $_POST["page"];
        $pgender = $_POST["pgender"];

        $tno = $_SESSION["tno"];
        $doj = $_SESSION["doj"];
        $sp = $_SESSION["sp"];
        $dp = $_SESSION["dp"];
        $class = $_SESSION["class"];

        $query = "SELECT fare FROM classseats WHERE trainno='" . $tno . "' AND class='" . $class . "' AND doj='" . $doj . "' AND sp='" . $sp . "' AND dp='" . $dp . "'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $row = mysqli_fetch_array($result);
        $fare = $row[0];
        $tempfare = 0;
        $temp = 0;

        for ($i = 0; $i < $_SESSION["nos"]; $i++) {
            if ($page[$i] >= 18) {
                $temp++;
                $tempfare += $fare;
            } else if ($page[$i] < 18 || $page[$i] >= 60) {
                $tempfare += 0.5 * $fare;
            }
        }

        echo "<div class='message-box'>";
        if ($temp == 0) {
            echo "<h1 style='color: red;'>At least one adult must accompany!</h1>";
            echo "<p><a href=\"http://localhost/railway/enquiry.php\">Back to Enquiry</a></p>";
            echo "</div>";
            die();
        }

        echo "<h1 style='color: green;'>Total Fare: Rs." . $tempfare . "/-</h1>";

        $sql = "INSERT INTO resv(id, trainno, sp, dp, doj, tfare, class, nos) 
                VALUES ('" . $_SESSION["id"] . "','" . $_SESSION["tno"] . "','" . $_SESSION["sp"] . "','" . $_SESSION["dp"] . "','" . $_SESSION["doj"] . "','" . $tempfare . "','" . $_SESSION["class"] . "','" . $_SESSION["nos"] . "')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Reservation Successful</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }

        $tid = $_SESSION["id"];
        $ttno = $_SESSION["tno"];
        $tdoj = $_SESSION["doj"];

        $query = "SELECT pnr FROM resv WHERE id='" . $tid . "' AND trainno='" . $ttno . "' AND doj='" . $tdoj . "'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $row = mysqli_fetch_array($result);
        $rpnr = $row['pnr'];

        $tpname = $_POST['pname'];
        $tpage = $_POST["page"];
        $tpgender = $_POST["pgender"];

        for ($i = 0; $i < $_SESSION["nos"]; $i++) {
            $sql = "INSERT INTO pd(pnr, pname, page, pgender) 
                    VALUES  ('" . $rpnr . "','" . $tpname[$i] . "','" . $tpage[$i] . "','" . $tpgender[$i] . "')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: blue;'>Passenger details added successfully!</p>";
            } else {
                echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
            }
        }

        echo "<p><a href=\"http://localhost/railway/index.htm\">Go Back</a></p>";
        echo "</div>";

        $conn->close();
    ?>
</body>
</html>
