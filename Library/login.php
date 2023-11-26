<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f7f7f7;
            color: #333;
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

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #1e70bf;
        }

        p {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
include_once('db.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DB();
    $user = $db->authenticateUser($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;

        // Redirect based on user role
        if ($user['role'] === 'User') {
            header('Location: view.php');
        } elseif ($user['role'] === 'Librarian') {
            header('Location: option.php'); // Redirect to option.php for Librarians
        } else {
            // Handle other roles or scenarios
            echo "Invalid user role!";
        }
        exit(); // Ensure that the script stops execution after the redirect header
    } else {
        $error = "Invalid username or password";
    }
}
?>

<h2>User Login</h2>
<?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>
<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Login">

    <button onclick="location.href='home.php'" type="button">Go to Home</button>
</form>

</body>
</html>
