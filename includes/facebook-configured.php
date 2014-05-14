<?php

require_once "base_facebook.php";
include_once("../includes/facebook.php");
	$facebook = new Facebook(array(
		'appId'  => '511297335556303',
		'secret' => '574a1a675f22239be84c587f9dda88e6',
	));
   

   $facebooklocal = new Facebook(array(
		'appId'  => '1423275721261751',
		'secret' => 'fb128bad83e110f49f368737e2885c8f',
	));
	
	/* LOCAL FIX - COMMENT ON ONLINE VERSION */
//		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
//		Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
	/* END LOCAL FIX */ 
	
//$facebook = $facebooklocal;	
	
