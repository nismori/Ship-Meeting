<?php 
session_start();

if(!isset($_SESSION['index'])){
    header('Location: page_connexion.php');
    exit();
}

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

$grade = $tab[$_SESSION['index']]['grade'];

if($grade == "inscrit"){
    header("Location: user_list_inscrit.php");
    exit();
}
if($grade == "abonné"){
    header("Location: user_list_abonné.php");
    exit();
}
if($grade == "admin"){
    header("Location: user_list_admin.php");
    exit();
}
else{
    header("Location: page_accueil.php");
    exit(); 
}