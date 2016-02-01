<?php





define("iLPB24HOSTINGVER", "13"); 


function _pr($print = array()){

	return '<pre>'.print_r($print, true).'</pre>';

}


function autoload($className){


        $thisClass = str_replace(__NAMESPACE__.'\\', '', __CLASS__);


        $baseDir = __DIR__;


        if (substr($baseDir, -strlen($thisClass)) === $thisClass) {


            $baseDir = substr($baseDir, 0, -strlen($thisClass));


        }


        $className = ltrim($className, '\\');


        $fileName  = $baseDir.'/';


        $namespace = '';    


        if ($lastNsPos = strripos($className, '\\')) {


            $namespace = substr($className, 0, $lastNsPos);


            $className = substr($className, $lastNsPos + 1);


            $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;


        }


        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';


        if (file_exists($fileName)) {


            require $fileName;


        }


}





/**


 * Register Slim's PSR-0 autoloader


*/


function registerAutoloader(){


	spl_autoload_register("autoload");


}


    


function handleError($errno, $errstr, $errfile, $errline, array $errcontext)


{


    if (0 === error_reporting()) {


        return false;


    }





    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);


}


set_error_handler('handleError');





function compareStrings($expected, $actual)


{





	if (function_exists('mb_orig_strlen'))


	{


		$lenExpected = mb_orig_strlen($expected);


		$lenActual = mb_orig_strlen($actual);


	}


	else


	{


		$lenExpected = strlen($expected);


		$lenActual = strlen($actual);


	}





	$status = $lenExpected ^ $lenActual;


	$len = min($lenExpected, $lenActual);


	for ($i = 0; $i < $len; $i++)


	{


		$status |= ord($expected[$i]) ^ ord($actual[$i]);


	}





	return $status === 0;


}





function getToken(){


	return str_replace('?', '', TOKEN);


}





if (!function_exists("file_get_contents"))


{


	function file_get_contents($filename)


	{


		$fd = fopen("$filename", "rb");


		$content = fread($fd, filesize($filename));


		fclose($fd);


		return $content;


	}


}





function GetMessage($str){


	return $str;


}