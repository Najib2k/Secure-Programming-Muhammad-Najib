<?php
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $isbn = $_POST['isbn'];
    $version = $_POST['version'];
    $shelf = $_POST['shelf'];

    $db = new DB();
    $query = "INSERT INTO books (title, author, publisher, isbn, version, shelf) VALUES ('$title', '$author', '$publisher', '$isbn', '$version', '$shelf')";
    $db->executeQuery($query);

    // Redirect to index.php after adding a book
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - Library Management System</title>
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

<h2>Add New Book</h2>
<form method="post">
    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Author:</label>
    <input type="text" name="author" required>

    <label>Publisher:</label>
    <input type="text" name="publisher" required>

    <label>ISBN Number:</label>
    <input type="text" name="isbn" required>

    <label>Version:</label>
    <input type="text" name="version" required>

    <label>Shelf:</label>
    <input type="text" name="shelf" required>

    <input type="submit" value="Add Book">
</form>

</body>
</html>
