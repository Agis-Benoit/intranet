<?php

/*
 * Copyright (C) 2015 bs4300280
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of TableauFicheView
 * @author bs4300280
 */
class TableauFicheView {

    const DEFAULT_RESULT_LIMIT_BY_PAGE = "1000";
    const HTML_CELL_WIDTH_C1 = " width=15%";
    const HTML_CELL_WIDTH_C3 = " width=4%";
    const HTML_CELL_WIDTH_SELECTION = " width=1%";
    const HTML_CELL_BGCOLOR_MODIFY = "";
    const HTML_CELL_BGCOLOR_VALIDATE = " bgcolor=#AFFF5A";
    const HTML_CELL_BGCOLOR_DEFAULT = " bgcolor=#A5A5CE";
    const HTML_CELL_BGCOLOR_ARCADIA_ATTENTE = " bgcolor=#99FFFF";
    const HTML_CELL_BGCOLOR_ARCADIA_ERREUR = " bgcolor=#FF9999";
    const HTML_CELL_BGCOLOR_ARCADIA_OK = " bgcolor=#99FF99";
    const HTML_TEXT_COLOR_DIN = " color=#808080";
    const HTML_IMAGE_ECHEANCE_EXPIRED = "../lib/images/exclamation.png";
    CONST HTML_CLASS_RED = " class=couleur_rouge";

    static public function getHtmlIconEcheance() {
        return "<img src=" . self::HTML_IMAGE_ECHEANCE_EXPIRED . " title='" . UserInterfaceMessage::FR_WARNING_ECHEANCE_DEPASSEE . "' width=30 height=27 border=0 />";
    }

    static public function getHtmlTable($paramIdFta, $paramChoix, $paramResultLimitByPage = self::DEFAULT_RESULT_LIMIT_BY_PAGE, $paramOrderCommon = NULL) {

        /*
         * Déclaration des variables locales
         */
        $largeur_html_C1 = self::HTML_CELL_WIDTH_C1; // largeur cellule type
        $largeur_html_C3 = self::HTML_CELL_WIDTH_C3; // largeur cellule type
        $compteur_ligne = 1;
        $selection_width = self::HTML_CELL_WIDTH_SELECTION;
        $lien = "";
        $tableau_fiches = "<table class=titre width=100% border=0>"
                . "<tr class=titre_principal><td></td><td>"
        ;
        $synthese_action = "all";


        /*
         * Initilisation
         */
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $idFtaRole = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($idUser);
        $ftaModel = new FtaModel($paramIdFta);

        //Chargement manuel des données pour optimiser les performances
        $abreviation_fta_etat = $ftaModel->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();
        $LIBELLE = $ftaModel->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
        $NB_UNIT_ELEM = $ftaModel->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue();
        $Poids_ELEM = $ftaModel->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
        $suffixe_agrologic_fta = $ftaModel->getModelClassificationRacourcis()->getNameRaccourcisClassif();
        $designation_commerciale_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
        $id_dossier_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue();
        $id_version_dossier_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
        $code_article_ldc = $ftaModel->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
        $dateEcheanceFtatmp = $ftaModel->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue();
        $createur_nom = $ftaModel->getModelCreateur()->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $createur_prenom = $ftaModel->getModelCreateur()->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $workflowName = $ftaModel->getModelFtaWorkflow()->getDataField(FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW)->getFieldValue();
        $idWorkflowFtaEncours = $ftaModel->getModelFtaWorkflow()->getKeyValue();
        $nomSiteProduction = $ftaModel->getModelSiteProduction()->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue();
        $idclassification = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        $listeIdFtaRole = $ftaModel->getDataField(FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE)->getFieldValue();
        $idSiteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();
        $idFtaEtat = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();

        /**
         * Changment du format de date en Fr
         */
        $dateEcheanceFta = FtaController::changementDuFormatDeDateFR($dateEcheanceFtatmp);


        /**
         * On obtient IdintranetAction du site de production
         */
        $idIntranetActionsSiteDeProduction = FtaActionSiteModel::getArrayIdIntranetActionByWorkflowAndSiteDeProduction($idWorkflowFtaEncours, $idSiteDeProduction);
        /**
         * On verifie si selon le workflow  et site de production en cours l'utilisateur connecté à les droits d'accès.
         * Puisqu'un utilisateur ne doit pas avoir accès aux boutons :
         * historique, transition, retirer, duplication et pourcentage d'avancement
         * si il n'a pas les accès aux site de production.
         */
        $checkAccesButtonBySiteProd = IntranetActionsModel::isAccessFtaActionByIdUserFtaWorkflowAndSiteDeProduction($idUser, $idWorkflowFtaEncours, $idIntranetActionsSiteDeProduction);


        /**
         * Donne accès aux bouton de transition 
         * pour les utilisateur se trouvant en fin de parcours de l'espace de travail
         */
        $accesTransitionButton = FtaTransitionModel::isAccesTransitionButton($idFtaRole, $idWorkflowFtaEncours);

        /*
         * Attribution des couleurs de fonds suivant l'état de la FTA
         */
        $bgcolor = self::getHtmlCellBgColor($abreviation_fta_etat);
        $bgcolorArcadia = self::getHtmlCellBgColorArcadia($paramIdFta, $bgcolor);

        $tauxRound = FtaSuiviProjetModel::getPourcentageFtaTauxValidation($ftaModel);

        /**
         * Lien vers l'historique de la Fta
         */
        $lienHistorique = self::getHtmlLinkHistorique($abreviation_fta_etat, $paramIdFta, FtaRoleModel::ID_FTA_ROLE_COMMUN, $synthese_action, $tauxRound, $checkAccesButtonBySiteProd, $idFtaEtat);

        /**
         * Gestion des icones en fonction des délais
         */
        $bgcolor_header = self::getHtmlBgColorIconHeader($abreviation_fta_etat, $paramIdFta);
        $icon_header = self::getHtmlIconEcheanceByEtatAndFta($abreviation_fta_etat, $paramIdFta);

        /**
         * Bouton d'accès au détail de la FTA
         */
        $lien .= self::getHtmlLinkModify($abreviation_fta_etat, $paramIdFta, $synthese_action, $idFtaEtat, $checkAccesButtonBySiteProd);


        /**
         * Historique de modification
         */
        $lien .= self::getHtmlLinkHistoriqueModfify($abreviation_fta_etat, $paramIdFta, $synthese_action, $idFtaEtat);
        /**
         * Bouton d'accès au rendu PDF de la FTA
         */
        $lien .= self::getHtmlLinkPDF($abreviation_fta_etat, $paramIdFta, $idWorkflowFtaEncours);

        /**
         * Bouton d'accès à la transition
         */
        $lien .= self::getHmlLinkTransiter($paramIdFta, $idFtaRole, $abreviation_fta_etat, $checkAccesButtonBySiteProd
                        , $accesTransitionButton, $synthese_action, $tauxRound);

        /**
         * Bouton d'accès pour retirer une FTA
         */
        if (FtaRoleModel::isGestionnaire($idFtaRole) AND $checkAccesButtonBySiteProd AND $abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE) {
            $lien .= self::getHtmlLinkRemoveFta($paramIdFta);
            $javascript.=self::getJavascriptLinkRemoveFta($paramIdFta, $idFtaRole, $synthese_action);
        }

        /**
         * Bouton d'accès pour dupliquer  une FTA
         */
        if (FtaRoleModel::isGestionnaire($idFtaRole) AND $checkAccesButtonBySiteProd) {
            $lien .= self::getHtmlLinkDuplicateFta($paramIdFta, $idFtaRole);
        }

        //Désignation commerciale
        $din = self::getStringDINCompacted($designation_commerciale_fta, $LIBELLE, $NB_UNIT_ELEM, $Poids_ELEM);

        /*
         * Noms des services dans lequel la Fta se trouve
         */
        $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);


//        switch (TRUE) {
//            /**
//             * Si la FTA est en modification et que l'utilisateur n'est pas autorisé à accéder aux boutons.
//             */
//            case (
//            $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION AND $checkAccesButton != FALSE
//            ):
//                $service = "";
//                break;
//
//            /**
//             * Si la FTA est en modification et que l'utilisateur est autorisé à accéder aux boutons.
//             */
//            case (
//            $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION AND $checkAccesButton != TRUE
//            ):
//                $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
//                break;
//            /**
//             * Sinon:
//             */
//            default:
//                $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
//        }

        /**
         * Calssification
         */
        if ($idclassification) {
            $classification = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idclassification, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
        }

        //Nom de l'assistante de projet responsable:
        $createur_link = "\"Géré par $createur_prenom $createur_nom\"";

        $tableau_fiches.= "<tr class=contenu>
                              <td $bgcolor_header " . $selection_width . " > $icon_header $selection</td>
                              ";
        $tableau_fiches.= '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '<br>(' . $workflowName . ')</td>'//Site
                . '<td ' . $bgcolor . ' width=3%>' . $classification . '</td>'//Client
                . '<td ' . $bgcolor . ' width=3%>' . $suffixe_agrologic_fta . '</td>'; // Raccourcie Class.
        $tableau_fiches.="<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"
                . "<td $bgcolor width=3%>" . $id_dossier_fta . "v" . $id_version_dossier_fta . "</td>";

        $tableau_fiches.="<td $bgcolorArcadia width=\"1%\"> <b><font size=\"2\" color=\"#0000FF\">" . $code_article_ldc . "</font></b></td>";
        if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            $tableau_fiches.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
        } else {
            $tableau_fiches.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
        }
        $tableau_fiches .= '<td ' . $bgcolor . ' width=5% align=center >' . $lienHistorique . '</td>'//% Avancement FTA
                . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                . '<td ' . $bgcolor . ' width=8%' . ' align=center >' . $lien . '</td>'; // Actions
        $tableau_fiches.="</tr>";
        $compteur_ligne++;
//        }//fin tant que tableau_origine
        $tableau_fiches = $javascript . $tableau_fiches . "</table>";

        //Ajoute de la fonction de traitement de masse
        if ($traitementDeMasse) {
            $liste_action_groupe = FtaTransitionModel::getListeFtaGrouper($abreviation_fta_etat);

            $tableau_fiches.= '&nbsp;
            <img src = ../lib/images/fleche_gauche_et_haut.png width = 38 height = 22 border = 0 />
            <i>Transitions groupées</i>:
            ' . $liste_action_groupe . '
            <input type = \'text\' name=\'subject\' size=\'20\' />
            <input type=image src=images/transiter.png width=20 height=20 />
            <input type=hidden name=action value=transition_groupe>
                         ';
        }

        return $tableau_fiches;
    }

    /**
     * Lien vers l'historique de la Fta
     * @param string $paramAbreviationFtaEtat
     * @param int $paramIdFta
     * @param int $paramIdFtaRole
     * @param string $paramSyntheseAction
     * @param string $paramTauxRound
     * @param boolean $paramCheckAccesButton
     * @param int $paramIdFtaEtat
     * @return string
     */
    static public function getHtmlLinkHistorique($paramAbreviationFtaEtat, $paramIdFta, $paramIdFtaRole, $paramSyntheseAction, $paramTauxRound, $paramCheckAccesButton, $paramIdFtaEtat) {
        $lienHistorique = NULL;

        /**
         * Lien vers l'historique de la Fta
         */
        if ($paramCheckAccesButton AND ( Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION))) {
            $lienHistorique = ' <a href=historique-' . $paramIdFta
                    . '-1'
                    . '-' . $paramIdFtaEtat
                    . '-' . $paramAbreviationFtaEtat
                    . '-' . $paramIdFtaRole
                    . '-' . $paramSyntheseAction
                    . '-1'
                    . '.html >' . $paramTauxRound . '</a>';
        } else {
            $lienHistorique = $paramTauxRound;
        }
        return $lienHistorique;
    }

    /**
     * Détermine le font de couleur suivant l'état de la Fta
     * @param string $paramAbreviationFtaEtat
     * @return string
     */
    static public function getHtmlCellBgColor($paramAbreviationFtaEtat) {

        $bgcolor = self::HTML_CELL_BGCOLOR_DEFAULT;
        /*
         * Attribution des couleurs de fonds suivant l'état de la FTA
         */
        switch ($paramAbreviationFtaEtat) {
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION:
                $bgcolor = self::HTML_CELL_BGCOLOR_MODIFY;
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE:
                $bgcolor = self::HTML_CELL_BGCOLOR_VALIDATE;
                break;
        }
        return $bgcolor;
    }

    /**
     * Détermine le font de couleur suivant le code de retour de la transaction vers Arcadia
     * @param string $paramAbreviationFtaEtat
     * @return string
     */
    static public function getHtmlCellBgColorArcadia($paramIdFta, $paramBgColor) {
        $bgcolorArcadia = $paramBgColor;

        $keyValue = Fta2ArcadiaTransactionModel::checkIdArcadiaTransaction($paramIdFta);
        if ($keyValue) {
            $Fta2ArcadiaTransactionModel = new Fta2ArcadiaTransactionModel($keyValue);
            $codeReply = $Fta2ArcadiaTransactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_CODE_REPLY)->getFieldValue();
            switch ($codeReply) {
                case Fta2ArcadiaTransactionModel::CONSOMME:
                    $bgcolorArcadia = TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_OK;

                    break;
                case Fta2ArcadiaTransactionModel::REJET_TASKS:
                    $bgcolorArcadia = TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ERREUR;

                    break;
                case Fta2ArcadiaTransactionModel::REFUSE:
                    $bgcolorArcadia = TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ERREUR;

                    break;
                case Fta2ArcadiaTransactionModel::CLOTURE_AUTO:
                    $bgcolorArcadia = TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ERREUR;
                    break;
                default :
                    $bgcolorArcadia = TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ATTENTE;

                    break;
            }
        }
        return $bgcolorArcadia;
    }

    static private function getHtmlBgColorIconHeader($paramAbreviationFtaEtat, $paramIdFta) {
        $return = "";
        if ($paramAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            switch (FtaProcessusDelaiModel::getFtaDelaiAvancementStatus($paramIdFta)) {
                case FtaProcessusDelaiModel::VALUE_DELAI_AVANCEMENT_ONE_PROCESSUS_EXPIRED:
                    $return = self::getHtmlCellBgColor($paramAbreviationFtaEtat);
                    break;
                case FtaProcessusDelaiModel::VALUE_DELAI_AVANCEMENT_ALL_FTA_EXPIRED:
                    $return = self::HTML_CLASS_RED;
                    break;
            }
        }
        return $return;
    }

    static private function getHtmlIconEcheanceByEtatAndFta($paramAbreviationFtaEtat, $paramIdFta) {
        $iconHeader = "";
        if ($paramAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            switch (FtaProcessusDelaiModel::getFtaDelaiAvancementStatus($paramIdFta)) {
                case FtaProcessusDelaiModel::VALUE_DELAI_AVANCEMENT_ONE_PROCESSUS_EXPIRED:
                case FtaProcessusDelaiModel::VALUE_DELAI_AVANCEMENT_ALL_FTA_EXPIRED:
                    $iconHeader = self::getHtmlIconEcheance();
                    break;
            }
        }
        return $iconHeader;
    }

    /**
     * Historique de modification
     * @param type $paramAbreviationFtaEtat
     * @param type $paramIdFta
     * @param type $paramSyntheseAction
     * @param type $paramIdFtaEtat
     * @param type $paramIdFtaRole
     * @return string
     */
    static public function getHtmlLinkHistoriqueModfify($paramAbreviationFtaEtat, $paramIdFta, $paramSyntheseAction, $paramIdFtaEtat, $paramIdFtaRole = FtaRoleModel::ID_FTA_ROLE_COMMUN, $paramTaille = NULL, $paramText = NULL) {
        if (!$paramTaille) {
            $paramTaille = "30";
        }

        $lien .=' <a href=modification_fta_historique.php?' . FtaModel::KEYNAME . '=' . $paramIdFta
                . '&' . FtaEtatModel::KEYNAME . '=' . $paramIdFtaEtat
                . '&' . FtaEtatModel::FIELDNAME_ABREVIATION . '=' . $paramAbreviationFtaEtat
                . '&' . FtaRoleModel::KEYNAME . '=' . $paramIdFtaRole
                . '&synthese_action=' . $paramSyntheseAction
                . ' ><img src=./images/dossier.png alt=\'\' title=\'Historique des modifications Fta\' width=\'' . $paramTaille . '\' height=\'' . $paramTaille . '\' border=\'0\' /> ' . $paramText . ' </a>';



        return $lien;
    }

    static private function getHtmlLinkModify($paramAbreviationFtaEtat, $paramIdFta, $paramSyntheseAction, $paramIdFtaEtat, $paramAccesBouton, $paramIdFtaRole = FtaRoleModel::ID_FTA_ROLE_COMMUN) {
        $lien = "";
        if (
                (Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION) and $paramAccesBouton)
                or ( Acl::getValueAccesRights(Acl::ACL_FTA_CONSULTATION) and $paramAbreviationFtaEtat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION )
        ) {

            $lien .= '<a '
                    . 'href=modification_fiche.php'
                    . '?id_fta=' . $paramIdFta
                    . '&synthese_action=' . $paramSyntheseAction
                    . '&comeback=1'
                    . '&id_fta_etat=' . $paramIdFtaEtat
                    . '&abreviation_fta_etat=' . $paramAbreviationFtaEtat
                    . '&id_fta_role=' . $paramIdFtaRole
                    . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                    . '</a>'
            ;
        }

        return $lien;
    }

    static public function getHtmlLinkPDF($paramAbreviationFtaEtat, $paramIdFta, $paramIdWorkflow, $paramTaille = NULL, $paramName = NULL) {

        $lien = "";
        if (
                (Acl::getValueAccesRights(Acl::ACL_FTA_IMPRESSION) and ( $paramAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE ))or ( $paramIdWorkflow == FtaWorkflowModel::ID_WORKFLOW_PRESENTATION)
        ) {
            if (!$paramTaille) {
                $paramTaille = "30";
            }

            $lien .= "  "
                    . "<a "
                    . "href=pdf.php?id_fta=" . $paramIdFta . "&mode=client "
                    . "target=_blank"
                    . "><img src=./images/pdf.png alt=\"\" title=\"Exportation PDF\" width=\"$paramTaille\" height=\"$paramTaille\" border=\"0\" /> $paramName"
                    . "</a>"
            ;
        }
        return $lien;
    }

    static private function isUserRightsLinkTransiter($paramIdFtaRole, $paramAbreviationFtaEtat, $paramCheckAccesButton
    , $paramAccesTransitionButton, $paramSyntheseAction, $paramTauxRound) {
        $return = FALSE;

        switch (TRUE) {

            /**
             * Dans le cas où on a les droits de modification, 
             * que le soit chef de projet,
             * que la Fta en cours de modification soit dans un pourcentage d'avancement effectués,
             * que l'on est les droits sur le site de production
             * on accède au boutton de transition
             */
            case (
            Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION)
            AND ( FtaRoleModel::isGestionnaire($paramIdFtaRole) )
            AND ( $paramAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
            AND $paramSyntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL
            AND $paramCheckAccesButton

            )
            ) :
            /**
             * Dans le cas où on a les droits de modification, 
             * que le soit chef de projet,
             * que la Fta en cours est dans un état différents que modification,
             * que l'on est les droits sur le site de production
             * on accède au boutton de transition
             */
            case (
            Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION)
            AND ( FtaRoleModel::isGestionnaire($paramIdFtaRole) )
            AND $paramAbreviationFtaEtat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
            AND $paramCheckAccesButton

            ) :
            /**
             * Dans le cas où on a les droits de modification, 
             * que l'on est accès aux bouton de transition,
             * que la Fta en cours de modification soit à 100%,
             * que l'on est les droits sur le site de production
             * on accède au boutton de transition
             */
            case (
            Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION)
            AND $paramAccesTransitionButton == TRUE
            AND ( $paramAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION)
            AND $paramTauxRound == FtaProcessusDelaiModel::TAUX_100
            AND $paramCheckAccesButton

            ) :
            /**
             * Dans le cas où on a les droits de modification, 
             * que l'on est accès aux bouton de transition,
             * que la Fta soit valider,
             * que l'on est les droits sur le site de production
             * on accède au boutton de transition
             */
            case (
            Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION)
//            AND $paramAccesTransitionButton == TRUE
            AND ( $paramAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE)
            AND $paramCheckAccesButton

            ) :

                $return = TRUE;
                break;
        }
        return $return;
    }

    public static function getHmlLinkTransiter($paramIdFta, $paramIdFtaRole, $paramAbreviationFtaEtat, $paramCheckAccesButton
    , $paramAccesTransitionButton, $paramSyntheseAction, $paramTauxRound, $paramTaille = NULL, $paramName = NULL) {
        $return = "";
        if (
                self::isUserRightsLinkTransiter($paramIdFtaRole, $paramAbreviationFtaEtat, $paramCheckAccesButton
                        , $paramAccesTransitionButton, $paramSyntheseAction, $paramTauxRound)
        ) {

            if (!$paramTaille) {
                $paramTaille = "30";
            }
            $return = '<a '
                    . 'href=transiter.php'
                    . '?id_fta=' . $paramIdFta
                    . '&id_fta_role=' . $paramIdFtaRole
                    . '&comeback=1'
                    . '><img src=./images/transiter.png alt=\'\' title=\'Transiter\' width=\'' . $paramTaille . '\' height=\'' . $paramTaille . '\' border=\'0\' />'
                    . $paramName . '</a>'

            ;
        }
        return $return;
    }

    static private function getHtmlLinkRemoveFta($paramIdFta) {
        $lien = '<a '
                . 'href=# '
                . 'onClick=confirmation_correction_fta' . $paramIdFta . '(); '
                . '/>'
                . '<img src=../lib/images/supprimer.png alt=\'Retirer cette FTA\' width=\'25\' height=\'25\' border=\'0\' />'
                . '</a>'
        ;
        return $lien;
    }

    static private function getJavascriptLinkRemoveFta($paramIdFta, $idFtaRole, $paramSyntheseAction) {
        $return = '<SCRIPT LANGUAGE=JavaScript>'
                . 'function confirmation_correction_fta' . $paramIdFta . '()'
                . '{'
                . 'if(confirm(\'Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.\'))'
                . '{'
                . 'location.href =\'transiter.php?id_fta=' . $paramIdFta
                . '&id_fta_role=' . $idFtaRole
                . '&synthese_action=' . $paramSyntheseAction
                . '&action=correction'
                . '&demande_abreviation_fta_transition=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE . '\''
                . '}'
                . 'else{}'
                . '}'
                . '</SCRIPT>'
        ;
        return $return;
    }

    static private function getHtmlLinkDuplicateFta($paramIdFta, $idFtaRole) {
        $lien = '<a '
                . 'href=creer_fiche.php'
                . '?action=dupliquer_fiche'
                . '&id_fta=' . $paramIdFta
                . '&id_fta_role=' . $idFtaRole
                . '&comeback=1'
                . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                . '</a>'
        ;
        return $lien;
    }

    static public function getStringDINCompacted($paramDesignationCommercialeFta, $paramLibelle, $paramNbUnitElem, $PoidsElem) {
        $din = "";

        if ($paramLibelle) {
            $din = $paramLibelle;
        } else {
            if (strlen($paramDesignationCommercialeFta) > 55) {
                $paramDesignationCommercialeFta = substr($paramDesignationCommercialeFta, 0, 52) . "...";
            }
            $din = "<font size=\"1\" " . self::HTML_TEXT_COLOR_DIN . ">"
                    . "<i>" . $paramDesignationCommercialeFta . "(" . $paramNbUnitElem . " x " . $PoidsElem . "Kg)</i>"
                    . "</font>"
            ;
        }

        return $din;
    }

}
