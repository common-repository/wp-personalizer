<?php

$insertcsrfvalid=false;
if(isset($_POST['insertcsrf'])&& wp_verify_nonce($_POST['insertcsrf'],'insertcsrf'))
{
  $insertcsrfvalid=true;
}
if(isset( $insertcsrfvalid))
{

     global $wpdb;
         
     $areakey11 = utf8_decode(sanitize_text_field( $_POST['areakey11'])); 

     $areavalue11 = utf8_decode(sanitize_text_field($_POST['areavalue11'])); 
     
      $table_name = $wpdb->prefix."wppersonalizer";
     
     $result = $wpdb->get_col("SELECT personalisor_key FROM $table_name WHERE personalisor_key='".$areakey11."'");  
     
   if (count ($result) == "0") {

       $sql = $wpdb->prepare( "insert into $table_name(personalisor_key, personalisor_key_description) values(%s,%s)",$areakey11, $areavalue11 );

       $insert = $wpdb->query($sql);
        
       echo "Data Inserted";

   }

 else {
       
       echo "Already Exists.";

   }
}
?>