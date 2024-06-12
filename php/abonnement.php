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
?>

<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/abonnement.css">
    <title>Abonnement</title>
    </head>
    <body>
        <div id=divdroit><a href="page_accueil.php"> <img src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
        <div id="table">
        <center> 
        <header><p id="titre">abonnement</p></header>
            <table>
                <tr height=20px>
                    il semblerait que vous souhaitez devenir abonné sur ce site. <br>
                    Veuillez mettre les informations suivantes: <br>
                </tr>
                <tr height=50px>
                    <td>
                        <center>
                            votre numéro de carte de crédit:  <br>
                            <textarea name="" id=""></textarea>
                        </center>
                    </td>
                </tr>
                <tr height=50px>
                    <td>
                        <center>
                            votre numéro de téléphone: <br>
                            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                        </center>
                    </td>        
                </tr>
                <tr>
                    <td>
                        <center>
                            <button onclick="abonné()">activer l'abonnement</button>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        </div>
    </body>
</html>
<script>
    function abonné(){
        document.location.href="abonné.php"
    }
</script>