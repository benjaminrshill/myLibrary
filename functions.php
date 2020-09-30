<?php

$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');

function filterIt() {
    if (isset($_GET['filterBy'])) {
        $_SESSION['filterBy'] = $_GET['filterBy'];
        $_SESSION['filterBy'] = "rating = $_GET[filterBy]";
    } elseif (isset($_GET['searchBy'])) {
        $_SESSION['filterBy'] = $_GET['searchBy'];
        $_SESSION['filterBy'] = "title LIKE '%$_GET[searchBy]%' OR author LIKE '%$_GET[searchBy]%'";
    } elseif (isset($_SESSION['filterBy'])) {
        return;
    } else {
        $_SESSION['filterBy'] = 'rating = rating';
    }
}

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

function displayLibrary(object $db) {
    try {
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $displayQuery = $db->prepare(
            "SELECT * FROM books WHERE $_SESSION[filterBy] ORDER BY $_SESSION[sortBy];"
        );
//        $displayQuery->bindParam(':filter', $_SESSION[filterBy]);
//        $displayQuery->bindParam(':order', $_SESSION[sortBy]);
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
                . '</td><td class="centerCell"><a href="?edit='
                . urlencode($book['title'])
                . '">~</a></td></tr>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
