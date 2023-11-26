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

// Search logic
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $result = $db->executeQuery("SELECT * FROM books WHERE title LIKE '%$searchTerm%' OR isbn LIKE '%$searchTerm%'");
} else {
    // Default query to fetch all books
    $result = $db->executeQuery("SELECT * FROM books");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List - Library Management System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
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

        h1 {
            margin: 0;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
        }

        .search-btn {
            padding: 8px 16px;
            cursor: pointer;
            background-color: #333;
            color: #fff;
            border: none;
        }

        .search-btn:hover {
            background-color: #1e70bf;
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

        a {
            text-decoration: none;
            color: #3498db;
        }

        a:hover {
            color: #1e70bf;
        }

        .add-book-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #1e70bf;
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

<!-- Search form -->
<form method="post" class="search-form">
    <label for="searchTerm">Search:</label>
    <input type="text" name="searchTerm" class="search-input" placeholder="Enter title or ISBN">
    <input type="submit" name="search" value="Search" class="search-btn">
</form>

<h2>Book List</h2>
<table border='1'>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>ISBN Number</th>
        <th>Version</th>
        <th>Shelf</th>
    </tr>

    <?php
    // Ensure $result is defined
    if ($result) {
        while ($row = $result->fetch_assoc()) :
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['publisher']; ?></td>
                <td><?php echo $row['isbn']; ?></td>
                <td><?php echo $row['version']; ?></td>
                <td><?php echo $row['shelf']; ?></td>
            </tr>
        <?php
        endwhile;
    } else {
        echo "Error fetching data.";
    }
    ?>

</table>

</body>
</html>
