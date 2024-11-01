<?php



$deletecsrfvalid=false;
if(isset($_POST['deletecsrf'])&& wp_verify_nonce($_POST['deletecsrf'],'deletecsrf'))
{
  $deletecsrfvalid=true;
}
if(isset( $deletecsrfvalid))
{
     global $wpdb;
      $key = utf8_decode(sanitize_text_field($_POST['key'])); 
      $val = utf8_decode(sanitize_text_field($_POST['val']));
// echo $key.$val;
     $table_name = $wpdb->prefix."wppersonalizer";

		$wpdb->delete( $table_name, array( 'personalisor_key' => $key,'personalisor_key_description' => $val ), array( '%s','%s' ) );
       echo "Data Deleted";




}


?>