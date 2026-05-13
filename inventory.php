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


if (empty($_POST["click"])){
  ///////////////////////////////////// Récupérration des donners de la bannière ////////////////////////////////////////////////////
  $titre = $tableBanniere[0]["nom_banniere"]; //titre de la bannière
  $version = $tableBanniere[0]['id_banniere']; //prend la version initiale
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $reponse4 = "SELECT id_personnage,rarete FROM appartenir WHERE id_banniere = '$version'";
  $personnage = lectureBDD($reponse4); //liste des personnages de la bannière
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 4*
  $reponse5 = "SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=4";
  $personnage_4 = lectureBDD($reponse5); //liste des personnages 4* de la bannière
  
  $nom_id_4 = array();
  foreach($personnage_4 as $key => $value) {
    $nom_id_4[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_4 = array();
  foreach($nom_id_4 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = "SELECT nom FROM personnage WHERE id_personnage = '$id'";
    $auxiliaire = lectureBDD($reponseAux);
    $nom_str_4[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 4*
  };

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 5*
  $reponse6 = "SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=5";
  $personnage_5 = lectureBDD($reponse6); //liste des personnages 5* de la bannière
  
  $nom_id_5 = array();
  foreach($personnage_5 as $key => $value) {
    $nom_id_5[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_5 = array();
  foreach($nom_id_5 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = "SELECT nom FROM personnage WHERE id_personnage = '$id'";
    $auxiliaire = lectureBDD($reponseAux);
    $nom_str_5[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 5*
  };
}

else{
  ///////////////////////////////////// Récupérration des donners de la bannière ////////////////////////////////////////////////////
  $titre = $tableBanniere[$_POST["click"]]["nom_banniere"]; //titre de la bannière
  $version = $tableBanniere[$_POST["click"]]['id_banniere']; //prend la version actuelle
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $reponse4 = "SELECT id_personnage,rarete FROM appartenir WHERE id_banniere = '$version'";
  $personnage = lectureBDD($reponse4); //liste des personnages de la bannière
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 4*
  $reponse5 = "SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=4";
  $personnage_4 = lectureBDD($reponse5); //liste des personnages 4* de la bannière
  
  $nom_id_4 = array();
  foreach($personnage_4 as $key => $value) {
    $nom_id_4[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_4 = array();
  foreach($nom_id_4 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = "SELECT nom FROM personnage WHERE id_personnage = '$id'";
    $auxiliaire = lectureBDD($reponseAux);
    $nom_str_4[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 4*
  };

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 5*
  $reponse6 = "SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=5";
  $personnage_5 = lectureBDD($reponse6); //liste des personnages 5* de la bannière
  
  $nom_id_5 = array();
  foreach($personnage_5 as $key => $value) {
    $nom_id_5[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_5 = array();
  foreach($nom_id_5 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = "SELECT nom FROM personnage WHERE id_personnage = '$id'";
    $auxiliaire = lectureBDD($reponseAux);
    $nom_str_5[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 5*
  };
}

// TRAITEMENT DU FORMULAIRE
// Initialisation des variables du select
if(!empty($_POST["altNom"]))
    $altNom = $_POST["altNom"];
else
    $altNom = $nom_str_5[count($nom_str_5)-1];

if (isset($_POST["tirage"])){
     // Récupération de l'id du personnage
     $tirage = "SELECT id_personnage FROM personnage WHERE nom = '$altNom'";
     $lectureTirage = lectureBDD($tirage);
     $id_personnage = $lectureTirage[0]["id_personnage"];

    //  var_dump($tirage);
    //  var_dump($lectureTirage[0]["id_personnage"]);

     // Requête SQL
    $insert = "INSERT INTO obtention (id_personnage, id_banniere)
       VALUES ('$id_personnage', '$version')";  
        
    // echo $insert;

    $nb_ecriture = ecritureBDD($insert);
      if ($nb_ecriture == 1)
        $resultat = "Article <span class='code'>test</span> enregistré dans la base de données";
      else
        $erreur = "Echec lors de l'enregistrement de l'article";

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honkai: Star Rail</title>
    <link rel="shortcut icon" href="img/Item_Eidolon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/inventory.css">
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
            <a class="icon <!--translate-->" href="warp.php">
                <img src="img/icones/gacha.png" alt="">
            </a>
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

    <main>
    <div class="classification">
            <img class="type" src="img/icones/Path_Destruction.webp" alt="">
            <img class="type" src="img/icones/Path_The_Hunt.webp" alt="">
            <img class="type" src="img/icones/Path_Erudition.webp" alt="">
            <img class="type" src="img/icones/Path_Harmony.webp" alt="">
            <img class="type" src="img/icones/Path_Nihility.webp" alt="">
            <img class="type" src="img/icones/Path_Preservation.webp" alt="">
            <img class="type" src="img/icones/Path_Abundance.webp" alt="">
            <img class="type" src="img/icones/Path_Remembrance.webp" alt="">
            <img class="type" src="img/icones/Path_Elation.webp" alt="">
        </div>
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
                    <div>inventory</div>
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

    <!-- PARTIE TIRAGE ANIMATION -->

    <section class="screenPull hidden">
            <div class="gate1"></div>
            <div class="gate2"></div>
    </section>

    <script src="js/warp.js"></script>
</body>

</html>