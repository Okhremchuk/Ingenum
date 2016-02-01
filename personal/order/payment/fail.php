<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$inv_id = $_REQUEST["InvId"];

if (isset($inv_id))
{
echo "<div class='col_10'>Вы отказались от оплаты. Заказ# $inv_id</div>";
}
else
{
echo "<div class='col_10'>Вы отказались от оплаты.</div>";
}


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?> 