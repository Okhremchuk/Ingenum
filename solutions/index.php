<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "INGENUM");
$APPLICATION->SetTitle("Решения автоматизации торговли");
?> 
<div class="row"> 
  <div class="col-lg-12"><?$APPLICATION->IncludeComponent(
	"eagle:vacancies.section", 
	".default", 
	array(
		"AJAX_MODE" => "N",
		"SEF_MODE" => "Y",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "31",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"ADD_SECTIONS_CHAIN" => "Y",
		"DISPLAY_COMPARE" => "N",
		"SET_STATUS_404" => "N",
		"PAGE_ELEMENT_COUNT" => "9",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "TIP_ZASHCHITY",
			1 => "REDAKTSIYA",
			2 => "KOL_VO_RAB_MEST",
			3 => "ADRES_DOSTAVKI",
			4 => "CML2_ARTICLE",
			5 => "CML2_BASE_UNIT",
			6 => "DATA_OPLATY",
			7 => "CML2_MANUFACTURER",
			8 => "CML2_TRAITS",
			9 => "CML2_TAXES",
			10 => "CML2_ATTRIBUTES",
			11 => "CML2_BAR_CODE",
			12 => "EST_ORIGINAL",
			13 => "REG_NOMER_OSNOVNOY_POSTAVKI_1S",
			14 => "REKOMENDUEM",
			15 => "SOVMESTNO",
			16 => "SOTRUDNIK_KONTRAGENTA",
			17 => "DATA_ZAKAZA_NA_SAYTE",
			18 => "NOMER_ZAKAZA_NA_SAYTE",
			19 => "ID_ZVONOK",
			20 => "RAZMER",
			21 => "KACHESTVO",
			22 => "KOLICHESTVO_V_BARABANE",
			23 => "KHARAKTERISTIKA",
			24 => "METOD_OPLATY",
			25 => "METOD_OPLATY_ID",
			26 => "ZAKAZ_OPLACHEN",
			27 => "DOSTAVKA_RAZRESHENA",
			28 => "OTMENEN",
			29 => "FINALNYY_STATUS",
			30 => "STATUS_ZAKAZA",
			31 => "STATUSA_ZAKAZA_ID",
			32 => "DATA_IZMENENIYA_STATUSA",
			33 => "SAYT",
			34 => "ARTIKUL_POSTAVSHCHIKA",
			35 => "VERSIYA",
			36 => "_1S",
			37 => "BESPLATNAYA_DOSTAVKA",
			38 => "BESPLATNAYA_USTANOVKA",
			39 => "BESPLATNAYA_INTEGRATSIYA",
			40 => "UPRAVLYAEMOE_PRILOZHENIE",
			41 => "ITS_PROF_3",
			42 => "SEO_DLYA_1_EDRPOU",
			43 => "ZAKRYTYY_PROGRAMMNYY_KOD",
			44 => "OBYCHNOE_PRILOZHENIE",
			45 => "PERIOD_PODPISKI",
			46 => "PRODLENIE",
			47 => "KOLICHESTVO_SAYTOV",
			48 => "PEREKHOD_S_REDAKTSII",
			49 => "PEREKHOD_NA_REDAKTSIYU",
			50 => "MODEL",
			51 => "PODSISTEMA",
			52 => "MODUL",
			53 => "UNIT_IN",
			54 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "TIP_ZASHCHITY",
			1 => "REDAKTSIYA",
			2 => "KOL_VO_RAB_MEST",
			3 => "ADRES_DOSTAVKI",
			4 => "CML2_ARTICLE",
			5 => "CML2_BASE_UNIT",
			6 => "DATA_OPLATY",
			7 => "MORE_PHOTO",
			8 => "CML2_MANUFACTURER",
			9 => "CML2_TRAITS",
			10 => "CML2_TAXES",
			11 => "CML2_ATTRIBUTES",
			12 => "CML2_BAR_CODE",
			13 => "EST_ORIGINAL",
			14 => "REG_NOMER_OSNOVNOY_POSTAVKI_1S",
			15 => "REKOMENDUEM",
			16 => "SOVMESTNO",
			17 => "SOTRUDNIK_KONTRAGENTA",
			18 => "DATA_ZAKAZA_NA_SAYTE",
			19 => "NOMER_ZAKAZA_NA_SAYTE",
			20 => "ID_ZVONOK",
			21 => "RAZMER",
			22 => "KACHESTVO",
			23 => "KOLICHESTVO_V_BARABANE",
			24 => "KHARAKTERISTIKA",
			25 => "METOD_OPLATY",
			26 => "METOD_OPLATY_ID",
			27 => "ZAKAZ_OPLACHEN",
			28 => "DOSTAVKA_RAZRESHENA",
			29 => "FINALNYY_STATUS",
			30 => "ARTIKUL_POSTAVSHCHIKA",
			31 => "VERSIYA",
			32 => "BESPLATNAYA_DOSTAVKA",
			33 => "BESPLATNAYA_USTANOVKA",
			34 => "BESPLATNAYA_INTEGRATSIYA",
			35 => "UPRAVLYAEMOE_PRILOZHENIE",
			36 => "ITS_PROF_3",
			37 => "SEO_DLYA_1_EDRPOU",
			38 => "ZAKRYTYY_PROGRAMMNYY_KOD",
			39 => "OBYCHNOE_PRILOZHENIE",
			40 => "PERIOD_PODPISKI",
			41 => "PRODLENIE",
			42 => "KOLICHESTVO_SAYTOV",
			43 => "PEREKHOD_S_REDAKTSII",
			44 => "PEREKHOD_NA_REDAKTSIYU",
			45 => "MODEL",
			46 => "OPISANIE",
			47 => "IZOBRAZHENIE",
			48 => "KOMPLEKTATSIYA",
			49 => "PODSISTEMA",
			50 => "PROGRAMMNAYA_ZASHCHITA",
			51 => "MODUL",
			52 => "TIP_PODPISKI",
			53 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "0",
		"PRICE_CODE" => array(
			0 => "Поставка не облагается НДС - SID",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
			0 => "PEREKHOD_S_REDAKTSII",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "N",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "TIP_ZASHCHITY",
			1 => "REDAKTSIYA",
			2 => "KOL_VO_RAB_MEST",
			3 => "ADRES_DOSTAVKI",
			4 => "CML2_ARTICLE",
			5 => "CML2_BASE_UNIT",
			6 => "DATA_OPLATY",
			7 => "CML2_MANUFACTURER",
			8 => "CML2_TRAITS",
			9 => "CML2_TAXES",
			10 => "CML2_ATTRIBUTES",
			11 => "CML2_BAR_CODE",
			12 => "EST_ORIGINAL",
			13 => "REG_NOMER_OSNOVNOY_POSTAVKI_1S",
			14 => "REKOMENDUEM",
			15 => "SOVMESTNO",
			16 => "SOTRUDNIK_KONTRAGENTA",
			17 => "DATA_ZAKAZA_NA_SAYTE",
			18 => "NOMER_ZAKAZA_NA_SAYTE",
			19 => "ID_ZVONOK",
			20 => "RAZMER",
			21 => "KACHESTVO",
			22 => "KOLICHESTVO_V_BARABANE",
			23 => "KHARAKTERISTIKA",
			24 => "METOD_OPLATY",
			25 => "METOD_OPLATY_ID",
			26 => "ZAKAZ_OPLACHEN",
			27 => "DOSTAVKA_RAZRESHENA",
			28 => "OTMENEN",
			29 => "FINALNYY_STATUS",
			30 => "STATUS_ZAKAZA",
			31 => "STATUSA_ZAKAZA_ID",
			32 => "DATA_IZMENENIYA_STATUSA",
			33 => "SAYT",
			34 => "ARTIKUL_POSTAVSHCHIKA",
			35 => "VERSIYA",
			36 => "_1S",
			37 => "BESPLATNAYA_DOSTAVKA",
			38 => "BESPLATNAYA_USTANOVKA",
			39 => "BESPLATNAYA_INTEGRATSIYA",
			40 => "UPRAVLYAEMOE_PRILOZHENIE",
			41 => "ITS_PROF_3",
			42 => "SEO_DLYA_1_EDRPOU",
			43 => "ZAKRYTYY_PROGRAMMNYY_KOD",
			44 => "OBYCHNOE_PRILOZHENIE",
			45 => "PERIOD_PODPISKI",
			46 => "PRODLENIE",
			47 => "KOLICHESTVO_SAYTOV",
			48 => "PEREKHOD_S_REDAKTSII",
			49 => "PEREKHOD_NA_REDAKTSIYU",
			50 => "MODEL",
			51 => "OPISANIE",
			52 => "IZOBRAZHENIE",
			53 => "KOMPLEKTATSIYA",
			54 => "PODSISTEMA",
			55 => "PROGRAMMNAYA_ZASHCHITA",
			56 => "MODUL",
			57 => "TIP_PODPISKI",
		),
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SEF_FOLDER" => "/solutions/",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?></div>
 </div>
<div id="hypercomments_widget"></div>
 
<script type="text/javascript">
_hcwp = window._hcwp || [];
_hcwp.push({widget:"Stream", widget_id: 22244});
(function() {
if("HC_LOAD_INIT" in window)return;
HC_LOAD_INIT = true;
var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/22244/"+lang+"/widget.js";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hcc, s.nextSibling);
})();
</script>
 <a href="http://hypercomments.com" class="hc-link" title="comments widget" >comments powered by HyperComments</a> 

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>