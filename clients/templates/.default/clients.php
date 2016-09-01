<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.list",
	"",
	array(
		"BLOCK_ID" => $arParams['CLIENT_BLOCK_ID'],
		"DETAIL_URL" => "?CLIENT_ID=#ID#",
		"COMPONENT_TEMPLATE" => ".default",
		'ROWS_PER_PAGE' => 10,
		'NAV_TEMPLATE' => 'modern',

		"DETAIL_LINK_FIELD" => $arParams["LIST_DETAIL_LINK_FIELD"],
		"DISPLAY_FIELDS" => $arParams["LIST_DISPLAY_FIELDS"],
	),
	$component
);?>
