<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>

<div class="row">
    <div class="col-lg-6 col-md-6">

        <div class="error-404">
            <h3>404 <i class="fa fa-question-circle"></i></h3>
            <h4>Извините, запрашиваемая страница не существует</h4>
        </div>

    </div>
    <div class="col-lg-6 col-md-6">
        <h4>Полезные ссылки</h4>
        <?$APPLICATION->IncludeComponent("bitrix:main.map", "sitemap", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"SET_TITLE" => "Y",
	"LEVEL" => "3",
	"COL_NUM" => "2",
	"SHOW_DESCRIPTION" => "Y"
	),
	false
);?>
    </div>
</div>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>