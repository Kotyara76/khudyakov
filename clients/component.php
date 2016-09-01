<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$arDefaultUrlTemplates404 = array(
	"clients" => "",
	"detail" => "#ID#",
	"edit" => "edit/#ID#",
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	"CLIENT_ID",
	"COMPANY_ID",
);

$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

$componentPage = "";

if(isset($arVariables["CLIENT_ID"]) && intval($arVariables["CLIENT_ID"]) > 0) {
	$componentPage = "detail";
} elseif (isset($arVariables["COMPANY_ID"]) && intval($arVariables["COMPANY_ID"]) > 0) {
	$componentPage = "edit";
} else
	$componentPage = "clients";

$arResult = array(
	"FOLDER" => "",
	"URL_TEMPLATES" => Array(
		"clients" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
		"detail" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["CLIENT_ID"]."=#ID#"),
		"edit" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["COMPANY_ID"]."=#ID#"),
	),
	"VARIABLES" => $arVariables,
	"ALIASES" => $arVariableAliases
);

$this->IncludeComponentTemplate($componentPage);

?>