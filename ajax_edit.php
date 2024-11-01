<?php

$editcsrfvalid=false;
if(isset($_POST['editcsrf'])&& wp_verify_nonce($_POST['editcsrf'],'editcsrf'))
{
  $editcsrfvalid=true;
}
if(isset( $editcsrfvalid))
{

     global $wpdb;

      $key_edit = trim(utf8_decode(sanitize_text_field($_POST['key_edit'])));  
    //  echo $key_edit;
      $val_edit = trim(utf8_decode(sanitize_text_field($_POST['val_edit']))); 
      
      $hidden_key = trim(utf8_decode(sanitize_text_field($_POST['hidden_key']))); 

      $hidden_val = trim(utf8_decode(sanitize_text_field($_POST['hidden_val']))); 

      $table_name = $wpdb->prefix."wppersonalizer";
      
     $query = $wpdb->query("UPDATE {$table_name} SET personalisor_key = '{$key_edit}', personalisor_key_description = '{$val_edit}' WHERE personalisor_key = '{$hidden_key}' and personalisor_key_description = '{$hidden_val}'");
     
     if($query) 
{

echo "Sucessful Updation.";

}else{
    echo "Updation failed.";
}


}


?>