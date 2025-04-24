<html>
<head>
    <style>
        body {
            background-image: url(userimage.webp);
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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
            font-family: Arial, sans-serif;
            
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php 
        require "db.php";

        $pwd = $_POST["password"];
        $eid = $_POST["emailid"];
        $mno = $_POST["mobileno"];
        $dob = $_POST["dob"];

        $sql = "INSERT INTO user (password, emailid, mobileno, dob) VALUES ('".$pwd."', '".$eid."', '".$mno."', '".$dob."')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='message-box'>
                    Hi $eid,<br><br> 
                    <a href=\"http://localhost/railway/index.htm\">Click here</a> to browse through our website!
                  </div>";
        } else {
            echo "<div class='message-box'>
                    Error: " . $conn->error . "<br><br>
                    <a href=\"http://localhost/railway/new_user_form.htm\">Go Back to Login</a>
                  </div>";
        }

        $conn->close(); 
    ?>
</body>
</html>
