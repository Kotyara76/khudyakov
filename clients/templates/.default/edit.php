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
var_dump($arResult);
?>
<?$APPLICATION->IncludeComponent(
    "khudyakov:highloadblock.edit",
    "",
    Array(
        "BLOCK_ID" => $arParams['COMPANY_BLOCK_ID'],
        "LIST_URL" => $arResult['URL_TEMPLATES']['clients'],
        "ROW_ID" => $arResult['VARIABLES']['COMPANY_ID']
    ),
    $component
);?>