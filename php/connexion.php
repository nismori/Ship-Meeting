<?php
session_start();

$file_path = "../data/info_formulaire.json";
if(file_exists($file_path)){
    $json_data = file_get_contents($file_path);
    $tab = json_decode($json_data, true);
    if(empty($json_data) || !is_array($tab)){
        echo "Vous n'avez pas créer un compte sur Ship-Meeting";
        exit();
    }
}
if(isset($_POST['email'], $_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    foreach($tab as $index => $compte){
        if(isset($compte['email']) && (isset($compte['password']))){
            if($compte['email'] == $email && $compte['password'] == $password){
                if($compte['banni']){
                    echo "Tu es ban!!";
                    exit();
                }   
                $_SESSION['index'] = $index;
                header("Location: page_accueil.php");
                exit();
            }
        }
    }
    echo "Votre email ou mot de passe est incorrect ou vous n'avez pas créer de compte chez Ship-Meeting. Veuillez réessayer de vous connecter ou inscrivez vous.";
}

?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connexion.css">
    <title>Formulaire de connexion</title>
</head>

<body>
    <form method="POST" action="../php/connexion.php"><div id=divdroit><a href="page_connexion.php"><img src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
        <legend><h1>Formulaire de connexion</h1>
            <table>  
                <tr>
                    <td colspan="2"><input placeholder="email" name="email" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input placeholder="password" type="password" name="password" required></td>
                </tr>
                <tr>
                    <td><button id="inscription" type="button" onclick="SignIn()">S'inscrire ?</button></td>
                    <td><button id="inscription" type="submit">Se connecter</button></td>
                </tr>
            </table>
        </legend>
    </form>
    <script>
        function Accueil(){
            window.location.href = "page_connexion.php";
        }
        function SignIn(){
            window.location.href = "inscription.php";
        }
    </script>
</body>
</html>