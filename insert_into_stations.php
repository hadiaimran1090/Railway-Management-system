<!DOCTYPE html>
<html>
<head>
    <title>Manage Stations</title>
    <style>
        body {
            background-image: url('detail.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        
        table {
            width: 10%; 
            margin: 30px auto; 
            border-collapse: collapse;
            background-color: rgb(194, 199, 202);
            color: #000;
            border-radius: 10px;
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
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        table tr:nth-child(even) {
            background-color: rgba(186, 245, 249, 0.8);
        }

        table tr:hover {
            background-color: rgba(10, 74, 203, 0.1);
        }

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

        /* Add station form styling */
        .add-station {
            width: 40%;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(20, 20, 20, 0.8);
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }

        .add-station label {
            color: #fff;
            font-size: 16px;
        }

        .add-station input[type="text"] {
            width: 70%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 15px;
        }

        .add-station input[type="submit"] {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .add-station input[type="submit"]:hover {
            background-color: #062b4f;
        }

        /* Back link styling */
        .back-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            font-size: 18px;
            text-decoration: none;
            color: rgb(4, 26, 75);
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
require "db.php";

$cdquery = "SELECT id, sname FROM station";
$cdresult = mysqli_query($conn, $cdquery);

echo "<table>";
echo "<thead><tr><td>ID</td><td>Station</td><td colspan='2'>Actions</td></tr></thead>";

while ($cdrow = mysqli_fetch_array($cdresult)) {
    $cdId = $cdrow['id'];
    $cdTitle = $cdrow['sname'];
    echo "<tr><td>$cdId</td><td>$cdTitle</td>
          <td><a href='edit_station.php?id=$cdId'><button>Edit</button></a></td>
          <td><a href='delete_station.php?id=$cdId'><button>Delete</button></a></td></tr>";
}
echo "</table>";
?>

<div class="add-station">
    <form action="insert_into_station.php" method="post">
        <label for="sname">Add Station:</label>
        <input type="text" id="sname" name="sname" placeholder="Enter new station name" required>
        <input type="submit" value="Add">
    </form>
</div>

<a href="admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>
