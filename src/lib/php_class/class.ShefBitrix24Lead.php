<?php

class ShefBitrix24Lead {
	private static $fieldsVariants = array(
		 'OPPORTUNITY'
		,'COMPANY_TITLE'
		,'NAME'
		,'LAST_NAME'
		,'SECOND_NAME'
		,'POST'
		,'ADDRESS'
		,'COMMENTS'
		,'SOURCE_DESCRIPTION'
		,'STATUS_DESCRIPTION'
		,'CURRENCY_ID'
		,'PRODUCT_ID'
		,'SOURCE_ID'
		,'ASSIGNED_BY_ID'
		,'PHONE_WORK'
		,'PHONE_MOBILE'
		,'PHONE_FAX'
		,'PHONE_HOME'
		,'PHONE_PAGER'
		,'PHONE_OTHER'
		,'WEB_WORK'
		,'WEB_HOME'
		,'WEB_FACEBOOK'
		,'WEB_LIVEJOURNAL'
		,'WEB_TWITTER'
		,'WEB_OTHER'
		,'EMAIL_WORK'
		,'EMAIL_HOME'
		,'EMAIL_OTHER'
		,'IM_SKYPE'
		,'IM_ICQ'
		,'IM_MSN'
		,'IM_JABBER'
		,'IM_OTHER'
		,'STATUS_ID'
	);
	
	public static function insert($params, $projectId){
		$leadTitle = array();
		$projectId = intval($projectId);
		$params['formId'] = isset($params['formId']) ? trim($params['formId']) : '';
		$params['blockId'] = isset($params['blockId']) ? trim($params['blockId']) : '';
		
		$project = Configuration::getValue('project_'.$projectId);

		if(
			!is_array($params) 
			|| !isset($params['formId'])
			|| !isset($project['content'][$params['blockId']]['CONTENT'][$params['formId']])
		){
			return array(
				'response' => array('status' => 'error', 'message' => 'bad form params'),
				'values' => array()
			);
		}
/////do auth
	$conect = ShBitrix24::connectToBitrix24(
		 array(
		 	'USERINFO' => $project['info']['USERINFO'], 
		 	'CUR_DOMEN' => $project['info']['CUR_DOMEN']
		 ),
		 $projectId
	 );	
	if($conect === true){
	
	}else{
		@self::sendMailForAdmin($params, $project);
		return $conect;
	}
//// add lead
	$frm = $project['content'][$params['blockId']]['CONTENT'][$params['formId']];
		$lead = array();
		foreach($frm['crm']['values'] as $arValue){
			$lead[$arValue['field']] = $arValue['value'];
		}
		$arResult = array();
//get from params
		if(is_array($params)){
			foreach($frm['childs'][0] as $key => $arValue){
				$val = '';
				if(isset($params[$key])){
					$val = $params[$key];
				}
				if(isset($arValue['crm']['values'][0])){
					$item = $arValue['crm']['values'][0];
					if(isset($arValue['props']['text']) || isset($arValue['props']['inputPlaceholder'])){
						$subKey = strlen($arValue['props']['text']) > 0 ? $arValue['props']['text'] : $arValue['props']['inputPlaceholder'];
						$subKey = strlen(trim($subKey)) > 0 ? $subKey : $item['field'];
					}else{
						$subKey = $item['field'];
					}
					if($item['field'] == 'COMMENTS'){
						if(!isset($lead['COMMENTS'])){
							$lead['COMMENTS'] = array();
						}
						if(!is_array($lead['COMMENTS'])){
							$lead['COMMENTS'] = array(
								'SYSTEM' => $lead['COMMENTS']
							);
						}
						$lead['COMMENTS'][$subKey.'['.$key.']'] = $val;
						$leadTitle['COMMENTS'][$subKey.'['.$key.']'] = $subKey;
					}else{
						$lead[$item['field']] = $val;
						$leadTitle[$item['field']] = $subKey;
					}
					
				}else{
					//echo $key.' >> '.$val.''; //key not set in crm propertys
				}
			}
		}
		$arResult = self::add($lead);
		
		if(isset($arResult['error']) || intval($arResult['result']) < 1){
			@self::sendMailForAdmin($lead, $project);
			return array(
				'response' => array('status' => 'error', 'message' => $arResult['error_description']),
				'values' => array()
			);
		}

		$leadId = intval($arResult['result']);
		//products
		if(
			isset($frm['crm']['products'])
			&& count($frm['crm']['products']) > 0
		){
			$products = array();
			foreach($frm['crm']['products'] as $arValue){
				$products[] = array(
					"PRODUCT_ID" => $arValue['product']['ID'],
					"PRICE" => $arValue['price'],
					"QUANTITY" => $arValue['quantity'],
					"CURRENCY_ID" => $arValue['currency_id'],
				);
			}
			
			$arResult = self::productRowsSet(
				$arResult['result'],
				$products
			);
			if(isset($arResult['error']) || intval($arResult['result']) < 1){
				@self::sendMailForAdmin($lead, $project);
				return array(
					'response' => array('status' => 'error', 'message' => $arResult['error_description']),
					'values' => array()
				);
			}
		}
		
		
		@self::sendMailForAdmin($lead, $project, false, $leadTitle, $leadId);
		return array(
			'response' => array('status' => 'ok', 'message' => ''),
			'values' => array()
		);
	}

	private static function sendMailForAdmin($lead, $project, $isError = true, $leadTitle = array(), $leadId = 0){
		if($isError){
			if(isset($project['info']['ADMIN_EMAIL'])){
				$emailTo = trim($project['info']['ADMIN_EMAIL']);
			}else{
				$emailTo = '';
			}
		}else{
			$leadId = intval($leadId);
			if(
				isset($project['info']['ADMIN_EMAIL_ARR'])
				&& is_array($project['info']['ADMIN_EMAIL_ARR'])
			){
				$emailTo = trim(implode(',', $project['info']['ADMIN_EMAIL_ARR']));
			}else{
				$emailTo = '';
			}
		}
		
		if(strlen($emailTo) == 0){
			return false;
		}
		
		if(isset($project['info']['LINK'])){
			$link = trim($project['info']['LINK']);
		}else{
			$link = '';
		}
		
		if(isset($project['info']['CUR_DOMEN'])){
			$domen = trim($project['info']['CUR_DOMEN']);
		}else{
			$domen = '';
		}
//@todo: translate		
		$message = 
			'Дата и время создания: '.date("Y-m-d H:i:s")."\n"
			.'Страница: '.$link."\n\n";

		foreach($lead as $key => $row){
			$rowTitle = $rowMess = '';
			
			if($isError){
				$rowTitle = $key.': ';
			}elseif(isset($leadTitle[$key])){
				$rowTitle = ($key == 'COMMENTS' ? 'Комментарий' : $leadTitle[$key]).': ';
				
			}else{
				continue;
			}
			
			if(is_array($row)){
				$rowMess = '';
				foreach ($row as $val){
					$val = trim(strip_tags($val));
					if(strlen($val) > 0){
						$rowMess .= "\n  *".$val;
					}
				}
			}else{
				$rowMess = trim(strip_tags($row));
			}

			if(strlen($rowMess) > 0){
				$message .= $rowTitle.$rowMess."\n";
			}
		}

		if(!$isError && $leadId > 0){
//@todo: translate
			$message .= "\n Открыть в Битрикс24: https://".$project['info']['CUR_DOMEN']."/crm/lead/show/".$leadId."/";
		}
//$message .= _pr(array($leadTitle, $lead, $leadId));			
			
//@todo: translate
		if($isError){
			@mail(
				$emailTo, 
				'Ошибка добавления лида в CRM Битрикс24 '.$domen, 
				$message
			);
		}else{
			@mail(
				$emailTo,
				'Создан новый лид CRM Битрикс24 '.$domen,
				$message
			);
		}

	}

	public static function insertTest($projectId){
		$lead = array(
			'TITLE' => 'test'
		);
		$projectId = intval($projectId);
		$project = Configuration::getValue('project_'.$projectId);
		$arResult = self::add($lead);
		if(isset($arResult['result'])){
			$leadId = intval($arResult['result']);
		}else{
			$leadId = 0;
		}
		@self::sendMailForAdmin($lead, $project, false, array(), $leadId);
		return $arResult;
	}
// private

	private static function array_implode( $glue, $separator, $array ) {
		if ( ! is_array( $array ) ) return $array;
		$string = array();
		foreach ( $array as $key => $val ) {
			if ( is_array( $val ) )
				$val = implode( ',', $val );
			$string[] = "{$key}{$glue}{$val}";
	
		}
		return implode( $separator, $string );
	
	}
	private static function add($lead){
		$b24 = ShBitrix24::getInstance();
		//@todo: check this in b24 form edit
		$_lead = array();
		$_lead['TITLE'] = strlen($lead['TITLE']) > 0 ? $lead['TITLE'] : 'New';
		foreach (self::$fieldsVariants as $field){
			
			if(isset($lead[$field])){
					
				if(is_array($lead[$field])){
					$lead[$field] = self::array_implode(': ', "<br>", $lead[$field]);
				}
			
				if(strlen($lead[$field]) > 0){
					$lead[$field] = strip_tags(trim($lead[$field]), '<br>');
					switch ($field) {
						case 'PHONE_WORK':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'WORK' );
						break;
						case 'PHONE_WORK':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'WORK' );
						break;
						case 'PHONE_MOBILE':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'MOBILE' );
						break;
						case 'PHONE_FAX':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'FAX' );
						break;
						case 'PHONE_HOME':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'HOME' );
						break;
						case 'PHONE_PAGER':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'PAGER' );
						break;
						case 'PHONE_OTHER':
							$_lead['PHONE'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'OTHER' );
						break;
						case 'WEB_WORK':
							$_lead['WEB'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'WORK' );
						break;
						case 'WEB_HOME':
							$_lead['WEB'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'HOME' );
						break;
						case 'WEB_FACEBOOK':
							$_lead['WEB'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'FACEBOOK' );
						break;
						case 'WEB_LIVEJOURNAL':
							$_lead['WEB'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'LIVEJOURNAL' );
						break;
						case 'WEB_TWITTER':
							$_lead['WEB'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'TWITTER' );
						break;
						case 'WEB_OTHER':
							$_lead['WEB'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'OTHER' );
						break;
						case 'EMAIL_WORK':
							$_lead['EMAIL'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'WORK' );
						break;
						case 'EMAIL_HOME':
							$_lead['EMAIL'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'HOME' );
						break;
						case 'EMAIL_OTHER':
							$_lead['EMAIL'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'OTHER' );
						break;
						case 'IM_SKYPE':
							$_lead['IM'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'SKYPE' );
						break;
						case 'IM_ICQ':
							$_lead['IM'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'ICQ' );
						break;
						case 'IM_MSN':
							$_lead['IM'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'MSN' );
						break;
						case 'IM_JABBER':
							$_lead['IM'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'JABBER' );
						break;
						case 'IM_OTHER':
							$_lead['IM'][] = array("VALUE" => $lead[$field], "VALUE_TYPE"=> 'OTHER' );
						break;
						default:
							$_lead[$field] = $lead[$field];
						break;
					}
				}
				unset($lead[$field]);
			}
		}
		// for UF_*
		if(count($lead) > 0){
			foreach($lead as $field => $value ){
				if(stripos($field, 'UF_CRM_') === false){
					//not UF_CRM
				}else{
					$_lead[$field] = $lead[$field];
				}
			}
		}
		
		if(isset($_lead['COMMENTS'])){
			$_lead['COMMENTS'] = self::array_implode(': ', "<br>", $_lead['COMMENTS']);
		}
		
		//@tosee: this best way for see out in work
		//echo '<pre>'.print_r(array($lead, $_lead, $b24->getUrl('rest', 'crm.lead.add')), true).'</pre>';die();		
		$codes = Response::proxy(
				$b24->getUrl('rest', 'crm.lead.add'), true,
				array( 'fields' => $_lead )
		);
		//@todo: crm.duplicate.findbycomm()
		return json_decode($codes['contents'], true);
	}
	private static function productRowsSet($leadId, $products = array()){
		$b24 = ShBitrix24::getInstance();
		$codes = Response::proxy(
				$b24->getUrl('rest', 'crm.lead.productrows.set'), true,
				array( 'id' => $leadId,
						'rows' => $products
				)
		);
		return json_decode($codes['contents'], true);
	}
}