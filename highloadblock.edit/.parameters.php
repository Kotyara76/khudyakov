<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"BLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage('HLEDIT_COMPONENT_BLOCK_ID_PARAM'),
			"TYPE" => "TEXT",
			"DEFAULT" => '={$_REQUEST[\'BLOCK_ID\']}'
		),
		"ROW_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage('HLEDIT_COMPONENT_ID_PARAM'),
			"TYPE" => "TEXT",
			"DEFAULT" => '={$_REQUEST[\'ID\']}'
		),
		"LIST_URL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage('HLEDIT_COMPONENT_LIST_URL_PARAM'),
			"TYPE" => "TEXT"
		)
	)
);