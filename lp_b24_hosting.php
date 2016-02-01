<?php
header('Access-Control-Allow-Origin: *');
define("SCRIPT_DIR", dirname(__FILE__));
require SCRIPT_DIR."/src/lp_b24_config.php";
//*/






























///////// WORK /////////
// only UTF-8
if(
		!defined('TOKEN') 
		|| TOKEN == '' 
		|| TOKEN == 'HERE_TO_INSERT_CODE' // this test. Put code in to /src/lp_b24_config.php"
	){
	Response::setValue('response', array('status' => 'error', 'message' => 'token key not set in config at hosting'));
	Response::setValue('values', iLPB24HOSTINGVER); //update_ver
	Response::sendValues();
	die();
}elseif(
		!isset($_REQUEST['token']) 
		|| ( !compareStrings(getToken(), $_REQUEST['token']) && !compareStrings(md5(getToken()), $_REQUEST['token']) )
)
{
	Response::setValue('response', array('status' => 'error', 'message' => 'bad token key'));
	Response::setValue('values', iLPB24HOSTINGVER); //update_ver
	Response::sendValues();
	die();	
}elseif(!isset($_REQUEST['projectId']) || intval($_REQUEST['projectId']) < 1){
	Response::setValue('response', array('status' => 'error', 'message' => 'bad project ID'));
	Response::sendValues();
	die();	
}

try {
	
// decode angular response ///////////////////////	
	if(isset($_REQUEST['prepere'])){
		$params = json_decode(trim(file_get_contents('php://input')), true);
		if(count($params) > 0){
			foreach($params as $kode => $val){
				$_REQUEST[$kode] = $val;
			}
		}
	}
	/////////////////////////////////
	
	$_REQUEST['projectId'] = intval($_REQUEST['projectId']);
	$_REQUEST['params'] = isset($_REQUEST['params']) ? $_REQUEST['params'] : array();
	if (get_magic_quotes_gpc()) {
		$_REQUEST['params'] = is_string($_REQUEST['params']) ? stripslashes($_REQUEST['params']) : $_REQUEST['params'];
	}
	
	$classFunctionName = $_REQUEST['className'].'::'.$_REQUEST['functionName'];
	
	$result = array();

	switch($classFunctionName):
		case 'ShefB24Uploader::checkProject':		 $result = ShefB24Uploader::checkProject($_REQUEST['params'], $_REQUEST['projectId']); break;
		case 'ShefB24Uploader::uploadProjectFiles':	 $result = ShefB24Uploader::uploadProjectFiles($_REQUEST['params'], $_REQUEST['projectId']); break;
		case 'ShefB24Uploader::compileProject':		 $result = ShefB24Uploader::compileProject($_REQUEST['params'], $_REQUEST['projectId']); break;
		case 'ShefBitrix24Lead::insert':		 $result = ShefBitrix24Lead::insert($_REQUEST['params'], $_REQUEST['projectId']); break;
		case 'ShefBitrix24Test::testConnect':		 $result = ShefBitrix24Test::testConnect($_REQUEST['params'], $_REQUEST['projectId']); break;
		case 'ShefB24Uploader::getVer':			 $result = array('response' => array('status' => 'ok', 'message' => iLPB24HOSTINGVER), 'values' => array()); break;
		case 'ShefAutoUpdate::makeUpdate':		 $result = AutoUpdate::makeUpdate($_REQUEST['params']); break;

		default: 
			$result = array(
				'response' => array('status' => 'error', 'message' => 'bad name space'),
				'values' => array()
			);
		break;
	endswitch;
	
	Response::setValue(
		'response', $result['response']
	);
	if(isset($result['values'])){
		Response::setValue(
			'values', $result['values']
		);
	}
} catch (Exception $e) {
	ob_get_clean();
	Response::setValue(
		'response', array('status' => 'error', 'message' => 'Exception: '.$e->getMessage())
		//'response', array('status' => 'error', 'message' => 'Exception: '.$e->getMessage().'<pre>.'.print_r($e->getTrace(), true).'</pre>')
	);
}
Response::sendValues();
die();	
?>