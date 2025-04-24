<html>
<body style=" background-image: url(user.jpg);
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover; 
    font-family: Arial, sans-serif; color: #fff; text-align: center;
    margin: 0; padding: 20px;
    ">

<?php
session_start();
require "db.php";

if ($conn->connect_error) {
    die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
}

// Capture user inputs
$mobile = $_POST["mno"];
$pwd = $_POST["password"];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM user WHERE mobileno = ? AND password = ?");
$stmt->bind_param("is", $mobile, $pwd);
$stmt->execute();
$result = $stmt->get_result();


$temp1 = "";
$temp2 = "";

if ($row = $result->fetch_assoc()) {
    echo "<h2>Welcome, " . htmlspecialchars($row['emailid']) . "</h2>";
    $temp1 = $row['emailid'];
    $temp2 = $row['id'];

    
    $_SESSION["id"] = $temp2;

    $query2 = $conn->prepare("
        SELECT * FROM user
        INNER JOIN resv ON user.id = resv.id
        WHERE user.mobileno = ?
    ");
    $query2->bind_param("i", $mobile);
    $query2->execute();
    $resvResult = $query2->get_result();

    if ($resvResult->num_rows > 0) {
        echo "<h3>Your Reservations:</h3>";
        echo "<table border='1' style='margin: 0 auto; border-collapse: collapse; width: 80%; color: #000; background: #fff;'>";
        echo "<thead style='background: #444; color: #fff;'><tr>
                <th>PNR</th>
                <th>Train No</th>
                <th>Date of Journey</th>
                <th>Total Fare</th>
                <th>Class</th>
                <th>Seats Reserved</th>
                <th>Status</th>
              </tr></thead>";
        echo "<tbody>";
        while ($resvRow = $resvResult->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($resvRow["pnr"]) . "</td>
                    <td>" . htmlspecialchars($resvRow["trainno"]) . "</td>
                    <td>" . htmlspecialchars($resvRow["doj"]) . "</td>
                    <td>" . htmlspecialchars($resvRow["tfare"]) . "</td>
                    <td>" . htmlspecialchars($resvRow["class"]) . "</td>
                    <td>" . htmlspecialchars($resvRow["nos"]) . "</td>
                    <td>" . htmlspecialchars($resvRow["status"]) . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No Reservations Yet!</p>";
    }
} else {
    echo "<p style='color: red;'>Invalid Mobile Number or Password!</p>";
    echo "<a href='http://localhost/railway/index.htm' style='color: #fff;'>Go Back to Home Page</a>";
    die();
}


?>

<h3>Cancel a Reservation</h3>
<form action="cancel.php" method="post" style="background: rgba(0, 0, 0, 0.5); padding: 20px; display: inline-block; border-radius: 10px;">
    <label for="cancpnr">Enter PNR for Cancellation:</label><br>
    <input type="text" id="cancpnr" name="cancpnr" required style="padding: 10px; margin: 10px; width: 80%;"><br>
    <input type="submit" value="Cancel" style="padding: 10px 20px; background: #ff4c4c; border: none; color: #fff; border-radius: 5px; cursor: pointer;">
</form>

<br><br>
<a href="http://localhost/railway/index.htm" style="color: blue; text-decoration: none; font-weight: bold;">Go Back to Home Page</a>

<?php
$conn->close();
?>

</body>
</html>
