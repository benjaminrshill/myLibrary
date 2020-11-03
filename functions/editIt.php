<?php
/**
 * If GET is set to edit with book title, fetch data for that book
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

/**
 * If POST is set from the edit page, update the book's fields with the user input
 * and redirect to 'updated.php' for success/error message
 */
if (isset($_POST['editBook'])) {
    $_SESSION['lastActive'] = time();
    $oldTitle = $_SESSION['title'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $editQuery = $db->prepare("UPDATE books
                            SET title = :title, author = :author, year = :year, category = :category, rating = :rating
                            WHERE title = :oldTitle;");
        $editQuery->bindParam(':oldTitle', $oldTitle);
        $editQuery->bindParam(':title', $title);
        $editQuery->bindParam(':author', $author);
        $editQuery->bindParam(':year', $year);
        $editQuery->bindParam(':category', $category);
        $editQuery->bindParam(':rating', $rating);
        $editQuery->execute();
        $_SESSION['update'] = "$title updated successfully!";
        header('Location: updated.php');
    } catch (PDOException $e) {
        $_SESSION['update'] = 'Error: ' . $e->getMessage();
    }
} elseif (isset($_POST['editCancel'])) {
    header('Location: index.php');
}