<?php

class ShBitrix24 {
	protected $resource;
	protected $projectId;
	protected static $apps = null;
	
	public static function getInstance(){
		return static::$apps;
	}
	
	public function __construct($projectId){
		$projectId = intval($projectId);
		$this->projectId = $projectId;
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
		$protocol = isset($_SERVER["https"]) ? 'https' : 'http';
        $this->resource = array(
			"CLIENT_ID" => DEV_MODE ? '5d38b1fb45041a5425b24cdf5752d2d9' : (PRE_REL ?  'c3fea61dd5aac82ea129f874785d8841' : 'f54c04ee8677435c4a64da4feebea6e3'),
			"CLIENT_SECRET" => DEV_MODE ? 'adaa5bfc67601ea3821aed2e18154061' : (PRE_REL ? '87ea805b80b96d02d9315e0b8c6ca08e':  '3f2e25b8088bb2aff1c454f581b79348'),
			"TITLE" => 'Landing Page Import',
			"REDIRECT_URI" => $protocol.'://'.$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"],
			"SCOPE" => array('entity', 'crm', 'user'), //, 'user', 'entity', 'crm'
			'domen' => null,
			'code' => null,
			'access_token' => null,
			'expires_in' => null,
			'expires_die' => time(),
			'refresh_token' => null
		);
		$this->initFromStorage();
		static::$apps = $this;
	}
	private function initFromStorage(){
		$tmp = Configuration::getValue('project_'.$this->projectId);
		
		if(isset($tmp['b24connect']) && is_array($tmp['b24connect']) && count($tmp['b24connect']) > 0){
			$this->resource = array_merge($this->resource, $tmp['b24connect']);
		}
	}
	private function saveForStorage(){
		$tmp = Configuration::getValue('project_'.$this->projectId);
		$tmp['b24connect'] = $this->resource;
		if(isset($tmp['info']['USERINFO'])){
			$tmp['info']['USERINFO'] = array (
	          'access_token' => $this->resource['access_token'],
	          'refresh_token' => $this->resource['refresh_token'],
	          'expires_in' => $this->resource['expires_in'],
	          'domain' => $tmp['info']['USERINFO']['domain'],
	          'member_id' => $tmp['info']['USERINFO']['member_id'],
	        );
		}else{
			$tmp['info']['USERINFO'] = array (
	          'access_token' => $this->resource['access_token'],
	          'refresh_token' => $this->resource['refresh_token'],
	          'expires_in' => $this->resource['expires_in'],
	          'domain' => 'null',
	          'member_id' => 'null',
	        );
		}
		Configuration::setValue('project_'.$this->projectId, $tmp);
	}
	
	public function setDomen($value) {
		$this->resource['domen'] = $value;
		$this->saveForStorage();
	}
	public function setCode($value) {
		$this->resource['code'] = $value;
		$this->saveForStorage();
	}
	public function setToken($access_token, $expires_in, $refresh_token) {
		$this->resource['access_token'] = $access_token;
		$this->resource['expires_in'] = $expires_in;
		$this->resource['expires_die'] = $expires_in+time();
		$this->resource['refresh_token'] = $refresh_token;
		$this->saveForStorage();
	}

	public function getToken(){
		return array(
			'access_token' => $this->resource['access_token']
			,'expires_in' => $this->resource['expires_in']
			,'expires_die' => $this->resource['expires_die']
			,'refresh_token' => $this->resource['refresh_token']
		);
	}
	
	public function isNeedAuth(){
		
		return !isset($this->resource['access_token']) || $this->resource['access_token'] === null ? true : false;
	}
	public function isNeedRefresh(){
		//@tosee:
		// we make all time refresh - this garanted add to crm
		//return true;
		return time() > $this->resource['expires_die'] ? true : false;
	}

	public function getUrl($type = 'rest', $function = '') {

		$urls = array(
			'code' =>
				'https://'.$this->resource['domen'].'/oauth/authorize/?client_id='.$this->resource['CLIENT_ID'].
				'&response_type=code'.
				'&redirect_uri='.urlencode($this->resource['REDIRECT_URI']),
			'codeEXT' =>
				'https://'.$this->resource['domen'].'/oauth/authorize/?login=yes'.
				'&response_type=code'.
				'&client_id='.$this->resource['CLIENT_ID'].
				'&redirect_uri='.urlencode($this->resource['REDIRECT_URI']),
			'authorization_code' =>
				'https://'.$this->resource['domen'].'/oauth/token/?client_id='.$this->resource['CLIENT_ID'].
				'&grant_type=authorization_code'.
				'&client_secret='.$this->resource['CLIENT_SECRET'].
				'&redirect_uri='.urlencode($this->resource['REDIRECT_URI']).
				'&code='.$this->resource['code'].
				'&scope='.implode(',', $this->resource['SCOPE']),
			'rest' => 'https://'.$this->resource['domen'].'/rest/'.$function.'?auth='.$this->resource['access_token'],
			'refresh' => 'https://'.$this->resource['domen'].'/oauth/token/?client_id='.$this->resource['CLIENT_ID'].
				'&grant_type=refresh_token'.
				'&client_secret='.$this->resource['CLIENT_SECRET'].
				'&redirect_uri='.urlencode($this->resource['REDIRECT_URI']).
				'&refresh_token='.$this->resource['refresh_token'].
				'&scope='.implode(',', $this->resource['SCOPE'])
		);
		return $urls[$type];
	}

	public static function connectToBitrix24($params, $projectId) {

		$USERINFO = $params['USERINFO'];
		$DOMEN = $params['CUR_DOMEN'];
		
		$projectId = intval($projectId);
		$b24 = new ShBitrix24($projectId);
		
		$b24->setToken(
			$USERINFO['access_token'],
			$USERINFO['expires_in'],
			$USERINFO['refresh_token']
		);


		$b24->setDomen($DOMEN);
		//if( $b24->isNeedRefresh() === true ){
			$codes = Response::proxy($b24->getUrl('refresh'));
			if($codes['status'] != 200){
				return array(
					'response' => array('status' => 'error', 'message' => 'refresh: '.$codes['contents']),
					'values' => array()
				);
			}
			
			/*/
			print_r(array(
				$b24->getUrl('refresh'),
				$b24->getToken(),
				$codes
			));
				
			//die();
			//*/
			
			$codes = json_decode($codes['contents'], true);
			$b24->setToken(
				$codes['access_token'],
				$codes['expires_in'],
				$codes['refresh_token']
			);
		//}
		return true;
	}
	
}

class ShefBitrix24Test {

	public static function testConnect($params, $projectId){
		$conect = ShBitrix24::connectToBitrix24(
			 $params,
			 $projectId
		 );	
		if($conect === true){

			$arResult = ShefBitrix24Lead::insertTest($projectId);

			if(isset($arResult['error']) || intval($arResult['result']) < 1){
				$conect = array(
					'response' => array('status' => 'error', 'message' => $arResult['error_description']),
					'values' => array()
				);
			}else{
				$conect = array(
					'response' => array('status' => 'ok', 'message' => 'test lead add'),
					'values' => array(intval($arResult['result']))
				);
			}

			$b24 = ShBitrix24::getInstance();
			$b24->setToken(null, null, null);

		}
		
		return $conect;
	}
}