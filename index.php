<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Library</title>
    <link rel="stylesheet" type="text/css" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php require 'functions.php'; ?>

<header>
    My Library
</header>

<main>

    <section class="sidePane">

        <div class="addEdit">
            <form method="post">
                Add / Edit
            </form>
        </div>

    </section>

    <section class="displayPane">

        <div class="filterSearch">

            <div class="filter">
                <form method="get">
                    <div>
                        <label for="filterBy">Filter by:</label>
                        <select id="filterBy" name="filterBy">
                            <option value="None">None</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Non-fiction">Non-fiction</option>
                        </select>
                        <input type="submit" value="Filter!" class="smallSubmit" />
                    </div>
                </form>
            </div>

            <div class="search">
                <form method="get">
                    <label for="searchBy"><span>&#9906;</span></label>
                    <input type="search" id="searchBy" name="searchBy" placeholder="Which book would you like today?" />
                    <input type="submit" value="Search" />
                </form>
            </div>

        </div>

        <table>
            <tr>
                <th class="vitalCell longCell">
                    <a href="index.php?sortBy=title">Title</a>
                </th>
                <th class="vitalCell longCell">
                    <a href="index.php?sortBy=author">Author</a>
                </th>
                <th class="usefulCell shortCell">
                    <a href="index.php?sortBy=year">Year</a>
                </th>
                <th class="usefulCell medCell">
                    <a href="index.php?sortBy=genre">Genre</a>
                </th>
                <th class="maybeCell shortCell centerCell">
                    <a href="index.php?sortBy=rating">Rating</a>
                </th>
                <th class="vitalCell shortCell centerCell">
                    Edit
                </th>
            </tr>
            <?php displayLibrary($db, $filter, $order); ?>
        </table>

    </section>

</main>

</body>
</html>

