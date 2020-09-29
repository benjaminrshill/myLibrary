<?php

$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');
$filter = '';
$order = 'author';

if (isset($_GET['filterBy'])) {
    switch ($_GET['filterBy']) {
        case 'Fiction':
            return $filter = "WHERE genre = 'Fiction'";
        case 'Non-fiction':
            return $filter = "WHERE genre = 'Non-fiction'";
        default:
            break;
    }
}

if (isset($_GET['sortBy'])) {
    switch ($_GET['sortBy']) {
        case 'title':
            return $order = 'title, author';
        case 'author':
            return $order = 'author, title';
        case 'year':
            return $order = 'year, author';
        case 'genre':
            return $order = 'genre, author';
        case 'rating':
            return $order = 'rating DESC';
        default:
            break;
    }
}

if (isset($_GET['searchBy'])) {
    $searchQuery = $_GET['searchBy'];
    $filter = "WHERE title LIKE '%$searchQuery%' OR author LIKE '%$searchQuery%'";
}

function displayLibrary(object $db, $filter, $order) {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $displayQuery = $db->prepare("SELECT * FROM books $filter ORDER BY $order;");
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
            . '</td><td class="centerCell"><a href="?title='
            . urlencode($book['title'])
            . '">~</a></td></tr>';
    }
}
