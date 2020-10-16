<?php
session_start();
require 'functions.php';
?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <title>My Library | Delete a book</title>
    <link rel="stylesheet" type="text/css" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<header>
    My Library
</header>

    <section class="editIt">

        <form method="post" class="addEdit">
            <div>
                <h3>Are you sure you want to delete <?php echo $_SESSION['delBook']?>?</h3>
                <div>
                    <input type="submit" name="confirmDelete" value="Delete!" class="addSubmit" />
                </div>
                <div>
                    <input type="submit" name="cancelDelete" value="Cancel" class="addSubmit" />
                </div>
            </div>
        </form>

    </section>

</body>
</html>
