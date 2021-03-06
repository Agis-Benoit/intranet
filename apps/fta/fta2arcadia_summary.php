<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ('../lib/session.php');         //Récupération des variables de sessions
        include ('../lib/functions.php');       //On inclus seulement les fonctions sans construire de page
        include ('functions.php');              //Fonctions du module
        echo '
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ';

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ('../lib/session.php');         //Récupération des variables de sessions
//        include ('../lib/debut_page.php');      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
        flush();


//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ('./$menu');
//        }
//        else
//        {
//           include ('./menu_principal.inc');    //Sinon, menu par défaut
//        }
}//Fin de la sélection du mode d'affichage de la page

$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$synthese_action = Lib::getParameterFromRequest('synthese_action');
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours', '1');
$comeback = Lib::getParameterFromRequest('comeback');
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);

/**
 * Initialisation
 */
$ftaModel = new FtaModel($id_fta);
$ftaModel->setDataFtaTableToCompare();
$ftaView = new FtaView($ftaModel);
$ftaView->setIsEditable(Chapitre::NOT_EDITABLE);
$idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
$globalConfig = new GlobalConfig();
if ($globalConfig->getAuthenticatedUser()) {
    $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
} else {
    $titre = UserInterfaceMessage::FR_WARNING_DECONNECTION_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DECONNECTION;
    Lib::showMessage($titre, $message, $redirection);
}

$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();

/**
 * Contrôle du rôle attribué
 */
if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN) {
    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
        $synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS;
    }
    $arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, $idFtaWorkflow);
    $idFtaRole = $arrayIdFtaRoleAcces["0"];
}
$id_fta_chapitre = $id_fta_chapitre_encours;

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = 'modification_fiche.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'width=100% '
        . 'class=titre_principal '
;
$detail_id_fta;              //Identifiant de la fiche sur laquelle on souhaite un détail

/*
  Récupération des données MySQL
 */

Navigation::initNavigation($id_fta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, TRUE, TRUE);
$navigue = Navigation::getHtmlNavigationBar();


/**
 * Identité
 */
//Raccoucis de classification
$bloc.="<td align=center>Identité</td>" . $ftaView->getHtmlClassificationRaccourcisView();

//Commentaire sur la Fta
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMMENTAIRE);

//Environnement de conservation
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION);

//Données lié à arcadia 
$bloc.= $ftaView->getHtmlArcadiaDataNotEditable();
$bloc.=$ftaView->getHtmlArcadiaDataVariableEditable();

//Désignation commerciale
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE);

//Poids net de l’UVF
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE);

/**
 * Site de production
 */
$bloc.="<td align=center>Site de production</td>" . $ftaView->listeSiteByAcces($idUser, $isEditable);


/**
 * Expédition, EANS, Facturation
 */
//Site d'expedition
$bloc.="<td align=center>Expédition, EANS, Facturation</td>" . $ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);

//Unité de Facturation
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_UNITE_FACTURATION);

//Gencod EAN Article
$bloc.=$ftaView->getHtmlEANArticle();

//Gencod EAN Colis
$bloc.=$ftaView->getHtmlEANColis();

//Gencod EAN Palette
$bloc.=$ftaView->getHtmlEANPalette();

/**
 * Methode de préarationet type d'acquisition
 */
$methodeDePreparationArcadiaValue = $ftaModel->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_METHODE_DE_PREPARATION)->getFieldValue();
$typePreparationAcquisitionArcadiaValue = $ftaModel->getModelAnnexeUniteFacturation()->getDataField(AnnexeUniteFacturationModel::FIELDNAME_ID_ARCADIA_TYPE_PREPA_ACQUISITION)->getFieldValue();

$bloc.="<tr class=contenu><td align=left>Methode de Preparation</td><td>" . $methodeDePreparationArcadiaValue . "</td></tr>";
$bloc.="<tr class=contenu><td align=left>Type prepa Acquisition</td><td>" . $typePreparationAcquisitionArcadiaValue . "</td></tr>";

/**
 * Exigence client
 */
$bloc.="<td align=center>Exigence client</td>";
if ($idFtaWorkflow == FtaWorkflowModel::ID_WORKFLOW_MDD_AVEC or $idFtaWorkflow == FtaWorkflowModel::ID_WORKFLOW_MDD_SANS) {
    //Durée de vie garantie client (en jours)
    $bloc.=$ftaView->getHtmlIsDureeDeVieCalculateWithDureeDeVieClient();
} else {
    //Durée de vie garantie client (en jours)
    $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE);
}

/**
 * Durrée de vie 
 */
$bloc.="<td align=center>Durrée de vie</td>";
//Durée de vie Production (en jours)
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION);


//Code Douane 
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA);


/**
 * PCB
 */
//Nombre d’UVC par colis
$bloc.="<td align=center>PCB</td>" . $ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON);


/**
 * Emballages du Colis
 */
AnnexeEmballageGroupeTypeModel::initEmballage($id_fta);
$bloc.="<td align=center>Emballages du Colis</td>" . $ftaView->getHtmlEmballageDuColis($id_fta, $id_fta_chapitre_encours, $synthese_action, $idFtaEtat, $abreviationFtaEtat, $idFtaRole);

//Vérification que l'enballage sélectionner soit existant sur Arcadia
$bloc.=$ftaView->checkEmballageColisValide();

//Palette
//Nombre total de Carton par palette:

$bloc.=$ftaView->getHtmlColisTotalUVC();

//Poids total de l'emballage de l'UVC
$bloc.=$ftaView->getHtmlPoidsEmballageUVC();
/**
 * Codification
 */
//Désignation Abrégée
$bloc.="<td >Codification</td>" . $ftaView->getHtmlNomAbrege();

//Désignation Interne Agis
//        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);
$bloc.=$ftaView->getHtmlDesignationInterneAgis();

//Code Article LDC, code Article arcadia
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC);

//Famille Eco Emballage Arcadia
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_ECO_EMBALLAGES);

//Cellule Article Arcadia
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ID_ARCADIA_CELLULE_ARTICLE);


$fta2ArcadiaController = new Fta2ArcadiaController($ftaModel, Fta2ArcadiaTransactionModel::SUMMARY_PAGE, TRUE);
$ficherXML = $fta2ArcadiaController->showExportXmlFile();

/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case 'pdf':
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = 'Arial';
        $t1_police = $police_standard;
        $t1_style = 'B';
        $t1_size = '12';

        $t2_police = $police_standard;
        $t2_style = 'B';
        $t2_size = '11';

        $t3_police = $police_standard;
        $t3_style = 'BIU';
        $t3_size = '10';

        $contenu_police = $police_standard;
        $contenu_style = '';
        $contenu_size = '8';

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array('print', 'copy'));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */




    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo $navigue . '
             <form name=navigation method=' . $method . ' action=' . $page_action . '>
             <input type=hidden name=action value=' . $action . '>

             <' . $html_table . '>
            <tr>
                ' . $bloc
        . $ficherXML . '
            </tr>
             </table>
             </form>
             ';



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ('../lib/fin_page.inc');

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>