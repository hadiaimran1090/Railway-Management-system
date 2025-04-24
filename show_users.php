<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
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
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: rgb(194, 199, 202);
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

$cdquery = "SELECT * FROM user";
$cdresult = mysqli_query($conn, $cdquery);

echo "
<h2 style='text-align:center; color:#000;'>User Management</h2>
<table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Email Id</td>
            <td>Password</td>
            <td>Mobile No</td>
            <td>Date of Birth</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
";

while ($cdrow = mysqli_fetch_array($cdresult)) {
    echo "
    <tr>
        <td>" . $cdrow[0] . "</td>
        <td>" . $cdrow[1] . "</td>
        <td>" . $cdrow[2] . "</td>
        <td>" . $cdrow[3] . "</td>
        <td>" . $cdrow[4] . "</td>
        <td><a href=\"edit_user.php?id=" . $cdrow[0] . "\"><button>Edit</button></a></td>
        <td><a href=\"delete_user.php?id=" . $cdrow[0] . "\"><button>Delete</button></a></td>
    </tr>
    ";
}

echo "</table>";
?>

<a href="new_user_form.html" class="back-link">Add New User</a>
<a href="admin_login.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>