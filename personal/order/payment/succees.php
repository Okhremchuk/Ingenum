<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$inv_id = $_REQUEST["InvId"];

if (isset($inv_id))
{
echo "<div class='col_10'>Платеж совершен успешно. Заказ# $inv_id в обработке.</div>";
}
else
{
echo "<div class='col_10'>Платеж совершен успешно. Заказ в обработке.</div>";
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?> 