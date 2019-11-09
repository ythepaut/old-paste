<?php

function isAuthorized() {
    
    include("../includes/db-config.php");

    $connection = mysqli_connect($db['ip'], $db['login'], $db['password'], $db['login']); 

    
    $delay = time() - 3600*24;
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "SELECT * FROM PASTE_Pastes";

    $results = mysqli_query($connection,$query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($results)) {
        if ($row['IP'] == $ip && $row['SubmitionDate'] > $delay) {
            $i++;
        }
    }

    if ($i>50) {
        return false;
    } else {
        return true;
    }

}
