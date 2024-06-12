<?php
session_start();

if(!isset($_SESSION['index'])){
    header('Location: page_connexion.php');
    exit();
}

$file_path = "../data/info_formulaire.json";
$file_path2 = "../data/send_messages.json";

if(file_exists($file_path)){
    $json_data = file_get_contents($file_path);
    $tab = json_decode($json_data, true);
    if(empty($json_data) || !is_array($tab)){
        echo "Erreur Critique";
        exit();
    }
}
else{
    echo "Erreur Critique";
    exit();
}

$index = $_SESSION['index'];

if((isset($_POST['ship'])) && (!empty($_POST['ship']))){
    $tab[$index]['ship'] = $_POST['ship'];
    file_put_contents($file_path, json_encode($tab,JSON_PRETTY_PRINT));
    header("Location: page_accueil.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <body>
        <div id="divdroit"><a href="page_accueil.php"><img weight=50px id="home_icon" src="https://www.educol.net/coloriage-maison-dl28263.jpg" width="40px" alt="Home"></a></div>
        <center>
            <table width="75%" id="Mytab">
                <tr>
                    <center>
                        <th colspan="4"> <big>Veuillez choisir un ship</big> </th>
                    </center>
                </tr>
                <tr>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/736x/7e/ce/c4/7ecec434137d1fcbe023db38e06c1260.jpg" alt="" name="Eren" class="normal"></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://www.manga-news.com/public/images/pix/perso/3645/mikasa-ackerman-charcater-anime.jpg" alt="" name="Mikasa" class="normal"></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://cdn.staticneo.com/w/attackontitan/SashaBlouse.jpg" alt="" name="Sasha" class="normal"></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://pm1.aminoapps.com/7099/6c02b10d239105399fe31a4360a937a62f0ef093r1-416-496v2_00.jpg" alt="" name="Erwin" class="normal"></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/736x/69/8f/df/698fdf0baeabe2c719b644fa93b64e1e.jpg" alt="" name="Dazai" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://static.zerochan.net/Yosano.Akiko.full.1950761.jpg" alt="" name="Yosano" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://s1.zerochan.net/Ozaki.Kouyou.%28Bungou.Stray.Dogs%29.600.4088602.jpg" alt="" name="Ozaki" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/736x/31/a8/d1/31a8d1d71beccb856890597df318943d.jpg" alt="" name="Nakahara" ></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/originals/38/f4/e3/38f4e36c60404da85ba3669708156094.jpg" alt="" name="Luffy" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://ih1.redbubble.net/image.4035327503.5285/flat,750x,075,f-pad,750x1000,f8f8f8.jpg" alt="" name="Robin" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://s1.zerochan.net/Nami.600.3731416.jpg" alt="" name="Nami" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/originals/35/d7/c1/35d7c1bb21acdf636c378269d92de7a0.jpg" alt="" name="Zoro" ></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/736x/62/86/a4/6286a4d55cade4feaae4320a896bb751.jpg" alt="" name="Saitama" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://i.pinimg.com/564x/9b/9e/59/9b9e59360c9f5173e987ed074f8e19f2.jpg" alt="" name="Tatsumaki" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://i.redd.it/58hh1h4padia1.jpg" alt="" name="Suiko" ></center>
                    </td>
                    <td>
                        <center><img width=100px src="https://static.zerochan.net/Genos.full.1431114.jpg" alt="" name="Genos" ></center>
                    </td>
                </tr>
            </table>
            <form action="ship.php" method = "POST">
                <input type="hidden" name="ship" id="ship" value="">
                <button type="submit" id="button" name="ship1" value="" onmouseover=""> envoyer</button>
            </form>
    </center>
</html>
        
<script type="text/javascript">
    var nom1; var nom2; var ship;
    const tab = document.getElementById("Mytab");
    tab.addEventListener("click", function (e) {
    /** @type {HTMLElement} */ const image = e.target; //séléctioner l'image d'une cellule
        const nom = image.getAttribute("name");
        console.log(nom);
        if (nom == null) {
            return;
        }
        if (nom1 != null) {
            if (nom1 != nom) {
                if (nom2 != null) {
                    if (nom2 != nom) {
                        alert("Le ship possède déjà tous ses personnages, veuillez remodifier le ship ou l'enregistrer!")
                    }
                    else {
                        image.parentElement.style.backgroundColor = "white";    //la cellule où se trouve l'image change son background color
                        nom2 = null;
                    }
                }
                else {
                    nom2 = nom;
                    image.parentElement.style.backgroundColor = "lightblue";
                }
            }
            else {
                image.parentElement.style.backgroundColor = "white";
                nom1 = null;
            }
        }
        else {
            image.parentElement.style.backgroundColor = "lightblue";
            nom1 = nom;
        }
    
        if(nom1 == nom2){
            nom2 = null;
        }

    if(nom1!=null && nom2!=null){
        var x;
        if(nom1>nom2){  //remettre les personnages dans l'ordre alphabétique pour rendre le php plus simple par la suite
            x=nom1;
            nom1=nom2;
            nom2=x;
        }
        ship=nom1+"x"+nom2;
    };

    if(nom1!=null && nom2!=null && nom1 != nom2){
            document.getElementById('ship').value=ship;             //activer/désactiver le bouton en fonction de si on a assez de données
            document.getElementById('button').style.visibility="visible";
        }
        else{
            document.getElementById('ship').value="";
            document.getElementById('button').style.visibility="hidden";
        }
    })

    document.getElementById('ship').value="";
    document.getElementById('button').style.visibility="hidden";
</script>