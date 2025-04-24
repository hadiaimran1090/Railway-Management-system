<!DOCTYPE html>
<html>
<head>
    <title>Admin Menu</title>
    <style>
        body {
            background-image: url('detail.jpg');
            background-attachment: fixed;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: rgba(90, 183, 230, 0.6);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 50%;
            margin: 150px auto;
        }

        h2 {
            font-size: 32px;
            color: #000;
            margin-bottom: 20px;
        }

        a {
            display: block;
            font-size: 24px;
            color:rgb(27, 145, 163);
            text-decoration: none;
            margin: 15px 0;
            font-weight: bold;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        a:hover {
            color: #062b4f;
            text-decoration: underline;
        }

        .back-link {
            font-size: 20px;
            color: rgb(4, 26, 75);
            font-weight: bold;
            margin-top: 30px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Menu</h2>
    <?php 
    echo " <a href=\"http://localhost/railway/insert_into_stations.php\">Show All Stations</a> ";
    echo " <a href=\"http://localhost/railway/insert_into_train_1.php\">Enter New Train</a> ";
    echo " <a href=\"http://localhost/railway/insert_into_classseats_1.php\">Enter Train Schedule</a> ";
    echo " <a href=\"http://localhost/railway/booked.php\">View All Booked Tickets</a> ";
    echo " <a href=\"http://localhost/railway/cancelled.php\">View All Cancelled Tickets</a> ";
    ?>
    <br>
    <a href="http://localhost/railway/index.htm" class="back-link">Go to Home Page!!! You'll be Logged Out!!!</a>
</div>

</body>
</html>