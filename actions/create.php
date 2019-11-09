<?php


require("../includes/db-config.php");
include("../includes/spam.php");

if (isset($_POST['paste']) && $_POST['paste'] != "" && strlen($_POST['paste'] < 1000000)) {

    if (!isAuthorized()) {
        header("Location: https://paste.ythepaut.com/antispam");
        die("Denied by anti spam.");
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
    fwrite($file, gzcompress($paste, 9));
    fclose($file);

}

header("Location: https://paste.ythepaut.com/" . $id);


function randomString() { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $result = ''; 
  
    for ($i = 0; $i < 8; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $result .= $characters[$index]; 
    } 
  
    return $result; 
} 