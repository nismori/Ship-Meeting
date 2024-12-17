<?php 
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/page_connexion.css">
    <title>Page de connexion</title>
</head>

<body>
    <header><p id="titre">Ship Meeting</p></header>
    <table>
        <tr>
            <td onclick="Connect()">Connexion</td>
            <td onclick="SignIn()">S'inscrire</td>
        </tr>
    </table>
    <div id="accueil">
        <p><h2 align="center">Bienvenue sur Ship-Meeting</h2>
            <h3 align="center">Veuillez vous connectez ou vous s'inscrire pour continuer</p></h3>
        </p>
    </div>
</body>
<script>
    function Connect()
    {
        window.location.href = "connexion.php";
    }
    function SignIn()
    {
        window.location.href = "inscription.php";
    }
</script>

</html>