<?php

$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');

/**
 * Get the current filterBy GET request and add to SESSION
 * or if no GET filterBy and SESSION already has a filterBy, do nothing
 * or if no GET filterBy and no SESSION filterBy, set SESSION filterBy to ''
 */
function filterIt() {
    if (isset($_GET['filterBy'])) {
        $_SESSION['filterBy'] = $_GET['filterBy'];
    } elseif (isset($_GET['searchBy'])) {
        $_SESSION['filterBy'] = $_GET['searchBy'];
    } elseif (isset($_SESSION['filterBy'])) {
        return;
    } else {
        $_SESSION['filterBy'] = '';
    }
}

/**
 * Get the current sortBy GET request and add to SESSION
 * or if no GET sortBy, set SESSION sortBy to 'author'
 */
function sortIt() {
    if (isset($_GET['sortBy'])) {
        switch ($_GET['sortBy']) {
            case 'Title':
                $_SESSION['sortBy'] = 'title, author';
                break;
            case 'Author':
                $_SESSION['sortBy'] = 'author, title';
                break;
            case 'Year':
                $_SESSION['sortBy'] = 'year, author';
                break;
            case 'Genre':
                $_SESSION['sortBy'] = 'genre, author';
                break;
            case 'Rating':
                $_SESSION['sortBy'] = 'rating DESC';
                break;
            default:
                break;
        }
    } else {
        $_SESSION['sortBy'] = 'author';
    }
}

/**
 * Create connection to db, query db, echo table of items
 *
 * @param   object $db
 */
function displayLibrary(object $db) {
    try {
        $filter = $_SESSION['filterBy'];
        $sort = $_SESSION['sortBy'];
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $displayQuery = $db->prepare("SELECT * FROM books
                                        WHERE rating = :filter 
                                        OR title LIKE CONCAT('%', :filter, '%')
                                        OR author LIKE CONCAT('%', :filter, '%')
                                        ORDER BY $sort;");
        $displayQuery->bindParam(':filter', $filter);
        $displayQuery->execute();
        $myLibrary = $displayQuery->fetchAll();
        foreach ($myLibrary as $book) {
            echo '<tr><td>'
                . $book['title']
                . '</td><td>'
                . $book['author']
                . '</td><td class="usefulCell">'
                . $book['year']
                . '</td><td class="usefulCell medCell">'
                . $book['genre']
                . '</td><td class="maybeCell centerCell">'
                . $book['rating']
                . '</td><td class="centerCell">
                  <form method="get" action="edit.php">
                  <button type="submit" name="edit" value="'
                . $book['title']
                . '" class="chooseEdit">edit
                  </button>
                  </form>
                  </td></tr>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

/**
 * ADD/EDIT A BOOK
 */
if (isset($_POST['addBook']) || isset($_POST['editBook'])) {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    if (isset($_POST['addBook'])) {
        try {
            $query = $db->prepare("INSERT INTO books (title, author, year, genre, rating)
                                VALUE (:title, :author, :year, :genre, :rating);");
            $query->bindParam(':title', $title);
            $query->bindParam(':author', $author);
            $query->bindParam(':year', $year);
            $query->bindParam(':genre', $genre);
            $query->bindParam(':rating', $rating);
            $query->execute();
            return $added = "Added successfully!";
        } catch (PDOException $e) {
            return $added = 'Error: ' . $e->getMessage();
        }
    } elseif (isset($_POST['editBook'])) {
        try {
            $query = $db->prepare("UPDATE books
                                    SET title = :title, author = :author, year = :year, genre = :genre, rating = :rating
                                    WHERE title = :title;");
            $query->bindParam(':title', $title);
            $query->bindParam(':author', $author);
            $query->bindParam(':year', $year);
            $query->bindParam(':genre', $genre);
            $query->bindParam(':rating', $rating);
            $query->execute();
            unset($_GET);
            $_SESSION['edited'] = "Updated successfully! Taking you back in a sec";
            header('Location: updated.php');
        } catch (PDOException $e) {
            $_SESSION['edited'] = 'Error: ' . $e->getMessage();
        }
    }
}

/**
 * EDIT
 */
if (isset($_GET['edit'])) {
    $title = $_GET['edit'];
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $displayItemQuery = $db->prepare("SELECT * FROM books WHERE title = :title;");
    $displayItemQuery->bindParam(':title', $title);
    $displayItemQuery->execute();
    $toEdit = $displayItemQuery->fetchAll();
}

if (isset($_POST['editCancel'])) {
    unset($_GET);
    header('Location: index.php');
}

function notifyEdit() {
    if (isset($_SESSION['edited'])) {
        echo $_SESSION['edited'];
    }
}