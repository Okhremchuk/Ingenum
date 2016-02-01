<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("demo");
?>
<noindex>
<!--<style type="text/css">.container{padding-left:0px !important;}</style>-->
<script type="text/javascript">
	$(function(){
			var ww=$(document).width(),
				wh=$(document).height();
			$('#content').width(ww).height(wh);
			$('#inner-content').width(ww).height(wh);
			$('#1c_frame').width(ww-32).height(wh-20);
			$('.splash')
		});
	
</script></noindex>
 <?$APPLICATION->IncludeComponent(
	"bitrix:intranet.1c82.interface", 
	".default", 
	array(
		"1C_URL" => "http://www.ingenum.ua:8082/UT11_ING/ru/",
		"LOGIN" => "",
		"PASS" => "",
		"NAME" => "Демонстрация возможностей управляемого приложения",
		"BLANK_MODE" => "N",
		"SET_TITLE" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>