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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];

    // Fetch user information based on the ID
    $result = $db->executeQuery("SELECT * FROM users WHERE id = $id");
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Delete user from the database
    $query = "DELETE FROM users WHERE id=$id";
    $db->executeQuery($query);

    // Redirect back to the user management page
    header('Location: manage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - Library Management System</title>
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

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1e70bf;
        }
    </style>
</head>
<body>

<header>
    <h1>Library Management System</h1>
</header>

<h2>Delete User</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label>Username:</label>
    <p><?php echo $row['username']; ?></p>

    <label>Role:</label>
    <p><?php echo $row['role']; ?></p>

    <input type="submit" value="Delete User">
</form>

</body>
</html>
