<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?> 
<div class="row"> 
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-push-8 col-md-push-8"> 
    <div class="heading"> 
      <h4>Мой кабинет</h4>
     </div>
   <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"vertical_left_menu",
	Array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array()
	)
);?> </div>
 
  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-pull-4 col-md-pull-4"> <?$APPLICATION->IncludeComponent(
	"bitrix:isale.keys.list", 
	"keys", 
	array(
		"TEMPLATE_URL_ORDER_DETAIL" => "/personal/order/make/index.php?ORDER_ID=2",
		"PAGE_COUNT" => "20",
		"PAGING_TEMPLATE" => "",
		"SET_TITLE" => "Y"
	),
	false
);?></div>
 </div>
 					<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>