<?php
session_start();

if(!isset($_SESSION['index'])){
    header('Location: page_connexion.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/page_accueil.css">
    <title>Formules</title>
</head>
    </head>
    <body>
    
        <div id=divdroit><a href="page_accueil.php"> <img src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
        <header><p id="titre">Formules</p></header>
        <table width=30% align="center" id=table>
            <tr>
                <td height=100px bgcolor="blue" onclick="abonné()">Formule abonné/e</td>
                <td height=100px bgcolor="yellow" onclick="admin()">Formule admin</td>
            </tr>
        </table>
        <h4>Présentation des formules :</h4>
            1. <b>abonné/e</b> : Cette formule vous permet de voir le nombre de personnes qui ont regardé votre compte ainsi que de pouvoir écrire avec d'autres personnes pour une durée limité.<br>
            2. <b>admin</b> : Cette formule vous donne accès à la liste complète des utilisateurs ainsi que de pouvoir regarder toutes leurs informations (sauf pour leur mot de passe) et de bannir un utilisateur, en plus des avantages des abonnés.<br>
    </body>
</html>

<script type="text/javascript">
    function abonné(){
        document.location.href="abonnement.php";
    }
    function admin()
    {
        document.location.href="admin.php";
    }
</script>

</html>