<?php
/**
 * Delete book: send to confirmation page
 */
if (isset($_POST['delBook'])) {
    $_SESSION['delBook'] = $_POST['delBook'];
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $displayItemQuery = $db->prepare("SELECT title FROM books WHERE id = :bookId;");
    $displayItemQuery->bindParam(':bookId', $_POST['delBook']);
    $displayItemQuery->execute();
    $toEdit = $displayItemQuery->fetchAll();
    $_SESSION['delTitle'] = $toEdit[0]['title'];
    header('Location: delete.php');
}

/**
 * Confirm delete
 */
if (isset($_POST['confirmDelete'])) {
    $_SESSION['lastActive'] = time();
    $bookId = $_SESSION['delBook'];
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $db->prepare("DELETE FROM books WHERE id = :bookId;");
        $query->bindParam(':bookId', $bookId);
        $query->execute();
        $_SESSION['update'] = $_SESSION['delTitle'] . " deleted successfully!";
    } catch (PDOException $e) {
        $_SESSION['update'] = 'Error: ' . $e->getMessage();
    }
    header('Location: index.php');
} elseif (isset($_POST['cancelDelete'])) {
    header('Location: index.php');
}
