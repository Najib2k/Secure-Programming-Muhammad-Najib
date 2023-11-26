<?php
session_start();

// Check if the user is logged in and has the 'Librarian' role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Librarian') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Options</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        h2 {
            color: #333;
        }

        .options-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .option-button {
            margin: 0 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, Librarian!</h1>
</header>

<form method="post" action="login.php" class="logout-btn">
    <input type="submit" name="logout" value="Logout">
</form>

<h2>Select an Option</h2>
<div class="options-container">
    <a href="index.php" class="option-button">Go to Index</a>
    <a href="manage.php" class="option-button">Go to Manage Users</a>
</div>

</body>
</html>