<?php

return [

	'environment' => env('PAYU_ENV', 'secure'),
	
	/**
	 * Identyfikator posid konta PayU
	 */
	'posid' => env('PAYU_POSID', '273499'),

	/**
	 * Pierwszy klucz MD5
	 */
	'key1'  => env('PAYU_KEY1', '110f29db8481d447918087bf35bb56e6'),

	/**
	 * Drugi klucz MD5
	 */
	'key2'  => env('PAYU_KEY2', '1df73b8508b054f92c30305c423d2377'),


];