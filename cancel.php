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
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
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
            color: #333;
            margin-bottom: 15px;
        }
        .message-box p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
        .message-box a {
            font-size: 18px;
            color: #007BFF;
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
        session_start();
        require "db.php";

        $pnr = $_POST["cancpnr"];
        $uid = $_SESSION["id"];

        $sql = "UPDATE resv SET status ='CANCELLED' WHERE resv.pnr='" . $pnr . "' AND resv.id='" . $uid . "'";

        echo "<div class='message-box'>";
        if ($conn->query($sql) === TRUE) {
            echo "<h1>Cancellation Successful!</h1>";
        } else {
            echo "<h1 style='color: red;'>Error!</h1>";
            echo "<p>" . $conn->error . "</p>";
        }
        echo "<p><a href=\"http://localhost/railway/index.htm\">Go to Home Page</a></p>";
        echo "</div>";

        $conn->close(); 
    ?>
</body>
</html>
