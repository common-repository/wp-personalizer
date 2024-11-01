<?php
add_shortcode('wppersonalizer_Country', 'wppersonalizer_country');
if(!function_exists('wppersonalizer_country'))
{

function wppersonalizer_country($atts, $content) {
    
   $country = WPPersonalizerSecond_get_client_ip();
     $url="http://pro.ip-api.com/json/".$country."?key=hKTTGTDeZib1VzK";
	$response = wp_remote_get($url);
$body = wp_remote_retrieve_body( $response );
$wp_country=json_decode($body);
	$data=$wp_country->country;
	return $data;
}
}