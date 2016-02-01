<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	".default", 
	array(
		"USER_PROPERTY_NAME" => "",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "SECOND_NAME",
			3 => "LAST_NAME",
			4 => "PERSONAL_PROFESSION",
			5 => "PERSONAL_ICQ",
			6 => "PERSONAL_PHONE",
			7 => "PERSONAL_FAX",
			8 => "PERSONAL_MOBILE",
			9 => "PERSONAL_STREET",
			10 => "PERSONAL_MAILBOX",
			11 => "PERSONAL_STATE",
			12 => "PERSONAL_ZIP",
			13 => "PERSONAL_COUNTRY",
			14 => "PERSONAL_NOTES",
			15 => "WORK_COMPANY",
		),
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "PERSONAL_MOBILE",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>