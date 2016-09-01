<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage('HLEDIT_COMPONENT_NAME'),
	"DESCRIPTION" => GetMessage('HLEDIT_COMPONENT_DESCRIPTION'),
	"ICON" => "images/hl_detail.gif",
	"SORT" => 20,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "hlblock",
			"NAME" => GetMessage('HLEDIT_COMPONENT_CATEGORY_TITLE'),
			"CHILD" => array(
				"ID" => "hlblock_edit",
			),
		),
	),
);

?>