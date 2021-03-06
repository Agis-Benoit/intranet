<?php

/**
 * Page d'accueil
 * 
 * @author Franckwastaken
 */
class AccueilFta {

    protected static $abreviationFtaEtat;
    protected static $arrayFtaEtat;
    protected static $arrayFtaRole;
    protected static $arrayFtaWorkflow;
    protected static $arrayIdFtaAndIdWorkflow;
    protected static $arrayIdFtaAndIdWorkflowEncours;
    protected static $arrayIdFtaByUserAndWorkflow;
    protected static $arrayIdFtaByUserAndWorkflowEncours;
    protected static $arraNameSiteByWorkflow;
    protected static $idFtaRole;
    protected static $idFtaEtat;
    protected static $idUser;
    protected static $lieuGeo;
    protected static $nombreFta;
    protected static $nombreFtaEncours;
    protected static $orderBy;
    protected static $syntheseAction;
    protected static $ftaModification;
    protected static $ftaConsultation;
    protected static $ftaImpression;
    protected static $numeroDePageCourante;

    /**
     * Initialisation des données de la page d'accueil
     * @param type $id_user
     * @param type $idFtaEtat
     * @param type $abreviationFtaEtat
     * @param type $syntheseAction
     * @param type $IdFtaRole
     * @param type $OrderBy
     */
    public static function initAccueil($id_user, $idFtaEtat, $abreviationFtaEtat, $syntheseAction, $IdFtaRole, $OrderBy, $debut, $numeroDePageCourante, $paramLieuGeo) {

        self::$idUser = $id_user;
        self::$lieuGeo = $paramLieuGeo;
        self::$abreviationFtaEtat = $abreviationFtaEtat;
        self::$syntheseAction = $syntheseAction;
        self::$idFtaRole = $IdFtaRole;
        self::$idFtaEtat = $idFtaEtat;
        self::$orderBy = $OrderBy;
        self::$numeroDePageCourante = $numeroDePageCourante;

        /*
         * On recherche les roles auxquelles l'utilisateur à les droits d'acces
         */

        self::$arrayFtaRole = FtaRoleModel::getArrayIdFtaRoleByIdUser(self::$idUser);

        /**
         * Modification
         */
        self::$ftaModification = IntranetDroitsAccesModel::getFtaModification(self::$idUser);

        /**
         * Consultation
         */
        self::$ftaConsultation = IntranetDroitsAccesModel::getFtaConsultation(self::$idUser);

        /**
         * Impression
         */
        self::$ftaImpression = IntranetDroitsAccesModel::getFtaImpression(self::$idUser);
        /*
         * Selon le role  nous cherchons ces etats. 
         * 
         */
        self::$arrayFtaEtat = FtaEtatModel::getFtaEtatAndNameByRole(self::$idFtaRole, self::$ftaModification);

        /*
         * $arrayIdFtaAndIdWorkflow[1] sont les id_fta
         * $arrayIdFtaAndIdWorkflow[2] sont les nom des workflows correspondant aux  id_fta
         */
        if (self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS or self::$idFtaEtat <> FtaEtatModel::ID_VALUE_MODIFICATION) {
            self::$arrayIdFtaAndIdWorkflow = FtaEtatModel::getIdFtaByEtatAvancement(self::$syntheseAction, self::$idFtaRole, self::$idUser, self::$idFtaEtat, self::$ftaModification, self::$lieuGeo);

            self::$arrayIdFtaByUserAndWorkflow = UserModel::getIdFtaByUserAndWorkflow(self::$arrayIdFtaAndIdWorkflow, self::$orderBy, $debut, self::$ftaModification);

            self::$arraNameSiteByWorkflow = IntranetActionsModel::getNameSiteByWorkflow(self::$idUser, self::$arrayIdFtaByUserAndWorkflow['3']);

            self::$nombreFta = self::$arrayIdFtaByUserAndWorkflow['2'];
        } else {
            self::$arrayIdFtaAndIdWorkflow = FtaEtatModel::getIdFtaByEtatAvancement(self::$syntheseAction, self::$idFtaRole, self::$idUser, self::$idFtaEtat, self::$ftaModification, self::$lieuGeo);
            self::$arrayIdFtaAndIdWorkflowEncours = FtaEtatModel::getIdFtaByEtatAvancement(FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS, self::$idFtaRole, self::$idUser, self::$idFtaEtat, self::$ftaModification, self::$lieuGeo);

            self::$arrayIdFtaByUserAndWorkflow = UserModel::getIdFtaByUserAndWorkflow(self::$arrayIdFtaAndIdWorkflow, self::$orderBy, $debut, self::$ftaModification);
            self::$arrayIdFtaByUserAndWorkflowEncours = UserModel::getIdFtaByUserAndWorkflow(self::$arrayIdFtaAndIdWorkflowEncours, self::$orderBy, $debut, self::$ftaModification);

            self::$arraNameSiteByWorkflow = IntranetActionsModel::getNameSiteByWorkflow(self::$idUser, self::$arrayIdFtaByUserAndWorkflow['3']);

            self::$nombreFta = self::$arrayIdFtaByUserAndWorkflow['2'];
            self::$nombreFtaEncours = self::$arrayIdFtaByUserAndWorkflowEncours['2'];
        }
    }

    public static function getTableauSythese() {

        $tableau_synthese = AccueilFta::getHtmlTableauSythese(self::$arrayFtaRole, self::$arrayFtaEtat, self::$abreviationFtaEtat, self::$idFtaRole, self::$syntheseAction);
//        $tableau_syntheseWorkflow = AccueilFta::getHtmlTableauSytheseWorkflow(self::$arrayIdFtaByUserAndWorkflow['3'], self::$arraNameSiteByWorkflow);
//        $tableau_synthese.=$tableau_syntheseWorkflow;
        return $tableau_synthese;
    }

    /**
     * Fonction de pagination des résultats
     *
     * Retourne le code HTML des liens de pagination
     *    
     * @param integer nombre de résultats par page
     * @param integer numéro de la page courante
     * @param integer nombre de pages avant la page courante
     * @param integer nombre de pages après la page courante
     * @param integer afficher le lien vers la première page (1=oui / 0=non)
     * @param integer afficher le lien vers la dernière page (1=oui / 0=non)
     * @return string code HTML des liens de pagination
     * */
    public static function paginer($nb_results_p_page, $numero_page_courante, $nb_avant, $nb_apres, $premiere, $derniere) {
// Initialisation de la variable a retourner
        $resultat = '';

// nombre total de pages
        $nb_pages = ceil(self::$nombreFta / $nb_results_p_page);
// nombre de pages avant
        $avant = $numero_page_courante > ($nb_avant + 1) ? $nb_avant : $numero_page_courante - 1;
// nombre de pages apres
        $apres = $numero_page_courante <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $numero_page_courante;

// premiere page
        if ($premiere && $numero_page_courante - $avant > 1) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=1'
                    . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abreviationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction
                    . '&order_common=' . self::$orderBy
                    . '" title="Première page">&laquo;&laquo;</a>&nbsp;';

            /**
             * Version avec le rewrite
             */
//            $resultat .= '<a href="index'
//                    . '-' . self::$idFtaEtat
//                    . '-' . self::$abrevationFtaEtat
//                    . '-' . self::$idFtaRole
//                    . '-' . self::$syntheseAction
//                    . '&order_common=' . self::$orderBy
//                    . '&numeroPage=1.html" title="Première page">&laquo;&laquo;</a>&nbsp;';
        }

// page precedente
        if ($numero_page_courante > 1) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=' . ($numero_page_courante - 1)
                    . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abreviationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction
                    . '&order_common=' . self::$orderBy
                    . '" title="Page précédente ' . ($numero_page_courante - 1) . '">&laquo;</a>&nbsp;';
            /**
             * Version avec le rewrite
             */
//            $resultat .= '<a href="index'
//                    . '-' . self::$idFtaEtat
//                    . '-' . self::$abrevationFtaEtat
//                    . '-' . self::$idFtaRole
//                    . '-' . self::$syntheseAction
//                    . '&order_common=' . self::$orderBy
//                    . '&numeroPage=' . ($numero_page_courante - 1) . '.html" title="Page précédente ' . ($numero_page_courante - 1) . '">&laquo;</a>&nbsp;';
        }

// affichage des numeros de page
        for ($i = $numero_page_courante - $avant; $i <= $numero_page_courante + $apres; $i++) {
// page courante
            if ($i == $numero_page_courante) {
                $resultat .= '&nbsp;[<strong>' . $i . '</strong>]&nbsp;';
            } else {
                $resultat .= '&nbsp;[<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) . '?numeroPage=' . $i
                        . '&id_fta_etat=' . self::$idFtaEtat
                        . '&nom_fta_etat=' . self::$abreviationFtaEtat
                        . '&id_fta_role=' . self::$idFtaRole
                        . '&synthese_action=' . self::$syntheseAction
                        . '&order_common=' . self::$orderBy
                        . '" title="Consulter la page ' . $i . '">' . $i . '</a>]&nbsp;';
                /**
                 * Version avec le rewrite
                 */
//                $resultat .= '&nbsp;[<a href="index'
//                        . '-' . self::$idFtaEtat
//                        . '-' . self::$abrevationFtaEtat
//                        . '-' . self::$idFtaRole
//                        . '-' . self::$syntheseAction
//                        . '&order_common=' . self::$orderBy
//                        . '&numeroPage=' . $i . '.html " title="Consulter la page ' . $i . '">' . $i . '</a>]&nbsp;';
            }
        }

// page suivante
        if ($numero_page_courante < $nb_pages) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=' . ($numero_page_courante + 1) . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abreviationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction
                    . '&order_common=' . self::$orderBy
                    . '" title="Consulter la page ' . ($numero_page_courante + 1) . ' !">&raquo;</a>&nbsp;';
            /**
             * Version avec le rewrite
             */
//            $resultat .= '<a href="index'
//                    . '-' . self::$idFtaEtat
//                    . '-' . self::$abrevationFtaEtat
//                    . '-' . self::$idFtaRole
//                    . '-' . self::$syntheseAction
//                    . '&order_common=' . self::$orderBy
//                    . '&numeroPage=' . ($numero_page_courante + 1) . '.html " title="Consulter la page ' . ($numero_page_courante + 1) . ' !">&raquo;</a>&nbsp;';
        }

// derniere page     
        if ($derniere && ($numero_page_courante + $apres) < $nb_pages) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) . '?numeroPage=' . $nb_pages
                    . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abreviationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction
                    . '&order_common=' . self::$orderBy
                    . '" title="Dernière page">&raquo;&raquo;</a>&nbsp;';
            /**
             * Version avec le rewrite
             */
//            $resultat .= '<a href="index'
//                    . '-' . self::$idFtaEtat
//                    . '-' . self::$abrevationFtaEtat
//                    . '-' . self::$idFtaRole
//                    . '-' . self::$syntheseAction
//                    . '&order_common=' . self::$orderBy
//                    . '&numeroPage=' . $nb_pages . '.html" title="Dernière page">&raquo;&raquo;</a>&nbsp;';
        }

        /**
         * Augmentation de la taille d'affichage
         */
        $resultat = "<h3>" . $resultat . "</h3>";
// On retourne le resultat
        return $resultat;
    }

    public static function paginerClassification($nb_results_p_page, $numero_page_courante, $nb_avant, $nb_apres, $premiere, $derniere, $paramNbDeResultat) {
// Initialisation de la variable a retourner
        $resultat = '';

// nombre total de pages
        $nb_pages = ceil($paramNbDeResultat / $nb_results_p_page);
// nombre de pages avant
        $avant = $numero_page_courante > ($nb_avant + 1) ? $nb_avant : $numero_page_courante - 1;
// nombre de pages apres
        $apres = $numero_page_courante <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $numero_page_courante;

// premiere page
        if ($premiere && $numero_page_courante - $avant > 1) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=1'
                    . '" title="Première page">&laquo;&laquo;</a>&nbsp;';
        }

// page precedente
        if ($numero_page_courante > 1) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=' . ($numero_page_courante - 1)
                    . '" title="Page précédente ' . ($numero_page_courante - 1) . '">&laquo;</a>&nbsp;';
        }

// affichage des numeros de page
        for ($i = $numero_page_courante - $avant; $i <= $numero_page_courante + $apres; $i++) {
// page courante
            if ($i == $numero_page_courante) {
                $resultat .= '&nbsp;[<strong>' . $i . '</strong>]&nbsp;';
            } else {
                $resultat .= '&nbsp;[<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) . '?numeroPage=' . $i
                        . '" title="Consulter la page ' . $i . '">' . $i . '</a>]&nbsp;';
            }
        }

// page suivante
        if ($numero_page_courante < $nb_pages) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=' . ($numero_page_courante + 1)
                    . '" title="Consulter la page ' . ($numero_page_courante + 1) . ' !">&raquo;</a>&nbsp;';
        }

// derniere page     
        if ($derniere && ($numero_page_courante + $apres) < $nb_pages) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) . '?numeroPage=' . $nb_pages
                    . '" title="Dernière page">&raquo;&raquo;</a>&nbsp;';
        }

// On retourne le resultat
        return $resultat;
    }

    /**
     * 
     * @param type $paramAbrevation1
     * @param type $paramAbrevation2
     * @return string
     */
    private static function getLienByEtatFta($paramAbrevation1, $paramAbrevation2) {
        if ($paramAbrevation1 == 'I' or $paramAbrevation2 == 'P') {
            $tableau_synthese .= 'encours>';
        } else {
            $tableau_synthese .= 'all>';
        }
        /**
         * Version avec le rewrite
         */
//        if ($paramAbrevation1 == 'I' or $paramAbrevation2 == 'P') {
//            $tableau_synthese .= 'encours.html>';
//        } else {
//            $tableau_synthese .= 'all.html>';
//        }
        return $tableau_synthese;
    }

    /**
     * Affichage HTTML de la barre de navigation du la page d'accueil
     * @param type $paramRole
     * @param type $paramEtat
     * @param type $paramNomEtat
     * @param type $paramIdFtaRole
     * @param type $paramSyntheseAction
     * @return type
     */
    private static function getHtmlTableauSythese($paramRole, $paramEtat, $paramNomEtat, $paramIdFtaRole, $paramSyntheseAction) {

        $idKeyNameFtaEtat = '0';
        $tableau_synthese = '';

        if (!self::$nombreFta) {
            self::$nombreFta = '0';
        }
        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                $nombreFta1 = ' (' . self::$nombreFta . ')';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $nombreFta2 = ' (' . self::$nombreFta . ')';
                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $nombreFta3 = ' (' . self::$nombreFta . ')';
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $nombreFta4 = ' (' . self::$nombreFta . ')';
                break;
        }

        switch ($paramNomEtat) {
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION:
                $lien['0'] = '<a href=index.php?id_fta_etat=1'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=attente >En attente' . $nombreFta1 . '</a>';
                if (self::$syntheseAction <> FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS) {
                    $nombreFta2 = ' (' . self::$nombreFtaEncours . ')';
                }
                $lien['1'] = ' <a href=index.php?id_fta_etat=1'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=encours >En cours' . $nombreFta2 . '</a>';
                $lien['2'] = '<a href=index.php?id_fta_etat=1'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=correction >Effectuées' . $nombreFta3 . '</a>';
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE:
                $lien['0'] = '<a href=index.php?id_fta_etat=3'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=all >Voir' . $nombreFta4 . '</a>';
                $lien['1'] = '';
                $lien['2'] = '';
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE:
                $lien['0'] = '<a href=index.php?id_fta_etat=5'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=all >Voir' . $nombreFta4 . '</a>';
                $lien['1'] = '';
                $lien['2'] = '';
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE:
                $lien['0'] = '<a href=index.php?id_fta_etat=6'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=all >Voir' . $nombreFta4 . '</a>';
                $lien['1'] = '';
                $lien['2'] = '';
                break;
        }
        /**
         * Version avec le rewrite
         */
//        switch ($paramNomEtat) {
//            case FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION:
//                $lien['0'] = '<a href=index-1'
//                        . '-' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
//                        . '-' . $paramIdFtaRole
//                        . '-attente.html >En attente' . $nombreFta1 . '</a>';
//                $lien['1'] = ' <a href=index-1'
//                        . '-' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
//                        . '-' . $paramIdFtaRole
//                        . '-encours.html >En cours' . $nombreFta2 . '</a>';
//                $lien['2'] = '<a href=index-1'
//                        . '-' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
//                        . '-' . $paramIdFtaRole
//                        . '-correction.html >Effectuées' . $nombreFta3 . '</a>';
//                break;
//            case FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE:
//                $lien['0'] = '<a href=index-3'
//                        . '-' . FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE
//                        . '-' . $paramIdFtaRole
//                        . '-all.html >Voir' . $nombreFta4 . '</a>';
//                $lien['1'] = '';
//                $lien['2'] = '';
//                break;
//            case FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE:
//                $lien['0'] = '<a href=index-5'
//                        . '-' . FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE
//                        . '-' . $paramIdFtaRole
//                        . '-all.html >Voir' . $nombreFta4 . '</a>';
//                $lien['1'] = '';
//                $lien['2'] = '';
//                break;
//            case FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE:
//                $lien['0'] = '<a href=index-6'
//                        . '-' . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE
//                        . '-' . $paramIdFtaRole
//                        . '-all.html >Voir' . $nombreFta4 . '</a>';
//                $lien['1'] = '';
//                $lien['2'] = '';
//                break;
//        }



        $tableau_synthese = '<table  class = contenu width = 100% border = 0>'
                /*
                 * Entête de la barre de navigation de la page d'accueil
                 */
                . '<TR>'
                . '<TH>Rôle</TH> <TH>Etat FTA</TH> <TH>' . UserInterfaceLabel::FR_AVANCEMENT_FTA . '</TH>'
                . '</TR>';
        /*
         * Données du tableau
         */
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '0', $idKeyNameFtaEtat = '0', $idKeyValueFtaEtatAvancement = '0');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '1', $idKeyNameFtaEtat = '1', $idKeyValueFtaEtatAvancement = '1');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '2', $idKeyNameFtaEtat = '2', $idKeyValueFtaEtatAvancement = '2');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '3', $idKeyNameFtaEtat = '3', $idKeyValueFtaEtatAvancement = '3');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '4', $idKeyNameFtaEtat = '4', $idKeyValueFtaEtatAvancement = '3');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '5', $idKeyNameFtaEtat = '5', $idKeyValueFtaEtatAvancement = '3');

        return $tableau_synthese;
    }

    /**
     * Tableau Html affichant les noms des espaces de travail auxquel l'utilisateur aura les droits d'accès 
     * et le noms des sites de production correspondant en info-bulles
     * @param type $paramWorkflow
     * @param type $paramNameSiteByWorkflow
     * @return string
     */
    private static function getHtmlTableauSytheseWorkflow($paramWorkflow, $paramNameSiteByWorkflow) {
        $bgcolor = 'bgcolor = #3CDA31 ';

        /*
         * Debut de la ligne
         */
        $tableau_synthese = '<TABLE ' . $bgcolor . ' width=100%>'
                . '<TR>'
                . '<td> Espace de Travail :</td>';

        /*
         * Infobulle affichant le noms des sites de production des fta par workflow
         */
        $paramNameSite0 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '0');
        $paramNameSite1 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '1');
        $paramNameSite2 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '2');
        $paramNameSite3 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '3');
        $paramNameSite4 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '4');
        $paramNameSite5 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '5');

        $paramNameSite = array_merge($paramNameSite0, $paramNameSite1, $paramNameSite2, $paramNameSite3, $paramNameSite4, $paramNameSite5);

        /**
         * Element de la ligne
         */
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '0', $paramNameSite, $idKeyNameFtaSite = '0');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '1', $paramNameSite, $idKeyNameFtaSite = '1');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '2', $paramNameSite, $idKeyNameFtaSite = '2');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '3', $paramNameSite, $idKeyNameFtaSite = '3');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '4', $paramNameSite, $idKeyNameFtaSite = '4');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '5', $paramNameSite, $idKeyNameFtaSite = '5');
        $tableau_synthese .= '<TR >'
                . '</TABLE><TABLE>';

        return $tableau_synthese;
    }

    /*
     * fonction de mise e forme recuperant tous les nom des site dont l'utilisateur à les droits d'accès par workflow
     */

    /**
     * Mise en forme des noms de site auxquel l'utilisateur aura les drotis d'accès en info-bulle
     * @param type $paramNameSiteByWorkflow
     * @param type $idKeyNameFtaSite
     * @return string
     */
    private static function getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite) {
        $codeSautDeLigne = '&#013';
        if ($paramNameSiteByWorkflow[$idKeyNameFtaSite]) {
            $paramNameSiteByWorkflow = $paramNameSiteByWorkflow[$idKeyNameFtaSite];
        }
        for ($i = 0; $i < count($paramNameSiteByWorkflow); $i++) {
            $paramNameSite[$idKeyNameFtaSite] .= $paramNameSiteByWorkflow[$i][IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . $codeSautDeLigne;
        }
        return $paramNameSite;
    }

    /**
     * Affiche les lignes concernant les worflows de la barre de navigation de la page d'accueil
     * @param type $paramArrayWorkflow
     * @param type $idKeyNameFtaWorkflow
     * @param type $paramNameSiteByWorkflow
     * @param type $idKeyNameFtaSite
     * @return type
     */
    private static function getLineSyntheseWorkflow($paramArrayWorkflow, $idKeyNameFtaWorkflow, $paramNameSiteByWorkflow, $idKeyNameFtaSite) {

        return '<td>'
                . '<a href=#'
                . $paramArrayWorkflow[$idKeyNameFtaWorkflow][FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW]
                . ' title= ' . $paramNameSiteByWorkflow[$idKeyNameFtaSite] . ' >'
                . $paramArrayWorkflow[$idKeyNameFtaWorkflow][FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW]
                . '</a>'
                . '</td>'

        ;
    }

    /**
     * Affiches les lignes de la barre de navigation de la page d'accueil
     * @param array $paramArrayRole
     * @param array $paramArrayEtat
     * @param type $idFtaRole
     * @param type $nomFtaEtat
     * @param type $paramSyntheseAction
     * @param type $lien
     * @param type $idFieldNomFtaRole
     * @param type $idKeyNameFtaEtat
     * @param type $idKeyValueFtaEtatAvancement
     * @return string
     */
    private static function getLineSynthese(
    $paramArrayRole, $paramArrayEtat, $idFtaRole, $nomFtaEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole, $idKeyNameFtaEtat, $idKeyValueFtaEtatAvancement
    ) {
        $color = '';
//        $color1 = '';
        $color2 = '';
        $globalConfig = new GlobalConfig();

        if ($paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME] == $idFtaRole) {
            /**
             * couleurV2 test violet
             */
//            $color = 'bgcolor=#AAAAFF';
            /**
             * couleurV3 test bleu
             */
//            $color = 'bgcolor=#009dd1';
            $color = 'bgcolor=' . $globalConfig->getConf()->getCssBackgroundValue();
        }

        if ($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] == $nomFtaEtat) {
            /**
             * couleurV2 test violet
             */
//            $color1 = 'bgcolor=#AAAAFF';
            /**
             * couleurV3 test bleu
             */
//            $color1 = 'bgcolor=#009dd1';
            $color1 = 'bgcolor=' . $globalConfig->getConf()->getCssBackgroundValue();
        }


        switch ($idKeyValueFtaEtatAvancement) {
            case '0':
                $ligneEtatAvancement = 'attente';
                if ($lien['2'] == NULL) {
                    $ligneEtatAvancement = 'all';
                }
                break;

            case '1':
                $ligneEtatAvancement = 'encours';
                break;

            case '2':
                $ligneEtatAvancement = 'correction';
                break;
        }
        if ($paramSyntheseAction == $ligneEtatAvancement) {
            /**
             * couleurV2 test violet
             */
//            $color2 = 'bgcolor=#AAAAFF';
            /**
             * couleurV3 test bleu
             */
//            $color2 = 'bgcolor=#009dd1';
            $color2 = 'bgcolor=' . $globalConfig->getConf()->getCssBackgroundValue();
        }


        return '<TR>'
                . '<td ' . $color . '  id=\'' . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_NOM_FTA_ROLE] . '\'> '
                . '<a href=index.php?id_fta_etat=' . $paramArrayEtat['0'][FtaEtatModel::KEYNAME]
                . '&nom_fta_etat=' . $paramArrayEtat['0'][FtaEtatModel::FIELDNAME_ABREVIATION]
                . '&id_fta_role=' . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME]
                . '&synthese_action='
                . AccueilFta::getLienByEtatFta($paramArrayEtat['0'][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat ['0'][FtaEtatModel::FIELDNAME_ABREVIATION])
                . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE]
                . '</a>'
                . '</td>'
                . '<td ' . $color1 . ' id=\'' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] . '\'>  '
                . '<a href=index.php?id_fta_etat=' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                . '&nom_fta_etat=' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                . '&id_fta_role=' . $idFtaRole
                . '&synthese_action='
                . AccueilFta::getLienByEtatFta($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat [$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION])
                . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_NOM_FTA_ETAT]
                . '</a>'
                . '</td>'
                . '<td ' . $color2 . ' >' . $lien[$idKeyValueFtaEtatAvancement]
                . '</td>'
                . '</TR>'
        ;
        /**
         * Version avec le module rewrite
         */
//        return '<TR>'
//                . '<td ' . $color . '  id=\'' . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_NOM_FTA_ROLE] . '\'> '
//                . '<a href=index-' . $paramArrayEtat['0'][FtaEtatModel::KEYNAME]
//                . '-' . $paramArrayEtat['0'][FtaEtatModel::FIELDNAME_ABREVIATION]
//                . '-' . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME]
//                . '-'
//                . AccueilFta::getLienByEtatFta($paramArrayEtat['0'][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat ['0'][FtaEtatModel::FIELDNAME_ABREVIATION])
//                . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE]
//                . '</a>'
//                . '</td>'
//                . '<td ' . $color1 . ' id=\'' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] . '\'>  '
//                . '<a href=index-' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
//                . '-' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
//                . '-' . $idFtaRole
//                . '-'
//                . AccueilFta::getLienByEtatFta($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat [$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION])
//                . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_NOM_FTA_ETAT]
//                . '</a>'
//                . '</td>'
//                . '<td ' . $color2 . ' >' . $lien[$idKeyValueFtaEtatAvancement]
//                . '</td>'
//                . '</TR>'
//        ;
    }

    /**
     * Tableau Html affichant la liste des Fta
     * @return string
     */
    public static function getHtmlTableauFiche() {

        $tableauFicheN = '';
        $tableauFicheNWork = '';
        $tableauFicheTrWork = '';
        $largeur_html_C1 = ' width=15% '; // largeur cellule type
        $largeur_html_C3 = ' width=5% '; // largeur cellule type
        $largeur_html_C3_action = ' width=150px '; // largeur cellule type
        $selection_width = '1%';

        $tableauFiche = '';
        $tableauFicheTr = '';
        $tableauFiche = '<table id=tableauFiche  align=middle class=titre width=100% >'
                . '<thead><tr class=titre_principal><th></th>'
        ;

//Contrôle pour savoir si on est sur l'index du module
        $URL = $_SERVER['REQUEST_URI'];

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '7');
                $ok = '0';
                $bgcolor = 'bgcolor=#A5A5CE ';


                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '7');
                $ok = '1';
                $bgcolor = '';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '10');
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '3');
                $bgcolor = 'bgcolor=#AFFF5A';

                break;
        }
        if (substr($URL, -2) == 'pp') {
            $URL = $URL . 's/fta/index.php?';
        }
        if ((substr($URL, -2)) == 'v3') {
            $URL = $URL . '/apps/fta/index.php?';
        }
        $tableauFiche .= '<th><a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_SITE_PRODUCTION . '&numeroPage=' . self::$numeroDePageCourante . '><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom de Site de Production\'  border=\'0\' /></a>'
                . 'Site'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . '&numeroPage=' . self::$numeroDePageCourante . '><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom du Propriétaire\'  border=\'0\' /></a>'
                . 'Client'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . '&numeroPage=' . self::$numeroDePageCourante . ' ><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom de Classification\'  border=\'0\' /></a>'
                . 'Class.'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . '&numeroPage=' . self::$numeroDePageCourante . ' ><img src=../lib/images/order-AZ.png title=\'Ordonné par Noms du Produit\'  border=\'0\' /></a>'
                . 'Produits'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_DOSSIER_FTA . '&numeroPage=' . self::$numeroDePageCourante . ' ><img src=../lib/images/order-AZ.png title=\'Ordonné par code Fta\'  border=\'0\' /></a>'
                . 'Dossier FTA'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . '&numeroPage=' . self::$numeroDePageCourante . ' ><img src=../lib/images/order-AZ.png title=\'Ordonné par code arcadia\'  border=\'0\' /></a>'
                . 'Code Article Arcadia'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . '&numeroPage=' . self::$numeroDePageCourante . ' ><img src=../lib/images/order-AZ.png title=\'Ordonné par Date\'  border=\'0\' /></a>'
                . 'Echéance de validation'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=' . FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT . '&numeroPage=' . self::$numeroDePageCourante . ' ><img src=../lib/images/order-AZ.png title=\'Ordonné par ' . UserInterfaceLabel::FR_AVANCEMENT_FTA . '\'  border=\'0\' /></a>'
                . UserInterfaceLabel::FR_AVANCEMENT_FTA
                . '</th><th>'
                . 'Rôles'
                . '</th><th>'
                . 'Actions'
                . '</th><th>'
                . 'Commentaires sur la Fta'
                . '</th>';
        /**
         * Version avec le module rewrite
         */
//        $tableauFiche .= '<th><a href=' . $URL . '&order_common=Site_de_production&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom de Site de Production\'  border=\'0\' /></a>'
//                . 'Site'
//                . '</th><th>'
//                . '<a href=' . $URL . '&order_common=id_fta&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom du Propriétaire\'  border=\'0\' /></a>'
//                . 'Client'
//                . '</th><th>'
//                . '<a href=' . $URL . '&order_common=suffixe_agrologic_fta&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom de Classification\'  border=\'0\' /></a>'
//                . 'Class.'
//                . '</th><th>'
//                . '<a href=' . $URL . '&order_common=designation_commerciale_fta&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par Noms du Produit\'  border=\'0\' /></a>'
//                . 'Produits'
//                . '</th><th>'
//                . '<a href=' . $URL . '&order_common=id_dossier_fta&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par code Fta\'  border=\'0\' /></a>'
//                . 'Dossier FTA'
//                . '</th><th>'
//                . '<a href=' . $URL . '&order_common=code_article_ldc&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par code arcadia\'  border=\'0\' /></a>'
//                . 'Code Arcadia'
//                . '</th><th>'
//                . '<a href=' . $URL . '&order_common=date_echeance_fta&numeroPage=' . self::$numeroDePageCourante . '.html ><img src=../lib/images/order-AZ.png title=\'Ordonné par Date\'  border=\'0\' /></a>'
//                . 'Echéance de validation'
//                . '</th><th>'
//                . '% Avancement FTA'
//                . '</th><th>'
//                . 'Service'
//                . '</th><th>'
//                . 'Actions'
//                . '</th><th>'
//                . 'Commentaires'
//                . '</th>';

        $tmp = null;

        /**
         * Droits d'actions sur le bouton de transition, de duplication et retirer
         */
        $valueIsGestionnaire = FtaRoleModel::isGestionnaire(self::$idFtaRole);


        if (self::$arrayIdFtaByUserAndWorkflow['1']) {
            $createurNTmp = null;
            $createurTrTmp = null;
            foreach (self::$arrayIdFtaByUserAndWorkflow['1'] as $rowsDetail) {
                $workflowDescription = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                $workflowName = $rowsDetail[FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW];

                //Chargement manuel des données pour optimiser les performances
                $idFta = $rowsDetail[FtaModel::KEYNAME];
                $abreviationFtaEtat = $rowsDetail[FtaEtatModel::FIELDNAME_ABREVIATION];
                $LIBELLE = $rowsDetail[FtaModel::FIELDNAME_LIBELLE];
                $idClassificationRaccourcis = $rowsDetail[FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS];
                $designationCommercialeFta = $rowsDetail[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
                $idDossierFta = $rowsDetail[FtaModel::FIELDNAME_DOSSIER_FTA];
                $idVersionDossierFta = $rowsDetail[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
                $codeArticleLdc = $rowsDetail[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
                $dateEcheanceFtatmp = $rowsDetail[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
                $createurFta = $rowsDetail[FtaModel::FIELDNAME_CREATEUR];
                $nomSiteProduction = $rowsDetail[GeoModel::FIELDNAME_GEO];
                $idWorkflowFtaEncours = $rowsDetail[FtaModel::FIELDNAME_WORKFLOW];
                $idclassification = $rowsDetail[FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2];
                $recap[$idFta] = $rowsDetail[FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT];
                $listeIdFtaRole = $rowsDetail[FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE];

                if ($recap[$idFta] == NULL) {
                    $recap[$idFta] = "0%";
                }

                /**
                 * On récupère le nom de la classification
                 */
                $suffixeAgrologicFta = ClassificationRaccourcisModel::getNameRaccroucisClassifById($idClassificationRaccourcis);

                /**
                 * Changment du format de date en Fr
                 */
                $dateEcheanceFta = FtaController::changementDuFormatDeDateFR($dateEcheanceFtatmp);

                /**
                 * Donne accès aux bouton de transition 
                 * pour les utilisateur se trouvant en fin de parcours de l'espace de travail
                 */
                $accesTransitionButton = FtaTransitionModel::isAccesTransitionButton(self::$idFtaRole, $idWorkflowFtaEncours);
                $din = null;

                /*
                 * Initialisation des valeurs pour un commentaire
                 */
                $ftaModel = new FtaModel($idFta);
                $commentaireDataField = $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE);
                $htmlFieldCommentaire = html::getHtmlObjectFromDataField($commentaireDataField);
                $htmlFieldCommentaire->setHtmlRenderToTable();


                /**
                 * Classification
                 */
                if ($idclassification) {
                    $classification = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idclassification, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
                } else {
                    $classification = "";
                }

                /*
                 * Récupération du nom du créateur de la fta
                 */

                $userModel = new UserModel($createurFta);
                $createurNom = $userModel->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
                $createurPrenom = $userModel->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();

                /*
                 * Nom de l'assistante de projet responsable:
                 */
                $createur_link = '\'Géré par ' . $createurPrenom . ' ' . $createurNom . '\'';



                /**
                 * Lien vers l'historique de la Fta
                 * Il ne s'affiche que  pour le Fta Validé et Modifier
                 */
                if (self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE or self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                    $lienHistorique = ' <a href=historique-' . $idFta
                            . '-1'
                            . '-' . self::$idFtaEtat
                            . '-' . self::$abreviationFtaEtat
                            . '-' . self::$idFtaRole
                            . '-' . self::$syntheseAction
                            . '-1'
                            . '.html >' . $recap[$idFta] . '</a>';
                }
                /*
                 * Designation commerciale
                 */
                if (strlen($designationCommercialeFta) > '55') {
                    $designationCommercialeFta = substr($designationCommercialeFta, '0', '52') . '...';
                }
                if ($LIBELLE) {
                    $din = $LIBELLE;
                } else {
                    $din = '<font size=\'1\' color=\'#808080\'><i>' . $designationCommercialeFta . '</i></font>';
                }



//                /*
//                 * Calcul d'etat d'avancement
//                 */
//
//                $taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($ftaModel, FALSE);
//                $recap[$idFta] = round($taux_temp['0'] * '100', '0') . '%';

                /*
                 * Definition de la couleur de la cellule selon l'état d'avancement
                 */

                if (self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES) {
                    $ok = '2';
                    if ($recap[$idFta] == '100%') {
                        $bgcolor = 'bgcolor=#AFFF5A';
                    } else {
                        $bgcolor = 'bgcolor=#A5A5CE ';
//                            $bgcolor = 'bgcolor=#009dd1 ';
                    }
                }

                /**
                 * Détermine le fond de la cellule suivant le code de retour de la transaction vers Fta
                 */
                $bgcolorArcadia = TableauFicheView::getHtmlCellBgColorArcadia($idFta, $bgcolor);

                $HTML_date_echeance_fta = FtaProcessusDelaiModel::getArraytFtaDelaiAvancement($idFta);
//$return['status']
//    0: Aucun dépassement des échéances
//    1: Au moins un processus en cours a dépassé son échéance
//    2: La date d'échéance de validation de la FTA est dépassée
//    3: Il n'y a pas de date d'échéance de validation FTA saisie
//$return['liste_processus_depasses'][$id_processus]
//    Renvoi un tableau associatif contenant:
//    - la listes des processus en cours ayant dépassé leur échéance
//    - leur date d'échéance
//$return['HTML_synthese']
//    Contient le code source HTML utilisé pour la fonction visualiser_fiches()
//echo $HTML_date_echeance_fta['status'];
                if (self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                    switch ($HTML_date_echeance_fta['status']) {
                        case '1':
                            $bgcolor_header = $bgcolor;
                            $icon_header = '<img src=../lib/images/exclamation.png title=\'Certaines échéances sont dépassées !\' width=30 height=27 border=0 />';
                            break;
                        case '2':
                            $bgcolor_header = 'class=couleur_rouge';
                            $icon_header = '<img src=../lib/images/exclamation.png title=\'L\'échéance de la Fta est dépassées !\' width=30 height=27 border=0 />';
                            break;
                        default:
//$bgcolor_header = $bgcolor;
                            $icon_header = '';
                    }
                }

                /*
                 * Droit de consultation standard HTML
                 */
                $actions = '';



                if (
                        (self::$ftaModification)
                        or ( self::$ftaConsultation and self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE )
                ) {

                    $actions = '<a '
//                            . 'href=#'
                            . 'href=modification_fiche.php'
                            . '?id_fta=' . $idFta
                            . '&synthese_action=' . self::$syntheseAction
                            . '&comeback=1'
                            . '&id_fta_etat=' . self::$idFtaEtat
                            . '&abreviation_fta_etat=' . self::$abreviationFtaEtat
                            . '&id_fta_role=' . self::$idFtaRole
                            . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;
                    /**
                     * Version avec le module rewrite
                     */
//                    $actions .= '<a '
////                            . 'href=#'
//                            . 'href=modification_fiche'
//                            . '-' . $idFta
//                            . '-' . self::$syntheseAction
//                            . '-1'
//                            . '-' . self::$idFtaEtat
//                            . '-' . self::$abrevationFtaEtat
//                            . '-' . self::$idFtaRole
////                            . ' onClick=\'modification_fiche_' . $idFta . '();\' '
//                            . '.html /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
//                            . '</a>'
                    ;
                    /**
                     * Version avec la méthode Post
                     */
//                $actions .= '                    
//                     <form name=\'modification_fiche_' . $idFta . '\'  method=\'post\' action=\'modification_fiche.php\' >
//                        <input type=hidden name=id_fta_role_' . $idFta . ' id=id_fta_role_' . $idFta . ' >
//                        <input type=hidden name=id_fta_etat_' . $idFta . ' id=id_fta_etat_' . $idFta . '>
//                        <input type=\'hidden\' name=\'synthese_action_' . $idFta . ' id=synthese_action_' . $idFta . ' />
//                        <input type=hidden name=abreviation_fta_etat_' . $idFta . ' id=abreviation_fta_etat_' . $idFta . ' >
//                        <input type=\'hidden\' name=\'comeback_' . $idFta . ' id=comeback_' . $idFta . '/>  
//
//                  </form>';
//                $javascript1.=' <SCRIPT LANGUAGE=JavaScript> 
//                
//                                    function modification_fiche_' . $idFta . '() {  
//                                        document.modification_fiche.id_fta.value=\'' . $idFta . '\'; 
//                                        document.modification_fiche.id_fta_role.value=\'' . self::$idFtaRole . '\'; 
//                                        document.modification_fiche.id_fta_etat.value=\'' . self::$idFtaEtat . '\'; 
//                                        document.modification_fiche.synthese_action.value=\'' . self::$syntheseAction . '\'; 
//                                        document.modification_fiche.abreviation_fta_etat.value=\'' . self::$abrevationFtaEtat . '\'; 
//                                        document.modification_fiche.comeback.value=\'1\'; 
//                                        modification_fiche.submit(); 
//                                        
//                                        return true; 
//                                    } 
//                                    function doPreview()   {
//                                        form=document.getElementById(\'idOfForm\');
//                                        form.action=\'transiter_post.php\';
//                                        form.submit();                                 
//                                    }
//                                </SCRIPT>';
                }
                /*
                 * Export PDF
                 */
                if (
                        (self::$ftaImpression and ( $abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE))
                        or ( $_SESSION['mode_debug'] == '1') or ( $workflowName == 'presentation')
                ) {

                    $actions .= '  '
                            . '<a '
                            . 'href=pdf.php?id_fta=' . $idFta . '&mode=client '
                            . 'target=_blank'
                            . '><img src=./images/pdf.png alt=\'\' title=\'Exportation PDF\' width=\'30\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;
                }
                /**
                 * Historique de modification
                 */
                $actions .= ' <a href=modification_fta_historique.php?' . FtaModel::KEYNAME . '=' . $idFta
                        . '&' . FtaEtatModel::KEYNAME . '=' . self::$idFtaEtat
                        . '&' . FtaEtatModel::FIELDNAME_ABREVIATION . '=' . self::$abreviationFtaEtat
                        . '&' . FtaRoleModel::KEYNAME . '=' . self::$idFtaRole
                        . '&synthese_action=' . self::$syntheseAction
                        . ' ><img src=./images/dossier.png alt=\'\' title=\'Historique des modifications Fta\' width=\'30\' height=\'30\' border=\'0\' /></a>';
                /*
                 * Transiter
                 */
                if (
                /**
                 * Dans le cas où on a les droits de modification, 
                 * que le soit chef de projet,
                 * que la Fta en cours est dans un état différents que modification,
                 * on accède au boutton de transition
                 */
                        $valueIsGestionnaire and self::$ftaModification and ( self::$abreviationFtaEtat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION)

                        /**
                         * Dans le cas où on a les droits de modification, 
                         * que le soit chef de projet,
                         * que la Fta en cours de modification soit dans un pourcentage d'avancement effectués,
                         * on accède au boutton de transition
                         */
                        or ( ($valueIsGestionnaire) and self::$ftaModification and ( self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) and self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES)
                        /**
                         * Dans le cas où on a les droits de modification, 
                         * que l'on est accès aux bouton de transition,
                         * que la Fta en cours de modification soit à 100%,
                         * on accède au boutton de transition
                         */
                        or ( self::$ftaModification and self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION and $recap[$idFta] == FtaProcessusDelaiModel::TAUX_100 and $ok == '2' and $accesTransitionButton == TRUE)
                        /**
                         * Dans le cas où on a les droits de modification, 
                         * que l'on est accès aux bouton de transition,
                         * que la Fta soit valider,
                         * on accède au boutton de transition
                         */
                        or ( self::$ftaModification and self::$abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE
//                                and $accesTransitionButton == TRUE
                        )
                ) {
                    $actions .= '<a '
                            . 'href=transiter.php'
                            . '?id_fta=' . $idFta
                            . '&id_fta_role=' . self::$idFtaRole
                            . '&comeback=1'
                            . '><img src=./images/transiter.png alt=\'\' title=\'Transiter\' width=\'30\' height=\'30\' border=\'0\' />'
                            . '</a>'
                    ;

                    if (self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES and $recap[$idFta] == '100%') {
                        $selection = '<input type=\'checkbox\' name=selection_fta_' . $idFta . ' value=\'' . $idFta . '\' checked />';
                        $traitementDeMasse = '1';
                        $selection_width = '2%';
                        $StringFta .= $idFta . ',';
                        $tableauFiche .= '<input type=hidden name=arrayFta value=' . $StringFta . '>';
                    }
                }

                /*
                 * Action que seul les Chefs de projet peuvent faire
                 */
                /*
                 * Retirer une FTA en cours de modification
                 */
                if ($valueIsGestionnaire == '1') {
                    if ($abreviationFtaEtat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE) {
                        $actions .= '<a '
                                . 'href=# '
                                . 'onClick=confirmation_correction_fta' . $idFta . '(); '
                                . '/>'
                                . '<img src=../lib/images/supprimer.png alt=\'Retirer cette FTA\' width=\'25\' height=\'25\' border=\'0\' />'
                                . '</a>'
                        ;
                        $javascript.='
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_fta' . $idFta . '()
                                   {
                                   if(confirm(\'Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.\'))
                                   {
                                       location.href =\'transiter.php?id_fta=' . $idFta . '&id_fta_role=' . self::$idFtaRole . '&synthese_action=' . self::$syntheseAction . '&action=correction&demande_abreviation_fta_transition=R\'
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ';
                    }

                    $actions .= '<a '
                            . 'href=creer_fiche.php'
                            . '?action=dupliquer_fiche'
                            . '&id_fta=' . $idFta
                            . '&id_fta_role=' . self::$idFtaRole
                            . '&comeback=1'
                            . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                            . '</a>'
                    ;
                }


                /*
                 * Noms des services dans lequel la Fta se trouve
                 */
                $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
                if (self::$ftaModification) {
                    /**
                     * Affichage de la page d'accueil avec regroupement
                     *  pour les utilisateurs intervenant sur les Fta
                     */
                    if ($recap[$idFta] <> '100%') {
                        $createurFtaTr = $createurFta;
                        $workflowTR = $workflowDescription;
                        $diffWorkflowTr = $workflowTR <> $workflowTrTmp;
                        if ($diffWorkflowTr) {
                            $tableauFicheTr2 .= $tableauFicheTrWork . $tableauFicheTr;
                            $nombreDeCellule = '13';
                            $tableauFicheTrWork = '<tbody  id=\'' . $workflowName . '\' >'
                                    . '<tr class=contenu>'
                                    . '<td  class=titre COLSPAN=' . $nombreDeCellule . '>' . $workflowDescription . '</td>'
                                    . '</tr>';
                            $workflowTrTmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                            $tableauFicheTr = NULL;
                            $tmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                        }
                    } else {
                        $createurFtaN = $createurFta;
                        $workflowN = $workflowDescription;
                        $diffWorkflowN = $workflowN <> $workflowNTmp;
                        if ($diffWorkflowN) {
                            $tableauFicheN2.= $tableauFicheNWork . $tableauFicheN;
                            $nombreDeCellule = '13';
                            $tableauFicheNWork = '<tbody  id=\'' . $workflowName . '\' >'
                                    . '<tr class=contenu>'
                                    . '<td  class=titre COLSPAN=' . $nombreDeCellule . '>' . $workflowDescription . '</td>'
                                    . '</tr>';
                            $workflowNTmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                            $tableauFicheN = NULL;
                            $tmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                        }
                    }
                    /**
                     * TableauN les idFta à 100% et tableauTr les autres
                     * Tableau avec Tmp sont les lignes sans le noms du créateur
                     * Conditions :
                     * - l'utilisateur connecté est il le créateur de la Fta
                     * - l'utilisateur précedent est il le même créateur de la Fta actuel
                     * - la Fta actuel est-elle à 100%
                     * - Avons-nous changer de workflow ?
                     * - Les fta créer par l'utilisateur connectée doivent vu en priorité
                     */
                    switch (self::$idUser) {
                        case $createurFta:
                            /*
                             * Commentaire de la Fta et code Regate Mère
                             */
                            $htmlFieldCommentaire->setIsEditable(TRUE);
                            $commentaire = $htmlFieldCommentaire->getHtmlResult();
                            if ($recap[$idFta] == '100%') {
                                if ($createurFtaN <> $createurNTmp or $diffWorkflowN) {
                                    $tableauFicheN .= '<tr class=contenu>'
                                            . '<td COLSPAN=' . $nombreDeCellule . ' ><font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                            . '</tr>'
                                            . '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' > ' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    }
                                    $tableauFicheN .= '<td ' . $bgcolor . ' width=5% align=center >' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                    $createurNTmp = $createurFtaN;
                                } else {
                                    $tableauFicheN .= '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . '></td>';
                                    }
                                    $tableauFicheN .= '<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                }
                            } else {
                                if ($createurFtaTr <> $createurTrTmp or $diffWorkflowTr) {
                                    $tableauFicheTr .= '<tr class=contenu>'
                                            . '<td COLSPAN=' . $nombreDeCellule . ' ><font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                            . '</tr>'
                                            . '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'/// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheTr.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheTr.='<td ' . $bgcolor . $largeur_html_C3 . '></td>';
                                    }
                                    $tableauFicheTr .= '<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                    $createurTrTmp = $createurFtaTr;
                                } else {
                                    $tableauFicheTr .= '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheTr.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheTr.='<td ' . $bgcolor . $largeur_html_C3 . ' ></td>';
                                    }
                                    $tableauFicheTr .= '<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                }
                            }
                            break;


                        default :
                            /*
                             * Commentaire de la Fta
                             */

                            $htmlFieldCommentaire->setIsEditable(FALSE);
                            $commentaire = $htmlFieldCommentaire->getHtmlResult();
                            /*
                             * Nouvelle ligne pour créateur
                             */
                            if ($recap[$idFta] == '100%') {
                                if ($createurFtaN <> $createurNTmp or $diffWorkflowN) {
                                    $tableauFicheTmp .= '<tr class=contenu>'
                                            . '<td COLSPAN=' . $nombreDeCellule . ' > <font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                            . '</tr>'
                                            . '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' ></td>';
                                    }
                                    $tableauFicheTmp .= '<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                    $createurNTmp = $createurFtaN;
                                } else {
                                    $tableauFicheTmp .= '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolor . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate


                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' ></td>';
                                    }
                                    $tableauFicheTmp .='<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                }
                            } else {
                                if ($createurFtaTr <> $createurTrTmp or $diffWorkflowTr) {
                                    $tableauFicheTrTmp .= '<tr class=contenu>'
                                            . '<td COLSPAN=' . $nombreDeCellule . ' > <font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                            . '</tr>'
                                            . '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate


                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheTrTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheTrTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' ></td>';
                                    }
                                    $tableauFicheTrTmp .= '<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                    $createurTrTmp = $createurFtaTr;
                                } else {
                                    $tableauFicheTrTmp .= '<tr class=contenu >'
                                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                        $tableauFicheTrTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                                    } else {
                                        $tableauFicheTrTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' ></td>';
                                    }
                                    $tableauFicheTrTmp .='<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                                            . $commentaire  // Commentaires
                                            . '</tr >';
                                }
                            }
                            break;
                    }

                    /**
                     * Affichage de la page d'accueil sans regroupement pour les utilisateurs en consultation
                     */
                } elseif (self::$ftaConsultation) {
                    /*
                     * Commentaire de la Fta
                     */

                    $htmlFieldCommentaire->setIsEditable(FALSE);
                    $commentaire = $htmlFieldCommentaire->getHtmlResult();
                    $tableauFicheTmp .= '<tr class=contenu >'
                            . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                            . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                            . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                            . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                            . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                            . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                            . '<td ' . $bgcolorArcadia . ' width=\'3%\' align=center> <b><font size=\'2\' color=\'#0000FF\' >' . $codeArticleLdc . '</font></b></td>'; //Code regate

                    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                        $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                    } else {
                        $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' ></td>';
                    }
                    $tableauFicheTmp .= '<td ' . $bgcolor . ' width=5% align=center>' . $lienHistorique . '</td>'//% Avancement FTA
                            . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                            . '<td ' . $bgcolor . $largeur_html_C3_action . ' align=center >' . $actions . '</td>'// Actions
                            . $commentaire  // Commentaires
                            . '</tr >';
                }

                $tableauFicheN.= $tableauFicheTmp;
                $tableauFicheTr .= $tableauFicheTrTmp;
                $tableauFicheTrTmp = NULL;
                $tableauFicheTmp = NULL;
                $icon_header = NULL;
                $selection = NULL;
                $bgcolor_header = NULL;
            }
        } else {
            $tableauFiche .= '<tr class=contenu><td>' . UserInterfaceMessage::FR_NONE_FTA . '</td></tr>';
        }

        $tableauFicheN2.= $tableauFicheNWork . $tableauFicheN;
        $tableauFicheTr2 .= $tableauFicheTrWork . $tableauFicheTr;
        $tableauFiche .= $tableauFicheN2 . $tableauFicheTr2 . $javascript
//                . $javascript1 
                . '</tbody></table>';

        //Ajoute de la fonction de traitement de masse
        if ($traitementDeMasse) {
            $liste_action_groupe = FtaTransitionModel::getListeFtaGrouper(self::$abreviationFtaEtat);

            $tableauFiche.= '&nbsp;
            <img src = ../lib/images/fleche_gauche_et_haut.png width = 38 height = 22 border = 0 />
            <i>Transitions groupées</i>:
            ' . $liste_action_groupe . '
            <input type = \'text\' name=\'subject\' size=\'50\' />
            <input type=image src=images/transiter.png width=20 height=20  />
            <input type=hidden name=action value=transition_groupe>
                         ';
//            $tableauFiche.= '&nbsp;
//            <img src = ../lib/images/fleche_gauche_et_haut.png width = 38 height = 22 border = 0 />
//            <i>Transitions groupées</i>:
//            ' . $liste_action_groupe . '
//            <input type = \'text\' name=\'subject\' size=\'20\' />
//            <input type=image src=images/transiter.png width=20 height=20  />
//            <input type=hidden name=action value=transition_groupe>
//                         ';
        }

        return $tableauFiche;
    }

    /**
     * Génère le file d'ariane en entête de la page d'accueil
     * @return string
     */
    public static function getFileAriane() {

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:

                $EtatAvancement = 'En attente';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $EtatAvancement = 'En cours';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $EtatAvancement = 'Effectuées';
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $EtatAvancement = 'Voir';
                break;
        }

        $fileAriane = '<table class=titre width=100%  ><tr>'
                . '<td>' . FtaRoleModel::getNameRoleByIdRole(self::$idFtaRole) . '</td>'
                . '<td> > </td>'
                . '<td>' . FtaEtatModel::getNameEtatByIdEtat(self::$idFtaEtat) . '</td>'
                . '<td> > </td>'
                . '<td>' . $EtatAvancement . '</td>'
                . '</tr></table>';

        return $fileAriane;
    }

    /**
     * Fonction de création d'une liste déroulante basée sur une requete SQL
      le premier champ retourné par la requête est désigné comme Clef de la liste
      le second alimente le contenu de la liste déroulante
     * Le dernier paramètre est un boolean qui permet d'afficher l'élément "tous"
     * dans la liste déroulante pour valeur "0"
     * @param string $paramRequeteSQL
     * @param int $paramIdDefaut
     * @param string $paramNomDefaut
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function afficherRequeteEnListeDeroulante($paramRequeteSQL, $paramIdDefaut, $paramNomDefaut, $paramIsEditable, $paramTous = NULL) {
        //Recherche de la clef
        $table = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($paramRequeteSQL);
        if (!$table) {//Si la liste est vide
            $html_liste = '<i>(vide)</i>';
        } else {
            if ($paramIsEditable <> FALSE) {
                $key = array_keys($table);
                if (!$paramNomDefaut) {
                    $paramNomDefaut = $key['1'];
                }

                //Création de la liste déroulante
                $html_liste = '<select id=' . $paramNomDefaut . ' name=' . $paramNomDefaut . ' onChange=' . $paramNomDefaut . '_js()>';
                if ($paramTous) {
                    $html_liste .='<option value=0 >Tous</option>';
                }

                /*
                 * PDO::FETCH_BOTH
                 * Retourne la ligne suivante en tant qu'un tableau indexé par le nom et le numéro de la colonne
                 */
                //Création du contenu de la liste
                $array = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($paramRequeteSQL);
                foreach ($array as $rows) {
                    if ($rows['0'] == $paramIdDefaut) {
                        $selected = ' selected';
                    } else {
                        $selected = '';
                    }

                    $html_liste .= '<option value=' . $rows['0'] . '  ' . $selected . '>' . $rows['1'] . '</option>';
                }
                $html_liste .= '</select>';
            } else {
                $array = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($paramRequeteSQL);
                foreach ($array as $rows) {
                    if ($rows['0'] == $paramIdDefaut) {
                        $html_listeTMP = $rows['1'];
                    } else {
                        $html_liste = NULL;
                    }
                    if (!$html_liste) {
                        $html_liste = $html_listeTMP;
                    }
                }
            }//Fin de la construction de la liste
        }
        return $html_liste;
    }

}
