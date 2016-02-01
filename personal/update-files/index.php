<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Релизы панелей телефонии");
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
 
  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-pull-4 col-md-pull-4"> <?

if ($USER->IsAuthorized()&&CModule::IncludeModule("sale")):
   $arOrders = array();
   $arFilter = Array(
      "USER_ID" => $USER->GetID(),
      "STATUS_ID"=>"F"
      );
   $rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
   while ($arSales = $rsSales->Fetch())
   {
      $arOrders[] = $arSales["ID"];
   }



$dbBasketItems = CSaleBasket::GetList(
    array(
            "NAME" => "ASC",
            "ID" => "ASC",
        ),
    array(
          
             "ORDER_ID"=>$arOrders
         ),
    false,
    false,
    array("PRODUCT_ID" )
    );

while ($arItems = $dbBasketItems->Fetch())
{
   	 $arBasketItems[] = $arItems["PRODUCT_ID"];
} 


$arFilter = Array(
   "IBLOCK_ID"=>31, 
   "ACTIVE"=>"Y", 
   "PROPERTY_Linked_Goods"=>$arBasketItems
   );

endif;
?> <?if ((!empty($arBasketItems)
		&&!empty($arOrders)
		&&$USER->IsAuthorized()
		)
		||($USER->isAdmin())){?> 
    <h3>Релизы </h3>
   <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"board",
	Array(
		"IBLOCK_TYPE" => "NewRelease",
		"IBLOCK_ID" => "31",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"ELEMENT_SORT_FIELD" => "active_from",
		"ELEMENT_SORT_ORDER" => "desc",
		"FILTER_NAME" => "arFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"OFFERS_LIMIT" => "10",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_GROUPS" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "Y",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_PROPERTIES" => array(),
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Дистрибутивы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?> <? } else { 
		$APPLICATION->AuthForm('Вы не авторизованы в системе');
  	}?>  </div>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>