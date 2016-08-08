<?
class Proxy{
	
	public static function _get($url, $parameters = array()){
		return self::retrieve($url, 'GET', $parameters);
	}
	
	public static function _post($url, $parameters = array()){
		return self::retrieve($url, 'POST', $parameters);
	}
	
	protected static function retrieve($url, $method = 'GET', $parameters = array()){
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);

		$dataToSend = self::_paramsToStr($parameters);

		if(strtoupper($method) == 'GET'){
			curl_setopt($ch, CURLOPT_POSTFIELDS, null);
			curl_setopt($ch, CURLOPT_POST, false);	
			$url = $url.'?'.$dataToSend;
		}else{
			//Add post data to stream			
			curl_setopt($ch, CURLOPT_POST, true);		
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataToSend);	
		}


		//Set the URL for this request		
		curl_setopt($ch, CURLOPT_URL, $url);		

		
		//Execute the request
		$response = curl_exec($ch);
		
		//Get the response code for the request
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		//Close the connection
		curl_close($ch);

		//Check for invalid response code
		if($responseCode != '200') {
			return null;
		}
		
		
		return $response;
		
	}
	
	protected static function _paramsToStr($params){
		if(is_array($params)){		
			$paramStr = '';
			$tmpArray = array();
			foreach($params as $key=>$value){
				$tmpArray[] = self::_paramToStr($key, $value);
			}
			$paramStr .= implode('&',$tmpArray);
			return $paramStr;
		}else{
			return $params;
		}
	}
	
	protected static function _paramToStr($key,$value){
		return $key."=".urlencode($value);
	}
}
?>