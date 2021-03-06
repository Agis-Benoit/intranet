<?php

/**
 * Description of HtmlList
 *
 * @author bs4300280
 */
class DataFieldToHtmlListBoolean extends HtmlListBoolean {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        parent::__construct();
        parent::initAbstractHtmlSelect(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
                , HtmlListBoolean::getArrayListContentBoolean()
                , $this->getDataField()->getDataValidationSuccessful()
                , $this->getDataField()->getDataWarningMessage()
                , $this->getDataField()->getIsFieldLock()
                , $this->getDataField()->getLinkFieldLock()
        );

        $this->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $this->getDataField()->getTableName()
                , $this->getDataField()->getKeyName()
                , $this->getDataField()->getKeyValue()
                , $this->getDataField()->getFieldName()
        );

        /**
         * Détermine si le datafield encours doit être non éditiable
         */
        $this->setContentLocked($paramDataField->getFieldsToLock());
    }

    public function getHtmlViewedContent() {
        $return = '';
        if ($this->getSelectedValue()) {
            $return = Html::showValue(self::YES_LABEL);
        } else {
            $return = Html::showValue(self::NO_LABEL);
        }
        return $return;
    }

}
