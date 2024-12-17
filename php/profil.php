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
        echo "Erreur critique";
        exit();
    }
}
else{
    echo "Erreur Critique";
    exit();
}


if((isset($_SESSION['other_index'])) && ($_SESSION['other_index'] != -1)){
    $index = $_SESSION['other_index'];
}
else{
    $index = $_SESSION['index'];
}


$email = $tab[$index]["email"];
$grade = $tab[$index]["grade"];
$pseudo = $tab[$index]["pseudo"];
$nom = $tab[$index]["nom"];
$prenom = $tab[$index]["prenom"];
$description = $tab[$index]["description"];
$age = $tab[$index]["age"];
$genre = $tab[$index]["genre"];
$password = $tab[$index]["password"];
$vues = $tab[$index]["vues"];
$pays = $tab[$index]["pays"];
$ship = $tab[$index]["ship"];
$photo = $tab[$index]['photo'];
if((isset($_SESSION['other_index'])) && ($index == $_SESSION['other_index'])){
    $password2 = "";
    for($i=0;$i<strlen($password);$i++){
        $password2 = $password2 . "*";
    }
    $password = $password2;
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/all.css">
</head>
    <div id=divdroit><a href="page_accueil.php"> <img src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
    <?php if($index == $_SESSION['index'])
        echo "<div id=divdroit><a href='compte.php'><img src='../images/pencil.png' width='40px' alt='' ></a></div>"
    ?>
    <?php if((isset($_SESSION['other_index'])) && ($index == $_SESSION['other_index']))
    echo "<div id=divdroit><a href='chat.php'><img src='../images/messages.png' width='40px' alt='' ></a></div>"
    ?>
    <div class="divtab">
        <table width="90%" height="90%" align="center" margin-top="auto">
            <tr colspan="3">
                <center><h1>Profil</h1></center>
            </tr>
            <tr height="200">
                <td rowspan="6" id="fond">
                    <vertical-align>
                        <center>
                            <img src="../icones/<?echo $photo;?>" alt="" class="profil"> <br>
                            <h2><FONT color="white"><?php echo  "pseudo: $pseudo"?></FONT></h2>
                        </center>
                    </vertical-align>
                </td>
                <td colspan="2" rowspan="2">
                    <center>description: </center> <br>
                    <center><?php echo "$description" ?></center>
                </td>
            </tr>
            <tr></tr>
            <tr height="110">
                <td> <?php if($index == $_SESSION['index'])echo "Prénom: $prenom"?></td>                           <!-- seulement pour le propritétaire du compte--> 
                <td> <?php if($index == $_SESSION['index'])echo "Nom: $nom"?></td>                              <!-- seulement pour le propritétaire du compte--> 
                
            </tr>
            <tr>
                <td> <?php if($index == $_SESSION['index'])echo "mot de passe: $password" ?></td>    <!-- seulement pour le propritétaire du compte--> 
                <td> <?php if($index == $_SESSION['index'])echo "Mail: $email" ?></td>            <!-- seulement pour le propritétaire du compte--> 
            </tr>
            <tr height="110">
                <td> <?php echo "sexe: $genre" ?></td>
                <td> <?php echo "age: $age" ?></td>                        <!-- seulement pour le propritétaire du compte--> 
            </tr>
            <tr height="110">
                <td> <?php echo "Pays: $pays" ?></td>                  <!-- seulement pour le propritétaire du compte-->
                <td> <?php echo "ship: $ship" ?></td> 
            </tr>
        </table>
    </div>
        <div id="divdroit">
        <?php 
        echo "$vues"; 
        if((isset($_SESSION['other_index'])) && ($index == $_SESSION['other_index'])){
            $vues++;  
            $tab[$index]["vues" ] = $vues;
            file_put_contents($file_path, json_encode($tab,JSON_PRETTY_PRINT));
        }
        ?>       
        <img src="https://previews.123rf.com/images/yupiramos/yupiramos1702/yupiramos170203297/70844218-signe-humain-oeil-isol%C3%A9-ic%C3%B4ne-dessin-vectoriel.jpg" alt=""width="40px">
        </div>

</html>
