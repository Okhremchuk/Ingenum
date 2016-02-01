<?
$sLibertyPageIs = 'home';
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?> 
<div class="top-promo row"> 
  <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 promo-text"><strong>INGENUM</strong> - уважаемые посетили, наш корпоративный сайт находится на реконструкции. Все материалы на сайте носят демонстрационный характер.</div>
 
  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 promo-button"> <a href="http://marketplace.1c-bitrix.ru/tobasket.php?ID=doninbiz.liberty" target="_blank" class="btn btn-lg btn-primary" >КУПИТЬ СЕЙЧАС</a> 
    <div class="buy-today">завтра может быть дороже!</div>
   </div>
 </div>
 
<div class="home-services services-catalog"> 
  <div class="heading text-center"> 
    <h2>Наши услуги</h2>
   </div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"home_services",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCKS" => array('22'),
		"NEWS_COUNT" => "9",
		"FIELD_CODE" => array(0=>"PREVIEW_TEXT",1=>"PREVIEW_PICTURE",2=>"",),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "/services/#SECTION_CODE#/#CODE#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y"
	)
);?> </div>
 
<div class="row home-portfolio"> 
  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR.'include_areas/index_slider_portfolio_text.php',
		"EDIT_TEMPLATE" => ""
	)
);?> <span class="bxslider-prev" id="hp-bx-prev"></span> <span class="bxslider-next" id="hp-bx-next"></span> </div>
 
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"> <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"home_portfolio",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCKS" => array("24"),
		"NEWS_COUNT" => "20",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"PROPERTY_DATE_PROJECT",2=>"",),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "/portfolio/#SECTION_CODE#/#CODE#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y"
	)
);?> </div>
 </div>
 
<div class="row"> 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bxslider-block"> 
    <div class="heading"> 
      <h3>Наши новости</h3>
     </div>
   <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"home_news",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCKS" => array('21'),
		"NEWS_COUNT" => "10",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",3=>"DETAIL_PICTURE",4=>"DATE_ACTIVE_FROM",5=>"",),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "/news/#SECTION_CODE#/#CODE#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "j M Y"
	)
);?> </div>
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bxslider-block"> 
    <div class="heading"> 
      <h3>Отзывы клиентов</h3>
     </div>
   <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"customer_reviews",
	Array(
		"IBLOCK_TYPE" => "tools",
		"IBLOCKS" => array('23'),
		"NEWS_COUNT" => "99",
		"FIELD_CODE" => array(0=>"PREVIEW_TEXT",1=>"PREVIEW_PICTURE",2=>"PROPERTY_NAME",3=>"PROPERTY_POSITION",4=>"PROPERTY_SITE",),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y"
	)
);?></div>
 </div>
 
<div class="clearfix"></div>
 <?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>