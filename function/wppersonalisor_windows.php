<?php
add_shortcode('wppersonalizer_Windows', 'wppersonalizer_windows');
if(!function_exists('wppersonalizer_windows'))
{
function wppersonalizer_windows($atts, $content) {
    
    $serinfo = $_SERVER; 
    $wppersonalizer_serverinfo = $serinfo['HTTP_USER_AGENT'];
    $wppersonalizer_serverinfo = explode('(', $wppersonalizer_serverinfo);
     $wppersonalizer_serverinfo = explode(';', $wppersonalizer_serverinfo['1']);
      
   return $wppersonalizer_serverinfo['0'];
}

}


?>