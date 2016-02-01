<?php
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if( CModule::IncludeModule("iblock")&&CModule::IncludeModule("catalog") ){
	  if( isset($_POST['id']) && isset($_POST['ib']) && isset($_POST['fl']) ){
			  $ids=$_POST['id'];
			  $IBLOCK_ID=$_POST['ib'];
			  $f=fopen($_POST['fl'],"a");
			  $arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
				  foreach($ids as $id){
						  $rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $id)); 
						  while ($arOffer = $rsOffers->GetNextElement()){
								  $el = $arOffer->GetFields();
								  $el["PROPERTIES"] = $arOffer->GetProperties();
								  $NewCnt=$id.'|'.$el['ID'].'|'.$el['ACTIVE'].'|'.$el['NAME'].'|'.$el['XML_ID'].'|'.$el['DETAIL_PAGE_URL'].'|';
								  //$NewCnt.=$el['PROPERTIES']['CML2_2']['VALUE'].'|'.$el['PROPERTIES']['COLOR']['VALUE'].'|'.$el['PROPERTIES']['CML2_1']['VALUE'].'|';
								  $NewCnt.=chr(13);
								  $NewCnt=iconv('UTF-8',"windows-1251",$NewCnt);
								  fwrite($f,$NewCnt);
							  }
					  }
			  fclose($f);
			  //print_r($ids);
			  echo true;
		  }else echo md5('GET OUT!!!');
	}else echo false;
?>
