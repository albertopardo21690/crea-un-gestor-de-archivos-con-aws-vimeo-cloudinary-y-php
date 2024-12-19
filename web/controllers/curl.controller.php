<?php

class CurlController {

	/*=============================================
	Peticiones a la API propia
	=============================================*/

	static public function request($url, $method, $fields) {

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://api-fms.com/'.$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $fields,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: vGi4k7w3mTB5cJiPLKAb44A6u3rvcD5Z8CBx3xAutVQ5H4TmfH3ZNpfexmg1qh1yJUXcePhyCr6CJwtf'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$response = json_decode($response);

		return $response;

	}
	
}

?>