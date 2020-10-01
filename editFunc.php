<?php

$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');

/**
 * EDIT
 */
if (isset($_GET['edit'])) {
    $title = $_GET['edit'];
    $_SESSION['title'] = $title;
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $displayItemQuery = $db->prepare("SELECT * FROM books WHERE title = :title;");
    $displayItemQuery->bindParam(':title', $title);
    $displayItemQuery->execute();
    $toEdit = $displayItemQuery->fetchAll();
}

if (isset($_POST['editBook'])) {
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $oldTitle = $_SESSION['title'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $rating = $_POST['rating'];
        $query = $db->prepare("UPDATE books
                            SET title = :title, author = :author, year = :year, genre = :genre, rating = :rating
                            WHERE title = :oldTitle;");
        $query->bindParam(':oldTitle', $oldTitle);
        $query->bindParam(':title', $title);
        $query->bindParam(':author', $author);
        $query->bindParam(':year', $year);
        $query->bindParam(':genre', $genre);
        $query->bindParam(':rating', $rating);
        $query->execute();
        $_SESSION['update'] = "Updated successfully!";
        header('Location: updated.php');
    } catch (PDOException $e) {
        $_SESSION['update'] = 'Error: ' . $e->getMessage();
    }
} elseif (isset($_POST['editCancel'])) {
    header('Location: index.php');
}