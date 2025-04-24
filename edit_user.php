<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
        }

        table {
            width: 60%;
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


if (isset($_POST["emailid"]) && $_POST["emailid"] != "") { 
    $sql = "UPDATE user SET emailid='" . $_POST["emailid"] . "',password='" . $_POST["password"] . "',mobileno='" . $_POST["mobileno"] . "',dob='" . $_POST["dob"] . "' WHERE id='" . $_GET["id"] . "'";

    if ($conn->query($sql) === TRUE) {
        echo "<h1 style='text-align:center; color:#000;'>User details updated successfully!</h1>";
    } else {
        echo "Error: " . $conn->error;
    }
} else { 
    
    $cdquery = "SELECT * FROM user WHERE id='" . $_GET["id"] . "'";
    $cdresult = mysqli_query($conn, $cdquery);
    $cdrow = mysqli_fetch_array($cdresult);

    echo "
    <h2 style='text-align:center; color:#000;'>Edit User Details</h2>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Email Id</td>
                <td>Password</td>
                <td>Mobile No</td>
                <td>Date of Birth</td>
            </tr>
        </thead>
        <tr>
            <td>" . $cdrow["id"] . "</td>
            <form action=\"edit_user.php?id=" . $_GET["id"] . "\" method=\"post\">
            <td><input type=\"text\" name=\"emailid\" value=\"" . $cdrow["emailid"] . "\" required></td>
            <td><input type=\"text\" name=\"password\" value=\"" . $cdrow["password"] . "\" required></td>
            <td><input type=\"text\" name=\"mobileno\" value=\"" . $cdrow["mobileno"] . "\" required></td>
            <td><input type=\"date\" name=\"dob\" value=\"" . $cdrow["dob"] . "\" required></td>
        </tr>
    </table>
    <div style='text-align:center;'>
        <input value='Update Record' type=\"submit\" class='button'>
    </div>
    </form>";
}

?>

<a href="show_users.php" class="back-link">Go Back to User Menu</a>
<a href="admin_login_1.php" class="back-link">Go Back to Admin Menu</a>

</body>
</html>