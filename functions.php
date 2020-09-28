<?php

$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');

function displayLibrary($db) {
    $order = 'author';
    if (isset($_GET['sort'])) {
        switch ($_GET['sort']) {
            case 'title':
                $order = 'title, author';
                break;
            case 'author':
                $order = 'author, title';
                break;
            case 'year':
                $order = 'year, author';
                break;
            case 'genre':
                $order = 'genre, author';
                break;
            case 'rating':
                $order = 'rating, author';
                break;
            default:
                break;
        }
    }
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $displayQuery = $db->prepare("SELECT * FROM books ORDER BY $order;");
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
            . '</td><td class="centerCell"><a href="index.php?title='
            . urlencode($book['title'])
            . '">~</a></td></tr>';
    }
}
