<pre><?php
if (isset($_GET['uid']) && file_exists($_GET['uid'])) {

    include('../includes/update-expiration.php');
    updateExpire($_GET['uid']);

    $code = file_get_contents($_GET['uid']);
    $code = gzuncompress($code);
    echo($code);
} else {
    header("Location: ../");
}
?>
</pre>