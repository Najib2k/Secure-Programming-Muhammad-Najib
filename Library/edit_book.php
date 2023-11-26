<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Library Management System</title>
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

<?php
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];

    $db = new DB();
    $result = $db->executeQuery("SELECT * FROM books WHERE id = $id");
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $isbn = $_POST['isbn'];
    $version = $_POST['version'];
    $shelf = $_POST['shelf'];

    $db = new DB();
    $query = "UPDATE books SET title='$title', author='$author', publisher='$publisher', isbn='$isbn', version='$version', shelf='$shelf' WHERE id=$id";
    $db->executeQuery($query);

    header('Location: index.php');
}
?>

<h2>Edit Book</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>

    <label>Author:</label>
    <input type="text" name="author" value="<?php echo $row['author']; ?>" required><br>

    <label>Publisher:</label>
    <input type="text" name="publisher" value="<?php echo $row['publisher']; ?>" required><br>

    <label>ISBN Number:</label>
    <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required><br>

    <label>Version:</label>
    <input type="text" name="version" value="<?php echo $row['version']; ?>" required><br>

    <label>Shelf:</label>
    <input type="text" name="shelf" value="<?php echo $row['shelf']; ?>" required><br>

    <input type="submit" value="Update Book">
</form>

</body>
</html>
