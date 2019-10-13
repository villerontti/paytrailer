<?php

/**
 * REST request sender
 * 
 * @author Joona Viertola <joonaviertola@scionar.com>
 * @version 1.0
 */

/**
 * Function to send requests
 * 
 * @param string $method
 *   Used HTTP method
 * 
 * @param string $url
 *   Full URL to send request
 * 
 * @param array $headers
 *   Headers in array as strings in format as ['Content-type: text/plain', 'Content-length: 100']
 * 
 * @param string $data
 *   Data to send via request
 * 
 * @return array
 *   Array with 'headers', 'body' and 'code' key/value -pairs
 */
function rest_req($method, $url, $headers, $data = NULL)
{
	$curl = curl_init();

	switch ($method)
	{
		case 'POST':
			curl_setopt($curl, CURLOPT_POST, 1);
			if (is_string($data))
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;

		case 'GET':
		 	curl_setopt($curl, CURLOPT_POST, 0);
			break;

		case 'PUT':
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
			if (is_string($data))
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
			break;
		
		case 'DELETE':
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
			break;
	}

	// Set settings for request
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
	//curl_setopt($curl, CURLOPT_MAXREDIRS, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, 1);

	$response = curl_exec($curl);

	if ($response != FALSE) {
		// HTTP request worked parse response into array
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$raw_headers = substr($response, 0, $header_size);
		//$header_array = http_parse_headers(PHP_EOL, substr($response, 0, $header_size)); //todo: No default on in PHP

		// Parses raw header string into array of key and value pairs
		$header_array = array();
		foreach (explode(PHP_EOL, $raw_headers) as $i => $h) {
            $h = explode(':', $h, 2);
            
            if (isset($h[1])) {
                $header_array[$h[0]] = trim($h[1]);
            }
        }

		$body_content = substr($response, $header_size);

		$result = array();
		$result['headers'] = $header_array;
		$result['body'] = $body_content;
		$result['code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	}
	else {
		// HTTP request failed
		$result = NULL;
	}

	curl_close($curl);

	return $result;
}
