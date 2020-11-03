<?php
$db = new PDO('mysql:host=db; dbname=myLibrary', 'root', 'password');

require_once 'filterSort.php';
require_once 'displayLib.php';
require_once 'addIt.php';
require_once 'editIt.php';
require_once 'deleteIt.php';

/**
 * Give success or error message upon add/edit/delete, and remove message from SESSION after one minute
 */
function notifyEdit() {
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        if (isset($_SESSION['lastActive']) && (time() - $_SESSION['lastActive'] > 10)) {
            unset($_SESSION['update']);
        }
    }
}
