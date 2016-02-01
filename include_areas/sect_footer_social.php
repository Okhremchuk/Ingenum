<div class="block">
  <div class="heading"> 
    <h4 class="title">Мы в соцсетях</h4>
   </div>
 
  <div class="box"> <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"bottom_social",
	Array(
		"IBLOCK_TYPE" => "tools",
		"IBLOCKS" => array('24'),
		"NEWS_COUNT" => "99",
		"FIELD_CODE" => array(0=>"PROPERTY_TYPE",1=>"PROPERTY_LINK",2=>"PROPERTY_VIEW",),
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y"
	)
);?> </div>
 </div>