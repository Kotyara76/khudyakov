<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CPageOption::SetOptionString("main", "nav_page_in_session", "N"); // Запрещаем сохранять страницу в сессии

$requiredModules = array('highloadblock');

foreach ($requiredModules as $requiredModule)
{
	if (!CModule::IncludeModule($requiredModule))
	{
		ShowError(GetMessage("F_NO_MODULE"));
		return 0;
	}
}

$arParams['DISPLAY_FIELDS'] = array_diff($arParams['DISPLAY_FIELDS'], array(''));

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

// hlblock info
$hlblock_id = $arParams['BLOCK_ID'];

if (empty($hlblock_id))
{
	ShowError(GetMessage('HLBLOCK_LIST_NO_ID'));
	return 0;
}

$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();

if (empty($hlblock))
{
	ShowError('404');
	return 0;
}

$entity = HL\HighloadBlockTable::compileEntity($hlblock);

// uf info
$fields = $GLOBALS['USER_FIELD_MANAGER']->GetUserFields('HLBLOCK_'.$hlblock['ID'], 0, LANGUAGE_ID);

// sort
$sort_id = 'ID';
$sort_type = 'DESC';

if (!empty($_GET['sort_id']) && (isset($fields[$_GET['sort_id']])))
{
	$sort_id = $_GET['sort_id'];
}

if (!empty($_GET['sort_type']) && in_array($_GET['sort_type'], array('ASC', 'DESC'), true))
{
	$sort_type = $_GET['sort_type'];
}

// limit
$limit = array(
	'nPageSize' => ($arParams['ROWS_PER_PAGE'] > 0) ? (int)$arParams['ROWS_PER_PAGE'] : 10,
	'iNumPage' => is_set($_GET['PAGEN_1']) ? $_GET['PAGEN_1'] : 1,
	'bShowAll' => true
);



// execute query

$main_query = new Entity\Query($entity);
$main_query->setSelect(array('*'));
$main_query->setOrder(array($sort_id => $sort_type));

if (isset($limit['nPageTop']))
{
	//$main_query->setLimit($limit['nPageTop']); // Размер страницы задаётся в NavStart
}
else
{
	//$main_query->setLimit($limit['nPageSize']);  // Размер страницы задаётся в NavStart
	$main_query->setOffset(($limit['iNumPage']-1) * $limit['nPageSize']);
}

//$main_query->setLimit($limit['nPageSize']);
//$main_query->setOffset(($limit['iNumPage']-1) * $limit['nPageSize']);

$result = $main_query->exec();
$result = new CDBResult($result);

$result->NavStart($limit['nPageSize']); // Магия
// build results
$rows = array();

$tableColumns = array();

while ($row = $result->Fetch())
{
	foreach ($row as $k => $v)
	{
		if ($k == 'ID')
		{
			$tableColumns['ID'] = true;
			continue;
		}

		$arUserField = $fields[$k];

		if ($arUserField["SHOW_IN_LIST"]!="Y")
		{
			continue;
		}

		$html = call_user_func_array(
			array($arUserField["USER_TYPE"]["CLASS_NAME"], "getadminlistviewhtml"),
			array(
				$arUserField,
				array(
					"NAME" => "FIELDS[".$row['ID']."][".$arUserField["FIELD_NAME"]."]",
					"VALUE" => htmlspecialcharsbx($v)
				)
			)
		);

		if($html == '')
		{
			$html = '&nbsp;';
		}

		$tableColumns[$k] = true;

		$row[$k] = $html;
	}


	$rows[] = $row;
}


$arResult["NAV_STRING"] = $result->GetPageNavString('', (is_set($arParams['NAV_TEMPLATE'])) ? $arParams['NAV_TEMPLATE'] : 'arrows');
$arResult["NAV_PARAMS"] = $result->GetNavParams();
$arResult["NAV_NUM"] = $result->NavNum;


$arResult['rows'] = $rows;
$arResult['fields'] = $fields;
$arResult['tableColumns'] = $tableColumns;

$arResult['sort_id'] = $sort_id;
$arResult['sort_type'] = $sort_type;
//var_dump($result);

$this->IncludeComponentTemplate();