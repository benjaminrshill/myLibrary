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
                display add or edit
            </form>
        </div>

    </section>

    <section class="displayPane">

        <div class="filterSearch">
            <div class="maybeCell filter">
                Filter by:
                <span>none</span>
                |
                <span>genre</span>
                |
                <span>rating</span>
            </div>

            <div class="search">
                <input type="search" placeholder="Search">
            </div>
        </div>

        <table>
            <tr>
                <th class="vitalCell longCell">
                    <a href="index.php?sort=title">Title</a>
                </th>
                <th class="vitalCell longCell">
                    <a href="index.php?sort=author">Author</a>
                </th>
                <th class="usefulCell shortCell">
                    <a href="index.php?sort=year">Year</a>
                </th>
                <th class="usefulCell medCell">
                    <a href="index.php?sort=genre">Genre</a>
                </th>
                <th class="maybeCell shortCell centerCell">
                    <a href="index.php?sort=rating">Rating</a>
                </th>
                <th class="vitalCell shortCell centerCell">
                    Edit
                </th>
            </tr>
            <?php displayLibrary($db); ?>
        </table>

    </section>

</main>

</body>
</html>