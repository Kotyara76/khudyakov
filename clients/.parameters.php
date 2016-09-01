<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("highloadblock"))
	return;

$arComponentParameters = array(
	"GROUPS" => array(
		"LIST_SETTINGS" => array(
			"NAME" => GetMessage("CN_P_LIST_SETTINGS"),
		),
		"DETAIL_SETTINGS" => array(
			"NAME" => GetMessage("CN_P_DETAIL_SETTINGS"),
		),
	),
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
			"CLIENT_ID" => Array("NAME" => 'Параметр идентификатора клиента'),
			"COMPANY_ID" => Array("NAME" => 'Параметр идентификатора компании'),
		),

		"AJAX_MODE" => array(),
		"CLIENT_BLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("K_CLIENT_BLOCK_ID_NAME"),
			"TYPE" => "STRING",
			"REFRESH" => "N",
		),
		"COMPANY_BLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("K_COMPANY_BLOCK_ID_NAME"),
			"TYPE" => "STRING",
			"REFRESH" => "N",
		),
		"LIST_DISPLAY_FIELDS" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("K_LIST_TABLE_FIELDS"),
			"TYPE" => "STRING",
			"MULTIPLE" => "Y",
			"REFRESH" => "N",
			"SIZE" => 3,
			"ADDITIONAL_VALUES" => "Y",
		),
		"LIST_DETAIL_LINK_FIELD" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("K_LIST_DETAIL_LINK_FIELD"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"REFRESH" => "N",
		)

	),
);