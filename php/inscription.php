<?php

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $file_path = "../data/info_formulaire.json";
    if(file_exists($file_path)){
        $json_data = file_get_contents($file_path);
        $tab = json_decode($json_data, true);
        if(empty($json_data) || !is_array($tab)){
            $tab = array();
        }
        else{
            foreach ($tab as $compte){
                if(isset($compte['email']) && $compte['email'] === $email){
                    echo "L'email est déjà enregistré. Veuillez utiliser un autre email.";
                    exit();
                }
            }
        }
    }
} 

if(isset($_POST['password'], $_POST['prenom'], $_POST['nom'], $_POST['age'], $_POST['pays'])){
    $password = $_POST['password'];
    if(isset($_POST['pseudo'])){
        $pseudo = $_POST['pseudo'];
    }
    else{
        $pseudo = 0;
    }
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $genre = $_POST['genre'];
    $age = $_POST['age'];
    $pays = $_POST['pays'];
    $file = $_FILES['photo'];

    $data_array = array(
        'email' => $email,
        'password' => $password,
        'pseudo' => $pseudo,
        'prenom' => $prenom,
        'nom' => $nom,
        'genre' => $genre,
        'age' => $age,
        'pays' => $pays,
        'grade' => "inscrit",
        'time' => 0,
        'ship' => 0,
        'description' =>"",
        'vues' => 0,
        'banni' => 0,
    );

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['photo'];
        $photo_name = $email . '.png';
        move_uploaded_file($file['tmp_name'], "../icones/$photo_name");
        $data_array['photo'] = $photo_name;
    } 
    else {
        $data_array['photo'] = "0.png";
    }

    $tab[] = $data_array;

    file_put_contents($file_path, json_encode($tab,JSON_PRETTY_PRINT));

    header("Location: connexion.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inscription.css">
    <title>Formulaire d'inscription</title>
</head>

<body>
    <div id=divdroit><a href="page_connexion.php"><img src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
    <form enctype="multipart/form-data" method="POST" action="inscription.php">
        <legend><h1>Formulaire d'inscription</h1>
            <p>Les champs marqués d'une étoiles sont obligatoires (la photo ne l'est pas)</p>
            <table>  
                <tr>
                    <td colspan="2"><input placeholder="email*" type="email" name="email" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input id="password" placeholder="password*" type="password" name="password" required></button></td>
                </tr>
                <tr>
                <td colspan="2"><input placeholder="pseudo" type="text" name="pseudo"> </td>
                </tr>
                <tr>
                    <td colspan="2"><input placeholder="prenom*" type="text" name="prenom" required> </td>
                </tr>
                <tr>
                    <td colspan="2"><input placeholder="nom*" type="text" name="nom" required></td>
                </tr>
                <tr>
                    <td colspan="2">Genre* : 
                        <input type="radio" name="genre" value="Homme" class="pointer" required><span class="pointer" onclick="Checked('Homme')">Homme</span>
                        <input type="radio" name="genre" value="Femme" class="pointer" required><span class="pointer" onclick="Checked('Femme')">Femme</span>
                        <input type="radio" name="genre" value="Autre" class="pointer" required><span class="pointer" onclick="Checked('Autre')">Autre</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input placeholder="age*" type="number" min="18" max="110" name="age" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input placeholder="pays*" name="pays" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input input id="id1" type="file" accept=".png" name="photo"></td>
                </tr>
                <tr>
                    <td><button id="inscription" type="button" onclick="Connect()">Se connecter ?</button></td>
                    <td><button id="inscription" type="submit">S'inscrire</button></td>
                </tr>
            </table>
        </legend>
    </form>
    <script>
        function Accueil(){
            window.location.href = "../page_connexion.php";
        }
        function Connect(){
            window.location.href = "connexion.php";
        }
        function Checked(valeur){
            var radio = document.getElementsByName('genre');
            for(var i=0; i < radio.length ; i++){
                if(radio[i].value == valeur){
                    radio[i].checked = true;
                    break;
                }
            }
        }
        function Password() {
            password = document.getElementById("password");
            if (password.type === "password")
                password.type = "text";
            else
                password.type = "password";
        }
    </script>
</body>
</html>