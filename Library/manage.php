<?php
include_once('db.php');

session_start();

// Logout logic
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

$db = new DB();

// Fetch all users
$result = $db->executeQuery("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Library Management System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .logout-btn {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .edit-btn:hover,
        .delete-btn:hover {
            background-color: #1e70bf;
        }

        .add-user-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

    </style>
</head>
<body>

<header>
    <h1>Library Management System</h1>
</header>

<form method="post" class="logout-btn">
    <input type="submit" name="logout" value="Logout">
</form>

<h2>User Management</h2>

<!--  add user   -->
<div class="add-user-link">
    <a href="register.php">Add User</a>

<table border='1'>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href='edit_user.php?id=<?php echo $row['id']; ?>' class='edit-btn'>Edit</a>
                <a href='delete_user.php?id=<?php echo $row['id']; ?>' class='delete-btn'>Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
