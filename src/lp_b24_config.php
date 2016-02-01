<?php

/*
 * CONFIG
 */
define("DEV_MODE", false);
define("PRE_REL", false);
$modePrefix = DEV_MODE ? '/local/dev/' : '/'; 
$modePrefix = PRE_REL ? '/pre_rel/' : $modePrefix; 
define("LANG_CHARSET", "UTF-8");
define("LANG", "ru");
define("TOKEN", "ahviifcydlkputprpbdxxcxqnrwzkpjcmt");

define("PROJECT_FILE_PATH", dirname(__FILE__)."/src/.settings.php");
define("DEBUG", false);

define("BLOCK_PATH", "https://bx-shef.by".$modePrefix."lp_b24_php/blocks/#BLOCK_CODE#/template/public_block.html");
define("PROXY_PATH", "https://bx-shef.by".$modePrefix."lp_b24_php/proxy/proxy.php");
define("FILE_PERMISSIONS", 0644);
define("DIR_PERMISSIONS", 0755);
define("DEFAULT_UPDATE_SERVER", "https://bx-shef.by".$modePrefix."lp_b24_hosting");
define('UPDATE_DIR_TEMP', dirname(__FILE__).'/temp/');
define('UPDATE_DIR_INSTALL', dirname(__FILE__).'/../');
error_reporting(E_ALL);

require_once(SCRIPT_DIR."/src/lib/php_class/class.HtmlTag.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.serv.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.Configuration.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.Response.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.AutoUpdate.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.ShefB24Uploader.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.ShBitrix24.php");
require_once(SCRIPT_DIR."/src/lib/php_class/class.ShefBitrix24Lead.php");