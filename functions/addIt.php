<?php
/**
 * Add a book
 */
if (isset($_POST['addBook'])) {
    $_SESSION['lastActive'] = time();
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $db->prepare("INSERT INTO books (title, author, year, category, rating)
                            VALUE (:title, :author, :year, :category, :rating);");
        $query->bindParam(':title', $title);
        $query->bindParam(':author', $author);
        $query->bindParam(':year', $year);
        $query->bindParam(':category', $category);
        $query->bindParam(':rating', $rating);
        $query->execute();
        $_SESSION['update'] = "$title added successfully!";
    } catch (PDOException $e) {
        $_SESSION['update'] = 'Error: ' . $e->getMessage();
    }
    header('Location: index.php');
}