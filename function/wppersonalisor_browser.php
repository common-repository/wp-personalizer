<?php
add_shortcode('wppersonalizer_Browser', 'wppersonalizer_browser');
if(!function_exists('wppersonalizer_browser'))
{
function wppersonalizer_browser($atts, $content) {
  
    $serinfo = $_SERVER; 
    $wppersonalizer_serverinfo = $serinfo['HTTP_USER_AGENT'];
    $wppersonalizer_serverinfo = explode('(', $wppersonalizer_serverinfo);
    $wppersonalizer_serverinfo = explode(' ', $wppersonalizer_serverinfo['2']);
      
   return $wppersonalizer_serverinfo['3'];
}
}


?>