<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->SetTitle("import");
?>
<?php
if( !CModule::IncludeModule("iblock") || !CModule::IncludeModule("catalog") )die('Not include moduls');
require_once 'data.php';

$pathToFolderFile=$_SERVER['DOCUMENT_ROOT'].'/analiz/result/';
$IBLOCK_ID=11;
$arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);

function viewDump($mess){?><pre><? var_dump($mess);?></pre><? }
class myLog{
		private $fileName;
		// Сохраняет файл
		private function saveFile($cnt,$access='a'){
				$f=fopen($this->fileName,$access);
			  		fwrite($f,$cnt);
			  	fclose($f);
			}
		public function  viewEr($mess){$this->saveFile('<div style="color:#f00">'.$mess.'</div>');	}
		public function viewSucc($mess){$this->saveFile('<div style="color:#0F0">'.$mess.'</div>'); }
		public function __construct($file='myLog.txt',$pathInRoot='/analiz/'){
				if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathInRoot.$file))$this->fileName=$_SERVER['DOCUMENT_ROOT'].$pathInRoot.$file;
					else echo '[myLog]Not Found Log File';
			}
		
	}
$myLog=new myLog();
$myLog->viewSucc('Start part #'.$i);
$i=$_POST['step'];
$sourceFile='p_'.$i.'_new_xml_offers.csv';
ini_set('max_execution_time',7200);
$fileJob=$pathToFolderFile.$sourceFile;
if( !file_exists($fileJob) ){
		echo "not found file $fileJob<br />";
		die();
	}

$f=fopen($fileJob,"r");
	while(!feof($f)){
			$string=fgets($f);
			$string=trim($string);
			$string.=';';
			$string=iconv('windows-1251','UTF-8',$string);
			if($string!=';' ){
					$d=new data($string);
					$arSelect = array('ID');
					//WHERE
					$arFilter = array("IBLOCK_ID" => $IBLOCK_ID,'XML_ID'=>$d->XML_PRODUCT);
					$arSort = array();
					$rsIBlockElement =CIBlockElement::GetList($arSort, $arFilter, false,  false,$arSelect);			
					if($rs = $rsIBlockElement->GetNext()){
							$arSelect = array('ID');
							//WHERE
							$parentID=$rs['ID'];
							$arFilter = array('IBLOCK_ID' => $arInfo['IBLOCK_ID'],'PROPERTY_'.$arInfo['SKU_PROPERTY_ID']=>$parentID,);
							$arSort = array();
							$rsIBlockElement =CIBlockElement::GetList(array(), $arFilter);
							$beFound=false;
							while( $rs = $rsIBlockElement->GetNextElement() ){
									$skuFields=$rs->GetFields();
									$skuProp=$rs->GetProperties();
									if($skuProp['CML2_2']['VALUE']==$d->COLOR && $skuProp['CML2_1']['VALUE']==$d->SIZE){
											$skuID=$skuFields['ID'];
											$beFound=true;
											$el = new CIBlockElement;
											$arLoadProductArray = array(
																	  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
																	  'XML_ID'=>$d->XML_OFFER,
																	  );
											$res = $el->Update($skuID, $arLoadProductArray);
											$myLog->viewSucc('id='.$skuID.' color '.$d->COLOR.' size '.$d->SIZE);
										}
								}
							if(!$beFound) $myLog->viewEr("Not found!!!");

						}else $myLog->viewEr("Not data base ".$d->XML_PRODUCT);
					unset($d);
				}
		}
fclose($f);
$myLog->viewSucc('END part #'.$i);
echo 'END part #'.$i.'<br />';
ini_set('max_execution_time',1800);
?>	
<? //require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>