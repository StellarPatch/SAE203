<?php
  /*******************************************************
  Se connecte à la base de données magasin 
    Entrée : 
  
    Retour : 
      [object] : Connexion vers la BDD magasin
  *******************************************************/
  function connexionBDD()
  {
    try   // Connexion à la base de données
    {
      $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT);   // Pour ne pas afficcher les erreurs SQL
      $database = new PDO('mysql:host=localhost;dbname=honkai', 'root', '', $options);
    }
    catch(Exception $err)
    {
      die('Erreur connexion MySQL : ' . $err->getMessage());
    }

    return $database;
  }

  /*******************************************************
  Exécute une requête de type SELECT et retourne la réponse dans un tableau associatif 
    Entrée : 
      requete [string] : Requête SELECT à exécuter
  
    Retour : 
      [array] : Tableau associatif contenant la réponse
  *******************************************************/
  function lectureBDD($requete)
  {
    $bdd=connexionBDD();      // Connexion à la base de données
  
    $reponse=$bdd->query($requete);    // Envoi de la requête SQL
  
    // Lecture de toutes les lignes de la réponse dans un tableau associatif
    $tableau=$reponse->fetchAll(PDO::FETCH_ASSOC);
  
    $bdd=null;                // Fin de la connexion
  
    return $tableau;          // Renvoi du tableau associatif
  }

  /*******************************************************
  Exécute une requête de type INSERT, UPDATE ou DELETE, et retourne le nombre de lignes modifiées
    Entrée : 
      requete [string] : Requête INSERT, UPDATE ou DELETE à exécuter
  
    Retour : 
      [int] ou [booléen] : Nombre de lignes modifiées en cas de succès, sinon false
  *******************************************************/
  function ecritureBDD($requete)
  {
    $bdd=connexionBDD();      // Connexion à la base de données
  
    $nb=$bdd->exec($requete);    // Exécution de la requête SQL
  
    return $nb;          // Renvoi du résultat de la requête
  }