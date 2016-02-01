
<div class="heading"> 
  <h2>Наши партнеры</h2>
 </div>
 
<div> 
  <div style="text-align: justify;">Самое ценное в нашей компании - это наши стратегические партнеры.</div>
 
  <div> 
    <br />
   </div>
 
  <div><?$APPLICATION->IncludeComponent(
	"bitrix:news.line", 
	"partners", 
	array(
		"IBLOCK_TYPE" => "tools",
		"IBLOCKS" => array(
			0 => "33",
		),
		"NEWS_COUNT" => "99",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "PROPERTY_WWW",
			4 => "PROPERTY_POSITION",
			5 => "PROPERTY_SOCIAL",
			6 => "PROPERTY_SOCIAL_LINK",
			7 => "",
		),
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y"
	),
	false
);?></div>
 </div>
