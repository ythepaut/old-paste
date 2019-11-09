<?php

require("../includes/db-config.php");
include("../includes/spam.php");

if (isset($_POST['paste']) && $_POST['paste'] != "") {

    if (!isAuthorized()) {
        die('{"status":"error","message":"Submition denied by spam protection."}');
    }
    if (strlen($_POST['paste']) > 1000000) {
        die('{"status":"error","message":"Paste size too big."}');
    }


    $id = randomString();
    $ip = $_SERVER['REMOTE_ADDR'];
    $submitionDate = time();
    $expirationDate = time() + 2592000;
    $paste = $_POST['paste'];

    $connection = mysqli_connect($db['ip'], $db['login'], $db['password'], $db['login']); 
    mysqli_set_charset($connection, "utf8");

    $query = $connection->prepare("INSERT INTO PASTE_Pastes (UID,IP,SubmitionDate,Expirationdate) VALUES (?,?,?,?)"); 

    $query->bind_param("ssii", $id, $ip, $submitionDate, $expirationDate);
    
    $query->execute();
    $query->close();


    $file = fopen("../raw/" . $id, "w");
    fwrite($file, $paste);
    fclose($file);

    $message = "{\"status\":\"success\",\"message\":\"Paste submitted.\",\"url\":\"https://paste.ythepaut.com/$id\"}";
    die($message);
    
} else {
    die('{"status":"error","message":"Missing required parameter \'paste\'."}');
}



function randomString() { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $result = ''; 
  
    for ($i = 0; $i < 8; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $result .= $characters[$index]; 
    } 
  
    return $result; 
} 