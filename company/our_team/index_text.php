
<div class="heading"> 
  <h2>Наши сотрудники</h2>
 </div>
 
<div> 
  <div style="text-align: justify;">Самое ценное в нашей компании - это наш коллектив. Мы одна большая дружная команда, которая работает над вашими проектами. Ответственность - главный критерий по которому мы подбираем сотрудников.</div>
 
  <div> 
    <br />
   </div>
 
  <div><?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"our_team",
	Array(
		"IBLOCK_TYPE" => "tools",
		"IBLOCKS" => array('25'),
		"NEWS_COUNT" => "99",
		"FIELD_CODE" => array(0=>"ID",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",3=>"PROPERTY_EMAIL",4=>"PROPERTY_POSITION",5=>"PROPERTY_SOCIAL",6=>"PROPERTY_SOCIAL_LINK",7=>"",),
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y"
	)
);?></div>
 </div>
