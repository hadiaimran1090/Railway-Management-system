<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('userimage.webp');
            background-attachment: fixed;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
            border-radius: 10px;
        }
        table td {
            padding: 10px;
            text-align: center;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            width: 90%;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: rgb(8, 113, 232);
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 10%;
        }
        input[type="submit"]:hover {
            background-color: rgb(52, 83, 197);
        }
        a {
            color:rgb(52, 83, 197);
            text-decoration: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            text-align: center;
        }
        .success-message {
            color: green;
            text-align: center;
        }
        
        .center-content {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<form action="new_png.php" method="post">
<?php
session_start();
require "db.php";


if (!isset($_POST["mno"]) || !isset($_POST["password"])) {
    echo "<p class='error-message'>Error: Missing required form inputs. Please go back and try again.</p>";
    echo "<a href=\"http://localhost/railway/enquiry_result.php\">Go Back</a>";
    die();
}

$mobile = $_POST["mno"];
$password = $_POST["password"];


$mobile = mysqli_real_escape_string($conn, $mobile);
$password = mysqli_real_escape_string($conn, $password);


$stmt = $conn->prepare("SELECT * FROM user WHERE mobileno = ? AND password = ?");
$stmt->bind_param("ss", $mobile, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p class='error-message'>No such login! Please check your credentials.</p>";
    echo "<a href=\"http://localhost/railway/enquiry_result.php\">Go Back</a>";
    die();
}


$row = $result->fetch_assoc();
$temp = $row['id'];
$_SESSION["id"] = $temp;


$tno = $_POST["tno"];
$class = $_POST["class"];
$nos = $_POST["nos"];

$_SESSION["tno"] = $tno;
$_SESSION["class"] = $class;
$_SESSION["nos"] = $nos;

echo "<table>";
for ($i = 0; $i < $nos; $i++) {
    echo "<tr>
        <td><input type='text' name='pname[]' placeholder='Passenger Name' required></td>
        <td><input type='text' name='page[]' placeholder='Passenger Age' required></td>
        <td><input type='text' name='pgender[]' placeholder='Passenger Gender' required></td>
    </tr>";
}
echo "</table>";

$conn->close();
?>


<div class="center-content">
    <a href="http://localhost/railway/enquiry.php">Back to Enquiry</a><br><br>
    <input type="submit" value="Book">
</div>

</form>
</body>
</html>
