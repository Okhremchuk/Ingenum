<?
$sLibertyPageIs = 'contacts';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "INGENUM");
$APPLICATION->SetTitle("Контакты компании");
?> 
<div class="row contacts-page"> 
  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"> 
   <noindex>
    <div class="heading"> 
      <h3>Написать письмо</h3>
     </div>
   
    <p>Мы оказываем бесплатную техническую поддержку по любой приобретенной у нас услуге или решению. Вы можете обратиться к нам по любому из каналов связи (корпоративный портал, телефон, электронная почта) если у вас возникли трудности при работе с нашими услугами или решениями.</p>
   
    <br />
   
   <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"contacts",
	Array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "info@ingenum.ua",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"EMAIL",2=>"MESSAGE",),
		"EVENT_MESSAGE_ID" => array(0=>"7",)
	)
);?></noindex> </div>
 
  <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6"> 
    <div class="heading"> 
      <h3>Наш офис</h3>
     </div>
   
    <div class="office"> 
      <address> <dl class="dl-horizontal"> <dt>Адрес:</dt> <dd><i class="fa fa-map-marker"></i> г. Киев, ул. Стройиндустрии, 8-б</dd> <dt>Телефоны:</dt> <dd><i class="fa fa-phone"></i> 0 (44) 393-42-97</dd><dd><i class="fa fa-phone"></i> 0 (67) 323-42-97</dd><dd><i class="fa fa-phone"></i> 0 (50) 464-42-97</dd><dd><i class="fa fa-phone"></i> 0 (93) 277-55-97</dd> <dt>Факс:</dt> <dd><i class="fa fa-phone-square"></i> 0 (44) 393-42-97</dd> <dt>Email:</dt> <dd><i class="fa fa-envelope"></i> <a href="mailto:info@ingenum.ua" >info@ingenum.ua</a></dd> </dl> </address>
     </div>
   <hr /> 
    <div class="heading"> 
      <h3>Рабочее время</h3>
     </div>
   
    <div class="operation-time"> <dl class="dl-horizontal"> <dt><i class="fa fa-clock-o"></i></dt> <dd>Понедельник-Четверг <b>9<sup>30</sup>-18<sup>00</sup></b></dd> <dt><i class="fa fa-clock-o"></i></dt> <dd>Пятница - <b>9<sup>30</sup>-17<sup>00</sup></b></dd> <dt><i class="fa fa-times-circle-o"></i></dt> <dd>Суббота-Воскресенье - <b>выходной</b></dd> </dl> </div>
   <hr /> 
    <div class="heading"> 
      <h3>Мы в соцсетях</h3>
     </div><noindex>
   <?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"contacts_social",
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
);?> </noindex></div>
 </div>
 <noindex>
</noindex><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>