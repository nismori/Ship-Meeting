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
    <link rel="stylesheet" href="../css/page_accueil.css">
    <title>Admin</title>
    </head>
    <body>
        <div id=divdroit><a href="page_accueil.php"> <img src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
        <div id="table">
            <center>
            <header><p id="titre">Admin</p></header>
                Il semblerait que vous souhaitez devenir admin sur ce site. <br>
                Veuillez trouver la solution du riddle suivant: <br>
                <br>
                -Je suis partout à la fois. <br>
                -Je suis présent depuis le big bang. <br>
                -Je suis dans le passé, le présent et le futur. <br>
                <br>
                <textarea placeholder="Qui-suis-je?" name="admin?" cols="50"></textarea><br>
                <button onclick="ajoutadmin()">activer le mode admin</button>
            </center>
        </div>
    </body>
    <script type="text/javascript">
    function ajoutadmin(){
        document.location.href="ad_admin.php";
    }
    </script>
</html>