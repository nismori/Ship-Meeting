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

            $seul = 1;

            foreach($tab as $key => $compte){
                if(($compte['banni'] == 0) && ($key != $_SESSION['index'])){
                    $seul = 0;
                    echo "<tr onclick='redirect(\"$key\")'>";
                    echo "<td class='border'>" . "<img class='img' src='../icones/" . $compte['photo'] . "'>" . "</td>";
                    echo "<td class='text'>" . $compte['email'] . "</td>";
                    echo "<td class='text'>" . $compte['password'] . "</td>";
                    echo "<td class='text'>" . $compte['pseudo'] . "</td>";
                    echo "<td class='text'>" . $compte['prenom'] . "</td>";
                    echo "<td class='text'>" . $compte['nom'] . "</td>";
                    echo "<td class='text'>" . $compte['genre'] . "</td>";
                    echo "<td class='text'>" . $compte['age'] . " ans</td>";
                    echo "<td class='text'>" . $compte['pays'] . "</td>";
                    echo "<td class='text'>" . $compte['grade'] . "</td>";
                    echo "<td class='text'>" . $compte['ship'] . "</td>";
                    echo "<button type='button' onclick='ban(\"$compte[email]\")'>Bannir " . $compte['email'];
                    echo "</tr>";
                }
            }
            if($seul){
                echo "<tr><td class='text'>Il n'y a personne sur le site à part vous évidemment (venez :-<)</td></tr>";
            }

            $seul = 1;

            echo "<table id='table' border='solid'>";
            echo "<form action='user_list_admin.php' method='POST'>";
            echo "<input placeholder='Cherchez un email' type='text' name='search'>";
            echo "<button type='submit'>Chercher</button>";
            echo "</form>";
            if(isset($_POST['search'])){
                foreach($tab as $key => $compte){
                    if(($compte['banni'] == 0) && ($key != $_SESSION['index'] && $compte['email'] == $_POST['search'])){
                        $seul = 0;
                        echo "<tr onclick='redirect(\"$key\")'>";
                        echo "<td class='border'>" . "<img class='img' src='../icones/" . $compte['photo'] . "'>" . "</td>";
                        echo "<td class='text'>" . $compte['email'] . "</td>";
                        echo "<td class='text'>" . $compte['password'] . "</td>";
                        echo "<td class='text'>" . $compte['pseudo'] . "</td>";
                        echo "<td class='text'>" . $compte['prenom'] . "</td>";
                        echo "<td class='text'>" . $compte['nom'] . "</td>";
                        echo "<td class='text'>" . $compte['genre'] . "</td>";
                        echo "<td class='text'>" . $compte['age'] . " ans</td>";
                        echo "<td class='text'>" . $compte['pays'] . "</td>";
                        echo "<td class='text'>" . $compte['grade'] . "</td>";
                        echo "<td class='text'>" . $compte['ship'] . "</td>";
                        echo "<button type='button' onclick='ban(\"$compte[email]\")'>Bannir " . $compte['email'];
                        echo "</tr>";
                    }
                }
                if($seul){
                    echo "<tr><td class='text'>Personne ne correspond à cette email</td></tr>";
                }         
            }
            ?>
        </table>
    </body>
</html>
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
            
            function ban(email){
                var xhr2 = new XMLHttpRequest();
                xhr2.open("POST", "set_other_index.php", true);
                xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr2.onreadystatechange = function () {
                    if (xhr2.readyState == 4 && xhr2.status == 200) {
                        window.location.href = "user_list_admin.php";  
                    }
                };
                xhr2.send("email_ban=" + email);
            }
        </script>