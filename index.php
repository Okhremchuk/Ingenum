<?
$sLibertyPageIs = 'home';
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "INGENUM");
$APPLICATION->SetTitle("INGENUM - готовые решения для автоматизации учета и управления в торговом предприятии");
?><div class="top-promo row">
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 promo-text">
		<h1>INGENUM - готовые решения для автоматизации учета и управления в торговом предприятии</h1>
 <span style="background-color: #ffffff;"><strong>INGENUM</strong>&nbsp;<b>занимается автоматизацией оптово-розничной торговли, электронной коммерции, мобильной торговли, а также оказывает услуги автоматизации &nbsp;компаниям, занимающимся профессиональными услугами для бизнеса!&nbsp;</b></span><span style="background-color: #ffffff;">Наша компания - образец использования готовых решений для этих сфер бизнеса. Мы работаем на тех же типовых решениях, которые предлагаем вам для автоматизации вашего бизнеса. Вся работа компании по управлению бизнесом и оперативному планированию проектов ведется в Битрикс24, который обменивается заказами и контактной информацией с нашими двумя интернет-магазинами на Битриксе, после чего данные оперативного учета мигрируют в 1С:Управление торговлей 3.0 и уже оттуда в 1С:Бухгалтерию. В нашу конфигурацию 1С:Управление торговлей интегрированы дополнительные подсистемы: Обмен с Битрикс, Панель телефонии Asterisk которая работает с IP-телефонией Askozia, система Электронная коммерция, службы СМС рассылок АльфаSMS, TurboSMS и Email рассылок MailChimp, а также службы доставки Новая почта и Интайм. Кадровый учет и расчет заработной платы ведется в 1С:Зарплата и управление персоналом после чего осуществляется обмен с 1С:Бухгалтерией. Данные регламентированной отчетности передаются из 1С:Бухгалтерия и 1С:Управление торговлей 3.0 прямо в 1С-Звит без промежуточной выгрузки/загрузки.&nbsp;</span><span style="line-height: 28.5714302062988px; background-color: #ffffff;">Консолидированные данные по всем организациям передаются в конфигурацию 1С:Управляющий для автоматизации</span><span style="line-height: 28.5714302062988px; background-color: #ffffff;"> ведения управленческого учета</span><span style="font-family: 'Open Sans', Tahoma, Arial, 'Sans Serif'; line-height: 28.5714302062988px; background-color: #ffffff;">.</span><span style="color: #666666; font-family: 'Open Sans', Tahoma, Arial, 'Sans Serif'; font-size: 20px; line-height: 28.5714302062988px; background-color: #ffffff;">&nbsp;</span><span style="background-color: #ffffff;">Все наши информационные базы используются в клиент-серверном варианте и некоторые из них опубликованы на WEB-сервере Apache, что позволяет работать с базой через тонкий клиент 1С без необходимости подключения к серверу по RDP.</span>
	</div>
	<div id="question" href="#formQuestion" class="col-lg-3 col-md-3 col-sm-4 col-xs-12 promo-button">
 <a href="http://ingenum.ua" target="_self" class="btn btn-lg btn-primary">ЗАКАЗАТЬ ДЕМОНСТРАЦИЮ</a>
		<div class="buy-today">
			 Ведется предварительная запись!
		</div>
	</div>
</div>
<div class="home-services services-catalog">
	<div class="heading text-center">
		<h2>Наши решения<br>
 </h2>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"home_services",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "home_services",
		"DETAIL_URL" => "/services/#SECTION_CODE#/#CODE#/",
		"FIELD_CODE" => array("PREVIEW_TEXT","PREVIEW_PICTURE",""),
		"IBLOCKS" => array("31"),
		"IBLOCK_TYPE" => "1c_catalog",
		"NEWS_COUNT" => "9",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
<div class="row home-portfolio">
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR.'include_areas/index_slider_portfolio_text.php'
	)
);?> <span class="bxslider-prev" id="hp-bx-prev"></span> <span class="bxslider-next" id="hp-bx-next"></span>
	</div>
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"home_portfolio",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "/portfolio/#SECTION_CODE#/#CODE#/",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"PROPERTY_DATE_PROJECT",2=>"",),
		"IBLOCKS" => array(0=>"23",),
		"IBLOCK_TYPE" => "content",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bxslider-block">
		<div class="heading">
			<h3>Наши&nbsp;новости</h3>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"home_news",
	Array(
		"ACTIVE_DATE_FORMAT" => "j M Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "/news/#SECTION_CODE#/#CODE#/",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",3=>"DETAIL_PICTURE",4=>"DATE_ACTIVE_FROM",5=>"",),
		"IBLOCKS" => array(0=>"20",),
		"IBLOCK_TYPE" => "content",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bxslider-block">
		<div class="heading">
			<h3>Отзывы клиентов</h3>
		</div>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"customer_reviews",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(0=>"PREVIEW_TEXT",1=>"PREVIEW_PICTURE",2=>"PROPERTY_NAME",3=>"PROPERTY_POSITION",4=>"PROPERTY_SITE",5=>"",),
		"IBLOCKS" => array(0=>"22",),
		"IBLOCK_TYPE" => "tools",
		"NEWS_COUNT" => "99",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
</div>
 <noindex>
<div id="formQuestion" style="display:none">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"FormMessageFromSolutions",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "Y",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"NOT_SHOW_FILTER" => array(0=>"SIMPLE_QUESTION_841",1=>"SIMPLE_QUESTION_766",2=>"SIMPLE_QUESTION_159",),
		"NOT_SHOW_TABLE" => "",
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "N",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => Array("action"=>"action"),
		"WEB_FORM_ID" => "1"
	)
);?>
</div>
 </noindex>
<div class="clearfix">
</div>
 <noindex>
<? 
	// Поодключаем fancybox 
	/*$fancybox='/bitrix/templates/.default/include/jquery.fancybox';
	$APPLICATION->SetAdditionalCSS($fancybox.'.css');
	$APPLICATION->AddHeadScript($fancybox.'.js');*/
?> <script type="text/javascript">
	$(function(){
			$("#question").fancybox({
		  			'transitionIn'	:	'elastic',
					'transitionOut'	:	'elastic',
					'speedIn'		:	600, 
					'speedOut'		:	200, 
					'scrolling':	'none',
					'overlayShow'	:	true,
					'overlayOpacity':0.3
				});
		});
</script>  </noindex>
 <?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
<?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/yandex_metrika.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/yandex_metrika.php");?>
<?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/google_analytics.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/google_analytics.php");?>