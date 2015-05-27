<?php

class Connectapi {
	
	private $base_url = NULL;
	private $auth_url = NULL; // URL where authorization is made
	private $status_url = NULL; // URL for checking current charging status
	private $merchant_id = NULL;
	private $merchant_secret = NULL;
 
	/**
	 * @param string $new_base_url
	 *   If new base url is wanted to give instead of default.
	 */
 	function __construct($new_base_url = 'https://account.paytrail.com') {
		$this->base_url = $new_base_url;
	}

	/**
     * Sets the merchant ID.
     *
     * @param mixed $merchant_id the merchant ID
     *
     * @return self
     */
	public function setMerchantId($merchant_id) {
        $this->merchant_id = $merchant_id;
    }

    /**
     * Sets the merchant secret.
     *
     * @param mixed $merchant_id the merchant secret
     *
     * @return self
     */
	public function setMerchantSecret($merchant_secret) {
        $this->merchant_secret = $merchant_secret;
    }

	// Request methods
	// Main requests of API protocol

	/**
	 * Requests authorization from Paytrail to do payment.
	 *
	 * @param array $content
	 *   JSON data for request data
	 *
	 * @return boolean
	 *   Authorization url succeess made if true, else false.
	 */
	public function requestAuthorization($content) {

		$method = 'POST';
		$resource_url = '/connectapi/authorizations';
		$body_content = $content;
		$header_array = $this->createHeader($method, $resource_url, $body_content);

		$response = rest_req($method, $this->base_url . $resource_url, $header_array, $body_content);

		$result = FALSE;

		if ($response != NULL) {
			$http_code = $response['code'];

			switch ($http_code) {
				case 201:
					$headers = $response['headers'];
					$this->auth_url = $headers['Location'];
					$result = TRUE;
					break;

				case 403:
					throw new PaytrailException('Invalid authorization', 403);
					break;

				case 405:
					throw new PaytrailException('Method not allowed', 405);
					break;

				case 400:
					throw new PaytrailException('Bad Request', 400);
					break;
			}
		}

		return $result;
	}

	/**
	 * Confirms authorization with user's PIN code.
	 *
	 * @param string $content
	 *   JSON data with user's given PIN code.
	 *
	 * @return boolean
	 *   Authorization confirmed by user succesfully returns true, else false.
	 */
	public function confirmAuthorization($content) {

		$method = 'POST';
		$resource_url = $this->auth_url . '/confirmation';
		$body_content = $content;
		$header_array = $this->createHeader($method, $resource_url, $body_content);

		$response = rest_req($method, $this->base_url . $resource_url, $header_array, $body_content);

		$result = FALSE;

		if ($response != NULL) {
			$http_code = $response['code'];
			switch ($http_code) {
				case 201:
					$result = TRUE;
					break;

				case 400:
					throw new PaytrailException('Confirmation failed due to given JSON being malformed or authSecret left blank', 400);
					break;
					
				case 403:
					throw new PaytrailException('Invalid authorization', 403);
					break;

				case 404:
					throw new PaytrailException('Not confirmed. Request failed. Either wrong authSecret was supplied or authorization resource does not exist', 404);
					break;

				case 405:
					throw new PaytrailException('Method not allowed', 405);
					break;
			}
		}

		return $result;
	}

	/**
	 * Sends payment to Paytrail with user's delivery address.
	 *
	 * @param string $content
	 *   A1 payment data as json string
	 *
	 * @return array
	 *   Response as array.
	 */
	public function chargePayment($content) {
	
		$method = 'POST';
		$resource_url = $this->auth_url . '/charges';
		$body_content = $content;
		$header_array = $this->createHeader($method, $resource_url, $body_content);

		$response = rest_req($method, $this->base_url . $resource_url, $header_array, $body_content);

		$result = NULL;

		if ($response != NULL) {
			$http_code = $response['code'];
			switch ($http_code) {
				case 201:
				case 202:
					$result = $response;
					$header = $result['headers'];
					$this->status_url = $header['Location'];
					break;

				case 400:
					throw new PaytrailException('Address or payment data is malformed, not accepted or missing', 400);
					break;

				case 403:
					throw new PaytrailException('Invalid authorization', 403);
					break;

				case 404:
					throw new PaytrailException('Authorization does not exist', 404);
					break;

				case 405:
					throw new PaytrailException('Method not allowed', 405);
					break;
			}
		}

		return $result;
	}

	/**
	 * Fetches status of payment.
	 *
	 * @return array
	 *   Response as array.
	 */
	public function fetchStatus() {

		$method = 'GET';
		$header_array = $this->createHeader($method, $this->status_url);

		$response = rest_req($method, $this->base_url . $this->status_url, $header_array);

		$result = NULL;

		if ($response != NULL) {
			$http_code = $response['code'];
			switch ($http_code) {
				case 200:
					$result = $response;
					break;

				case 403:
					throw new PaytrailException('Invalid authorization', 403);
					break;

				case 404:
					throw new PaytrailException('No such payment or authorization', 404);
					break;

				case 405:
					throw new PaytrailException('Method not allowed', 405);
					break;
			}
		}

		return $result;
	}

	/**
	 * Fetches user's delivery address, phone number and email.
	 *
	 * @return array
	 *   Response as array.
	 */
	public function fetchAddress() {

		$method = 'GET';
		$resource_url = $this->auth_url . '/deliveryAddress';
		$header_array = $this->createHeader($method, $resource_url);

		$response = rest_req($method, $this->base_url . $resource_url, $header_array);

		$result = NULL;

		if ($response != NULL) {
			$http_code = $response['code'];
			switch ($http_code) {
				case 200:
					$result = $respose;
					break;

				case 403:
					throw new PaytrailException('Invalid authorization', 403);
					break;

				case 404:
					throw new PaytrailException('Authorization is not yet confirmed or is invalidated or has no deliveryAddress access', 404);
					break;

				case 405:
					throw new PaytrailException('Method not allowed', 405);
					break;
			}
		}

		return $result;
	}

	/**
	 * Deletes authorization for current payment.
	 *
	 * @return array
	 *   Response as array.
	 */
	public function deleteAuthorization() {

		$method = 'DELETE';
		$resource_url = $this->auth_url;
		$header_array = $this->createHeader($method, $resource_url);

		$response = rest_req($method, $this->base_url . $resource_url, $header_array);

		$result = FALSE;

		if ($response != NULL) {

			$http_code = $response['code'];

			switch ($http_code) {
				case 204:
					$result = TRUE;
					break;
				
				case 403:
					throw new PaytrailException('Invalid authorization', 403);
					break;

				case 404:
					throw new PaytrailException('Invalid authorization state or authorization does not exist', 404);
					break;

				case 405:
					throw new PaytrailException('Method not allowed', 405);
					break;
			}
		}

		return $result;
	}

	// Helper methods
	// Made for simplify and prevent repeating

	/**
	 * @param string $method
	 *   HTTP request method written in capitals
	 * 
	 * @param string $resource_url
	 *   Resource URL, not full URL
	 * 
	 * @param string body
	 *   Request's body content
	 */
	private function createHeader($method, $resource_url, $body = '') {

		$timestamp = date('c');
		$content_MD5 = base64_encode(hash('md5', $body, TRUE));
		$api_name = 'PaytrailConnectAPI';

		$signature = base64_encode(hash_hmac(
			'SHA256',
			implode(PHP_EOL, array(
					$method,
					$resource_url,
					$api_name . ' ' . $this->merchant_id,
					$timestamp,
					$content_MD5,
			)),
			$this->merchant_secret,
			TRUE
		));

		$header_array = array(
			'Timestamp: ' . $timestamp,
			'Content-MD5: ' . $content_MD5,
			'Authorization: ' . $api_name . ' ' . $this->merchant_id . ':' . $signature
		);
		
		return $header_array;
	}
}

/**
 * If there's problematic REST response this should be used.
 */
class PaytrailException extends Exception
{
	public function __construct($message, $code)
	{
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return __CLASS__ . ': [' . $this->code . ']: ' . $this->message . PHP_EOL;
    }
}
