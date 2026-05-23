<?php

require "fonctions_BDD.php";
// ****** ACCES AUX DONNEES ******
$bdd = connexionBDD();

// Envoi des requêtes pour récupérer les tables/association
$reponse = "SELECT id_banniere, version_sortie, nom_banniere FROM banniere";
$reponse2 = "SELECT id_personnage, nom, type, voie, rarete FROM personnage";
$reponse3 = "SELECT id_appartenir, id_banniere, id_personnage, rarete FROM appartenir";

// Stockage sous forme de tableaux
$tableBanniere = lectureBDD($reponse);
$tablePersonnage = lectureBDD($reponse2);
$associationAppartenir = lectureBDD($reponse3);

if (isset($_POST["click"])) {
    $click = $_POST["click"];
} elseif (isset($_POST["tirage"])) {
    $click = $_POST["tirage"];
} else {
    $click = 0; //état initiale si rien set
}

///////////////////////////////////// Récupérration des donners de la bannière ////////////////////////////////////////////////////
$titre = $tableBanniere[$click]["nom_banniere"]; //titre de la bannière
$version = $tableBanniere[$click]['id_banniere']; //prend la version initiale

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse4 = "SELECT id_personnage,rarete FROM appartenir WHERE id_banniere = '$version'";
$personnage = lectureBDD($reponse4); //liste des personnages de la bannière
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 1) Stocker les id des perso 4*
$reponse5 = "SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=4";
$personnage_4 = lectureBDD($reponse5); //liste des personnages 4* de la bannière

$nom_id_4 = array();
foreach ($personnage_4 as $key => $value) {
    $nom_id_4[] = $value; //Liste des id(association appartenir)
}
;

// 2) convertion des id en noms
$nom_str_4 = array();
foreach ($nom_id_4 as $key => $value) {
    $id = $value['id_personnage'];

    $reponseAux = "SELECT nom FROM personnage WHERE id_personnage = '$id'";
    $auxiliaire = lectureBDD($reponseAux);
    $nom_str_4[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 4*
}
;

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 1) Stocker les id des perso 5*
$reponse6 = "SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=5";
$personnage_5 = lectureBDD($reponse6); //liste des personnages 5* de la bannière

$nom_id_5 = array();
foreach ($personnage_5 as $key => $value) {
    $nom_id_5[] = $value; //Liste des id(association appartenir)
}
;

// 2) convertion des id en noms
$nom_str_5 = array();
foreach ($nom_id_5 as $key => $value) {
    $id = $value['id_personnage'];

    $reponseAux = "SELECT nom FROM personnage WHERE id_personnage = '$id'";
    $auxiliaire = lectureBDD($reponseAux);
    $nom_str_5[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 5*
}
;

// TRAITEMENT DU FORMULAIRE
// Initialisation des variables du select
if (!empty($_POST["altNom"]))
    $altNom = $_POST["altNom"];
else
    $altNom = $nom_str_5[count($nom_str_5) - 1];

$nb_ecriture = 0 ;

if (isset($_POST["tirage"])) {
    // création d'une variable avec un nombre aléatoire sur 100
    $proba = random_int(1, 100);

    // condition pour avoir un perso 5* (15%)
    if ($proba <= 15) {
        $tirage = "SELECT id_personnage FROM personnage WHERE nom = '$altNom'";
        $lectureTirage = lectureBDD($tirage);
        $id_personnage = $lectureTirage[0]["id_personnage"];
    } else
    {   
        // prend un perso 4* aléatoir parmis ceux dans $nom_str_4
        $proba2 = random_int(0,count($nom_str_4)-1);

        $tirage = "SELECT id_personnage FROM personnage WHERE nom = '$nom_str_4[$proba2]'";
        $lectureTirage = lectureBDD($tirage);
        $id_personnage = $lectureTirage[0]["id_personnage"];
    }

    // var_dump($nom_str_4);
    //  var_dump($tirage);
    // var_dump($lectureTirage[0]["id_personnage"]);

    // Requête SQL
    $insert = "INSERT INTO obtention (id_personnage, id_banniere)
       VALUES ('$id_personnage', '$version')";

    // echo $insert;


    $nb_ecriture = ecritureBDD($insert);
    if ($nb_ecriture == 1){

        $resultat = 'SELECT * FROM obtention ORDER BY id_obtention DESC LIMIT 1';
        $affichage = lectureBDD($resultat);
    }
    elseif ($nb_ecriture == 10){
         $resultat = 'SELECT * FROM obtention ORDER BY id_obtention DESC LIMIT 10';
        $affichage = lectureBDD($resultat);
    }
    else
        $erreur = "Echec lors de l'enregistrement du personnage $nom_str_4[$proba2]";

    // var_dump($affichage);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honkai: Star Rail</title>
    <link rel="shortcut icon" href="img/Item_Eidolon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/warp.css">
</head>

<body>

    <!-- HEADER -->

    <header>
        <a href="index.html" class="btnAccueil">
            <img src="img/Logo.png" alt="">
        </a>

        <div class="iconFlex"> <!--//commentaire ajouter si je veux remettre l'animation icones -->
            <div class="icon <!--translate-->">
                <img src="img/icones/event.png" alt="">
            </div>
            <div class="icon <!--translate-->">
                <img src="img/icones/gacha.png" alt="">
            </div>
            <div class="icon <!--translate-->">
                <img src="img/icones/adventure.png" alt="">
            </div>
            <div class="icon <!--translate-->">
                <img src="img/icones/team.png" alt="">
            </div>
            <div class="icon <!--translate-->">
                <img src="img/icones/profil.png" alt="">
            </div>

        </div>
    </header>

    <div id="monnaieMargin">
        <section id="monnaieFlex">
            <div class="monnaie">
                <img src="img/icones/Item_Special_Pass.webp" alt="">
                7
            </div>

            <div class="monnaie">
                <img src="img/icones/Item_Stellar_Jade.webp" alt="">
                7226
            </div>
        </section>
    </div>

    <form id="barVersion" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="containerVersionRelative">
            <?php foreach ($tableBanniere as $key => $value) {
                $id_banniere = $value["id_banniere"];

                // Récupérer le dernier perso 5* de la bannière
                $requete = "
                SELECT p.nom FROM appartenir AS a
                INNER JOIN personnage AS p ON p.id_personnage = a.id_personnage
                WHERE a.id_banniere = '$id_banniere' AND a.rarete = 5
                ORDER BY a.id_personnage DESC
                LIMIT 1 ";

                $result = lectureBDD($requete);
                $nom_5 = $result[0]['nom'];

                echo "<button type='submit' name='click' value='" . ($id_banniere - 1) . "' class='version' ";
                echo "style=\"background-image:url('img/splash/Character_" . str_replace(" ", "_", $nom_5) . "_Splash_Art.webp')\">";
                echo $value['version_sortie'];
                echo "</button>";
            }
            ?>
        </div>
    </form>

    <main class="animation">

        <section class="container">

            <section class="content">
                <div class="etiquette">
                    <?php echo $version; ?>
                </div>

                <h2 id="titreBanniere">
                    <?php echo $titre; ?>
                </h2>

                <div class="sidePersoFlex">
                    <?php foreach ($nom_str_4 as $key => $value) {
                        $sideCharacter = "<div class='sidePerso'";
                        $sideCharacter .= 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $value) . '_Splash_Art.webp\')">';
                        $sideCharacter .= "</div>";
                        echo $sideCharacter;
                    }
                    ; ?>
                </div>

            </section>


            <!-- section image du perso principale de l'event -->
            <section class="mainPerso" <?php
            echo 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $nom_str_5[count($nom_str_5) - 1]) . '_Splash_Art.webp\')"';
            // prend le dernier dans le tableau
            ?>>

                <!-- str_replace pour formater le nom dans l'entité banniere au fichier -->
            </section>
        </section>

        <form class="btnFlex" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <!-- éviter de mettre un autre form sinon trop galère -->

            <button class="btn" name="tirage" value=<?php
            if (isset($_POST['click']))
                echo $_POST['click'];
            else
                echo 0;
            ?>>
                <img src="img/btn.apng" alt="">
                <img src="img/frameBtn.webp" alt="">
                <div><b>x1 Tirage</b></div>
            </button>


            <!-- Affichage d'un select si plusieurs perso 5* -->

            <?php if (count($nom_str_5) > 1) {
                echo '<select name="altNom" action="<?= $_SERVER[\'PHP_SELF\'] ?>" method="post">';

                foreach ($nom_str_5 as $key => $value) {
                    if ($key == (count($nom_str_5) - 1)) // si c'est le dernier dans la liste
                        echo "<option value='$value' selected>$value</option>";
                    else
                        echo "<option value='$value'>$value</option>";
                }

                echo "</select>";
            }
            ?>

            <button class="btn">
                <img src="img/btn.apng" alt="">
                <img src="img/frameBtn.webp" alt="">
                <div><b>x10 Tirage</b></div>
            </button>
        </form>
    </main>

    <!-- MENU OUVRANT FIXED -->

    <section class="out active"></section> <!-- zone noir pour fermer le menu -->
    
    <section id="menu">
        <!-- Bouton + Navigation -->
        <div id="relative"> <!-- attention y'a 2 relative /class -->
            <section id="btnMenu">
                <img src="img/icones/menu.png" alt="">
            </section>
            <section id="lieu">
                <li>
                    <div>Warp</div>
                </li>
            </section>
        </div>
        <!-- CONTENU -->
        <div class="phoneFlex">
            <div id="UID">UID 700499164</div>
            <div>Insert Icones</div>
        </div>

        <div class="phoneFlex align">
            <div class="phoneFlex align">
                <div class="profil"><img src="img/profils/Profile_Picture_Stelle.webp" alt=""></div>
                <div>
                    <div>Yukari</div>
                    <div class="color">Niveau d'équilibre 6 !</div>
                </div>
            </div>
            <div class="phoneOption">...</div>
        </div>

        <div class="description">
            May the world remain colorful!
        </div>

        <div class="phoneFlex">
            <div class="color">Niveau de pionier 70</div>
            <div>Niveau Max</div>
        </div>

        <div class="levelBar"></div>

        <div class="grid">
            <div><img src="img/icones/Icon_Store.webp" alt="">
                <div>Boutique</div>
            </div>
            <div><img src="img/icones/Icon_Assignment_Additional_Rewards_Completed.webp" alt="">Amis</div>
            <div><img src="img/icones/Icon_Assignments.webp" alt="">Affectations</div>
            <div><img src="img/icones/Icon_Travel_Log.webp" alt="">
                <div>Carnet de voyage</div>
            </div>
            <div><img src="img/icones/Icon_Synthesis.webp" alt="">Synthèse</div>
            <div><img src="img/icones/Icon_Store.webp" alt="">Succès</div>
            <div><img src="img/icones/Icon_Store.webp" alt="">Messages<br></div>
            <div class="smallFont"><img src="img/icones/Icon_Nameless_Honor.webp" alt="">Honneur <br> Sans Noms</div>
            <div class="case"><img src="img/icones/Icon_Warp.webp" alt="">Saut hyperespace</div>
            <div><img src="img/icones/profil.png" alt="">Personnages<br></div>
            <div><img src="img/icones/Icon_Store.webp" alt="">Guide interastral</div>
            <div><img src="img/icones/Icon_Store.webp" alt="">Mode multijoueur</div>
            <div><img src="img/icones/Icon_Navigation.webp" alt="">Navigation</div>
            <div><img src="img/icones/Icon_Tutorials.webp" alt="">Tutoriels</div>
        </div>
    </section>

    <!-- INTRO RETIRER -->
    <!-- <div class="relative"> 
        <section id="intro">
            <img id="logo" src="img/Logo.png" alt="Logo" draggable="false">
        </section>
    </div> -->

    <!-- PARTIE TIRAGE -->
    <?php
    if ($nb_ecriture > 0){
        $obtention = "<section class='resultat'>";

        if ($nb_ecriture == 1){

            // Récupérer l'id du personnage tiré
            $idPerso = $affichage[0]['id_personnage'];

            // Construire et exécuter la requête SQL
            $affichagePersoSQL = "SELECT nom FROM personnage WHERE id_personnage = $idPerso";
            $affichagePersoTableau = lectureBDD($affichagePersoSQL);

            // Récupérer le nom
            $nomPerso = $affichagePersoTableau[0]['nom'];

            // Construire l'affichage
            $sideCharacter  = "<div class='sidePerso' ";
            $sideCharacter .= 'style="background-image:url(\'img/splash/Character_' 
                            . str_replace(" ", "_", $nomPerso) 
                            . '_Splash_Art.webp\')">';
            $sideCharacter .= "</div>";

            $obtention .= $sideCharacter;
        }

        if ($nb_ecriture == 10){
            
            // Récupérer l'id du personnage tiré
            $idPerso = $affichage[0]['id_personnage'];

            // Construire et exécuter la requête SQL
            $affichagePersoSQL = "SELECT nom FROM personnage WHERE id_personnage = $idPerso";
            $affichagePersoTableau = lectureBDD($affichagePersoSQL);

            // Récupérer le nom
            $nomPerso = $affichagePersoTableau[0]['nom'];

            // Construire l'affichage
            $sideCharacter  = "<div class='sidePerso' ";
            $sideCharacter .= 'style="background-image:url(\'img/splash/Character_' 
                            . str_replace(" ", "_", $nomPerso) 
                            . '_Splash_Art.webp\')">';
            $sideCharacter .= "</div>";

            $obtention .= $sideCharacter;
        }

        $obtention .= "</section>";
        echo $obtention;
    }

    ?>
    <script src="js/warp.js"></script>
</body>

</html>