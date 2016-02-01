<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?>



<div class="col_10">

	 <?	// текст 
$APPLICATION->IncludeFile("/shared_inc/payment_info_inc.php", Array(), Array(
    "MODE"      => "html",                                           // будет редактировать в веб-редакторе
    "NAME"      => "Редактирование включаемой области раздела"     // текст всплывающей подсказки на иконке
    ));
?>


</div>
					<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>