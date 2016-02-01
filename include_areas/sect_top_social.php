<?$APPLICATION->IncludeComponent("bitrix:news.line", "top_social", Array(
		"IBLOCK_TYPE" => "tools",	// Тип информационного блока
		"IBLOCKS" => array('24'),
		"NEWS_COUNT" => "99",	// Количество новостей на странице
		"FIELD_CODE" => array(	// Поля
			0 => "PROPERTY_TYPE",
			1 => "PROPERTY_LINK",
			2 => "PROPERTY_VIEW",
		),
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "300",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);?>