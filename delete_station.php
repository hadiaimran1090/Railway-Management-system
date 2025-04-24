<html>
<head>
    <style>
        body {
            background-image: url(detail.jpg);
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .message-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
        }
        .message-box h1 {
            font-size: 24px;
            color: rgb(40, 44, 167); 
            margin-bottom: 15px;
        }
        .message-box p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message-box a {
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .message-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
        require "db.php";

        $id = $_GET["id"];

        echo "<div class='message-box'>";
        // Get the station name corresponding to the ID
        $query = $conn->prepare("SELECT sname FROM station WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sname = $row["sname"];

            
            $deleteClassSeats = $conn->prepare("DELETE FROM classseats WHERE sp = ?");
            $deleteClassSeats->bind_param("s", $sname);
            if (!$deleteClassSeats->execute()) {
                echo "<h1 style='color: #dc3545;'>Error!</h1>";
                echo "<p>Error deleting related classseats records: " . $conn->error . "</p>";
                exit;
            }

            // Delete related records from `resv` table
            $deleteResv = $conn->prepare("DELETE FROM resv WHERE sp = ? OR dp = ?");
            $deleteResv->bind_param("ss", $sname, $sname);
            if (!$deleteResv->execute()) {
                echo "<h1 style='color: #dc3545;'>Error!</h1>";
                echo "<p>Error deleting related reservation records: " . $conn->error . "</p>";
                exit;
            }

            // Delete the station from the `station` table
            $deleteStation = $conn->prepare("DELETE FROM station WHERE id = ?");
            $deleteStation->bind_param("i", $id);
            if ($deleteStation->execute()) {
                echo "<h1>Record Deleted Successfully!</h1>";
                echo "<p>'$sname' has been removed .</p>";
            } else {
                echo "<h1 style='color: #dc3545;'>Error!</h1>";
                echo "<p>Error deleting station record: " . $conn->error . "</p>";
            }
        } else {
            echo "<h1 style='color: #dc3545;'>Error!</h1>";
            echo "<p>Station not found.</p>";
        }

        echo "<a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu</a>";
        echo "</div>";

        $conn->close();
    ?>
</body>
</html>
