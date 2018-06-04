<?php

namespace App\Classes;

// class LinkedInException extends Exception
// {

// }

class LinkedIn 
{
	protected $_apiKey;
	protected $_apiSecret;
	protected $_accessToken = null;
	protected $_callbackUrl;
	
	const API_BASE_URI = 'https://api.linkedin.com/v1';
	const OAUTH_BASE_URI = 'https://www.linkedin.com/uas/oauth2';
	
	public function __construct($config) 
	{
		$this->_apiKey = $config['apiKey'];
		$this->_apiSecret = $config['apiSecret'];
		$this->_callbackUrl = $config['callbackUrl'];
	}
	
	public function getLoginUrl($scope="") 
	{
		$params = array('response_type' => 'code',
		'client_id' => $this->_apiKey,
		'scope' => $scope,
		'state' => uniqid('', true), 
		'redirect_uri' => $this->_callbackUrl,
		);

		$uri = self::OAUTH_BASE_URI.'/authorization?' . http_build_query($params);
		$_SESSION['state'] = $params['state'];
		
		return $uri;
	}
	
	public function getAccessToken($code) 
	{
		if ($this->_accessToken !== null) 
		{
			return $this->_accessToken;
		}
		
		$params = array('grant_type' => 'authorization_code',
			'client_id' => $this->_apiKey,
			'client_secret' => $this->_apiSecret,
			'code' => $code,
			'redirect_uri' => $this->_callbackUrl,
		);
		
		$uri = self::OAUTH_BASE_URI . '/accessToken?' . http_build_query($params);
		$context = stream_context_create(
			array(
				'http' => array(
					'method' => 'POST'
					)
				)
		);

		$response = file_get_contents($uri, false, $context);
		$token = json_decode($response);

		$this->_accessToken = $token->access_token; 
		$_SESSION['expires_in']   = $token->expires_in; 
		$_SESSION['expires_at']   = time() + $_SESSION['expires_in']; 
		
		return $this->_accessToken;
	}
	
	public function setAccessToken($token)
	{
		$this->_accessToken = $token;
	}
	
	public function makeRequest($method, $request, $params=array(), $format = 'json') 
	{
		$oauth_params = array(
			'oauth2_access_token' => $this->_accessToken,
			'format' => $format,
		);
		
		if(is_array($params))
			$params = http_build_query($params);

		$uri = self::API_BASE_URI . $request . '?' . http_build_query($oauth_params) . '&' . $params;
		
		$context = stream_context_create(
						array(
							'http' => array(
								'method' => $method,
								)
							)
						);
	
		$response = file_get_contents($uri, false, $context);
		return json_decode($response);
	}
	
	public function get($endpoint, $options){
		return $this->makeRequest('GET', $endpoint, $options);
	}
	
	public function post($endpoint, $options){
		return $this->makeRequest('POST', $endpoint, $options);
	}
		  
}