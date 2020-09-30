<div>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo $myLibrary[0]['title']; ?>" required="required" />
</div>
<div>
    <label for="author">Author:</label>
    <input type="text" id="author" name="author" value="<?php echo $myLibrary[0]['author']; ?>" required="required" />
</div>
<div>
    <label for="year">Year:</label>
    <input type="number" id="year" name="year" max="2020" value="<?php echo $myLibrary[0]['year']; ?>" required="required" />
</div>
<div>
    <label for="rating">My rating:</label>
    <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo $myLibrary[0]['rating']; ?>" />
</div>
<div>
    <label for="genre">Genre:</label>
    <select id="genre" name="genre" required="required">
        <option value="Fiction">Fiction</option>
        <option value="Non-fiction">Non-fiction</option>
    </select>
</div>
<div>
    <input type="submit" value="Update!" class="bigSubmit" />
</div>



<?php

/** EDIT **/
if (isset($_GET['title'])) {
    $title = $_GET['title'];
}

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$displayItemQuery = $db->prepare("SELECT * FROM books WHERE title = '$title';");
$displayItemQuery->execute();
$myLibrary = $displayItemQuery->fetchAll();

if (isset($_POST['title'])) {
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $rating = $_POST['rating'];
        $editQuery = $db->prepare("UPDATE books
                                    SET title = :title, author = :author, year = :year, genre = :genre, rating = :rating
                                    WHERE title = '$title';");
        $editQuery->bindParam(':title', $title);
        $editQuery->bindParam(':author', $author);
        $editQuery->bindParam(':year', $year);
        $editQuery->bindParam(':genre', $genre);
        $editQuery->bindParam(':rating', $rating);
        $editQuery->execute();
        echo "Updated successfully!";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}