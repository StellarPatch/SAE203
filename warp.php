<?php
  // ****** ACCES AUX DONNEES ******
  try   // Connexion à la base de données
  {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT);
    $bdd = new PDO('mysql:host=localhost;dbname=honkai', 'root', '', $options);
  }
  catch(Exception $err)
  {
    die('Erreur connexion MySQL : ' . $err->getMessage());
  }
 
   // Envoi des requêtes pour récupérer les tables/association
  $reponse = $bdd->query("SELECT id_banniere, version_sortie, nom_banniere, personnage1, personnage2, personnage3, personnage4, personnage5, personnage6, personnage7 FROM banniere");
  $reponse2 = $bdd->query("SELECT id_personnage, nom, type, voie, rarete FROM personnage");
  $reponse3 = $bdd->query("SELECT id_appartenir, id_banniere, id_personnage, rarete FROM appartenir");

  // Stockage sous forme de tableaux
  $tableBanniere = $reponse->fetchAll(PDO::FETCH_ASSOC);
  $tablePersonnage = $reponse2->fetchAll(PDO::FETCH_ASSOC);
  $associationAppartenir = $reponse3->fetchAll(PDO::FETCH_ASSOC);


if (empty($_POST["click"])){
  ///////////////////////////////////// Récupérration des donners de la bannière ////////////////////////////////////////////////////
  $titre = $tableBanniere[0]["nom_banniere"]; //titre de la bannière
  $version = $tableBanniere[0]['id_banniere']; //prend la version initiale
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $reponse4 = $bdd->query("SELECT id_personnage,rarete FROM appartenir WHERE id_banniere = '$version'");
  $personnage = $reponse4->fetchAll(PDO::FETCH_ASSOC); //liste des personnages de la bannière
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 4*
  $reponse5 = $bdd->query("SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=4");
  $personnage_4 = $reponse5->fetchAll(PDO::FETCH_ASSOC); //liste des personnages 4* de la bannière
  
  $nom_id_4 = array();
  foreach($personnage_4 as $key => $value) {
    $nom_id_4[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_4 = array();
  foreach($nom_id_4 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = $bdd->query("SELECT nom FROM personnage WHERE id_personnage = '$id'");
    $auxiliaire = $reponseAux->fetchAll(PDO::FETCH_ASSOC);
    $nom_str_4[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 4*
  };

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 5*
  $reponse6 = $bdd->query("SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=5");
  $personnage_5 = $reponse6->fetchAll(PDO::FETCH_ASSOC); //liste des personnages 5* de la bannière
  
  $nom_id_5 = array();
  foreach($personnage_5 as $key => $value) {
    $nom_id_5[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_5 = array();
  foreach($nom_id_5 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = $bdd->query("SELECT nom FROM personnage WHERE id_personnage = '$id'");
    $auxiliaire = $reponseAux->fetchAll(PDO::FETCH_ASSOC);
    $nom_str_5[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 5*
  };
}

else{
     ///////////////////////////////////// Récupérration des donners de la bannière ////////////////////////////////////////////////////
  $titre = $tableBanniere[$_POST["click"]]["nom_banniere"]; //titre de la bannière
  $version = $tableBanniere[$_POST["click"]]['id_banniere']; //prend la version initiale
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $reponse4 = $bdd->query("SELECT id_personnage,rarete FROM appartenir WHERE id_banniere = '$version'");
  $personnage = $reponse4->fetchAll(PDO::FETCH_ASSOC); //liste des personnages de la bannière
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 4*
  $reponse5 = $bdd->query("SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=4");
  $personnage_4 = $reponse5->fetchAll(PDO::FETCH_ASSOC); //liste des personnages 4* de la bannière
  
  $nom_id_4 = array();
  foreach($personnage_4 as $key => $value) {
    $nom_id_4[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_4 = array();
  foreach($nom_id_4 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = $bdd->query("SELECT nom FROM personnage WHERE id_personnage = '$id'");
    $auxiliaire = $reponseAux->fetchAll(PDO::FETCH_ASSOC);
    $nom_str_4[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 4*
  };

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // 1) Stocker les id des perso 5*
  $reponse6 = $bdd->query("SELECT id_personnage FROM appartenir WHERE id_banniere = '$version' AND rarete=5");
  $personnage_5 = $reponse6->fetchAll(PDO::FETCH_ASSOC); //liste des personnages 5* de la bannière
  
  $nom_id_5 = array();
  foreach($personnage_5 as $key => $value) {
    $nom_id_5[] = $value; //Liste des id(association appartenir)
  };

  // 2) convertion des id en noms
  $nom_str_5 = array();
  foreach($nom_id_5 as $key => $value) {
    $id = $value['id_personnage'];
   
    $reponseAux = $bdd->query("SELECT nom FROM personnage WHERE id_personnage = '$id'");
    $auxiliaire = $reponseAux->fetchAll(PDO::FETCH_ASSOC);
    $nom_str_5[] .= $auxiliaire[0]["nom"]; // variable avec tt les noms de perso rareté 5*
  };
}

$bdd = null;                // Fin de la connexion

// if (isset($_POST["tirage"])){
    
//   // Connexion PDO
//     try {
//          $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
//          $bdd = new PDO('mysql:host=localhost;dbname=honkai', 'root', '', $options);
//     } catch(Exception $err) {
//         die('Erreur connexion MySQL : ' . $err->getMessage());
//     }

//     // Connexion MySQLi
//     $conn = mysqli_connect("localhost", "root", "", "honkai");

//     if (!$conn) {
//         die("Erreur de connexion : " . mysqli_connect_error());
//     }

//     // Récupération de l'id du personnage
//     $reponse3 = $bdd->query("SELECT id_personnage FROM personnage WHERE nom = '$tirage'");
//     $id_tirage = $reponse3->fetchAll(PDO::FETCH_ASSOC);

//     // Extraction correcte
//     $id_personnage = $id_tirage[0]["id_personnage"];

//     // Requête SQL
//     $sql = "INSERT IGNORE INTO obtention (id_personnage, id_banniere)
//         VALUES ('$id_personnage', '$version')";

//     // Exécution
//     if (mysqli_query($conn, $sql)) {
//         $recordInsert = "Insertion réussie dans obtention";
//     } 
//     else {
//     echo "Erreur : " . mysqli_error($conn);
//     }

//     // Fermeture
//     mysqli_close($conn);
//     }
// else{

// }

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
                <?php foreach($tableBanniere as $key => $value) {
                    echo "<button type='submit' name='click' "."value='".($value["id_banniere"]-1)."' class='version'";
                    echo 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $value['personnage1']) . '_Splash_Art.webp\')">';
                    echo $value['version_sortie'];
                    echo "</button>" ;
                };?>
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
                    <?php foreach($nom_str_4 as $key => $value) {
                        $sideCharacter = "<div class='sidePerso'";
                        $sideCharacter .= 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $value) . '_Splash_Art.webp\')">';
                        $sideCharacter .= "</div>";
                        echo $sideCharacter;
                    };
                    
                    // for ($i=0;  $i<=2; $i++){
                    //     if (($nom[5] && $nom[6])==null)  //s'il y a 5 perso faire +2 pour charger les images des persos 4*
                    //     {
                    //         $sideCharacter = "<div class='sidePerso'";
                    //         $sideCharacter .= 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $nom[$i+2]) . '_Splash_Art.webp\')">';
                    //         $sideCharacter .= "</div>";
                    //     }
                    //     else //s'il y a 7 perso faire +4 pour charger les images des persos 4*
                    //     {
                    //       $sideCharacter = "<div class='sidePerso'";
                    //         $sideCharacter .= 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $nom[$i+4]) . '_Splash_Art.webp\')">';
                    //         $sideCharacter .= "</div>";
                    //     }
                    //     echo $sideCharacter;
                    // };
                    ?>
                </div>

            </section>


            <!-- section image du perso principale de l'event -->
            <section class="mainPerso"
            
            <?php
                echo 'style="background-image:url(\'img/splash/Character_' . str_replace(" ", "_", $nom_str_5[count($nom_str_5)-1]) . '_Splash_Art.webp\')"';
                
            ?>>
            
            <!-- str_replace pour formater le nom dans l'entité banniere au fichier -->
            </section>
        </section>

        <form class="btnFlex" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" > <!-- éviter de mettre un autre form sinon trop galère -->
            
            <button class="btn" name="tirage" value=<?php $version ?>>
                <img src="img/btn.apng" alt="">
                <img src="img/frameBtn.webp" alt="">
                <div><b>x1 Tirage</b></div>
            </button>


            <!-- Affichage d'un select si plusieurs perso 5* -->

            <?php if (!empty($altNom[1]) || !empty($altNom[2]) || !empty($altNom[3])){
                echo '<select name="altNom" action="<?= $_SERVER[\'PHP_SELF\'] ?>" method="post">';
                for ($i=0;  $i<=3; $i++){
                    if ($altNom[$i] <> null)
                    {echo "<option value='$nom[$i]'>$altNom[$i]</option>";}
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

    <!-- PARTIE TIRAGE ANIMATION -->

    <section class="screenPull hidden">
            <div class="gate1"></div>
            <div class="gate2"></div>
    </section>

    <script src="js/warp.js"></script>
</body>

</html>