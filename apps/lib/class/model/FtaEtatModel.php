<?php

/**
 * Description of FtaEtatModel
 * Table des états d'une FTA
 *
 * @author salokine
 */
class FtaEtatModel extends AbstractModel {

    const TABLENAME = 'fta_etat';
    const KEYNAME = 'id_fta_etat';
    const FIELDNAME_ABREVIATION = 'abreviation_fta_etat';
    const FIELDNAME_NOM_FTA_ETAT = 'nom_fta_etat';
    const ETAT_ABREVIATION_VALUE_ARCHIVE = 'A';
    const ETAT_ABREVIATION_VALUE_MODIFICATION = 'I';
    const ETAT_ABREVIATION_VALUE_PRESENTATION = 'P';
    const ETAT_ABREVIATION_VALUE_RETIRE = 'R';
    const ETAT_ABREVIATION_VALUE_VALIDE = 'V';
    const ETAT_ABREVIATION_VALUE_WORKFLOW = 'W';
    const ETAT_AVANCEMENT_VALUE_ALL = 'all';
    const ETAT_AVANCEMENT_VALUE_ATTENTE = 'attente';
    const ETAT_AVANCEMENT_VALUE_EFFECTUES = 'correction';
    const ETAT_AVANCEMENT_VALUE_EN_COURS = 'encours';
    const ID_VALUE_ARCHIVE = '5';
    const ID_VALUE_MODIFICATION = '1';
    const ID_VALUE_RETIRE = '6';
    const ID_VALUE_VALIDE = '3';

    protected function setDefaultValues() {
        
    }

    /**
     * Récupération du nom et de l'abrévation de l'état de la fta selon son rôle
     * @param type $paramIdFtaRole
     * @return type
     */
    public static function getFtaEtatAndNameByRole($paramIdFtaRole, $paramModification) {

        if ($paramModification) {
            $req = '';
        } else {
            $req = ' AND ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME . ' <> ' . FtaEtatModel::ID_VALUE_MODIFICATION
                    . ' AND ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME . ' <> ' . FtaEtatModel::ID_VALUE_RETIRE;
        }
        $arrayFtaEtatAndName = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                        . ',' . FtaEtatModel::FIELDNAME_ABREVIATION
                        . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . ' FROM ' . FtaEtatModel::TABLENAME
                        . ',' . FtaRoleModel::TABLENAME . ',' . FtaModel::TABLENAME
                        . ',' . FtaWorkflowStructureModel::TABLENAME
//                        . ',' . FtaWorkflowModel::TABLENAME
                        . ' WHERE ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME . '=' . $paramIdFtaRole
                        . ' AND ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                        . $req
                        /**
                         * Ticket 49823 en 3.1 activation/désactivation d'un workflow
                         */
//                        . FtaWorkflowModel::checkActifWorkflowSQL()
                        . ' ORDER BY ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
        );
        return $arrayFtaEtatAndName;
    }

    /**
     * Liste des id Fta selon l'état d'avancement en exécution
     * @param type $paramSyntheseAction
     * @param type $paramRole
     * @param type $paramIdUser
     * @param type $paramIdFtaEtat
     * @param type $paramFtaModification
     * @return type
     */
    public static function getIdFtaByEtatAvancement($paramSyntheseAction, $paramRole, $paramIdUser, $paramIdFtaEtat, $paramFtaModification, $paramLieuGeo) {
        $idFtaEffectue = array();
//        $compteur = "0";
        if ($_SESSION['CheckIdFtaRole'] <> $paramRole or $_SESSION[UserModel::KEYNAME] <> $paramIdUser) {
            Acl::setRightsAcces($paramIdUser, $paramRole);
        }

        switch ($paramSyntheseAction) {

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:


                /*
                 * On obtient les fta à vérifié dont tous les chapitres ne sont pas validés
                 */
                $arrayTmp = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . ',' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                . ' FROM ' . FtaWorkflowModel::TABLENAME . ', ' . FtaWorkflowStructureModel::TABLENAME
                                . ', ' . FtaSuiviProjetModel::TABLENAME
                                . ' , ' . FtaActionSiteModel::TABLENAME . ' , ' . FtaModel::TABLENAME
                                . ' , ' . IntranetDroitsAccesModel::TABLENAME . ' , ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ' IS NOT NULL'
                                . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_PRODUCTION
                                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' IN (' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME . ')'
                                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=' . FtaSuiviProjetModel::SIGNATURE_VALIDATION_SUIVI_PROJET_FALSE
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser                                                  // Nous recuperons l'identifiant de l'utilisateur connecté
                                . ' AND ' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . $paramIdFtaEtat                                                           // Nous recuperons l'identifiant de l'etat de la Fta
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramRole // Nous recuperons le type de role pour l'utilisateur
                                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ')'
                                /**
                                 * Ticket 49823 en 3.1 activation/désactivation d'un workflow
                                 */
//                                . FtaWorkflowModel::checkActifWorkflowSQL()
                );
                if (FtaRoleModel::isGestionnaire($paramRole)) {
                    $arrayTmp = NULL;
                }
                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $cheackIdFta = in_array($rows[FtaModel::KEYNAME], $idFtaEffectue);
                        if (!$cheackIdFta) {
                            $tauxDeValidadation = FtaProcessusModel::getValideProcessusEncours($rows[FtaModel::KEYNAME], $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS], $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                            if ($tauxDeValidadation <> '1') {
                                $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
//                                $compteur++;
//                                if ($compteur == ModuleConfig::VALUE_MAX_PAR_PAGE) {
//                                    break;
//                                }
                            }
                        }
                    }
                }
                $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaModel::KEYNAME
                                . ' FROM ' . FtaModel::TABLENAME
                                . ' WHERE ( ' . '0'
                                . ' ' . FtaModel::addIdFta($idFtaEffectue) . ')');


                break;


            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                //Récupération des suivis de projet gérés par l'utilisateur et non validé

                /*
                 * On obtient les fta à vérifié dont tous les chapitres ne sont pas validés
                 */
                $arrayTmp = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . ',' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                . ' FROM ' . FtaWorkflowModel::TABLENAME . ', ' . FtaWorkflowStructureModel::TABLENAME
                                . ', ' . FtaSuiviProjetModel::TABLENAME
                                . ' , ' . FtaActionSiteModel::TABLENAME . ' , ' . FtaModel::TABLENAME
                                . ' , ' . IntranetDroitsAccesModel::TABLENAME . ' , ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ' IS NOT NULL'
                                . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_FTA_WORKFLOW
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_PRODUCTION
                                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' IN (' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME . ')'
                                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=' . FtaSuiviProjetModel::SIGNATURE_VALIDATION_SUIVI_PROJET_FALSE
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser                                                    // Nous recuperons l'identifiant de l'utilisateur connecté
                                . ' AND ' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . $paramIdFtaEtat                                                             // Nous recuperons l'identifiant de l'etat de la Fta
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramRole    // Nous recuperons le type de role pour l'utilisateur
                                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ')'
                                /**
                                 * Ticket 49823 en 3.1 activation/désactivation d'un workflow
                                 */
//                                . FtaWorkflowModel::checkActifWorkflowSQL()
                );
                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $cheackIdFta = in_array($rows[FtaModel::KEYNAME], $idFtaEffectue);
                        if (!$cheackIdFta) {
                            $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValidePrecedent($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME], $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                            /**
                             * En cas d'oublier des chef de projet qui aurait créé une fta sans validé les informations de base
                             */
                            if (FtaRoleModel::isGestionnaire($paramRole)) {
                                $chefProjet = ($tauxDeValidadation == '0');
                                if ($tauxDeValidadation <> '0' OR $chefProjet == TRUE) {
                                    $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
//                                    $compteur++;
//                                    if ($compteur == ModuleConfig::VALUE_MAX_PAR_PAGE) {
//                                        break;
//                                    }
                                }
                            } elseif ($tauxDeValidadation == '1') {
                                $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
//                                $compteur++;
//                                if ($compteur == ModuleConfig::VALUE_MAX_PAR_PAGE) {
//                                    break;
//                                }
                            }
                        }
                    }
                }
                $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaModel::KEYNAME
                                . ' FROM ' . FtaModel::TABLENAME
                                . ' WHERE ( ' . '0'
                                . ' ' . FtaModel::addIdFta($idFtaEffectue) . ')');


                break;


            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                //Récupération de la liste fta pour le role concernés 
                /*
                 * On obtient les fta à vérifié dont tous les chapitres sont validés
                 */
                $arrayTmp = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . ',' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                . ' FROM ' . FtaWorkflowModel::TABLENAME . ', ' . FtaWorkflowStructureModel::TABLENAME
                                . ', ' . FtaSuiviProjetModel::TABLENAME
                                . ' , ' . FtaActionSiteModel::TABLENAME . ' , ' . FtaModel::TABLENAME
                                . ' , ' . IntranetDroitsAccesModel::TABLENAME . ' , ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ' IS NOT NULL'
                                . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_PRODUCTION
                                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' IN (' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME . ')'
                                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '<>' . FtaSuiviProjetModel::SIGNATURE_VALIDATION_SUIVI_PROJET_FALSE
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser                                                  // Nous recuperons l'identifiant de l'utilisateur connecté
                                . ' AND ' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . $paramIdFtaEtat                                                           // Nous recuperons l'identifiant de l'etat de la Fta
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramRole // Nous recuperons le type de role pour l'utilisateur
                                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ')'
                                /**
                                 * Ticket 49823 en 3.1 activation/désactivation d'un workflow
                                 */
//                                . FtaWorkflowModel::checkActifWorkflowSQL()
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $cheackIdFta = in_array($rows[FtaModel::KEYNAME], $idFtaEffectue);
                        if (!$cheackIdFta) {
                            $tauxDeValidadation = FtaProcessusModel::getValideIdFtaByRoleWorkflowProcessus($rows[FtaModel::KEYNAME], $paramRole, $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                            if ($tauxDeValidadation == '1') {
                                $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
//                                $compteur++;
//                                if ($compteur == ModuleConfig::VALUE_MAX_PAR_PAGE) {
//                                    break;
//                                }
                            }
                        }
                    }
                }
                $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaModel::KEYNAME
                                . ' FROM ' . FtaModel::TABLENAME
                                . ' WHERE ( ' . '0'
                                . ' ' . FtaModel::addIdFta($idFtaEffectue) . ')');
                break;


            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL: //Toutes les fiches de l'état sélectionné
                if ($paramFtaModification) {
                    $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT DISTINCT ' . FtaModel::KEYNAME
                                    . ' FROM ' . FtaModel::TABLENAME . ',' . IntranetDroitsAccesModel::TABLENAME
                                    . ',' . FtaWorkflowModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                                    . ' , ' . FtaActionSiteModel::TABLENAME
                                    . ' WHERE ' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . $paramIdFtaEtat   //Liaison
                                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                                    . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                                    . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                                    . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                    . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                    . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                                    . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                    . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ')'
                                    . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE
                                    . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_PRODUCTION
                                    . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_FTA_WORKFLOW
                                    . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                                    . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                    . ' IN (' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME . ')'
                                    /**
                                     * Ticket 49823 en 3.1 activation/désactivation d'un workflow
                                     */
//                                    . ' AND ' . FtaWorkflowModel::FIELDNAME_WORKFLOW_ACTIF . '=' . FtaWorkflowModel::WORKFLOW_ACTIF_TRUE
                    );
                } else {
                    $isSiteDeProd = GeoModel::isLieuGeoSiteDeProduction($paramLieuGeo);
                    if ($isSiteDeProd) {
                        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT DISTINCT ' . FtaModel::KEYNAME
                                        . ' FROM ' . FtaModel::TABLENAME
                                        . ' WHERE ' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . $paramIdFtaEtat   //Liaison
                                        . ' AND  ' . FtaModel::FIELDNAME_SITE_PRODUCTION . '=' . $paramLieuGeo   //Liaison
                        );
                    } else {
                        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT DISTINCT ' . FtaModel::KEYNAME
                                        . ' FROM ' . FtaModel::TABLENAME
                                        . ' WHERE ' . FtaModel::FIELDNAME_ID_FTA_ETAT . '=' . $paramIdFtaEtat   //Liaison
                        );
                    }
                }

                break;
        }

        return $array;
    }

    /**
     * On récupère le nom de l'état par l'id
     * @param int $paramIdEtat
     * @return string
     */
    public static function getNameEtatByIdEtat($paramIdEtat) {
        $arrayIdEtat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                        . ' FROM ' . FtaEtatModel::TABLENAME
                        . ' WHERE ' . FtaEtatModel::KEYNAME . '=' . $paramIdEtat
        );


        return $arrayIdEtat[0][FtaEtatModel::FIELDNAME_NOM_FTA_ETAT];
    }

    /**
     * On récupère l'abréviation de l'état par l'id
     * @param int $paramIdEtat
     * @return string
     */
    public static function getAbreviationEtatByIdEtat($paramIdEtat) {
        $arrayIdEtat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaEtatModel::FIELDNAME_ABREVIATION
                        . ' FROM ' . FtaEtatModel::TABLENAME
                        . ' WHERE ' . FtaEtatModel::KEYNAME . '=' . $paramIdEtat
        );


        return $arrayIdEtat[0][FtaEtatModel::FIELDNAME_ABREVIATION];
    }

}

?>
