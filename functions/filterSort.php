<?php
/**
 * Get the current GET request (filter/search) and add to SESSION
 * or if no GET filter/search and SESSION already has a filterBy, do nothing
 * or if no GET filter/search and no SESSION filter/search, set SESSION filter/search to ''
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
            case 'Category':
                $_SESSION['sortBy'] = 'category, author';
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