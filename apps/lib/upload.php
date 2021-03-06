<?php

//Inclusions
require_once '../inc/main.php';
/**
 * Initialisation
 */
$idIntranetColumnInfo = Lib::getParameterFromRequest(IntranetColumnInfoModel::KEYNAME);
$retour = "<br><a href=popup-mysql_field_desc.php?id_intranet_column_info=" . $idIntranetColumnInfo . "&edit_mode=1 >Retour</a>";
$dossier = ModuleConfigLib::CHEMIN_ACCES_UPLOAD;
$fichier = basename($_FILES['avatar']['name']);


/**
 * Affichage du type d'erreur
 */
switch ($_FILES['avatar']['error']) {
    case UPLOAD_ERR_OK:

        break;
    case UPLOAD_ERR_INI_SIZE:
        /**
         * La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.
         */
    case UPLOAD_ERR_FORM_SIZE:
        /**
         * Valeur : 2. La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.
         */
        $erreur .= ' - Le fichier est trop gros (limit of 10Go dans  le code ou excède la valeur de upload_max_filesize, configurée dans le php.ini).';
        break;
    case UPLOAD_ERR_PARTIAL:
        $erreur .= ' - Le fichier n\'a été que partiellement téléchargé.';
        break;
    case UPLOAD_ERR_NO_FILE:
        $erreur .= ' - Aucun fichier n\'a été téléchargé..';
        break;
    case UPLOAD_ERR_NO_TMP_DIR:
        $erreur .= ' - Un dossier temporaire est manquant.';
        break;
    case UPLOAD_ERR_CANT_WRITE:
        $erreur .= ' - Échec de l\'écriture du fichier sur le disque.';
        break;
    default:
        $erreur .= ' - erreur interne #' . $_FILES['avatar']['error'];
        break;
}


$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf', '.txt', '.doc', '.docx', '.odt', '.xlsx', '.csv', '.ppt', '.pptx');
$extension = strrchr($_FILES['avatar']['name'], '.');
////Début des vérifications de sécurité...
if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, pdf, jpeg, txt, doc, docx, odt, ppt, pptx, xlsx ou csv';
}

if (!isset($erreur)) { //S'il n'y a pas d'erreur, on upload
    //On formate le nom du fichier ici...
    $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        /**
         * Enregistrement du nom du fichier en BDD
         */
        $intranetColumInfoModel = new IntranetColumnInfoModel($idIntranetColumnInfo);
        $intranetColumInfoModel->getDataField(IntranetColumnInfoModel::FIELDNAME_UPLOAD_NAME_FILE)->setFieldValue($fichier);
        $intranetColumInfoModel->saveToDatabase();
        //Redirection
        header("Location: popup-mysql_field_desc.php?id_intranet_column_info=" . $idIntranetColumnInfo . "&edit_mode=1");
    } else { //Sinon (la fonction renvoie FALSE).
        echo 'Echec de l\'upload ! (probablement une erreur de permission sur le dossier lib/upload';
        echo $retour;
    }
} else {
    echo $erreur;
    echo $retour;
}

