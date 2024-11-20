<?php
session_start();
$file_path = "../data/info_formulaire.json";
$file_path2 = "../data/send_messages.json";

if (file_exists($file_path)) {
    $json_data = file_get_contents($file_path);
    $tab = json_decode($json_data, true);
    if (empty($json_data) || !is_array($tab)) {
        $tab = array();
    }
} else {
    $tab = array();
}

if (file_exists($file_path2)) {
    $json_data2 = file_get_contents($file_path2);
    $tab2 = json_decode($json_data2, true);
    if (empty($json_data2) || !is_array($tab2)) {
        $tab2 = array();
    }
} else {
    $tab2 = array();
}

$email = $tab[$_SESSION['index']]['email'];

if((isset($_SESSION['other_index'])) && ($_SESSION['other_index'] != "-1")){
    $_SESSION['other_email'] = $tab[$_SESSION['other_index']]['email'];
}

$other_email = $_SESSION['other_email'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/chat.css">
</head>
<body>
    <div id="divdroit"><a href="page_accueil.php"><img id="home_icon" src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="Home"></a></div>
    <div class="chat-container">
        <div class="chat-header">
            Chat Room
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Les messages seront ajoutés ici dynamiquement -->
            <?php
                foreach ($tab2 as &$entry) {
                    if (($entry['email'] == $email && $entry['other_email'] == $other_email) || ($entry['email'] == $other_email && $entry['other_email'] == $email)) {
                        foreach ($entry['messages'] as $message) {
                            if ($entry['email'] == $email) {
                                echo "<div class='message sent'><div class='message-content'>$message</div></div>";
                            } 
                            else {
                                echo "<div class='messagereceived'><div class='message-content'>$message</div></div>";
                            }
                        }
                    }
                }
            ?>
        </div>
        <div class="chat-input">
            <form id="chat-form" method="POST" action="chat.php">
                <input type="text" name="message" id="message" placeholder="Type a message..." required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    <script src="../java/chat.js"></script>
</body>
</html>