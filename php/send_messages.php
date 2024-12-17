<?php
session_start();
$file_path2 = "../data/info_formulaire.json";
$file_path = "../data/send_messages.json";


if (file_exists($file_path2)) {
    $json_data2 = file_get_contents($file_path2);
    $tab2 = json_decode($json_data2, true);
    if (empty($json_data2) || !is_array($tab2)) {
        $tab2 = array();
    }
} else {
    $tab2 = array();
}


// Vérifiez si le fichier existe et chargez les données
if (file_exists($file_path)) {
    $json_data = file_get_contents($file_path);
    $tab = json_decode($json_data, true);
    if (empty($json_data) || !is_array($tab)) {
        $tab = array();
    }
} else {
    $tab = array();
}


$email = $tab2[$_SESSION['index']]['email'];


if (!isset($_SESSION['send_messages'])) {
    $_SESSION['send_messages'] = array();
}


if (isset($_POST['message'])) {
    $_SESSION['send_messages'][] = $_POST['message'];
}


$last_entry = end($tab);


$found = false;
if ($last_entry['email'] == $email && $last_entry['other_email'] == $_SESSION['other_email']){
    $last_entry['messages'] = array_merge($last_entry['messages'], $_SESSION['send_messages']);
    $found = true;
    $tab[key($tab)] = $last_entry;
}


if (!$found) {
    $data_array = array(
        'email' => $email,
        'other_email' => $_SESSION['other_email'],
        'messages' => $_SESSION['send_messages'],
    );
    $tab[] = $data_array;
}


file_put_contents($file_path, json_encode($tab, JSON_PRETTY_PRINT));


$_SESSION['send_messages'] = array();