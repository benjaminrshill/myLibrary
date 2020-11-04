<?php
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
            echo '<tr><td class="vitalCell">'
                . $book['title']
                . '</td><td class="vitalCell">'
                . $book['author']
                . '</td><td class="usefulCell">'
                . $book['year']
                . '</td><td class="usefulCell medCell">'
                . $book['category']
                . '</td><td class="maybeCell centerCell">'
                . $book['rating']
                . '</td><td class="centerCell">
                  <form method="get" action="./edit.php">
                  <button type="submit" name="edit" value="'
                . $book['id']
                . '">edit</button>
                  </form>
                  </td></td><td class="maybeCell centerCell">
                  <form method="post">
                  <button type="submit" name="delBook" value="'
                . $book['id']
                . '">x</button>
                  </form>
                  </td></tr>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}