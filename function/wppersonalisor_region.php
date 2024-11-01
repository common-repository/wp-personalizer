<?php
add_shortcode('wppersonalizer_Region', 'wppersonalizer_region');

if(!function_exists('wppersonalizer_region'))
{

function wppersonalizer_region($atts, $content) {
    
   $region = WPPersonalizerSecond_get_client_ip();
     $url="http://pro.ip-api.com/json/".$region."?key=hKTTGTDeZib1VzK";
	$response = wp_remote_get($url);
$body = wp_remote_retrieve_body( $response );
$wp_region=json_decode($body);
	$data=$wp_region->region;
	return $data;
    
}
}



?>