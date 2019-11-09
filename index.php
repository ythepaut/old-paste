<?php
if (isset($_GET['uid'])) {
    if (file_exists('./raw/' . $_GET['uid'])) {
        include('./includes/update-expiration.php');
        updateExpire($_GET['uid']);
        include("./includes/view.php");
    } else {
        header("Location: https://paste.ythepaut.com/");
    }
} else {
    include("./includes/create.php");
}