<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/user_list.css">
        <title>Compte</title>
    </head>
    <body>
        <div id=divdroit><a href="page_accueil.php"> <img id="home_icon" src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
        <p id="titre">Liste des utilisateurs</p>
        <table id="table" border="solid">
            <?php
            $file_path = "../data/info_formulaire.json";
            $file_path2 = "../data/send_messages.json";

            if(file_exists($file_path)){
                $json_data = file_get_contents($file_path);
                $tab = json_decode($json_data, true);
                if(empty($json_data) || !is_array($tab)){
                    echo "Erreur critique";
                    exit();
                }
            }
            else{
                echo "Erreur Critique";
                exit();
            }

            if(file_exists($file_path2)){
                $n = 1;
                $json_data2 = file_get_contents($file_path2);
                $tab2 = json_decode($json_data2, true);
                if(empty($json_data2) || !is_array($tab2)){
                    $n = 0;
                }
            }
            else{
                $n = 0;
            }


            $send_messages_tab = 0;

            if($n){
                function other_messages($tab,$tab2){
                    $final_tab = array();
                    foreach($tab2 as $compte){
                        if($compte['email'] == $tab[$_SESSION['index']]['email']){
                            $final_tab[] = $compte['other_email'];
                        }
                        if($compte['other_email'] == $tab[$_SESSION['index']]['email']){
                            $final_tab[] = $compte['email'];
                        }
                    }
                    return $final_tab;
                }

                $tab3 = other_messages($tab,$tab2);

                function removeDuplicates($tab3) {
                    $seen = array();
                    $result = array();
                    
                    foreach ($tab3 as $email) {
                        if (!isset($seen[$email])) {
                            $seen[$email] = true;
                            $result[] = $email;
                        }
                    }
                    return $result;
                }

                $send_messages_tab = removeDuplicates($tab3);
            }
            function ifseen($selected_compte,$send_messages_tab,$n){
                if($n){
                    foreach($send_messages_tab as $email){
                        if($email == $selected_compte['email']){
                            return 1;
                        }
                    }
                    return 0;
                }
                else{
                    return 0;
                }
            }

            $ship = $tab[$_SESSION['index']]['ship'];
            $seul = 1;
            foreach($tab as $key => $compte){
                if((($compte['ship'] == $ship && $compte['banni'] == 0) && ($key != $_SESSION['index'] && $compte['ship'] != "0")) || (ifseen($compte,$send_messages_tab,$n))){
                    $seul = 0;
                    echo "<tr onclick='redirect(\"$key\")'>";
                    echo "<td class='border'>" . "<img class='img' src='../icones/" . $compte['photo'] ."'>" . "</td>";
                    echo "<td class='text'>" . $compte['pseudo'] . "</td>";
                    echo "<td class='text'>" . $compte['genre'] . "</td>";
                    echo "<td class='text'>" . $compte['age'] . " ans</td>";
                    echo "<td class='text'>" . $compte['pays'] . "</td>";
                    echo "<td class='text'>" . $compte['grade'] . "</td>";
                    echo "<td class='text'>" . $compte['time'] . "</td>";
                    echo "<td class='text'>" . $compte['ship'] . "</td>";
                    echo "</tr>";
                }
            }
            if($seul){
                echo "<tr><td class='text'>Il n'y a personne avec le même ship que vous (et heureusement)</td></tr>";
            }
            echo "</table>";

            $seul = 1;

            echo "<table id='table' border='solid'>";
            echo "<form action='user_list_inscrit.php' method='POST'>";
            echo "<input placeholder='Cherchez un pseudo' type='text' name='search'>";
            echo "<button type='submit'>Chercher</button>";
            echo "</form>";
            if(isset($_POST['search'])){
                foreach($tab as $key => $compte){
                    if(($compte['ship'] == $ship && $compte['banni'] == 0) && ($key != $_SESSION['index'] && $compte['pseudo'] == $_POST['search'])){
                        $seul = 0;
                        echo "<tr onclick='redirect(\"$key\")'>";
                        echo "<td class='border'>" . "<img class='img' src='../icones/" . $compte['photo'] ."'>" . "</td>";
                        echo "<td class='text'>" . $compte['pseudo'] . "</td>";
                        echo "<td class='text'>" . $compte['genre'] . "</td>";
                        echo "<td class='text'>" . $compte['age'] . " ans</td>";
                        echo "<td class='text'>" . $compte['pays'] . "</td>";
                        echo "<td class='text'>" . $compte['grade'] . "</td>";
                        echo "<td class='text'>" . $compte['time'] . "</td>";
                        echo "<td class='text'>" . $compte['ship'] . "</td>";
                        echo "</tr>";
                    }
                }
                if($seul){
                    echo "<tr><td class='text'>Personne ne correspond à ce pseudo</td></tr>";
                }         
            }

            ?>
        </table>
        <script>
            function redirect(key){
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "set_other_index.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.href = "profil.php";  
                    }
                };
                xhr.send("index=" + key);
            }
        </script>
    </body>
</html>
