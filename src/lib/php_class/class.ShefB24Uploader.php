<?php
class ShefB24Uploader {
	public static function checkProject($params, $projectId){
		(array)$params = json_decode($params, true);
		$projectId = intval($projectId);
		Configuration::setValue('project_'.$projectId, $params);
		return array(
			'response' => array('status' => 'ok', 'message' => 'project_save'),
			'values' => array()
		);
	}
	
	public static function uploadProjectFiles($params, $projectId) {
		$projectId = intval($projectId);
		$project = Configuration::getValue('project_'.$projectId);
		//(array)$params = json_decode($params, true);
		
		//download js
		$dirPath = $widgetFileTemplateDir = SCRIPT_DIR.'/src/js_'.$projectId;
		$dirPathAbs = Configuration::getPath($dirPath);
		if (!file_exists($dirPathAbs)) {
			mkdir($dirPathAbs, DIR_PERMISSIONS, false);
		}
		
		if(isset($project['src']['JS']) && is_array($project['src']['JS'])){
			foreach ($project['src']['JS'] as $value) {	
				$filePath = $dirPath.'/'.$value['name'];
				$filePathAbs = $dirPathAbs.'/'.$value['name'];
				$templateFix['contents'] = '';
				switch ($value['type']) {
					case 'h':
						break;
					case 'f':
						$templateFix = Response::proxy($value['content']);
						if($templateFix['status'] != 200){
							$templateFix['contents'] = '/* error download FILE '.$value['content'].' */';
						}else{
							$templateFix['contents'] = $templateFix['header2'].$templateFix['contents'];
						}
					break;
					case 't':
						$templateFix['contents'] = $value['content'];
					break;
					default:
						$templateFix['contents'] = '/* BAD FILE '.$value['type'].' */';
					break;
				}
				if(strlen($templateFix['contents']) > 0){ // fix for type h
					if (!is_writable($filePath)){
						@chmod($filePath, FILE_PERMISSIONS);
					}				
					file_put_contents($filePathAbs, trim($templateFix['contents']));
				}
			}	
		}
		//download css
		$dirPath = $widgetFileTemplateDir = SCRIPT_DIR.'/src/css_'.$projectId;
		$dirPathAbs = Configuration::getPath($dirPath);
		if (!file_exists($dirPathAbs)) {
			mkdir($dirPathAbs, DIR_PERMISSIONS, false);
		}
		
		if(isset($project['src']['CSS']) && is_array($project['src']['CSS'])){
			foreach ($project['src']['CSS'] as $value) {	
				$filePath = $dirPath.'/'.$value['name'];
				$filePathAbs = $dirPathAbs.'/'.$value['name'];
				$templateFix['contents'] = '';
				switch ($value['type']) {
					case 'h':
						break;
					case 'f':
						$templateFix = Response::proxy($value['content']);
						if($templateFix['status'] != 200){
							$templateFix['contents'] = '/* error download FILE '.$value['content'].' */';
						}else{
							$templateFix['contents'] = $templateFix['header2'].$templateFix['contents'];
						}
					break;
					case 't':
						$templateFix['contents'] = $value['content'];
					break;
					default:
						$templateFix['contents'] = '/* BAD FILE '.$value['type'].' */';
					break;
				}
				if(strlen($templateFix['contents']) > 0){ // fix for type h
					if (!is_writable($filePath)){
						@chmod($filePath, FILE_PERMISSIONS);
					}				
					file_put_contents($filePathAbs, trim($templateFix['contents']));
				}
			}	
		}
		
		//download widgets templates
		$widgetFileTemplateDir = SCRIPT_DIR.'/src/templates';
		$widgetFileTemplateDirAbs = Configuration::getPath($widgetFileTemplateDir);
		//check template dir
		if (!file_exists($widgetFileTemplateDirAbs)) {
			mkdir($widgetFileTemplateDirAbs, DIR_PERMISSIONS, false);
		}
		//clear template
		self::clearDir($widgetFileTemplateDirAbs);
		//import widgets
		foreach ($project['content'] as $value) {

			$widgetFileTemplate = $widgetFileTemplateDir.'/'.$value['path'].'_public_block.php';
			$widgetFileTemplateAbs = Configuration::getPath($widgetFileTemplate);
			if(!file_exists($widgetFileTemplateAbs)){
				$block_path = str_replace("#BLOCK_CODE#", $value['path'], BLOCK_PATH);
				
				$templateFix = Response::proxy($block_path);
				
				if($templateFix['status'] != 200){
					$templateFix['contents'] = '<div><h1>error upload template ['.$block_path.']</h1></div>';
				}
				if (!is_writable($widgetFileTemplate)){
					@chmod($widgetFileTemplate, FILE_PERMISSIONS);
				}				
				file_put_contents($widgetFileTemplateAbs, trim($templateFix['header2'].$templateFix['contents']));
				unset($templateFix);
			}
		}
			
		
		return array(
				'response' => array('status' => 'ok', 'message' => 'files_download'),
				'values' => array()
		);
	}
	
	public static function compileProject($params, $projectId){
		$projectId = intval($projectId);
		$project = Configuration::getValue('project_'.$projectId);
		$SITE_DIR = str_replace('//', '/', (SCRIPT_DIR.'/'));
		$SITE_DIR = str_replace($_SERVER["DOCUMENT_ROOT"], '', $SITE_DIR);
		$ver = time();
	// generate ///////////////
		$root = HtmlTag::createElement();
		$root->addElement('!DOCTYPE html');
		$doc = $root->addElement('html')
			->set('lang', (isset($project['info']['LANG']) && strlen($project['info']['LANG']) > 0 ? $project['info']['LANG'] : 'ru'))
			->set('data-ng-app', 'module-lp-b24')
			->set('data-ng-controller', 'globalController');
	// header /////////////////
		$head = $doc->addElement('head');
		
		
		$cahrset = (isset($project['info']['CHARSET']) && strlen($project['info']['CHARSET']) > 0) ? $project['info']['CHARSET'] : LANG_CHARSET;
		switch ($cahrset){
			case 'windows-1251':
				$cahrset = 'windows-1251';
				break;
			case 'UTF-8':
				$cahrset = 'UTF-8';
				break;
			default:
				$cahrset = LANG_CHARSET;
				break;
		}
		
		$head->addElement('meta')->set('charset',  $cahrset);
		$head->addElement('meta')->set('http-equiv', 'Content-Type')->set('content', 'text/html; charset='.$cahrset);
		$head->addElement('meta')->set('name', 'viewport')->set('content', 'width=device-width, initial-scale=1');
//@tosee: check update
//duble in js file directives.js
		$dirPath = SCRIPT_DIR.'/src';
		$dirPathAbs = Configuration::getPath($dirPath);
		ob_start();
			include $dirPathAbs.'/include_fix_html_css.php';
			include $dirPathAbs.'/include_fix_html_header_js.php';
		$result = ob_get_clean();
		$head->setText($result);
	//css ///////////
		
		if(isset($project['src']['CSS']) &&  is_array($project['src']['CSS'])){
			foreach ($project['src']['CSS'] as $value) {
				
				if($value['type'] == 'h'){
					$head->addElement('link')
						->set('rel', 'stylesheet')
						->set('type', 'text/css')
						->set('href', $value['content']);
				}else{
					$head->addElement('link')
						->set('rel', 'stylesheet')
						->set('type', 'text/css')
						->set('href', $SITE_DIR.'src/css_'.$projectId.'/'.$value['name'].'?ver='.$ver);
				}
			}	
		}
		
		$head->addElement('!--[if lt IE 9]');
			$head->addElement('script')->set('src', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
			$head->addElement('script')->set('src', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js');
		$head->addElement('![endif]--');
		
	// seo /////////////
		$head->addElement('title')->setText(
				(@self::chekStrAndReplase($project['info']['SEO_TITLE'], $project['info']['NAME']))
		);
		$head->addElement('meta')->set('name', 'description')->set('content', 
				(@self::chekStrAndReplase($project['info']['SEO_DESCR'], ' '))
		);
		$head->addElement('meta')->set('name', 'keywords')->set('content', 
				(@self::chekStrAndReplase($project['info']['SEO_KW'], ' '))
		);

		
// body /////////////////
		$body = $doc->addElement('body')->set('id', 'top');
		
		//js //////////////
		if(isset($project['src']['JS']) &&  is_array($project['src']['JS'])){
			foreach ($project['src']['JS'] as $value) {
		
				if($value['type'] == 'h'){
					$body->addElement('script')->set('src', $value['content']);
				}else{
					$body->addElement('script')->set('src', $SITE_DIR.'src/js_'.$projectId.'/'.$value['name'].'?ver='.$ver);
				}
			}
		}
		
		//$widget = $project['content'][0];
		$bodyContent = '';
		foreach ($project['content'] as $key => $block){
			//echo '<pre>'.print_r($block, true).'</pre>';
			$bodyContent = $bodyContent . (self::recursIncludeTemplate(
				$key, $block, $projectId, $project
			));
			
		}
// counters // footer js
		$dirPath = SCRIPT_DIR.'/src';
		$dirPathAbs = Configuration::getPath($dirPath);
		ob_start();
			include $dirPathAbs.'/include_counter_html.php';
		$result = ob_get_clean();
		$bodyContent = $result . $bodyContent;
		
		ob_start();
			include $dirPathAbs.'/include_fix_html_footer_js.php';
		$result = ob_get_clean();
		$bodyContent = $bodyContent . $result;
// plugins
		
		$bodyContent = $bodyContent . @self::chekStrAndReplase($project['info']['PLUGINS_CallbackHunter'], '');
		$bodyContent = $bodyContent . @self::chekStrAndReplase($project['info']['PLUGINS_Onicon'], '');
		$bodyContent = $bodyContent . @self::chekStrAndReplase($project['info']['PLUGINS_JivoSite'], '');
		
// fix proactive filter
		$bodyContent = str_replace(array(
			'sc ript'
			,'li nk'
			,'st yle'
			,'if rame'
			,'fo rm'
			,'on click'
		), array(
			'script'
			,'link'
			,'style'
			,'iframe'
			,'form'
			,'onclick'
		), $bodyContent);
// save body
		$body->showTextBeforeContent(true);
		$body->setText($bodyContent);
		
	//var_dump($bodyContent);
// save /////////////////////////////////
		$fileOutPit = SCRIPT_DIR.'/'.$project['info']['HOSTING_PATH'];
		$fileOutPit = Configuration::getPath($fileOutPit);
		
		if (!is_writable($project['info']['HOSTING_PATH'])){
			@chmod($project['info']['HOSTING_PATH'], FILE_PERMISSIONS);
		}
		$doc = trim($doc);
		$doc = self::convertEncoding(
			$doc, LANG_CHARSET, $cahrset
		);
		
		self::file_force_contents(SCRIPT_DIR, $project['info']['HOSTING_PATH'], $doc);
		
		$resUrl = 
				$_SERVER['HTTP_HOST'].
				$SITE_DIR.'/'.
				$project['info']['HOSTING_PATH'];
			
		$resUrl = 'http://'.self::getUrl($resUrl);

		return array(
				'response' => array('status' => 'ok', 'message' => 'page_create'),
				'values' => array( $resUrl )
		);
	}
	
// private	
	public static function convertEncoding($string, $charsetFrom, $charsetTo, &$errorMessage = "")
	{
		$string = strval($string);
	
		if (strcasecmp($charsetFrom, $charsetTo) == 0)
			return $string;
	
		$errorMessage = '';
	
		if ($string == '')
			return '';
	
		$res = 'error encode';
		if (extension_loaded("mbstring"))
		{
			//For UTF-16 we have to detect the order of bytes
			//Default for mbstring extension is Big endian
			//Little endian have to pointed explicitly
			if (strtoupper($charsetFrom) == "UTF-16")
			{
				$ch = substr($string, 0, 1);
				//If Little endian found - cutoff BOF bytes and point mbstring to this fact explicitly
				if ($ch == "\xFF" && substr($string, 1, 1) == "\xFE")
					return mb_convert_encoding(substr($string, 2), $charsetTo, "UTF-16LE");
				//If it is Big endian, just remove BOF bytes
				elseif ($ch == "\xFE" && substr($string, 1, 1) == "\xFF")
				return mb_convert_encoding(substr($string, 2), $charsetTo, $charsetFrom);
				//Otherwise assime Little endian without BOF
				else
					return mb_convert_encoding($string, $charsetTo, "UTF-16LE");
			}
			else
			{
				$res = mb_convert_encoding($string, $charsetTo, $charsetFrom);
				if (strlen($res) > 0)
					return $res;
			}
		}
	
		$utf_string = false;
		if (strtoupper($charsetFrom) == "UTF-16")
		{
			$ch = substr($string, 0, 1);
			if (($ch != "\xFF") || ($ch != "\xFE"))
				$utf_string = "\xFF\xFE".$string;
		}
		if (function_exists('iconv'))
		{
			if ($utf_string)
				$res = iconv($charsetFrom, $charsetTo."//IGNORE", $utf_string);
			else
				$res = iconv($charsetFrom, $charsetTo."//IGNORE", $string);

			if (!$res)
				$errorMessage .= "Iconv reported failure while converting string to requested character encoding. ";

			return $res;
		}
		elseif (function_exists('libiconv'))
		{
			if ($utf_string)
				$res = libiconv($charsetFrom, $charsetTo, $utf_string);
			else
				$res = libiconv($charsetFrom, $charsetTo, $string);

			if (!$res)
				$errorMessage .= "Libiconv reported failure while converting string to requested character encoding. ";

			return $res;
		}
	
		return $res;
	}
	
	private static function file_force_contents($rootDir, $dir, $contents){
		$parts = explode('/', $dir);
		$file = array_pop($parts);
		$dir = $rootDir.'/';
		$dir = Configuration::getPath($dir);
		foreach($parts as $part){
			//echo ($dir .= "/$part").'<br />';
			if(!is_dir($dir .= "/$part")) mkdir($dir);
		}
		file_put_contents("$dir/$file", $contents);
	}
	
	private static function clearDir($str, $deep = 1){
	
		if(is_file($str)){
			return @unlink($str);
		}elseif(is_dir($str)){
			if ($dir = opendir($str))
			{
			    while (false !== ($item = readdir($dir)))
			    {
				if ($item == '..' || $item == '.'){
				    continue;
				}

				$path = $str.'/'.$item;
				self::clearDir($path, 2);
			    }
			    closedir($dir);
			}

			if($deep > 1){
			    return @rmdir($str);
			}else{
			    return true;
			}
			
			
            
		}else{
			//echo 'celar WTF '.$str.'<br />';
			return false;
		}
	}
	
	private static function chekStrAndReplase($str, $repl){
		return 
			isset($str) && strlen($str) > 0
				? $str
				: $repl;
	}
	
	private static function recursIncludeTemplate($keyBlock, $block, $projectId, $project){
		$SITE_DIR = str_replace('//', '/', (SCRIPT_DIR.'/'));
		$SITE_DIR = str_replace($_SERVER["DOCUMENT_ROOT"], '', $SITE_DIR);
		$result = '';
		$widgetFileTemplateDir = SCRIPT_DIR.'/src/templates';
		$widgetFileTemplateDirAbs = Configuration::getPath($widgetFileTemplateDir);

		$widgetFileTemplate = $widgetFileTemplateDir.'/'.$block['path'].'_public_block.php';
		$widgetFileTemplateAbs = Configuration::getPath($widgetFileTemplate);
		if(!file_exists($widgetFileTemplateAbs)){
			$block_path = str_replace("#BLOCK_CODE#", $block['path'], BLOCK_PATH);
			
			$templateFix = Response::proxy($block_path);
			if($templateFix['status'] != 200){
				$templateFix['contents'] = '<div><h1>error upload template ['.$block_path.']</h1></div>';
			}
			if (!is_writable($widgetFileTemplate)){
				@chmod($widgetFileTemplate, FILE_PERMISSIONS);
			}				
			file_put_contents($widgetFileTemplateAbs, trim($templateFix['header2'].$templateFix['contents']));
			unset($templateFix);
		
		}
		
		$block['CONTENT'] = self::recursHtmlSpecialChars($block['CONTENT']);
		ob_start();
			include $widgetFileTemplateAbs;
		$result = ob_get_clean();

		return $result;
	}
	
	private static function recursHtmlSpecialChars($items, $isModify = false){
		$tmpArr = array();
		foreach($items as $key => $item){
			if(is_array($item)){
				if (
					isset($item['type']) && 
					$item['type'] == 'input'
					
				) {
					$isModify = true;
					
				}else{
					$isModify = $isModify;
				}
				$item = self::recursHtmlSpecialChars($item, $isModify);
			}else{
				if($isModify){
					$item = htmlspecialchars($item, ENT_QUOTES);
					//$item = str_replace('"', "'", $item);
				}
			}
			
			$tmpArr[$key] = $item;
		}
		
		return $tmpArr;
	}
		
		
// helper for public_block.html
	public static function getUrl($resUrl){
		$resUrl = str_replace('///', '/', $resUrl);
		$resUrl = str_replace('//', '/', $resUrl);
		return $resUrl;
	}
	public static function isCanShow($widget){
		if(
			   isset($widget['props']['text'])
			|| isset($widget['props']['href'])
			|| isset($widget['props']['innerHTML'])
			|| isset($widget['props']['youtube'])
			|| isset($widget['props']['getIcon'])
			|| isset($widget['props']['timer'])
			|| (isset($widget['props']['getImage']) && isset($widget['props']['getImage']['src']) && strlen($widget['props']['getImage']['src']) > 0)
		){
			return true;
		}else{
			return false;
		}
	}
	
	
	public static function putTagParams($widget){
		$tagParams = '';
		if(isset($widget['widget_class'])){
			$tagParams .=' class="'.
				implode(' ', $widget['widget_class']).' '.
				implode(' ', $widget['widget_type']['html_class_fx']).
			'" ';
		}
		if(isset($widget['widget_id']) && strlen($widget['widget_id']) > 0){
			$tagParams .=' id="'.$widget['widget_id'].'" ';
		}
		
		
		if(isset($widget['widget_analitic']['href']['click']) && is_array($widget['widget_analitic']['href']['click'])){
			$tmpStr = '';
			$analitic = $widget['widget_analitic']['href']['click'];
			if(isset($analitic['ym']) && is_array($analitic['ym']) && count($analitic['ym']) > 0){
				
				foreach($analitic['ym'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ym\', \''.implode('_||_', $val).'\'); ';
				}
			}
			if(isset($analitic['ga']) && is_array($analitic['ga']) && count($analitic['ga']) > 0){
				foreach($analitic['ga'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ga\', \''.implode('_||_', $val).'\'); ';
				}
				
				
			}
			$tagParams .= (strlen($tmpStr) > 0 ? ' onClick="'.$tmpStr.'" '  : '');
		}
		
		
		if(isset($widget['props']['href'])){
			$tagParams .=' href="'.$widget['props']['href'].'" ';
		}
		if(isset($widget['props']['isScroll']) && strlen($widget['props']['isScroll']) > 0){
			$tagParams .=' data-scroll ';
		}
		if(isset($widget['props']['isOpenModal']) && strlen($widget['props']['isOpenModal']) > 0){
			if(isset($widget['props']['href'])){
				$idModal = str_replace('#', '', $widget['props']['href']);
				$tagParams .=' data-ng-click="openModalEvent(\''.$idModal.'\', $event);" ';
				
			}
		}
		if(isset($widget['props']['title'])){
			$tagParams .=' title="'.($widget['props']['title']).'" ';
		}
		if(isset($widget['props']['getImage'])){
			$tagParams .=' src="'.$widget['props']['getImage']['src'].'" '.
				' alt="'.($widget['props']['getImage']['alt']).'"';
		}

		return $tagParams;
	}
	public static function putTagText($widget){
		return isset($widget['props']['text']) ? $widget['props']['text'] : '';
	}
	public static function putTagInnerHtml($widget){
		return isset($widget['props']['innerHTML']) ? $widget['props']['innerHTML'] : '';
	}
	public static function getTagVlaue($widget, $paramKey){
		$tagParams = '';
		if($paramKey == 'widget_class'  && isset($widget['widget_class'])){
			$tagParams =''.
				implode(' ', $widget['widget_class']).' '.
				implode(' ', $widget['widget_type']['html_class_fx']).
			'';
		}elseif($paramKey == 'widget_id' && isset($widget['widget_id'])){
			$tagParams = $widget['widget_id'];
		}elseif($paramKey == 'getImage' && isset($widget['props']['getImage'])){
			$tagParams =' src="'.$widget['props']['getImage']['src'].'" '.
						' alt="'.($widget['props']['getImage']['alt']).'"';
		}elseif($paramKey == 'src' && isset($widget['props']['getImage'])){
			$tagParams =''.$widget['props']['getImage']['src'].'';
		}elseif($paramKey == 'alt' && isset($widget['props']['getImage'])){
			$tagParams =''.($widget['props']['getImage']['alt']).'';
		}elseif($paramKey == 'widget_analitic_click' && isset($widget['widget_analitic']['href']['click']) && is_array($widget['widget_analitic']['href']['click'])){
			$tmpStr = '';
			$analitic = $widget['widget_analitic']['href']['click'];
			if(isset($analitic['ym']) && is_array($analitic['ym']) && count($analitic['ym']) > 0){
				
				foreach($analitic['ym'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ym\', \''.implode('_||_', $val).'\'); ';
				}
			}
			if(isset($analitic['ga']) && is_array($analitic['ga']) && count($analitic['ga']) > 0){
				foreach($analitic['ga'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ga\', \''.implode('_||_', $val).'\'); ';
				}
				
				
			}
			$tagParams = (strlen($tmpStr) > 0 ? $tmpStr  : '');
		}elseif($paramKey == 'widget_analitic_form_send' && isset($widget['widget_analitic']['form']['send']) && is_array($widget['widget_analitic']['form']['send'])){
			$tmpStr = '';
			$analitic = $widget['widget_analitic']['form']['send'];
			if(isset($analitic['ym']) && is_array($analitic['ym']) && count($analitic['ym']) > 0){
				
				foreach($analitic['ym'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ym\', \''.implode('_||_', $val).'\'); ';
				}
			}
			if(isset($analitic['ga']) && is_array($analitic['ga']) && count($analitic['ga']) > 0){
				foreach($analitic['ga'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ga\', \''.implode('_||_', $val).'\'); ';
				}
				
				
			}
			$tagParams = (strlen($tmpStr) > 0 ? $tmpStr  : '');
		}elseif($paramKey == 'widget_analitic_form_error' && isset($widget['widget_analitic']['form']['error']) && is_array($widget['widget_analitic']['form']['error'])){
			$tmpStr = '';
			$analitic = $widget['widget_analitic']['form']['error'];
			if(isset($analitic['ym']) && is_array($analitic['ym']) && count($analitic['ym']) > 0){
				
				foreach($analitic['ym'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ym\', \''.implode('_||_', $val).'\'); ';
				}
			}
			if(isset($analitic['ga']) && is_array($analitic['ga']) && count($analitic['ga']) > 0){
				foreach($analitic['ga'] as $val){
					$tmpStr .=' doShLpB24Analitic(\'ga\', \''.implode('_||_', $val).'\'); ';
				}
				
				
			}
			$tagParams = (strlen($tmpStr) > 0 ? $tmpStr  : '');
		}elseif($paramKey == 'slider' && isset($widget['props'][$paramKey])){
			$tagParams = json_encode($widget['props'][$paramKey]);
		}elseif(isset($widget['props'][$paramKey])){
			$tagParams = $widget['props'][$paramKey];
		}

		
		return $tagParams;
	}
	
	public static function getFormJs($keyBlock, $block, $num, $SITE_DIR, $projectId){
		
		ob_start();
	?>
		lpB24App.controller('SendCtrl<?=$block['path']?>_<?=$keyBlock?>', [
			'$scope', 
			'$http', 
			'$modal',
		function($scope, $http, $modal) {	
			$scope.sendField = {};
			$scope.params = {};
			$scope.alert = "";
			$scope.params.canSend = true;
		
		
			var initField = function(){
				$scope.sendField = {
					formId: <?=$num?> 
					,blockId: <?=$keyBlock?><?
					
					foreach($block['CONTENT'][$num]['childs'][0] as $key => $child):
						if(in_array($child['props']['inputType'], array('select', 'multiple-select', 'radio', 'checkbox')) && isset($child['props']['values'])):
							$arPut = array(
								'key' => ''		
								,'val' => null
							);
							foreach($child['props']['values'] as $keyItem => $item):
								switch($child['props']['inputType']):
									case 'select': 
									case 'radio':
										if(isset($item['def']) && $item['def'] == true):
											$arPut['key'] = $key;
											$arPut['val'] = ($item['title']);
										endif;	
										break;
									case 'multiple-select':
										if(isset($item['def']) && $item['def'] == true):
											$arPut['key'] = $key;
											$arPut['val'][] = ($item['title']);
										endif;
										break;
									case 'checkbox':
											$arPut['key'] = $key;
											$arPut['val'][] = ((isset($item['def']) && $item['def'] == true) ? $item['title'] : '');
										break;
									
								endswitch;
							endforeach;
							if(strlen($arPut['key']) > 0):	
								if(in_array($child['props']['inputType'], array('select', 'radio'))):
							?>
								,<?=$arPut['key']?>: "<?=$arPut['val']?>"
							<?
								elseif(in_array($child['props']['inputType'], array('multiple-select', 'checkbox'))):
							?>
								,<?=$arPut['key']?>: <?=json_encode($arPut['val'])?>
							<?
								endif;
							endif;
						endif;
					endforeach;
				?>
				};
				$scope.alert = "";
			};
			
			var openModal = function (message) {
				var modalInstance = $modal.open({
				  templateUrl: '<?=ShefB24Uploader::getUrl($SITE_DIR.'/src/lib/form/popUpMessageResult.html')?>' + newId,
				  controller: 'ModalInstanceCtrl<?=$block['path']?>_<?=$keyBlock?>',
				  resolve: {
				    sendField: function () {
				      return $scope.sendField;
				    }
				    ,resultMessage: function () {
				      return message;
				    }
				  }
				});
				
				modalInstance.result.then(function () {
					initField();
					$scope.params.canSend = true;
				}, function () {
					initField();
					$scope.params.canSend = true;
				});
			};
			
			$scope.send = function() {
				$scope.params.canSend = false;
				$http({
					method: 'POST'
					,url: '<?=ShefB24Uploader::getUrl($SITE_DIR.'/lp_b24_hosting.php')?>'
					,params: {
						projectId: <?=$projectId?>
						,token: '<?=md5(TOKEN)?>'
						,className: 'ShefBitrix24Lead'
						,functionName: 'insert'
						,prepere:'Y'
					}
					,data: {
						params: $scope.sendField
					}
				}).
				success(function(data, status) {
					if(data.response.status == 'error'){
						$scope.alert = data.response.message;
						$scope.params.canSend = true;
						//send event form error
						<?echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'widget_analitic_form_error'));?>
					}else{
						openModal(data.response.message);
					}
					
				}).
				error(function(data, status) {
					$scope.alert = (data || "Request failed");
					$scope.params.canSend = true;
					//send event form error
					<?echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'widget_analitic_form_error'));?>					
				});
			};
			
			initField();
		}]).
		controller('ModalInstanceCtrl<?=$block['path']?>_<?=$keyBlock?>', [
			'$scope', 
			'$modalInstance', 
			'sendField',
			'resultMessage',
		function ($scope, $modalInstance, sendField, resultMessage) {
			$scope.sendField = sendField;
		//////////////////	
			$scope.fields = []; 
			<?foreach($block['CONTENT'][$num]['childs'][0] as $key => $child):?>
				$scope.fields.push("<?@print(
						(
							strlen($child['props']['inputPlaceholder']) > 0 ? $child['props']['inputPlaceholder'] : $child['props']['text']
						)
					) ;?>");
			<?endforeach?>
		///////////////////////	
			$scope.message = {};
			$scope.message.resultMessageAuto = resultMessage;
			$scope.message.popUpTitle = '<?
				echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'popUpTitle'));
			?>';
			$scope.message.resultMessage = '<?
				echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'resultMessage'));
			?>';
			$scope.message.resultSubMessage = '<?
				echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'resultSubMessage'));
			?>';
			$scope.message.closeBtn = '<?
				echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'closeBtn'));
			?>';
		
			$scope.ok = function () {
				$modalInstance.close();
			};
			
			$scope.isShowList = function(field){
				return angular.isArray(field);
			};
			
			//send event form send
			<?echo htmlspecialchars_decode(ShefB24Uploader::getTagVlaue($block['CONTENT'][$num], 'widget_analitic_form_send'));?>
		}]);
	
		<?$result = ob_get_clean();
		return $result;
	}
	
}