<?php 
session_start();
if(isset($_SESSION['other_index']))
   $_SESSION['other_index'] = -1;
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/page_accueil.css">
    <title>Page d'accueil</title>
</head>

<body>
    <header><p id="titre">Ship Meeting</p></header>
    <table>
        <tr>
            <td onclick="Accueil()">Accueil</td>
            <td onclick="Ship_avatar()">Ship-avatar</td>
            <td onclick="Ship_chat()">Ship-chat</td>
            <td onclick="Formules()">Formules d'abonnement</td>
            <td onclick="Profil()">Profil</td>
        </tr>
    </table>
    <div id="accueil">
        <p><h2 align="center">Menu Principal</h2>
            <h3 align="center">Bienvenue sur Ship Meeting, le site qui vous propose de rencontrer des personnes avec les mêmes gouts que vous.</p></h3>
        </p>
        <p>
            <h4>Présentation des différents onglets :</h4>
            1. <b>Accueil</b> : Pour vous connecter ou vous inscrire à Ship Meeting.<br>
            2. <b>Ship-avatar</b> : Pour modifier votre avatar Ship Meeting. Vous ne pouvez le faire qu'une fois par mois sauf si vous avez un abonnement payant. Il est obligatoire pour aller sur le Ship Chat.<br>
            3. <b>Ship-chat</b> : Dès que vous avez fait votre Ship Avatar, le Ship Chat vous met en relation avec une personne qui a le même Ship Avatar. Vous pourrez alors entamer une conversation avec cette personne.<br>
            4. <b>Formule d'abonnement</b> : Allez sur cette onglet pour voir les différentes offres d'abonnements et leurs avantages.<br>
            5. <b>Profil</b> : Pour accéder aux informations de votre Ship Compte et les modifier.<br>
        </p>
    </div>
</body>
<script>
    function Accueil(){
        window.location.href = "page_connexion.php";
    }
    function Ship_avatar(){
        window.location.href = "ship.php";
    }
    function Ship_chat(){
        window.location.href = "choose_user_list.php";
    }
    function Formules(){
        window.location.href = "formules.php";
    }
    function Profil(){
        window.location.href = "profil.php";
    }
</script>

</html>
