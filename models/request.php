<?php

require_once('utils/bdd.php');


//Requête pour insérer le document à envoyer 
function insertDoc($nom,$message,$taille){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO fichier(nom_f, message_f, taille_f, date_f) VALUES (:nom, :messageMail,:taille, CURRENT_TIME)");
    $response->bindParam(":nom",$nom);
    $response->bindParam(":messageMail",$message, PDO::PARAM_STR);
    $response->bindParam(":taille",$taille, PDO::PARAM_INT);
  
    $response->execute();
    $result = $bdd->lastInsertId();
    return $result; 
}    

// Requête pour afficher les informations du document
function showDoc($nom,$message,$taille, $date, $lien){
    global $bdd;
    $response = $bdd->prepare("SELECT * FROM fichier(nom_f, message_f, taille_f, date_f, lien_f) VALUES (:nom, :messageMail,:taille, :dateFile, :lien)");
    $response->bindParam(":nom",$nom);
    $response->bindParam(":messageMail",$message, PDO::PARAM_STR);
    $response->bindParam(":taille",$taille, PDO::PARAM_INT);
    $response->bindParam(":dateFile",$date, PDO::PARAM_INT);
    $response->bindParam(":lien",$lienURL, PDO::PARAM_STR);
    $response->execute();
    $result=$response->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


// 1- Requête pour insérer l'adresse mail du destinataire

function addDestMail($mailDest){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO destinataire(mail_d) VALUES(:mailDest)");
    $response->bindParam(":mailDest",$mailDest, PDO::PARAM_STR);
    $response->execute();
    $result = $bdd->lastInsertId();

    return $result;
}


// 2- Requête pour insérer l'adresse mail de l'expéditeur

function addExpMail($mailExp){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO expediteur(mail_ex) VALUES(:mailExp)");
    $response->bindParam(":mailExp",$mailExp, PDO::PARAM_STR);
    $response->execute();
    $result = $bdd->lastInsertId();
    
    return $result; 
}
// 4- Requête pour supprimer les données mails
//L'idéal serait de pouvoir regrouper les 2 en cascade pour tout supprimer d'un coup

function removeDestMail(){
    global $bdd;
    $response = $bdd->prepare("DELETE FROM destinataire");
    $response->execute();

    $result=$response->fetchAll(PDO::FETCH_ASSOC);

    return $result;  
}


function removeExpMail(){
    global $bdd;
    $response = $bdd->prepare("DELETE FROM expediteur");
    $response->execute();
    $result=$response->fetchAll(PDO::FETCH_ASSOC);

    return $result; 
}

//requête insérer dans table de liaison

function tableLink($id_d, $id_f, $id_ex){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO liaison_fi_ex_dest(id_d, id_f, id_ex) VALUES (:id_d, :id_f, :id_ex)");
    $response->bindParam(":id_d", $id_d, PDO::PARAM_INT);
    $response->bindParam(":id_f", $id_f, PDO::PARAM_INT);
    $response->bindParam(":id_ex", $id_ex, PDO::PARAM_INT);

    $response->execute();
}



// liaison des tables expediteur, destinataire, et fichier

function linkAll($idMail){
    global $bdd;
    $response = $bdd->prepare("SELECT expediteur.mail_ex, destinataire.mail_d, fichier.nom_f, fichier.message_f, fichier.taille_f, fichier.date_f FROM (((liaison_fi_ex_dest INNER JOIN expediteur ON liaison_fi_ex_dest.id_ex = expediteur.id_ex) INNER JOIN destinataire ON liaison_fi_ex_dest.id_d = destinataire.id_d) INNER JOIN fichier ON liaison_fi_ex_dest.id_f = fichier.id_f) WHERE liaison_fi_ex_dest.id_liaison = :id_mail");
    $response->bindParam(":id_mail", $idMail, PDO::PARAM_INT);

    $response->execute();
    $result = $response->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}

//fonction de test sans l'url

// function linkAll(){
//     global $bdd;
//     $response = $bdd->prepare("SELECT expediteur.mail_ex, destinataire.mail_d, fichier.nom_f, fichier.message_f, fichier.taille_f, fichier.date_f FROM (((liaison_fi_ex_dest INNER JOIN expediteur ON liaison_fi_ex_dest.id_ex = expediteur.id_ex) INNER JOIN destinataire ON liaison_fi_ex_dest.id_d = destinataire.id_d) INNER JOIN fichier ON liaison_fi_ex_dest.id_f = fichier.id_f) WHERE liaison_fi_ex_dest.id_liaison = 18");

//     $response->execute();
//     $result = $response->fetchAll(PDO::FETCH_ASSOC);

//     return $result;
// }
