<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
////Inclusions
//include ('../lib/session.php');
//include ('../lib/functions.php');
//include ('./functions.php');
require_once '../inc/main.php';

$globalConfig = new GlobalConfig();

$action = Lib::getParameterFromRequest('action');
if ($action == 'transition_groupe') {
    $action = Lib::getParameterFromRequest('abreviation_fta_transition');
}
$idFta = Lib::getParameterFromRequest('id_fta');
if (!$idFta) {
    $idFtaArray = Lib::getParameterFromRequest('arrayFta');
    $idFtaTmp = explode(',', $idFtaArray);
    foreach ($idFtaTmp as $rowsIdFtaTmp) {
        if ($rowsIdFtaTmp) {
            $tmpFta = Lib::getParameterFromRequest('selection_fta_' . $rowsIdFtaTmp);
            if ($tmpFta) {
                $idFta[] = $tmpFta;
            }
        }
    }
}
$idFtaRole = Lib::getParameterFromRequest('id_fta_role');
$idFtaWorkflow = Lib::getParameterFromRequest('id_fta_workflow');
$dateEcheanceFta = Lib::getParameterFromRequest(FtaModel::TABLENAME . "_" . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . "_" . $idFta);
$new_commentaire_maj_ftatmp = Lib::getParameterFromRequest(FtaModel::TABLENAME . "_" . FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA . "_" . $idFta);
$new_commentaire_maj_fta = addslashes($new_commentaire_maj_ftatmp);

if (!$new_commentaire_maj_fta) {
    $subject = Lib::getParameterFromRequest('subject');
}
if (!$action) {
    $titre = 'Erreur';
    $message = 'Vous devez choisir une transition';
    $redirection = '';
    Lib::showMessage($titre, $message, $redirection);
} else {

    /*
      -----------------
      ACTION A TRAITER
      -----------------
      -----------------------------------
      Détermination de l'action en cours
      -----------------------------------

      Cette page est appelée pour effectuer un traitement particulier
      en fonction de la variable '$action'. Ensuite elle redirige le
      résultat vers une autre page.

      Le plus souvent, le traitement est délocalisé sous forme de
      fonction située dans le fichier 'functions.php'

     */
//echo $action.'<br>'.$id_fta.'<br>'.$new_commentaire_maj_fta.'<br>';
//echo $abreviation_fta_transition;
    $liste_global = array();    //Tableau contenant les emails et le nom des destinataire (cf fonction liste_diffusion_transition() )
    $commentaire_maj_fta = "";
//Dans le cas où il n'y aurait qu'une seule FTA a valider,
//Le tableau est rempli avec cette unique valeur.
    if (!$selection_fta) {
        if (!is_array($idFta)) {
            $selection_fta[] = $idFta;
            $envoi_mail_detail = 1;    //Permet d'envoi un mail en mode 'détaillé'
        } else {
            $selection_fta = $idFta;
        }
        $abreviation_fta_transition = $action;
    }

//Controle d'intégrité         *************************************************
//Justification du la transition
    if (
            (
            !$new_commentaire_maj_fta
            or substr($new_commentaire_maj_fta, 0, 1) == ' '
            )
            and
            $abreviation_fta_transition == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
    ) {
        $titre = 'Informations manquantes';
        $message = 'Vous devez spécifier un commentaire sur la mise à jour.';
        Lib::showMessage($titre, $message, $redirection);
        $error = 1;
    }

//Tableau des chapitres
//echo $action;
    if ($action == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION or $action == 'W') {
        $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaChapitreModel::KEYNAME . ',' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                        . ' FROM ' . FtaChapitreModel::TABLENAME
                        . ' ORDER BY ' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE);
        $ok = 0;
        foreach ($arrayChapitre as $rowsChapitre) {
            if (Lib::getParameterFromRequest(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $rowsChapitre[FtaChapitreModel::KEYNAME]) == 1) {
                $ListeDesChapitres[] = $rowsChapitre[FtaChapitreModel::KEYNAME];
                $ListeDesChapitresComment .= " " . $rowsChapitre[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE];
                $ok = 1;
            }
        }
        if (!$ok) {
            $titre = 'Informations manquantes';
            $message = 'Vous devez sélectionner au moins un chapitre à mettre à jour.';
            Lib::showMessage($titre, $message, $redirection);
            $error = 1;
        }

        $new_commentaire_maj_fta = $new_commentaire_maj_fta . "-" . $ListeDesChapitresComment;


        $idFtaChapitreByDefault = FtaChapitreModel::getIdFtaChapitreByDefault($idFtaRole, $idFtaWorkflow, $ListeDesChapitres);
    }


// Fin du controle d'intégrité *************************************************
//Si pas d'erreur, lancement de la transition
    if (!$error) {



        foreach ($selection_fta as $idFta) {
            //Transition de la FTA
            $commentaire_maj_fta = $new_commentaire_maj_fta;

            $t = FtaTransitionModel::buildTransitionFta($idFta, $abreviation_fta_transition, $commentaire_maj_fta, $idFtaWorkflow, $ListeDesChapitres, $dateEcheanceFta);

            //Codes de retour de la fonction:
            //   0: FTA correctement transitée
            //   1: FTA non transité car risque de doublon
            //   3: Erreur autre

            if ($abreviation_fta_transition == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE) { //Seules les FTA validées entrent dans un système de diffusion
                switch ($t["0"]) {
                    case 0:
                        //Récupération de la liste diffusion
                        $liste_destinataire = FtaTransitionModel::buildListeDiffusionTransition($idFta);

                        if ($liste_destinataire) {
                            $liste_global = $liste_global + $liste_destinataire;
                            //Envoi des mails de notification
                            if ($envoi_mail_detail) {
                                $idFta;
                                $liste_diffusion = $liste_destinataire;
                                $commentaire = $new_commentaire_maj_fta;
                                FtaTransitionModel::buildEnvoiMailDetail($idFta, $liste_diffusion, $commentaire);
                            }
                        }
                        break;

                    case 1:
                        $titre = 'Action vérrouillée';
                        $message = 'Cette fiche est déjà en cours de modification.';
                        $redirection = '';
                        Lib::showMessage($titre, $message, $redirection);
                        break;

                    case 3:
                        $titre = 'Erreur sur la FTA ' . $idFta;
                        $message = 'Impossible de valider cette FTA';
                        $redirection = '';
                        Lib::showMessage($titre, $message, $redirection);
                        break;
                }
            }//Fin de la diffusion des FTA Validée
        }//Fin du parcours de la selection des FTA
        //Envoi du mail global d'information (uniquement pour les FTA Validée
        if (!$envoi_mail_detail and $abreviation_fta_transition == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE) {
            $selection_fta;
            $liste_diffusion = $liste_global;
            $commentaire = $new_commentaire_maj_fta;
            FtaTransitionModel::buildEnvoiMailGlobal($selection_fta, $liste_diffusion, $subject, $liste_diffusion["log"]);
        }



        //Lancement de la passerelle de synchronisation
        if ($abreviation_fta_transition == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE) {
//            //Ouverture de la base ERP Data sync
//            if ($globalConfig->getConf()->getExecEnvironment() != EnvironmentConf::ENV_PRD) {
//                $extension = 'mdb';
//            } else {
//                $extension = 'agismde';
//            }
//            $open_erpdatasync = '../access/base_erp_datasync/erp_datasync.' . $extension;
//            header('Location: open_erpdatasync.php?open_erpdatasync=' . $open_erpdatasync);
            header('Location: index.php');
        } elseif ($abreviation_fta_transition == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            if ($t["0"] <> "1") {
                header('Location: modification_fiche.php?id_fta=' . $t["id_fta_new"] . '&id_fta_chapitre_encours=' . $idFtaChapitreByDefault . '&synthese_action=encours&id_fta_etat=' . $t[FtaEtatModel::KEYNAME] . '&abreviation_fta_etat=' . $t[FtaEtatModel::FIELDNAME_ABREVIATION] . '&id_fta_role=' . $idFtaRole);

                /**
                 * Version avec le module rewrite
                 */
//                header('Location: modification_fiche-$t["id_fta_new"]-encours-1-$t[FtaEtatModel::KEYNAME]-$t[FtaEtatModel::FIELDNAME_ABREVIATION]-$idFtaRole.html');
            }
        } else {
            header('Location: modification_fiche.php?id_fta=' . $t["id_fta_new"] . '&synthese_action=all&id_fta_etat=' . $t[FtaEtatModel::KEYNAME] . '&abreviation_fta_etat=' . $t[FtaEtatModel::FIELDNAME_ABREVIATION] . '&id_fta_role=' . $idFtaRole);
        }
    }//Fin du traitement

    /*     * **********
      Fin de switch
     * ********** */
}//Fin de l'exécution de la page
//include ('./action_bs.php');
//include ('./action_sm.php');
?>

