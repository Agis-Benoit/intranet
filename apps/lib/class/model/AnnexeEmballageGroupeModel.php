<?php

/**
 * Description of FtaProcessusMultisiteModel
 * Table des FtaProcessusMultisiteModel
 *
 * @author franckwastaken
 */
class AnnexeEmballageGroupeModel extends AbstractModel {

    const TABLENAME = 'annexe_emballage_groupe';
    const KEYNAME = 'id_annexe_emballage_groupe';
    const FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE = 'nom_annexe_emballage_groupe';
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION = 'id_annexe_emballage_groupe_configuration';
    const FIELDNAME_POIDS_VARIABLE_FTA_EMBALLAGE_GROUPE = 'poids_variable_fta_emballage_groupe';
    const ID_ANNEXE_EMBALLAGE_GROUPE_PALETTE = '10';

    public static function getArrayIdAnnexeEmballageGroupe($paramEmballageGroupeType) {
        if ($paramEmballageGroupeType == 2) {
            $op = '<=';
        } else {
            $op = '=';
        }
        $arrayEmballageGroupeType = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . AnnexeEmballageGroupeModel::KEYNAME
                        . ' FROM ' . AnnexeEmballageGroupeModel::TABLENAME . ',' . AnnexeEmballageGroupeTypeModel::TABLENAME
                        . ' WHERE ' . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . $op . $paramEmballageGroupeType
        );
        foreach ($arrayEmballageGroupeType as $rowsEmballageGroupeType) {
            $IdAnnexeEmballageGroupe[] = $rowsEmballageGroupeType[AnnexeEmballageGroupeModel::KEYNAME];
        }

        return $IdAnnexeEmballageGroupe;
    }

    public static function AddIdAnnexeEmballageGroupe($paramAnnexeEmballageGroupe) {
        if ($paramAnnexeEmballageGroupe) {
            foreach ($paramAnnexeEmballageGroupe as $value) {
                $req .= ' OR ' . AnnexeEmballageGroupeModel::TABLENAME . '. ' . AnnexeEmballageGroupeModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    function deleteAnnexeEmballageGroupe() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On retourne l'id annexe groupe emballage selon l'id annexe emballage et le type d'emballage
     * @param int $paramIdAnnexeEmballage
     * @param int $paramIdAnnexeAmballageGroupeType
     * @return string
     */
    public static function getIdAnnexeEmballageGroupeByIdAnnexeEmballageAndIdAnnexeGroupeType($paramIdAnnexeEmballage, $paramIdAnnexeAmballageGroupeType) {
        //Dans le cas d'emballage UVC, on peut avoir de l'emballage primaire
        if ($paramIdAnnexeAmballageGroupeType == 2) {
            $op = '<=';
        } else {
            $op = '=';
        }

        $arrayIdAnnexeEmballageGroupe = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::TABLENAME . "." . self::KEYNAME
                        . " FROM " . self::TABLENAME . "," . AnnexeEmballageGroupeTypeModel::TABLENAME . "," . AnnexeEmballageModel::TABLENAME
                        . " WHERE " . self::TABLENAME . "." . self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                        . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME
                        . " AND " . self::TABLENAME . "." . self::KEYNAME
                        . "=" . AnnexeEmballageModel::TABLENAME . "." . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . " AND " . self::TABLENAME . '.' . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                        . $op . $paramIdAnnexeAmballageGroupeType
                        . " AND " . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::KEYNAME
                        . "=" . $paramIdAnnexeEmballage
        );

        //Récupération de l'id Groupe
        if ($arrayIdAnnexeEmballageGroupe) {
            foreach ($arrayIdAnnexeEmballageGroupe as $rowsIdAnnexeEmballageGroupe) {
                $IdAnnexeEmballageGroupe = $rowsIdAnnexeEmballageGroupe[self::KEYNAME];
            }
        }

        return $IdAnnexeEmballageGroupe;
    }

}

?>