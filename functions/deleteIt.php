<?php
/**
 * Delete book: send to confirmation page
 */
if (isset($_POST['delBook'])) {
    $_SESSION['delBook'] = $_POST['delBook'];
    header('Location: delete.php');
}

/**
 * Confirm delete
 */
if (isset($_POST['confirmDelete'])) {
    $_SESSION['lastActive'] = time();
    $title = $_SESSION['delBook'];
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $db->prepare("DELETE FROM books WHERE title = :title;");
        $query->bindParam(':title', $title);
        $query->execute();
        $_SESSION['update'] = "$title deleted successfully!";
    } catch (PDOException $e) {
        $_SESSION['update'] = 'Error: ' . $e->getMessage();
    }
    header('Location: index.php');
} elseif (isset($_POST['cancelDelete'])) {
    header('Location: index.php');
}
