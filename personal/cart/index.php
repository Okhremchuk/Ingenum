<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><div class="row"> 
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
);?> 
</div>
 
  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-pull-4 col-md-pull-4">
  <p><?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "basketLiberty", Array(
	"PATH_TO_ORDER" => "/personal/order/make/",	// Страница оформления заказа
		"HIDE_COUPON" => "N",	// Спрятать поле ввода купона
		"COLUMNS_LIST" => array(	// Выводимые колонки
			0 => "NAME",
			1 => "DELETE",
			2 => "PRICE",
			3 => "QUANTITY",
		),
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",	// Рассчитывать скидку для каждой позиции (на все количество товара)
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"QUANTITY_FLOAT" => "N",	// Использовать дробное значение количества
		"ACTION_VARIABLE" => "action",	// Название переменной действия
		"OFFERS_PROPS" => "",	// Свойства, влияющие на пересчет корзины
	),
	false
);?></p>

 <?    // текст 
$APPLICATION->IncludeFile("/shared_inc/personal_cart_index.php", Array(), Array(
    "MODE"      => "html",                                           // будет редактировать в веб-редакторе
    "NAME"      => "Редактирование включаемой области раздела"     // текст всплывающей подсказки на иконке
    ));
?></div></div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>