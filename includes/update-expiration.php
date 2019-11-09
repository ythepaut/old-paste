<?php

function updateExpire($uid) {
    
    include("db-config.php");

    $connection = mysqli_connect($db['ip'], $db['login'], $db['password'], $db['login']); 
    mysqli_set_charset($connection, "utf8");

    $query = $connection->prepare("UPDATE PASTE_Pastes SET ExpirationDate = ? WHERE UID = ?"); 

    $newDate = time() + 3600*24*30;
    $query->bind_param("is", $newDate, $uid);
    $query->execute();
    $query->close();


}
