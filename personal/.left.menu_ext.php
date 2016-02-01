<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
global $USER;
$UserName=$USER->GetFullName();

$aMenuLinksExt=array(
					array(
						$UserName, 
						"", 
						Array(), 
						Array(), 
						"" 
						),
					);

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
unset($aMenuLinksExt);
?>