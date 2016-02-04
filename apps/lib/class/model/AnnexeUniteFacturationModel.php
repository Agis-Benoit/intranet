<?php

/**
 * Description of AnnexeUniteFacturationModel
 *
 * @author tp4300001
 */
class AnnexeUniteFacturationModel extends AbstractModel {

    const TABLENAME = 'annexe_unite_facturation';
    const KEYNAME = 'id_annexe_unite_facturation';
    const FIELDNAME_NOM_ANNEXE_UNITE_FACTURATION = 'nom_annexe_unite_facturation';
    const FIELDNAME_ID_ARCADIA_UNITE_FACTURATION = 'id_arcadia_unite_facturation';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
