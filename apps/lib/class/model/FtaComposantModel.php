<?php

/**
 * Description of FtaEtatModel
 * Table des états d'une FTA
 *
 * @author franckwastaken
 */
class FtaComposantModel extends AbstractModel {

    const TABLENAME = 'fta_composant';
    const KEYNAME = 'id_fta_composant';
    const FIELDNAME_ASCENDANT_FTA_NOMENCLATURE = 'ascendant_fta_nomenclature';
    const FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE = 'code_produit_agrologic_fta_nomenclature';
    const FIELDNAME_DESIGNATION_CODIFICATION = 'nom_fta_nomenclature';
    const FIELDNAME_DIN_FTA_NOMENCLATURE = 'din_fta_nomenclature';
    const FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION = 'duree_vie_technique_fta_composition';
    const FIELDNAME_ETAT_FTA_CODIFICATION = 'etat_fta_nomenclature';
    const FIELDNAME_ETIQUETTE = 'etiquette_fta_composition';
    const FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION = 'etiquette_duree_vie_fta_composition';
    const FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION = 'etiquette_id_fta_composition';
    const FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION = 'etiquette_libelle_fta_composition';
    const FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION = 'etiquette_libelle_legal_fta_composition';
    const FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION = 'etiquette_poids_fta_composition';
    const FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT = 'etiquette_decomposition_poids_fta_composant';
    const FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION = 'etiquette_quantite_fta_composition';
    const FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON = 'etiquette_supplementaire_fta_composition';
    const FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT = 'etiquette_information_complementaire_recto_fta_composant';
    const FIELDNAME_ID_ACCESS_RECETTE_RECETTE = 'id_access_recette_recette';
    const FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION = 'id_annexe_agrologic_article_codification';
    const FIELDNAME_ID_ANNEXE_UNITE = 'id_annexe_unite';
    const FIELDNAME_ID_CODIFICATION = 'id_fta_nomenclature';
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_ID_FTA_COMPOSTION = 'id_fta_composition';
    const FIELDNAME_ID_GEO = 'id_geo';
    const FIELDNAME_INGREDIENT_FTA_COMPOSITION = 'ingredient_fta_composition';
    const FIELDNAME_INGREDIENT_FTA_COMPOSITION1 = 'ingredient_fta_composition1';
    const FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT = 'is_composition_fta_composant';
    const FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT = 'is_nomenclature_fta_composant';
    const FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION = 'k_etiquette_fta_composition';
    const FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION = 'k_etiquette_verso_fta_composition';
    const FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO = 'k_codesoft_etiquette_logo';
    const FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION = 'k_style_paragraphe_ingredient_fta_composition';
    const FIELDNAME_LAST_ID_FTA_COMPOSANT = 'last_id_fta_composant';
    const FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION = 'mode_etiquette_fta_composition';
    const FIELDNAME_NOM_FTA_COMPOSITION = 'nom_fta_composition';
    const FIELDNAME_ORDRE_FTA_COMPOSITION = 'ordre_fta_composition';
    const FIELDNAME_POIDS_FTA_COMPOSITION = 'poids_fta_composition';
    const FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE = 'poids_total_carton_vrac_fta_nomenclature';
    const FIELDNAME_POIDS_UNITAIRE_CODIFICATION = 'poids_fta_nomenclature';
    const FIELDNAME_QUANTITE_FTA_COMPOSITION = 'quantite_fta_composition';
    const FIELDNAME_QUANTITE_PIECE_PAR_CARTON = 'quantite_piece_par_carton';
    const FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION = 'site_production_fta_nomenclature';
    const FIELDNAME_SUFFIXE_AGROLOGIC_FTA_NOMENCLATURE = 'suffixe_agrologic_fta_nomenclature';
    const FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION = 'taille_police_ingredient_fta_composition';
    const FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION = 'taille_police_nom_fta_composition';
    const FIELDNAME_VERSION = '_VERSION';
    const FIELDNAME_VAL_NUT_KCAL = 'val_nut_kcal';
    const FIELDNAME_VAL_NUT_KJ = 'val_nut_kj';
    const FIELDNAME_VAL_MAT_GRASSE = 'val_nut_mat_grasse';
    const FIELDNAME_VAL_ACIDE_GRAS = 'val_nut_acide_gras';
    const FIELDNAME_VAL_GLUCIDE = 'val_nut_glucide';
    const FIELDNAME_VAL_SUCRE = 'val_nut_sucre';
    const FIELDNAME_VAL_PROTEINE = 'val_nut_proteine';
    const FIELDNAME_VAL_SEL = 'val_nut_sel';
    const FIELDNAME_VIRTUAL_INGREDIENT_FTA_COMPOSITION = 'virtual_ingredient_fta_composition';
    const FIELDNAME_VIRTUAL_NOM_DU_COMPOSANT = 'virtual_nom_du_composant';
    const FIELDNAME_VIRTUAL_POIDS_FTA_COMPOSITION = 'virtual_poids_fta_composition';
    const FIELDNAME_VIRTUAL_QUANTITE_FTA_COMPOSITION = 'virtual_quantite_fta_composition';
    const FIELDNAME_VIRTUAL_SITE_DE_PRODUCTION = 'virtual_site_de_production';

    /**
     * FTA associée
     * @var FtaModel
     */
    private $modelFta;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaById($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue());
    }

    public function setModelFtaById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA)->setFieldValue($id);
        $this->setModelFta(
                new FtaModel($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue(), DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    function getModelFta() {
        return $this->modelFta;
    }

    function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    /**
     * 
     * @param type $paramIdFta
     */
    public static function DuplicateFtaComposantByIdFta($paramIdFtaOrig, $paramIdFtaNew) {
        DatabaseOperation::execute(
                ' INSERT INTO ' . FtaComposantModel::TABLENAME
                . ' (' . FtaComposantModel::FIELDNAME_ASCENDANT_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_DIN_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON
                . ', ' . FtaComposantModel::FIELDNAME_ID_ACCESS_RECETTE_RECETTE
                . ', ' . FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE
                . ', ' . FtaComposantModel::FIELDNAME_ID_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION
                . ', ' . FtaComposantModel::FIELDNAME_ID_GEO
                . ', ' . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1
                . ', ' . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                . ', ' . FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT
                . ', ' . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON
                . ', ' . FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_VERSION
                . ', ' . FtaComposantModel::FIELDNAME_LAST_ID_FTA_COMPOSANT
                . ', ' . FtaComposantModel::FIELDNAME_ID_FTA . ')'
                . ' SELECT ' . FtaComposantModel::FIELDNAME_ASCENDANT_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_DIN_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON
                . ', ' . FtaComposantModel::FIELDNAME_ID_ACCESS_RECETTE_RECETTE
                . ', ' . FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE
                . ', ' . FtaComposantModel::FIELDNAME_ID_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION
                . ', ' . FtaComposantModel::FIELDNAME_ID_GEO
                . ', ' . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1
                . ', ' . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                . ', ' . FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT
                . ', ' . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON
                . ', ' . FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION
                . ', ' . FtaComposantModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA_NOMENCLATURE
                . ', ' . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION
                . ', ' . FtaComposantModel::FIELDNAME_VERSION
                . ', ' . FtaComposantModel::KEYNAME
                . ', ' . $paramIdFtaNew
                . ' FROM ' . FtaComposantModel::TABLENAME
                . ' WHERE ' . FtaComposantModel::FIELDNAME_ID_FTA . '=' . $paramIdFtaOrig
        );
    }

    public static function getIdFtaComposant($paramIdFta) {
        $arrayIdFtaComposant = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaComposantModel::KEYNAME
                        . ' FROM ' . FtaComposantModel::TABLENAME
                        . ' WHERE ' . FtaComposantModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
        );
        return $arrayIdFtaComposant;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @param type $paramIdFtaComposant
     * @return int
     */
    public static function getArrayFtaConditonnement($paramIdFtaComposant) {

        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . FtaComposantModel::KEYNAME
                        . ',' . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
                        . ',' . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION
                        . ',' . FtaComposantModel::FIELDNAME_ID_GEO
                        . ',' . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                        . ',' . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                        . ' FROM ' . FtaComposantModel::TABLENAME
                        . ' WHERE ' . FtaComposantModel::KEYNAME . '=' . $paramIdFtaComposant);

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    FtaComposantModel::FIELDNAME_VIRTUAL_NOM_DU_COMPOSANT => $rows[FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION],
                    FtaComposantModel::FIELDNAME_VIRTUAL_INGREDIENT_FTA_COMPOSITION => $rows[FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION],
                    FtaComposantModel::FIELDNAME_VIRTUAL_SITE_DE_PRODUCTION => $rows[FtaComposantModel::FIELDNAME_ID_GEO],
                    FtaComposantModel::FIELDNAME_VIRTUAL_POIDS_FTA_COMPOSITION => $rows[FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION],
                    FtaComposantModel::FIELDNAME_VIRTUAL_QUANTITE_FTA_COMPOSITION => $rows[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * 
     * @param int $paramIdFta
     * @param int $paramIdFtaComposant
     * @return array
     */
    public static function getTablesNameAndIdForeignKeyOfFtaComposant($paramIdFta, $paramIdFtaComposant) {
        $tablesNameAndIdForeignKeyOfFtaConditionnement[$paramIdFtaComposant] = array(
            array(FtaModel::TABLENAME, FtaComposantModel::FIELDNAME_ID_FTA, $paramIdFta),
            array(FtaComposantModel::TABLENAME, FtaComposantModel::KEYNAME, $paramIdFtaComposant),
        );

        return $tablesNameAndIdForeignKeyOfFtaConditionnement;
    }

    public static function getAddLinkComposant($paramIdFta, $paramIdChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramProprietaire) {
        return 'modifier_composition.php?id_fta=' . $paramIdFta
                . '&id_fta_chapitre_encours=' . $paramIdChapitre
                . '&synthese_action=' . $paramSyntheseAction
                . '&proprietaire=' . $paramProprietaire
                . '&comeback=' . $paramComeback
                . '&id_fta_etat=' . $paramIdFtaEtat
                . '&abreviation_fta_etat=' . $paramAbreviationEtat
                . '&id_fta_role=' . $paramIdFtaRole
        ;
    }

    public static function getAddAfterLinkComposant($paramIdFta, $paramIdChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramProprietaire) {
        return 'modifier_composition.php?id_fta=' . $paramIdFta
                . '&id_fta_chapitre_encours=' . $paramIdChapitre
                . '&synthese_action=' . $paramSyntheseAction
                . '&proprietaire=' . $paramProprietaire
                . '&comeback=' . $paramComeback
                . '&id_fta_etat=' . $paramIdFtaEtat
                . '&abreviation_fta_etat=' . $paramAbreviationEtat
                . '&id_fta_role=' . $paramIdFtaRole
        ;
    }

    public static function getTableComposantLabel($paramIdFtaConditionnment) {
        $ftaCondtionnementModel = new FtaComposantModel($paramIdFtaConditionnment);

        return '<tr class=titre_tableau  align=center >' .
                '<td>' . $ftaCondtionnementModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaComposantModel::FIELDNAME_ID_GEO)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->getFieldLabel() . '</td>'
//                . '<td>Répartition (en %)</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION)->getFieldLabel() . '</td>'
                . '<td>Actions</td>'
                . '</tr>';
    }

    public static function InsertFtaComposant($paramIdFta) {
        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . FtaComposantModel::TABLENAME
                        . '(' . FtaComposantModel::FIELDNAME_ID_FTA . ')'
                        . 'VALUES (' . $paramIdFta . ')'
        );
        $key = $pdo->lastInsertId();

        return $key;
    }

    /**
     * Suppression d'une donnée de la table Fta composant par son identifiant
     * @param type $paramIdFtaComposant
     * @return type
     */
    public static function deleteFtaComposant($paramIdFtaComposant) {
        return DatabaseOperation::execute(
                        ' DELETE FROM ' . FtaComposantModel::TABLENAME . ' WHERE ' .
                        FtaComposantModel::KEYNAME . '=' . $paramIdFtaComposant);
    }

    /**
     * Lien se supression d'un Emballage de Conditionnment
     * @param int $paramIdFta
     * @param int $paramIdChapitre
     * @param array $paramIdFtaComposant
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getDeleteLinkComposant($paramIdFta, $paramIdChapitre, $paramIdFtaComposant, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        foreach ($paramIdFtaComposant as $rows) {
            $return[$rows] = 'modification_fiche_post.php?'
                    . 'id_fta=' . $paramIdFta
                    . '&id_fta_composant=' . $rows
                    . '&action=suppression_composant'
                    . '&id_fta_chapitre_encours=' . $paramIdChapitre
                    . '&synthese_action=' . $paramSyntheseAction
                    . '&comeback=' . $paramComeback
                    . '&id_fta_etat=' . $paramIdFtaEtat
                    . '&abreviation_fta_etat=' . $paramAbreviationEtat
                    . '&id_fta_role=' . $paramIdFtaRole;
        }

        return $return;
    }

    public static function getDetailLinkComposant($paramIdFta, $paramIdChapitre, $paramIdFtaComposant, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramProprietaire) {
        foreach ($paramIdFtaComposant as $rows) {
            $return[$rows] = 'modifier_composition.php?'
                    . 'id_fta=' . $paramIdFta
                    . '&id_fta_chapitre_encours=' . $paramIdChapitre
                    . '&id_fta_composant=' . $rows
                    . '&synthese_action=' . $paramSyntheseAction
                    . '&proprietaire=' . $paramProprietaire
                    . '&comeback=' . $paramComeback
                    . '&id_fta_etat=' . $paramIdFtaEtat
                    . '&abreviation_fta_etat=' . $paramAbreviationEtat
                    . '&id_fta_role=' . $paramIdFtaRole
            ;
        }
        return $return;
    }

    public static function ShowListeDeroulanteNomCodeProduitAgrologicByIdFta($paramObjetList, $paramIsEditable, $paramIdFta) {

        $ftaModel = new FtaModel($paramIdFta);
        $arrayCodeProduitAgrologic = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . AnnexeAgrologicArticleCodificationModel::KEYNAME . ', CONCAT_WS( - ,' . AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD
                        . ' , ' . AnnexeAgrologicArticleCodificationModel::FIELDNAME_NOM_ANNEXE_AGRO_ART_COD
                        . ') FROM ' . AnnexeAgrologicArticleCodificationModel::TABLENAME
                        . ' WHERE ' . AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD . '<>00'
                        . ' ORDER BY ' . AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD
        );
        $paramObjetList->setArrayListContent($arrayCodeProduitAgrologic);
        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . '_'
                . $paramIdFta
        ;
        $paramObjetList->getAttributes()->getName()->setValue(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE));
        $paramObjetList->setIsEditable($paramIsEditable);
        $paramObjetList->initAbstractHtmlSelect(
                $HtmlTableName, $paramObjetList->getLabel(), $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue(), NULL, $paramObjetList->getArrayListContent());
        $paramObjetList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramIdFta, FtaModel::FIELDNAME_WORKFLOW);

        $listeSiteWorkflow = $paramObjetList->getHtmlResult();

        return $listeSiteWorkflow;
    }

}

?>
