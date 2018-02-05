<?php

return [

	'environment' => env('PAYU_ENV', 'secure'),
	
	/**
	 * Identyfikator posid konta PayU
	 */
	'posid' => env('PAYU_POSID', '301519'),

	/**
	 * Pierwszy klucz MD5
	 */
	'key1'  => env('PAYU_KEY1', '155d4321403d610b7497601deada8dba'),

	/**
	 * Drugi klucz MD5
	 */
	'key2'  => env('PAYU_KEY2', 'bc6bd3e1b465de13e5fc3cb27f203718'),


];