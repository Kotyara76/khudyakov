<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("HLBLOCK_CLIENTS_NAME"),
	"DESCRIPTION" => GetMessage("HLBLOCK_CLIENTS_DESCRIPTION"),
	"ICON" => "/images/news_all.gif",
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "khudyakov",
		"CHILD" => array(
			"ID" => "clients",
			"NAME" => GetMessage("T_HLBLOCK_DESC_CLIENTS"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "clients",
			),
		),
	),
);

?>