<?php

class eBay {
	private $app_name;
	public $finding;
	public $shopping;
	public $trading;

	public function __construct($app_name) {
		$this->app_name = $app_name;
		$this->finding = new _eBayFinding($this->app_name);
		$this->shopping = new _eBayShopping($this->app_name);
		$this->trading = new _eBayTrading($this->app_name);
	}
}

class _eBayServicePrototype {
	protected $base_url;
	protected $app_name;

	public function __construct($app_name) {
		$this->app_name = $app_name;
	}

	public function call($call, $call_arguments) {
		$base_arguments = array(
			'OPERATION-NAME' => $call,
			'SERVICE-VERSION' => '1.0.0',
			'SECURITY-APPNAME' => $this->app_name,
			'RESPONSE-DATA-FORMAT' => 'JSON',
		);

		// Encode the arguments into a key/value url encoded string.
		$arguments_string = http_build_query($base_arguments) . '&REST-PAYLOAD';
		foreach($call_arguments[0] as $key => $value) {
			$arguments_string .= '&' . $key . '=' . urlencode($value);
		}

		$api_url = $this->base_url . '?' . $arguments_string;
		print 'URL: ' . $api_url;
		$result = file_get_contents($api_url);

		return json_decode($result, True);
	}

	public function __call($method, $arguments) {
		return $this->call($method, $arguments);
	}
}

class _eBayFinding extends _eBayServicePrototype {
	protected $base_url = 'http://svcs.ebay.com/services/search/FindingService/v1';
}

class _eBayShopping extends _eBayServicePrototype {
	protected $base_url = 'http://svcs.ebay.com/services/search/ShoppingService/v1';
}

class _eBayTrading extends _eBayServicePrototype {
	protected $base_url = 'http://svcs.ebay.com/services/search/TradingService/v1';
}
