<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация");
?><div class="row"> 
  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-push-9 col-md-push-9"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "right_menu",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => ""
	)
);?></div>
 
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-lg-pull-3 col-md-pull-3">

      <?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          Array(
              "AREA_FILE_SHOW" => "file",
              "PATH" => SITE_DIR . 'include_areas/index_add_faq.php',
              "EDIT_TEMPLATE" => ""
          )
      );?>

        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "page",
                "AREA_FILE_SUFFIX" => "text",
                "EDIT_TEMPLATE" => ""
            )
        );?>
  </div>
 </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
 <?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/yandex_metrika.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/yandex_metrika.php");?>
<?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/google_analytics.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/google_analytics.php");?>