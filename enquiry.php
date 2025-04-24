<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Form</title>
    <style>
        body {
            background-image: url('enquiry.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
            margin: 50px auto;
            text-align: left;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            flex: 1;
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }

        .form-group select,
        .form-group input {
            flex: 2;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input[type="date"] {
            width: 100%;
        }

        .form-container input[type="submit"] {
            background-color:#00AAFF;
            width: 40%;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto; /* Centers the button */
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-container a {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007BFF;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<div class="form-container"> 
    <h2>Train Enquiry Form</h2>
    <form action="enquiry_result.php" method="post">

        <div class="form-group">
            <label for="sp">Starting Point:</label>
            <select id="sp" name="sp" required>
                <?php
                require "db.php";
                $cdquery = "SELECT sname FROM station";
                $cdresult = mysqli_query($conn, $cdquery);

                echo "<option value=''>Select Starting Point</option>";
                while ($cdrow = mysqli_fetch_array($cdresult)) {
                    $cdTitle = $cdrow['sname'];
                    echo "<option value='$cdTitle'>$cdTitle</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="dp">Destination Point:</label>
            <select id="dp" name="dp" required>
                <?php
                require "db.php";
                $cdquery = "SELECT sname FROM station";
                $cdresult = mysqli_query($conn, $cdquery);

                echo "<option value=''>Select Destination Point</option>";
                while ($cdrow = mysqli_fetch_array($cdresult)) {
                    $cdTitle = $cdrow['sname'];
                    echo "<option value='$cdTitle'>$cdTitle</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="doj">Date of Journey:</label>
            <input type="date" id="doj" name="doj" required>
        </div>

        <input type="submit" value="Submit">
    </form>

    <a href="http://localhost/railway/index.htm">Go to Home Page</a>
</div>

</body>
</html>
