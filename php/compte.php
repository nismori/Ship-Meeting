<?php 
session_start();
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

$index = $_SESSION['index'];
if(isset($_POST['email'], $_POST['password'], $_POST['prenom'], $_POST['nom'], $_POST['age'], $_POST['pays'])){
    if(!($tab[$index]['email'] == $_POST['email'])){
        foreach ($tab as $compte){
            if($compte['email'] == $_POST['email']){ 
                echo "Il existe déjà un compte avec cet email. Veuillez essayez un autre email.";
                exit();
            }
        }
    }

    $tab[$index]['password'] = $_POST['password'];
    if(isset($_POST['pseudo']))
        $tab[$index]['pseudo'] = $_POST['pseudo'];
    else
        $tab[$index]['pseudo'] = "";
    $tab[$index]['prenom'] = $_POST['prenom'];
    $tab[$index]['nom'] = $_POST['nom'];
    $tab[$index]['age'] = $_POST['age'];
    $tab[$index]['pays'] = $_POST['pays'];
    $tab[$index]['description'] = $_POST['description'];

    $old_photo = $tab[$index]['photo'];
    $tab[$index]['email'] = $_POST['email'];
    $email = $_POST['email'];
    if($tab[$index]['photo'] != "0.png")
        rename("../icones/$old_photo","../icones/$email.png");

    if(isset($_FILES['photo'])){
        $file = $_FILES['photo'];
        move_uploaded_file($file['tmp_name'], "../icones/$email.png");
        if(file_exists("../icones/$email.png"))
            $tab[$index]['photo'] = "$email.png";
    }

    file_put_contents($file_path, json_encode($tab,JSON_PRETTY_PRINT));
    header("Location: compte.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/compte.css">
    <title>Compte</title>
</head>

<body>
    <div id=divdroit><a href="page_accueil.php"> <img id="home_icon" src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="" ></a></div>
    <div id="titre">Votre Compte</div>
    <div id="img" onclick="Image()"><img src="../icones/<?php echo $tab[$index]['photo'];?>"></div>
    <form action="compte.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><input id="text" placeholder="email" name="email" type="email" value="<?php echo $tab[$index]['email'];?>" required></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="password" name="password" type="text" value="<?php echo $tab[$index]['password'];?>" required></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="pseudo" name="pseudo" type="text" value="<?php echo $tab[$index]['pseudo'];?>"></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="prenom" name="prenom" type="text" value="<?php echo $tab[$index]['prenom'];?>" required></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="nom" name="nom" type="text" value="<?php echo $tab[$index]['nom'];?>" required></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="age" name="age" min="18" max="110" type="number" value="<?php echo $tab[$index]['age'];?>" required></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="pays" name="pays" type="text" value="<?php echo $tab[$index]['pays'];?>" required></input></td>
            </tr>
            <tr>
                <td><input id="text" placeholder="description" type="textarea" name="description" value="<?php echo $tab[$index]['description'];?>"></td>
            </tr>
                <td><button id="compte" type="submit">Valider les modifications</button></td>
            </tr>
        <input id="file" name="photo" type="file" accept=".png"> 
        </table>
    </form>
</body>

<script>
    function Accueil(){
        window.location.href = "../php/page_accueil.php";
    }
    function Image() {
        const fileInput = document.getElementById('file');
        fileInput.click();
    }
    document.getElementById('file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.getElementById('img').querySelector('img');
                imgElement.src = e.target.result;
            }    
            reader.readAsDataURL(file);
        }
    });
</script>