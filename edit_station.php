<!DOCTYPE html>
<html>
<head>
    <title>Edit Station</title>
    <style>
        body {
            background-image: url('admin.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background: rgba(236, 238, 239, 0.8); /* Light blue with some transparency */
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            margin-top: 30px;
        }

        h1 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            color: #333;
        }

        input[type="submit"] {
            background-color: #17a2b8;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: rgb(55, 91, 181);
        }

        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 18px;
            color: #17a2b8;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    require "db.php";

    if (isset($_POST["station"]) && $_POST["station"] != "") { 
        
        $newStationName = $_POST["station"];
        $stationId = $_GET["id"];

        
        $query = $conn->prepare("SELECT sname FROM station WHERE id = ?");
        $query->bind_param("i", $stationId);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentStationName = $row["sname"];

            
            $updateClassSeats = $conn->prepare("UPDATE classseats SET dp = ? WHERE dp = ?");
            $updateClassSeats->bind_param("ss", $newStationName, $currentStationName);
            $updateClassSeats->execute();

           
            $updateStation = $conn->prepare("UPDATE station SET sname = ? WHERE id = ?");
            $updateStation->bind_param("si", $newStationName, $stationId);
            if ($updateStation->execute()) {
                echo "<h2>Station updated successfully!</h2>";
            } else {
                echo "<h2>Error updating station: " . $conn->error . "</h2>";
            }
        } else {
            echo "<h2>Station not found.</h2>";
        }
    } else {
        
        echo "
        <h1>Edit Station</h1>
        <form action=\"edit_station.php?id=" . $_GET["id"] . "\" method=\"post\">
        <label for=\"station\">Edit Station Name:</label><br><br>
        <input type=\"text\" name=\"station\" required placeholder=\"Enter new station name\">
        <input type=\"submit\" value=\"Update\">
        </form>
        ";
    }

    echo "<a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu</a>";

    $conn->close();
    ?>
</div>

</body>
</html>
