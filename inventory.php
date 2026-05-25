<?php

    require "fonctions_BDD.php";
  
    // VIDENGE DE LA TABLE OBTENTION POR MOTEUR INNODB
  $reset = "TRUNCATE TABLE obtention";
  if (isset($_POST["reset"]))
    ecritureBDD($reset);

    // DEFINITION $OPTION DOUBLON
     if (isset($_POST["doublon"])) {
        if (in_array("double", $_POST["doublon"])) {
        $doublon = $_POST["doublon"];} 
        else {
        $doublon = array();}} 
    else {
        $doublon = array();}  


    // DEFINITION $OPTION RARETE
    if (isset($_POST["rarete"])) {
        if (in_array("4", $_POST["rarete"]) || in_array("5", $_POST["rarete"]))
            $rarete = $_POST["rarete"];
        else
            $rarete = array();
        }
    else {
        $rarete = array();}

    if (isset($_POST["alphabet"])) {
        $alphabet = $_POST["alphabet"]; // PRENDRE LA VALEUR POUR REQUËTE APRES
    } else {
        $alphabet = "ASC";} //INITIAL

// var_dump($alphabet);

//////////////////////////////////// REQUETE 1 INVENTAIRE ///////////////////////////////////////////

if (!empty($doublon)) // PAS DE DOUBLON ET RIEN COCHER
    {
        if (empty($rarete) || (in_array("4", $rarete) && in_array("5", $rarete))){
            $reponse = "SELECT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
            INNER JOIN obtention ON personnage.id_personnage = obtention.id_personnage ORDER BY nom $alphabet";
        }
        else
            {
                if (in_array("4" , $rarete)) // SI UNIQUEMENT 4*
                    $reponse = "SELECT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                INNER JOIN obtention ON personnage.id_personnage = obtention.id_personnage 
                                WHERE rarete = '4' ORDER BY nom $alphabet";
                if (in_array("5" , $rarete)) // SI UNIQUEMENT 5*
                    $reponse = "SELECT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                INNER JOIN obtention ON personnage.id_personnage = obtention.id_personnage 
                                WHERE rarete = '5' ORDER BY nom $alphabet";
            }
    }
  else
    {
    if (empty($rarete) || (in_array("4", $rarete) && in_array("5", $rarete))){
            $reponse = "SELECT DISTINCT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
            INNER JOIN obtention ON personnage.id_personnage = obtention.id_personnage ORDER BY nom $alphabet";
        }
        else
            {
                if (in_array("4" , $rarete))
                    $reponse = "SELECT DISTINCT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                INNER JOIN obtention ON personnage.id_personnage = obtention.id_personnage 
                                WHERE rarete = '4' ORDER BY nom $alphabet"; // SI UNIQUEMENT 4*
                if (in_array("5" , $rarete))
                    $reponse = "SELECT DISTINCT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                INNER JOIN obtention ON personnage.id_personnage = obtention.id_personnage 
                                WHERE rarete = '5' ORDER BY nom $alphabet"; // SI UNIQUEMENT 5*
            }
    } 

//////////////////////////////////// REQUETE 2 COLLECTION ///////////////////////////////////////////

  if (!empty($doublon)) // PAS DE DOUBLON ET RIEN COCHER
    {
        if (empty($rarete) || (in_array("4", $rarete) && in_array("5", $rarete))){
            $reponse2 = "SELECT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
            ORDER BY nom $alphabet";
        }
        else
            {
                if (in_array("4" , $rarete))
                    $reponse2 = "SELECT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                WHERE rarete = '4' ORDER BY nom $alphabet"; // SI UNIQUEMENT 4*
                if (in_array("5" , $rarete))
                    $reponse2 = "SELECT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                WHERE rarete = '5' ORDER BY nom $alphabet"; // SI UNIQUEMENT 5*
            }
    }
    else
    {
    if (empty($rarete) || (in_array("4", $rarete) && in_array("5", $rarete))){
            $reponse2 = "SELECT DISTINCT personnage.id_personnage, nom, type, voie, rarete FROM personnage ORDER BY nom $alphabet";
        }
        else
            {
                if (in_array("4" , $rarete))
                    $reponse2 = "SELECT DISTINCT personnage.id_personnage, nom, type, voie, rarete FROM personnage 
                                WHERE rarete = '4' ORDER BY nom $alphabet"; // SI UNIQUEMENT 4*
                if (in_array("5" , $rarete))
                    $reponse2 = "SELECT DISTINCT personnage.id_personnage, nom, type, voie, rarete FROM personnage
                                WHERE rarete = '5' ORDER BY nom $alphabet"; // SI UNIQUEMENT 5*
            }
    } 
  
// var_dump($reponse);

  // Stockage sous forme de tableaux
  $tableObtention = lectureBDD($reponse);
  $tablePersonnage = lectureBDD($reponse2);

// Choix de sélection entre les personnages obtenu et la liste de tt les perso

  if (empty($_POST["selection"]))
    $selection = "obtention";
  else{
    if ($_POST["selection"] == "obtention")
        $selection = "obtention";
    else
        $selection = "personnage";
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
            <a class="icon <!--translate-->" href="index.html"> 
                <img src="img/icones/event.png" alt="">
            </a>
            <a class="icon <!--translate-->" href="warp.php">
                <img src="img/icones/gacha.png" alt="">
            </a>
            <a class="icon <!--translate-->" href="meme.html">
                <img src="img/icones/adventure.png" alt="">
            </a>
            <a class="icon <!--translate-->" href="inventory.php">
                <img src="img/icones/inventory.png" alt="">
            </a>
            <a class="icon <!--translate-->" href="profile.html">
                <img src="img/icones/profil.png" alt="">
            </a>
        </div>
    </header>

    <!-- MONNAIE -->
    <div id="monnaieMargin">
        <section id="monnaieFlex">
            <div class="monnaie">
                <img src="img/icones/Item_Special_Pass.webp" alt="">
                ∞
            </div>

            <div class="monnaie">
                <img src="img/icones/Item_Stellar_Jade.webp" alt="">
                ∞
            </div>
        </section>
    </div>

    <!-- -------------------------- CONTENU ------------------------------ -->

    <main>
        <!-- FILTRE SUR TYPE -->
         <div class="classification">
            <label for="Physical">
                <input type="checkbox" name="Physical" id="Physical">
                <img class="type" src="img/icones/Type_Physical.webp" alt="">
            </label>
            <label for="Fire">
                <input type="checkbox" name="Fire" id="Fire">
                <img class="type" src="img/icones/Type_Fire.webp" alt="">
            </label>
            <label for="Ice">
                <input type="checkbox" name="Ice" id="Ice">
                <img class="type" src="img/icones/Type_Ice.webp" alt="">
            </label>
            <label for="Imaginary">
                <input type="checkbox" name="Imaginary" id="Imaginary">
                <img class="type" src="img/icones/Type_Imaginary.webp" alt="">
            </label>
            <label for="Lightning">
                <input type="checkbox" name="Lightning" id="Lightning">
                <img class="type" src="img/icones/Type_Lightning.webp" alt="">
            </label>
            <label for="Quantum">
                <input type="checkbox" name="Quantum" id="Quantum">
                <img class="type" src="img/icones/Type_Quantum.webp" alt="">
            </label>
            <label for="Wind">
                <input type="checkbox" name="Wind" id="Wind">
                <img class="type" src="img/icones/Type_Wind.webp" alt="">
            </label>
        </div>

        <!-- FILTRE SUR VOIE -->
        <div class="classification">
            <label for="Destruction">
                <input type="checkbox" name="Destruction" id="Destruction">
                <img class="type" src="img/icones/Path_Destruction.webp" alt="">
            </label>
            <label for="Hunt">
                <input type="checkbox" name="Hunt" id="Hunt">
                <img class="type" src="img/icones/Path_The_Hunt.webp" alt="">
            </label>
            <label for="Erudition">
                <input type="checkbox" name="Erudition" id="Erudition">
                <img class="type" src="img/icones/Path_Erudition.webp" alt="">
            </label>
            <label for="Harmony">
                <input type="checkbox" name="Harmony" id="Harmony">
                <img class="type" src="img/icones/Path_Harmony.webp" alt="">
            </label>
            <label for="Nihility">
                <input type="checkbox" name="Nihility" id="Nihility">
                <img class="type" src="img/icones/Path_Nihility.webp" alt="">
            </label>
            <label for="Preservation">
                <input type="checkbox" name="Preservation" id="Preservation">
                <img class="type" src="img/icones/Path_Preservation.webp" alt="">
            </label>
             <label for="Abundance">
                <input type="checkbox" name="Abundance" id="Abundance">
                <img class="type" src="img/icones/Path_Abundance.webp" alt="">
            </label>
             <label for="Remembrance">
                <input type="checkbox" name="Remembrance" id="Remembrance">
                <img class="type" src="img/icones/Path_Remembrance.webp" alt="">
            </label>
             <label for="Elation">
                <input type="checkbox" name="Elation" id="Elation">
                <img class="type" src="img/icones/Path_Elation.webp" alt="">
            </label>
        </div>

       <div class="filtreGrid rien"> <!-- la classe rien permet d'afficher tout de base -->
            <?php
                // sélection de quelle table à prendre en fonction du select qui force un submit
                if ($selection == "personnage")
                    $table = $tablePersonnage;
                else
                    $table = $tableObtention;

                // ajoute les classes : voie et type de chaque perso en + des images pour le filtre
                foreach ($table as $key => $value) {
                    $image = "<div class='" . $table[$key]['voie'] . " ";
                    $image .= $table[$key]['type'] . "'>";
                    $image .= "<img src='img/characterIcon/Character_";
                    $image .= str_replace(" ", "_", $table[$key]['nom']) . "_Icon.webp'>";
                    $image .= "</div>";
                    echo $image;
                }
            ?>
        </div>
    </main>

    <!-- OPTIONS DE FILTRE PHP -->
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

            <!-- CHOIX ENTRE CEUX OBTENU ET CEUX EXISTANTS -->
            <select name="selection" onchange=submit()>
                <option value="obtention"
                <?php if ($selection=="obtention"){
                    echo "selected";
                }?>>COLLECTION PERSONNELLE</option>
                <option value="personnage" 
                <?php if ($selection=="personnage"){
                    echo "selected";
                }?>>LISTE DES PERSONNAGES</option>
            </select>

            <!-- OPTION DOUBLON -->
            <label class="option
            <?php if (in_array("double",$doublon))
                echo "select"
            ?>">
                <input type="checkbox" name="doublon[]" value="double" onchange=submit()
                <?php if (in_array("double",$doublon))
                echo "checked";
                ?>>
                <div>DOUBLON</div>
            </label>

            <!-- OPTION PERSO 4* -->
            <label class="option 
            <?php if (in_array("4",$rarete))
                echo "select"
            ?>">
            <input type="checkbox" name="rarete[]" value="4" onchange=submit()
            <?php if (in_array("4", $rarete))
                echo "checked";
            ?>>
            <div>4 STARS</div>
            </label>

            <!-- OPTION PERSO 5* -->
            <label class="option
            <?php if (in_array("5",$rarete))
                echo "select"
            ?>">
            <input type="checkbox" name="rarete[]" value="5" onchange=submit()
            <?php if (in_array("5",$rarete))
                echo "checked";
            ?>>
            <div>5 STARS</div>
            </label>
            
            <!-- OPTION TRI ALPHABETIQUE -->
            <label class="option <?php
            if ($alphabet == "DESC")
                echo "select";
            ?>">
            <input type="checkbox" name="alphabet" 
            value=<?php 
            if ($alphabet == "ASC")
                echo "DESC";
            else
                echo "ASC";
            ?> onchange=submit()>
            <div>
                <?php 
                if ("DESC" == $alphabet){
                    echo "Z-A";}
                else
                    {echo "A-Z";}
                ?>
            </div>
            </label>

            <!-- BOUTON POUR EFFACER SON INVENTAIRE -->
            <button class="reset" name="reset" value="1">REINITIALISATION</button>
        </form>
     

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
                    <div>Inventaire</div>
                </li>
            </section>
        </div>
        <!-- CONTENU -->
        <div class="phoneFlex">
            <div id="UID">UID 700499164</div>
            <div></div>
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
            <div><img src="img/icones/Icon_Consumables.webp" alt="">Substances</div>
            <div><img src="img/icones/Icon_Data_Bank.webp" alt="">Banque de<br>données</div>
            <div><img src="img/icones/Icon_Nameless_Honor.webp" alt="">Honneur <br>Sans_Noms</div>
            <div><img src="img/icones/Icon_Warp.webp" alt="">Saut hyperespace</div>
            <div><img src="img/icones/profil.png" alt="">Personnages<br></div>
            <div><img src="img/icones/Icon_Bookshelf.webp" alt="">Bibliothèque</div>
            <div><img src="img/icones/UI_Mission.webp" alt="">Missions</div>
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

    <script src="js/inventory.js"></script>
</body>

</html>