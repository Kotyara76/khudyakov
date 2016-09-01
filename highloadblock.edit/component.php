<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$requiredModules = array('highloadblock');

foreach ($requiredModules as $requiredModule)
{
	if (!CModule::IncludeModule($requiredModule))
	{
		ShowError(GetMessage("F_NO_MODULE"));
		return 0;
	}
}

use	Bitrix\Main\Context;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$context = Context::getCurrent();
$request = $context->getRequest();

if (isset($_GET['ajax']) && $_GET['ajax'] === 'y') {
	$arResult['isAjax'] = true;
} else
	$arResult['isAjax'] = false;
$arResult['update'] = false;
$arResult['success'] = true;


global $USER_FIELD_MANAGER;

// hlblock info
$hlblock_id = $arParams['BLOCK_ID'];

if (empty($hlblock_id))
{
	ShowError(GetMessage('HLBLOCK_VIEW_NO_ID'));
	return 0;
}

$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();

if (empty($hlblock))
{
	ShowError('404');
	return 0;
}

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

// row data
$main_query = new Entity\Query($entity);
$main_query->setSelect(array('*'));
$main_query->setFilter(array('=ID' => $arParams['ROW_ID']));

$result = $main_query->exec();
$result = new CDBResult($result);
$row = $result->Fetch();

if (empty($row))
{
	ShowError(sprintf(GetMessage('HLBLOCK_VIEW_NO_ROW'), $arParams['ROW_ID']));
	return 0;
}

$fields = $USER_FIELD_MANAGER->getUserFieldsWithReadyData('HLBLOCK_'.$hlblock['ID'], $row, LANGUAGE_ID);

if ($request->isPost() && check_bitrix_sessid()) {
	// сохраняем новые значения
	$arResult['update'] = true;
	$arFields = array();
	foreach ($fields as $field) {
		$arFields[$field['FIELD_NAME']] = $request->getPost($field['FIELD_NAME']);
	}
	$arResult['postParams'] = $arFields;

	$result = $entity_data_class::update($arParams['ROW_ID'], $arFields);

	if (!$result->isSuccess())
		$arResult['success'] = false;
}

$arResult['fields'] = $fields;
$arResult['row'] = $row;

if($arResult['isAjax'])
{
	$this->setFrameMode(false);
	ob_start();
	$this->IncludeComponentTemplate();
	$json = ob_get_contents();
	$APPLICATION->RestartBuffer();
	while(ob_end_clean());
	header('Content-Type: text/html; charset='.LANG_CHARSET);
	echo $json;
	define("PUBLIC_AJAX_MODE", true);
	require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
	die();
} else {
	$this->IncludeComponentTemplate();
}
