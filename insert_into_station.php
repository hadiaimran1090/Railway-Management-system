<html>
<head>
    <style>
        body {
            background-image: url('enquiry.webp');
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif; 
            color: #ffffff; 
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

        echo "<div class='message-box'>";
        $sql = "INSERT INTO station(sname) VALUES ('" . $_POST["sname"] . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<h1>New Record Created Successfully!</h1>";
            echo "<p>'" . htmlspecialchars($_POST["sname"]) . "' has been added </p>";
        } else {
            echo "<h1 style='color: #dc3545;'>Error!</h1>";
            echo "<p>" . $conn->error . "</p>";
        }
        echo "<a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu</a>";
        echo "</div>";

        $conn->close();
    ?>
</body>
</html>
