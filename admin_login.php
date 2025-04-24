<?php 
session_start(); 

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('user.jpg');
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Content Container */
        .content {
            padding-top: 30px;
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            text-align: center;
        }
        h3{
           color:red;
           text-align:center;
        }

        
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }

        
        .menu-container a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 12px 25px;
            border: 2px solid #fff;
            border-radius: 5px;
            display: inline-block;
            background-color: rgb(79, 134, 169);
            width: 220px; 
            text-align: center;
            transition: all 0.3s ease;
        }

        .menu-container a:hover {
            background-color:#2D5690;
            transform: scale(1.1);
            color:black;
            box-shadow: 0px 0px 15px #2D5690;
        }
        
       
        form {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            transition: all 0.3s ease;
        }

        form input[type="text"],
        form input[type="password"] {
            padding: 15px;
            font-size: 16px;
            margin: 10px 0;
            border-radius: 5px;
            border: 2px solid #ccc;
            width: 100%;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }

        form input[type="text"]:focus,
        form input[type="password"]:focus {
            border: 2px solid #00FF00;
            outline: none;
        }

        form input[type="submit"] {
            padding: 15px 25px;
            background-color:rgb(36, 73, 124);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color:rgb(36, 73, 124);
            box-shadow: 0px 0px 10px rgb(36, 73, 124);
        }

        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        
        .home-link {
            font-size: 18px;
            color: #fff;
            text-decoration: none;
            background-color:rgb(36, 73, 124);
            padding: 15px 25px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .home-link:hover {
            background-color:rgb(4, 46, 105);
        }

    </style>
</head>

<body>
    <div class="content">
        <h1>Admin Portal</h1>
        <?php 
        
        if (isset($_POST["uid"]) && isset($_POST["password"])) {
            if ($_POST["uid"] == 'admin' AND $_POST["password"] == 'admin') {
                $_SESSION["admin_login"] = True;
            }
        }

        if (isset($_SESSION["admin_login"]) && $_SESSION["admin_login"] == True) {
            echo "<div class='menu-container'>";
            echo "<a href=\"http://localhost/railway/insert_into_stations.php\">Show All Stations</a>";
            echo "<a href=\"http://localhost/railway/show_trains.php\">Show All Trains</a>";
            echo "<a href=\"http://localhost/railway/show_users.php\">Show All Users</a>";
            echo "<a href=\"http://localhost/railway/insert_into_train_3.php\">Enter New Train</a>";
            echo "<a href=\"http://localhost/railway/insert_into_classseats_3.php\">Enter Train Schedule</a>";
            echo "<a href=\"http://localhost/railway/booked.php\">View All Booked Tickets</a>";
            echo "<a href=\"http://localhost/railway/cancelled.php\">View All Cancelled Tickets</a>";
            
            echo "</div>";
        } else {
            echo " <h3>TRY AGAIN!</h3>
            <form action=\"admin_login.php\" method=\"post\">
                <label for=\"uid\">User ID:</label>
                <input type=\"text\" name=\"uid\" required><br>
                <label for=\"password\">Password:</label>
                <input type=\"password\" name=\"password\" required><br>
                <input type=\"submit\" value=\"Login\">
            </form>";
        }
        ?>
        <br><a class="home-link" href="http://localhost/railway/index.htm">Go to Home Page</a>
    </div>
</body>
</html>
