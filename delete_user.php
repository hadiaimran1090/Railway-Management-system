<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <style>
        
        html, body {
            height: 100%; 
            margin: 0; 
            padding: 0; 
        }

        
        body {
            background-image: url('detail.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover; 
            font-family: Arial, sans-serif;
            color: #fff;
        }

        
        table {
            width: 60%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: rgba(194, 199, 202, 0.8); 
            color: #000;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        table thead {
            background-color: #073762;
            color: #fff;
            text-transform: uppercase;
        }

        table thead td {
            font-weight: bold;
            padding: 12px;
        }

        table tr td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        table tr:nth-child(even) {
            background-color: rgba(186, 245, 249, 0.8);
        }

        table tr:hover {
            background-color: rgba(10, 74, 203, 0.1);
        }

        /* Style the button */
        button {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #062b4f;
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

require "db.php";


if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $sql = "DELETE FROM user WHERE id = '" . $_GET["id"] . "'";

    if ($conn->query($sql) === TRUE) {
        echo "<h1 style='text-align:center; color:000;'>Record deleted successfully!</h1>";
    } else {
        echo "<h2 style='text-align:center; color:#fff;'>Error: " . $conn->error . "</h2>";
    }
} else {
    echo "<h2 style='text-align:center; color:#fff;'>No ID provided to delete.</h2>";
}

?>

<a href="admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>