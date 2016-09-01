<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

global $USER_FIELD_MANAGER;


foreach($arResult['fields'] as &$field) {
    if ('hlblock' === $arResult['fields'][$field['FIELD_NAME']]['USER_TYPE_ID']) {
        // Если поле привязано к инфоблоку, то выберем дополнительно значения полей
        // связанного элемента - Компании
        // todo по-хорошему, это нужно перенести в компонент, чтобы забирать все одним запросом
        
        $hlblock_id = $field['SETTINGS']['HLBLOCK_ID'];
        $hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $row = $entity_data_class::getById($field['VALUE'])->fetch();

        if (!empty($row))
        {
            $arResult['company'] = $USER_FIELD_MANAGER->getUserFieldsWithReadyData('HLBLOCK_'.$hlblock['ID'], $row, LANGUAGE_ID);
            foreach($arResult['company'] as &$companyField) {
                $companyField['displayTitle'] = htmlspecialcharsEx(($companyField["LIST_COLUMN_LABEL"]) ? $companyField["LIST_COLUMN_LABEL"] : $companyField['FIELD_NAME']);
                $companyField['displayValue'] = htmlspecialcharsEx($companyField["VALUE"]);
            }
        }


    }
    $field['displayTitle'] = htmlspecialcharsEx(($field["LIST_COLUMN_LABEL"]) ? $field["LIST_COLUMN_LABEL"] : $field['FIELD_NAME']);       
    $field['displayValue'] = $USER_FIELD_MANAGER->getListView($field, $arResult['row'][$field['FIELD_NAME']]);       
}
unset($field);