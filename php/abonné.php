<?php
session_start();
$file_path = "../data/info_formulaire.json";
if(file_exists($file_path)){
    $json_data = file_get_contents($file_path);
    $tab = json_decode($json_data, true);
    if(empty($json_data) || !is_array($tab)){
        echo "erreur critique";
        exit();
    }
}
else{
    echo "erreur critique";
    exit();
}

$index = $_SESSION["index"];
$tab[$index]["grade"]="abonné";
file_put_contents($file_path, json_encode($tab,JSON_PRETTY_PRINT));
header("location:page_accueil.php");