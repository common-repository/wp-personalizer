<?php
add_shortcode('wppersonalizer_City', 'wppersonalizer_city');
if(!function_exists('wppersonalizer_city'))
{
function wppersonalizer_city($atts, $content) {
    
      $city = WPPersonalizerSecond_get_client_ip();
    $url="http://pro.ip-api.com/json/".$city."?key=hKTTGTDeZib1VzK";
	$response = wp_remote_get($url);
$body = wp_remote_retrieve_body( $response );
$wp_city=json_decode($body);
	$data=$wp_city->city;
	return $data;

}
}

?>