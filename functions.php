<?php

$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');

/**
 * Get the current filterBy GET request and add to SESSION
 * or if no GET filterBy and SESSION already has a filterBy, do nothing
 * or if no GET filterBy and no SESSION filterBy, set SESSION filterBy to 'rating' (always true)
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
                . '</td><td class="centerCell"><a href="?edit='
                . urlencode($book['title'])
                . '">~</a></td></tr>';
        }
//        var_dump($displayQuery->debugDumpParams());
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}