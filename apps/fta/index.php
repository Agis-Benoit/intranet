<?php

/* * *******
  Inclusions
 * ******* */
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
flush();

$fta_consultation = Acl::getValueAccesRights('fta_consultation');
if (!$fta_consultation) {
    
} else {
    /*
     * Initilisation
     */
    $globalConfig = new GlobalConfig();

    if ($globalConfig->getAuthenticatedUser()) {
        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $lieuGeo = $globalConfig->getAuthenticatedUser()->getLieuGeo();
    }

    /*     * ***********
      Début Code PHP
     * *********** */
    if ($id_user) {
        /*
          Initialisation des variables
         */
        $page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
//   $page_action=$page_default.'_post.php';
        $page_action = 'transiter_post.php';
//    $page_action = 'modification_fiche.php';
        $page_pdf = $page_default . '_pdf.php';
        $action = 'valider';                       //Action proposée à la page _post.php
        $method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
        $html_table = 'table '              //Permet d'harmoniser les tableaux
                . 'border=1 '
                . 'width=100% '
                . 'class=contenu '
        ;
        $isIndex = 0;                //Variable booléenne disant si oui ou non on est sur l'index

        $abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
        /**
         * Faire un lien avec un model pour recuperer les droit consutation et modification
         */
        $fta_modification = Acl::getValueAccesRights('fta_modification');
        $id_fta_etat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
        $isLimit = $_SESSION['limit_affichage_fta_index'];
        $nomFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT);
        $nombre_fiche = Lib::getParameterFromRequest('nombre_fiche');
        $requete_resultat = Lib::getParameterFromRequest('requete_resultat');
        $synthese_action = Lib::getParameterFromRequest('synthese_action');
        $tableau_fiche = Lib::getParameterFromRequest('tableau_fiche');
        $visualiser_fiche_total_fta = Lib::getParameterFromRequest('visualiser_fiche_total_fta');
        $order_common = Lib::getParameterFromRequest('order_common', FtaWorkflowModel::KEYNAME);
        $numeroDePageCourante = Lib::getParameterFromRequest('numeroPage', '1');




        /*
          Récupération des données MySQL
         */
        //2008-07-28 - BS Par défaut, les utilisateurs participant aux processus arrivent sur leur page 'Fiche En cours'
        //Par défaut, tout le monde arrive sur la liste des FTA en cours de modification.
        //id_fta_etat=1&nom_fta_etat=I&synthese_action=encours
        if (!$id_fta_etat) {
            $isIndex = 1;  //On est sur l'index donc chargement des vues par défaut suivant le profile utilisateur
            $id_fta_etat = '1';
            $nomFtaEtat = 'I';
            $abreviationFtaEtat = $nomFtaEtat;
            //$arrayFtaRole = FtaRoleModel::getIdFtaRoleByIdUser($id_user);
            $idFtaRoleEncoursDefault = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($id_user);
            if ($fta_modification) {
                $synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS;
                if (!$idFtaRoleEncoursDefault) {
                    $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
                    $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_ROLES;
                    $redirection = "index.php";
                    Lib::showMessage($titre, $message, $redirection);
                }
            } else {
                $synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL;
                $idFtaRoleEncoursDefault = '0';
                $nomFtaEtat = FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE;
                $id_fta_etat = '3';
            }
        }
        if ($fta_modification) {
            $nbMaxParPage = ModuleConfig::VALUE_MAX_PAR_PAGE;
        } else {
            $nbMaxParPage = ModuleConfig::VALUE_MAX_PAR_PAGE_CONSUL;
            $messageConsultation = '<table width=100% border=1 valign=top cellspacing=0>
            <tr>
                <td class=titre_principal valign=\'middle\'> ' . UserInterfaceMessage::FR_LAST_50_FTA . '</td>
            </tr>
        </table>';
        }
        $idFtaRoleEncours = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME, $idFtaRoleEncoursDefault);
//echo 'id_fta_etat=$id_fta_etat / nom_fta_etat=$nom_fta_etat / synthese_action=$synthese_action <br>';

        /*
          Création des objets HTML (listes déroulante, cases à cocher ...etc.)
         */


        /*         * *********
          Fin Code PHP
         * ********* */

        $id_fta_etat_encours = $id_fta_etat;
        $ftaEtatModel = new FtaEtatModel($id_fta_etat);


        $nom_fta_etat_encours = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue();

        /*         * *****************************************************************************
          TABLEAU DE SYNTHESE
         * ***************************************************************************** */
        /**
         * Calcul des enregistrements à afficher
         */
        $debut = ($numeroDePageCourante - '1') * $nbMaxParPage;
        /*
         * Initialisation des valeurs
         */
        /**
         * traitement long
         */
        AccueilFta::initAccueil($id_user, $id_fta_etat, $nomFtaEtat, $synthese_action, $idFtaRoleEncours, $order_common, $debut, $numeroDePageCourante, $lieuGeo);



        /*
         * Génération de la barre de navigation de la page d'accueil
         */
        $tableau_synthese.=AccueilFta::getTableauSythese();


        //Tableau des FTA
        //Suivant si on est sur l'index ou pas, on charge une vue différentes,
        //et dans le cas des utilisateurs n'ayant que les droits en consultation
        //Ainsi, ils voient les fiches en cours et les 10 dernières FTA Validée
        /*
          if($isIndex and $synthese_action=='attente') //Dans le cas de l'index,
          {
          //Chargement de la vue dédiée:

          }
          else
         */ {
            $choix = 1;
            if ($synthese_action) {
                //echo $id_fta_etat;
                //$tableau_fiche = AccueilFta::getTableauFiche($id_fta_etat, $choix, $isLimit, $order_common);
                /**
                 * traitement long
                 */
                $tableau_fiche = AccueilFta::getHtmlTableauFiche();
//                $fileAriane = AccueilFta::getFileAriane();
                $pagination = AccueilFta::paginer(ModuleConfig::VALUE_MAX_PAR_PAGE, $numeroDePageCourante, '4', '4', '1', '1');
            }
          
        }
        /*         * ************
          Début Code HTML
         * ************ */

//Construction de la page <td>&nbsp</td>
        echo '    
    <form name=\'modification_fiche\' method=post action=' . $page_action . ' id=\'idOfForm\' >
        <input type=hidden name=id_fta_etat value=' . $id_fta_etat_encours . '>
        <input type=hidden name=nom_fta_etat value=' . $nom_fta_etat_encours . '> 
        <input type=hidden name=\'id_fta_role\' value=' . $idFtaRoleEncours . ' >
        <input type=hidden name=\'id_fta\' id=id_fta >
        <input type=hidden name=\'id_fta_etat\' value=' . $id_fta_etat . '>
        <input type=\'hidden\' name=\'synthese_action\' value=' . $synthese_action . ' />
        <input type=hidden name=\'abreviation_fta_etat\' value=' . $abreviationFtaEtat . ' >
        <input type=\'hidden\' name=\'comeback\' value=1 />  
        <table width=100% border=1 valign=top cellspacing=0>
            <tr>
                 <td class=titre_principal valign=\'middle\' > <br>' . $fileAriane . ' <br></td>
            </tr>
            <tr>
                <td> ' . $tableau_synthese . '</td>
            </tr>
        </table>
       ' . $messageConsultation . '
        
';

        if ($synthese_action and ! $requete_resultat) {
            echo '
          <table width=100% border=0>
             
              <tr><td valign=\'middle\'>' . $tableau_fiche . '</td></tr>
          </table>         
          ';
        }
        echo '
    </form>
' . $pagination;

        /*         * **********
          Fin Code HTML
         * ********** */
    }
}
/* * *********************
  Inclusion de fin de page
 * ********************* */
include ('../lib/fin_page.inc');
?>

