<?php
	/*--------------------------------------------------------------------------*
	 * 
	 * Copyright (C) 2014 Brand Labs Inc
	 * 
	 *--------------------------------------------------------------------------*/
	 
	 
	require_once dirname(__FILE__).'/../inc/configuration.php';
	require_once dirname(__FILE__).'/../inc/proxy.php';
	

	$url = SELLERS_BASE_URL.INFORMATION_PATH;
	
	//header("Content-type: application/json");
	print Proxy::_get($url, $_GET);
	
?>
