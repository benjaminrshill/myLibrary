<?php
session_start();
require_once 'functions/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Library | Update a book</title>
    <link rel="stylesheet" type="text/css" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <meta http-equiv="refresh" content="3; url=index.php">
</head>
<body>

<header>
    My Library
</header>

<section class="editIt">

    <div>
        <?php notifyEdit(); ?>
    </div>

</section>

</body>
</html>