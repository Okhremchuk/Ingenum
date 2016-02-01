<?php
class Response {	
	
	private static $instance;
	
	private $data = array();
			
			
	public static function getValues()
    {
        $response = Response::getInstance();
        return $response->get();
    }

    public static function setValue($name, $value)
    {
        $response = Response::getInstance();
        $response->add($name, $value);
    }
	public static function sendValues($type_send = 'json'){
		$response = Response::getInstance();
		if($type_send == 'json'){
			$response->sendJsonData();
		}elseif($type_send == 'print'){
			$response->sendPrintData();
		}else{
			throw new \Exception("send type [".$type_send."] not found"); //'"
		}
		
	}
    private function __construct()
    {
    	$this->initData();
    }
    
    private function initData(){
    	$this->data = array(
			'response' => array(
				'status' => '', //error || info || success
				'message' => '', //info about result
				),
			'values' => array() //values
			);
    }
    
	/**
     * @static
     * @return Response
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
    
	public function add($name, $value)
    {
		$this->data[$name] = $value;
    }
    
	public function get()
    {
		return $this->data;
    }
    
    public function sendJsonData(){	
		//$this->sendPrintData();
		header('Content-Type: application/x-javascript; charset='.LANG_CHARSET);
		/*
		if(){
			header('HTTP/1.0 400 Bad Request', true, 400);
			'response', array('status' => 'error',
		}
		*/
		if(LANG_CHARSET !== 'UTF-8'){
			array_walk_recursive($this->data, function(&$element) {
				$element = Response::convertEncoding(
						$element, LANG_CHARSET, 'UTF-8'
				);
			});
		}
		$callback = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : '';
		if(strlen($callback) > 0){
			echo $callback .'('.json_encode($this->data).');';
		}else{
			echo json_encode($this->data);
		}

		
	}
	
	public function sendPrintData(){
		echo '<pre>'.print_r($this->data, true).'</pre>';
	}
	
	public static function convertEncoding($string, $charsetFrom, $charsetTo, &$errorMessage = "")
	{
		$string = strval($string);
		if (strcasecmp($charsetFrom, $charsetTo) == 0) return $string;
		$errorMessage = '';
		if ($string == '') return '';
		$res = '';
		if (function_exists('iconv')){
			$res = iconv($charsetFrom, $charsetTo, $string);
			if (!$res) $errorMessage .= "Iconv reported failure while converting string to requested character encoding. ";
		}
		return $res;
	}
	
	public static function proxy($url, $isPost = false, $data = array()){
		$ch = curl_init( $url );
	  
		if ( $isPost === true ) {
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));	
		}
  //echo ($url).'<br>';
	  //curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );	  
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	  curl_setopt( $ch, CURLOPT_HEADER, true );
	  curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
	  
	  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
	  
	  curl_setopt( $ch, CURLOPT_VERBOSE, true);
	  $verbose = fopen('php://temp', 'rw+');
	  curl_setopt( $ch, CURLOPT_STDERR, $verbose);
	  
	  $header2 = $header = $contents = '';
	  $result = curl_exec($ch);
	  if ($result === FALSE) {
	  	printf("cUrl error (#%d): %s<br>\n", curl_errno($ch),
	  		htmlspecialchars(curl_error($ch))
	  	);
	  	rewind($verbose);
	  	$verboseLog = stream_get_contents($verbose);
	  	echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
	  }else{
	  	list( $header, $contents ) = preg_split( '/([\r\n][\r\n])\\1/', $result, 2);
	  	try {
	  		list( $header2, $contents ) = preg_split( '/([\r\n][\r\n])\\1/', $contents, 2 );
	  	} catch (Exception $e) {
	  		$header2 = '';
	  	}
	  	$status = curl_getinfo( $ch );
	  } 
	  curl_close( $ch );

	  return array(
	  	'status' => $status['http_code'],
	  	'contents' => $contents,
		'header' => $header,
		'header2' => $header2,
	  );
	  
	}
}