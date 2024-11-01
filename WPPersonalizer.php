<?php
/*
Plugin Name: WP Personalizer
Description: A highly customizable WP Plugin to create personalized and high converting landing pages that instantly spike up engagement and sales by many times.
Author: TEKNIKFORCE
Version: 1.0.0
Author URI: http://teknikforce.com/
*/
if ( ! defined( 'ABSPATH' ) ) exit;
$personalizerprefixinit='perswp_';

define('RESULT_PERSONALIZER', 'wppersonalizer');

    require_once("unichatbox/plugin.php");
$gdprwpvar=new \personalizer\license\Personalizerpluginlisence(array('wppersonalizer',$personalizerprefixinit));
if($gdprwpvar->validate()==1)
{
  
  add_action('admin_menu','WPPersonalizer_dashbord');
}
else
{
new \personalizer\license\Personalizeractivationpage(array('wppersonalizer',$personalizerprefixinit));
}
register_activation_hook( __FILE__, 'wppwesonalizer_install_personalisor_table' );

if(!function_exists('wppwesonalizer_install_personalisor_table'))
{
function wppwesonalizer_install_personalisor_table()
{

	global $wpdb;
  
         $charset_collate = '';
    if (!empty($wpdb->charset)) {
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    }
    if (!empty($wpdb->collate)) {
        $charset_collate .= " COLLATE {$wpdb->collate}";
    }
         $table_name = $wpdb->prefix . RESULT_PERSONALIZER;
	 $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (" .
				"`id` bigint(11) NOT NULL AUTO_INCREMENT,".				
                                "`personalisor_key` text NOT NULL,".
                                "`personalisor_key_description` text NOT NULL,".
				"PRIMARY KEY (`id`)".
			 ") {$charset_collate} ENGINE=InnoDB;";
         $wpdb->query($sql);    

         }

       }
register_deactivation_hook( __FILE__, 'wppwesonalizer_Uninstall_personalisor_table' );	


if(!function_exists('wppwesonalizer_Uninstall_personalisor_table'))
{
function wppwesonalizer_Uninstall_personalisor_table(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS " . $wpdb->prefix . RESULT_PERSONALIZER .            
            ";";
    $wpdb->query($sql);
}
}

add_action('wp_ajax_personalizeractionresponse_adminajxlcnc',"wppwesonalizer_licenseAjaxRun");

if(!function_exists('wppwesonalizer_licenseAjaxRun'))
{
function wppwesonalizer_licenseAjaxRun()
{
 if(isset($_POST['reverifyjkmvhblicense']) && isset($_POST['rvryfyplugin']) && isset($_POST['rvryfypluginpref']) && isset($_POST["pluginnonce"]) && wp_verify_nonce($_POST["pluginnonce"],'perswp_'))
  {
  //echo $_POST["pluginnonce"];
  //wpgener8tor
  $ob=new \personalizer\license\Personalizerpluginlisence(array(sanitize_text_field($_POST['rvryfyplugin']),sanitize_text_field($_POST['rvryfypluginpref'])));
  $ob->reValidate("server");
  }
  wp_die();
}

}
if(!function_exists('wppwesonalizer_installscripts'))
{

function wppwesonalizer_installscripts()
{

wp_enqueue_script('jquery');
   wp_register_style('personalizer_css',plugins_url('asset/css/wppersona.css',__FILE__));
    wp_enqueue_style('personalizer_css');
    
    wp_register_style('personalizer_admin_bootstrap',plugins_url('asset/css/bootstrap/css/bootstrap.min.css',__FILE__));
    wp_enqueue_style('personalizer_admin_bootstrap');
    wp_register_script('personalizer_bootstrap_popper',plugins_url('asset/css/bootstrap/js/popper.min.js',__FILE__),array('jquery'));
    wp_enqueue_script('personalizer_bootstrap_popper');
    wp_register_script('personalizer_admin_bootstrap_js',plugins_url('asset/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
    wp_enqueue_script('personalizer_admin_bootstrap_js'); 





}

}
add_action('admin_enqueue_scripts','wppwesonalizer_installscripts');

if(!function_exists('WPPersonalizer_register_meta_boxes'))
{
function WPPersonalizer_register_meta_boxes() {
    add_meta_box( 'WP-Personalizer-meta-box-id', __( 'WP Personalizer', 'WP_Personalizer' ), 'WPPersonalizer_my_display_callback', array(page) );
}
}
add_action( 'add_meta_boxes', 'WPPersonalizer_register_meta_boxes' );

if(!function_exists('WPPersonalizer_my_display_callback'))
{
function WPPersonalizer_my_display_callback($page){
    global $post_id; 
 
 $res = ( (!isset($_GET["normal"])) ||$_GET["normal"] == null)? 'Teknikforce': sanitize_text_field($_GET["normal"]);
?>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title></title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
 
  <script>
   jQuery(document).ready(function($){
      $('#personalizer_shortcode_type').on('change', function(){//alert( this.value );
        var personalizer_shortcode_type = this.value; 
        
        var gen_shortcode = "[wppersonalizer_"+personalizer_shortcode_type+"]";//alert(gen_shortcode);
        
        $('#personalizer_ppuri_copy').val(gen_shortcode);
        
      });
  });
  </script>
</head>

<body>


<div class="container-fluid">

 
    
  <div class="row">
      <div class="col-sm-3">
          <h3 style="margin-top: 28px !important;font-size: 13px !important;color: #616161 !important;" class="lead_finder_fb_heading" >Enter Your Page/Post URL : </h3>
      </div>
      <div class="col-sm-6" >
      <?php  update_option("personalizer_ppuri$page->ID",get_post_meta($page->ID, "personalizer_ppuri$page->ID", true)); ?>
          <h3 style="font-size: 13px !important;color: #616161 !important;"><input type="text" name="personalizer_ppuri<?= esc_attr($page->ID); ?>" class="lead_finder_fblimit lead_finder_fb form-control personalizer_ppuri" id="personalizer_ppuri" value="<?= get_post_meta($page->ID, "personalizer_ppuri$page->ID", true) != null ? esc_url(get_post_meta($page->ID, "personalizer_ppuri$page->ID", true)): esc_url(get_permalink($page->ID)).'&normal=Teknikforce'; ?>">
              
          </h3>
    </div>
    
  </div>
    </div>
    
</body>
</html> 

<?php
}
}



if(!function_exists('WPPersonalizer_register_meta_boxes1'))
{
function WPPersonalizer_register_meta_boxes1() {
    add_meta_box( 'WP-Personalizer-meta-box-id', __( 'WP Personalizer', 'WP_Personalizer' ), 'WPPersonalizer_my_display_callback1', array(post) );
}
}
add_action( 'add_meta_boxes', 'WPPersonalizer_register_meta_boxes1' );

if(!function_exists('WPPersonalizer_my_display_callback1'))
{
function WPPersonalizer_my_display_callback1($page){
    global $post_id; 
    //echo $_POST['publish'];echo $_POST['save'];
  $res = ((!isset($_GET["normal"])) || $_GET["normal"] == null)? 'Teknikforce': sanitize_text_field($_GET["normal"]);
?>
<html lang="en">
<head>
  
  <title>Bootstrap Example</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
 
  <script>
   jQuery(document).ready(function($){
      $('#personalizer_shortcode_type').on('change', function(){
        var personalizer_shortcode_type = this.value; 
        
        var gen_shortcode = "[wppersonalizer_"+personalizer_shortcode_type+"]";
        
        $('#personalizer_ppuri_copy').val(gen_shortcode);
        
      });
  });
  </script>
</head>

<body>


<div class="container-fluid">

 
    
  <div class="row">
      <div class="col-sm-3">
          <h3 style="margin-top: 28px !important;font-size: 13px !important;color: #616161 !important;" class="lead_finder_fb_heading" >Enter Your Page/Post URL : </h3>
      </div>
      <div class="col-sm-6" >
      <?php  update_option("personalizer_ppuri$page->ID",get_post_meta($page->ID, "personalizer_ppuri$page->ID", true)); ?>
          <h3 style="font-size: 13px !important;color: #616161 !important;"><input type="text" name="personalizer_ppuri<?= esc_attr($page->ID); ?>" class="lead_finder_fblimit lead_finder_fb form-control personalizer_ppuri" id="personalizer_ppuri" value="<?= get_post_meta($page->ID, "personalizer_ppuri$page->ID", true) != null ? esc_url(get_post_meta($page->ID, "personalizer_ppuri$page->ID", true)): esc_url(get_permalink($page->ID)).'&normal=Teknikforce'; ?>">
              
          </h3>
    </div>
    
  </div>
    </div>
    
</body>
</html> 

<?php

}
}



//add_action('admin_menu', 'WPPersonalizer_dashbord');

if(!function_exists('WPPersonalizer_dashbord'))
{
function WPPersonalizer_dashbord(){
    add_menu_page('WP_Personalizer', 'WP Personalizer', 'administrator', 'WPPersonalizer', 'WPPersonalizer_callback', plugins_url('asset/img/icon-p.png',__FILE__) );
   
 }      
}
if(!function_exists('WPPersonalizer_callback'))
{
function WPPersonalizer_callback(){
    global $page;

//function WPPersonalizer_my_display_callback($page){
    global $post_id; 
    global $wpdb;
    //'http://localhost/wordpress/wp-admin/admin.php?page=WPPersonalizer';
    $redi = admin_url()."admin.php?page=WPPersonalizer";
    $wppersonalisor_name = $wpdb->prefix."wppersonalizer";
    
    @$res = ((!isset($_GET["normal"])) || $_GET["normal"] == null)? 'Teknikforce': sanitize_text_field($_GET["normal"]);
    @$myrows = $wpdb->get_results( "SELECT * FROM $wppersonalisor_name" );
    @$myrows = json_encode($myrows, TRUE);
    @$myrows = json_decode($myrows,TRUE);
     
?>
<html lang="en">
<head>
  
  <title></title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
 
  <script>

    jQuery(document).ready(function($){
      $('body').css('background-color','#f1f1f1');
      $('#add_intextarea').on('click', function(){
          var areakey1 = $('#areakey').val(); 
          var areakey = areakey1.length;
          var areavalue1 = $('#areavalue').val(); 
          var areavalue = areavalue1.length;
           var insertcsrf="<?php echo wp_create_nonce('insertcsrf'); ?>";

          if ((areakey == 0) && (areavalue == 0) || (areakey == 0) || (areavalue == 0)){
          alert("Please enter Keyword and Description.");
         
          }
          else{
              
              var areakey11 = encodeURIComponent(areakey1);
              var areavalue11 = encodeURIComponent(areavalue1);
              
              $.ajax({

   		type: 'POST',

   		url: "<?php echo admin_url('admin-ajax.php');?>",



   		data: "action=insertdatarequest&areakey11="+areakey11+"&insertcsrf="+insertcsrf+"&areavalue11="+areavalue11,

                success: function(msg){
                    
                    alert(msg); 
                   $('#areakey').val('');
                   $('#areavalue').val(''); 
                    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
                }

               });  
              
              
          
          $('#personaliser_m').append("\<div class='scnt' id='scnt"+areakey1+"'><div class='personaliser_key'>"+areakey1+"</div>\n\
      <div class='personaliser_key_desc'>"+areavalue1+"</div>\n\
      <div class='personaliser_key_sho'>"+"[wppersonalizer_"+areakey1+" shortcode_text='"+areavalue1+"']"+"</div>\n\
      <div class='pers_Action_dyn' style='text-align: center !important;'>\n\
      <a id='personaliser_delete' onclick='"+'personaliser_delete("'+areakey1+'", "'+areavalue1+'","scnt'+areakey1+'")'+"' class='personaliser_delete' name='personaliser_delete'><img style='width: 69px;height: 25px;' src='"+"<?=esc_url(plugins_url('asset/img/delete.png',__FILE__)); ?>"+"'/></a>\n\
      <a style='margin-top:3px;' href='#areakey' id='personaliser_edit' onclick='"+'personaliser_edit("'+areakey1+'", "'+areavalue1+'","scnt'+areakey1+'")'+"' class='personaliser_edit' name='personaliser_edit' ><img style='width: 69px;height: 25px;' src='"+"<?=esc_url(plugins_url('asset/img/Edit-button.png',__FILE__)); ?>"+"'/></a>\n\
      </div></div>");
          
      }
      });
    
      /////////////////////////////////////////////////// 
  });
  
  function personaliser_delete(areakey1,areavalue1,id,event){
      jQuery(document).ready(function($){

  var idd =$.trim(id);  
  var key = encodeURIComponent(areakey1);
  var val = encodeURIComponent(areavalue1);
  var deletecsrf ="<?php echo wp_create_nonce('deletecsrf'); ?>";



   $.ajax({

   		type: 'POST',

   	

      url: "<?php echo admin_url('admin-ajax.php');?>",

 
   		data: "action=deletedatarequest&key="+key+"&deletecsrf="+deletecsrf+"&val="+val,

                success: function(msg){
                                        alert(msg); 

                 $("#"+idd).css('display','none'); 

                }

               });  
 event.preventDefault();
});

   }
  
  function personaliser_edit(areakey1,areavalue1,id_edit,event){
  jQuery( document ).ready(function( $ ) {

  $('#areakey').val(areakey1);
  $('#areavalue').val(areavalue1);
  $('#personalisor_update').css('display','none');
  $('#update_intextarea').css('display','block');
  $('#hidden_key').val(areakey1);
  $('#hidden_val').val(areavalue1);
  $('#hidden_id').val(id_edit);

  var idd_edit = $.trim(id_edit);
  
  var key_edit = encodeURIComponent(areakey1);
  var val_edit = encodeURIComponent(areavalue1);
  var editcsrf="<?php echo wp_create_nonce('editcsrf'); ?>";

  $.ajax({

   		type: 'POST',

       url: "<?php echo admin_url('admin-ajax.php');?>",

   		data: "action=editdatarequest&key_edit="+key_edit+"&editcsrf="+editcsrf+"&val_edit="+val_edit,

                success: function(msg){
                    
              

                }

               });  

    });
}
    
          jQuery(document).ready(function($){

      $('#update_intextarea').on('click', function(event){
         
          var key_edit1 = $('#areakey').val(); 
         // alert(key_edit1);
          var key_edit = key_edit1.length;
          var val_edit1 = $('#areavalue').val(); 
          var val_edit = val_edit1.length;
          var hidden_key = $('#hidden_key').val();
          var hidden_val = $('#hidden_val').val();
          var hidden_id = $('#hidden_id').val();
            var editcsrf="<?php echo wp_create_nonce('editcsrf'); ?>";

          if ((key_edit == 0) && (val_edit == 0) || (key_edit == 0) || (val_edit == 0)){
          alert("Please enter Keyword and Description.");
         
          }
          else{
              
              var key_edit11 = encodeURIComponent(key_edit1);
              var val_edit11 = encodeURIComponent(val_edit1);
              var hidden_key = encodeURIComponent(hidden_key);
              var hidden_val = encodeURIComponent(hidden_val);
              
    
          
          $.ajax({

   		type: 'POST',

       url: "<?php echo admin_url('admin-ajax.php');?>",



   		data:  "action=editdatarequest&key_edit="+key_edit11+"&editcsrf="+editcsrf+"&val_edit="+val_edit11+"&hidden_key="+hidden_key+"&hidden_val="+hidden_val,

                success: function(msg){
                    
                 alert(msg);
                 
                 location.href = '<?= esc_url($redi); ?>';

                }
                
               
               });
               
               
               }
             event.preventDefault();  
      });
      
      });
  </script>
</head>
<body>

  <div style="width: 80%;">
<div class="container-fluid">
    
    <div class="row" >
     
          <h2>WP Personalizer Settings </h2>
      
    </div>
    
  </div>
    
        <div class="row" id="personalisor_area">
      <div class="col-sm-4">
          <h3 style="margin-top: 28px !important;font-size: 13px !important;color: #616161 !important;" class="lead_finder_fb_heading" >Enter Keyword and its Description : </h3>
      </div>
      <div class="col-sm-8" >
      
          <h3 style="font-size: 13px !important;color: #616161 !important; margin-top: 28px !important;">
              <div>
                  <div><input type="text" value="" name="areakey" class="areakey form-control" id="areakey" style="width: 25%;float: left;" placeholder="Enter Keyword"/><div style="width: 1%;float: left;margin: 0 2%;line-height: 35px;"> = </div> </div>
                  <div><input type="text" value="" name="areavalue" class="areavalue form-control" id="areavalue" style="width: 55%;float: left;margin-right: 2%;" placeholder="Enter Keyword Description"/></div>
                  <a class="updaresucess"><div id="update_intextarea" style="display: none;cursor: pointer;"> 
                      <div style='width: 0%;line-height: 32px;'> <img style="width: 72px;height: 25px;position: absolute;margin-top: 4px;" src="<?= esc_url(plugins_url('asset/img/update.png',__FILE__)); ?>"> </div> 
                      <input type="hidden" name="hidden_key" id="hidden_key"> <input type="hidden" name="hidden_val" id="hidden_val"><input type="hidden" name="hidden_id" id="hidden_id">
                      </div> </a>
                  <div id="personalisor_update"><div id="add_intextarea" style='width: 0%;line-height: 32px; cursor: pointer;'> <img style="width: 72px;height: 25px;position: absolute;margin-top: 4px;" src="<?= esc_url(plugins_url('asset/img/add.png',__FILE__)); ?>"></div></div>
              </div>      
          </h3>
    </div>
    
  </div>

    
    <div class="pers_main" >

        <div class="pers_main_head" > 

     <div class="pers_Keywords"> Keywords </div>

      <div class="pers_Keyword_Description">Keyword Description</div>
      
      <div class="pers_Shortcode">Shortcode</div>

      <div class="pers_Action_theading">Action to be Taken</div>

    </div>    

    <div class='personaliser_m' id='personaliser_m'>  
        <?php
        $wppersonalisor = array('Normal'=>'normal','Upper_Case'=>'upper_case','Lower_Case'=>'lower_case','Proper_Case'=>'proper_case',
            'Windows'=>'windows','Browser'=>'browser','IP'=>'ip','City'=>'city','Region'=>'region','Country'=>'country');
    foreach ($wppersonalisor as $ke => $wppersonalisor){
    ?>
        <div class='scnt'>      

      <div class='personaliser_key'><?= esc_html(@$ke); ?></div>

      <div class='personaliser_key_desc'><?= esc_html(@$wppersonalisor); ?></div>
     
      <div class='personaliser_key_sho'><?php echo  "[wppersonalizer_".esc_html(@$ke)."  shortcode_text='".esc_html(@$wppersonalisor)."']"; ?></div>

      <div class='pers_Action_dyn'>

      </div></div>
    <?php
    }
        
        foreach($myrows as $key => $value){
        ?>
        <div class='scnt' id='scnt<?= esc_attr(@$value['personalisor_key']); ?>'>      

      <div class='personaliser_key'><?= esc_html(@$value['personalisor_key']); ?></div>

      <div class='personaliser_key_desc'><?= esc_html(@$value['personalisor_key_description']); ?></div>
     
      <div class='personaliser_key_sho'><?php echo  "[wppersonalizer_".esc_html(@$value['personalisor_key'])."  shortcode_text='".esc_html(@$value['personalisor_key_description'])."']"; ?></div>

      <div class='pers_Action_dyn' style='text-align: center !important;' id='pers_Action_dyn'>

          <a style='padding: 5px 5px;'  onclick="personaliser_delete('<?= esc_attr(@$value['personalisor_key']); ?>', '<?= esc_attr(@$value['personalisor_key_description']); ?>','scnt<?= esc_attr(@$value['personalisor_key']); ?>')" id='personaliser_delete' class='personaliser_delete' name='personaliser_delete'><img style='width: 69px;height: 25px;' src="<?= esc_url(plugins_url('asset/img/delete.png',__FILE__)); ?>"></a>

          <a style='margin-top:3px;' href='#areakey' style='padding: 2px 7px;border-radius: 6px;' onclick="personaliser_edit('<?= esc_attr(@$value['personalisor_key']); ?>', '<?= esc_attr(@$value['personalisor_key_description']); ?>','scnt<?=esc_attr( @$value['personalisor_key']); ?>')" id='personaliser_edit11' class='personaliser_edit' name='personaliser_edit' > <img style='width: 69px;height: 25px;'  src="<?= esc_url(plugins_url('asset/img/Edit-button.png',__FILE__)); ?>"> </a>

      </div></div>
    <?php
        }
    ?>
    </div> </div>
    
    
</div>
    
</body>


<?php
}
}

if(!function_exists('WPPersonalizerSecond_save_custom_meta_box'))
{

function WPPersonalizerSecond_save_custom_meta_box($post_id, $post){
   
    if(isset($_POST["personalizer_ppuri$post_id"]))
    {
        $personalizer_ppuri = sanitize_text_field($_POST["personalizer_ppuri$post_id"]);
    }   
    update_post_meta($post_id, "personalizer_ppuri$post_id", $personalizer_ppuri);
    
    if(isset($_POST['personalizer_ppuri_hidden']))
    {
        $personalizer_ppuri_hidden = sanitize_text_field($_POST['personalizer_ppuri_hidden']);
    }   
    update_post_meta($post_id, 'personalizer_ppuri_hidden', $personalizer_ppuri_hidden);
 

    if(isset($_POST["personalizer_textarea$post_id"]))
    {
        $personalizer_textarea = sanitize_text_field($_POST["personalizer_textarea$post_id"]);
    }   
    update_post_meta($post_id, "personalizer_textarea$post_id", $personalizer_textarea);
    
    if(isset($_POST['personalizer_shortcode_type']))
    {
        $personalizer_shortcode_type = sanitize_text_field($_POST['personalizer_shortcode_type']);
    }   
    update_post_meta($post_id, 'personalizer_shortcode_type', $personalizer_shortcode_type);
    
    if(isset($_POST['personalizer_shortcod_name']))
    {
        $personalizer_shortcod_name = sanitize_text_field($_POST['personalizer_shortcod_name']);
    }   
    update_post_meta($post_id, 'personalizer_shortcod_name', $personalizer_shortcod_name);
    
    if(isset($_POST['personalizer_shortcod_default']))
    {
        $personalizer_shortcod_default = sanitize_text_field($_POST['personalizer_shortcod_default']);
    }   
    update_post_meta($post_id, 'personalizer_shortcod_default', $personalizer_shortcod_default);
    
    if(isset($_POST['personalizer_ppuri_copy']))
    {
        $personalizer_ppuri_copy = sanitize_text_field($_POST['personalizer_ppuri_copy']);
    }   
    update_post_meta($post_id, 'personalizer_ppuri_copy', $personalizer_ppuri_copy);
    
}
}
add_action("save_post", "WPPersonalizerSecond_save_custom_meta_box", 10, 3);


if(!function_exists('WPPersonalizerSecond_get_client_ip'))
{
function WPPersonalizerSecond_get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
}
add_shortcode('wppersonalizer_Normal', 'wppersonalizer_Normal');


if(!function_exists('wppersonalizer_Normal'))
{
function wppersonalizer_Normal($atts, $content) {
   
    global $post;

    $serinfo = $_SERVER; 
    

    $ip = WPPersonalizerSecond_get_client_ip();
   //$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
   
  
     $url="http://pro.ip-api.com/json/".$ip."?key=hKTTGTDeZib1VzK";
	$response = wp_remote_get($url);
$body = wp_remote_retrieve_body( $response );
$wp_details=json_decode($body);
 	$details=$wp_details->ip;
 	
 	
 	 $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
 $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
	//  echo $protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	  //echo "<br>".get_permalink($post->ID);
    
    if($protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == esc_url(get_permalink($post->ID))){
   
     $res = get_option("personalizer_ppuri$post->ID"); 
    
     ?>
<script type="text/javascript"> 
    
        location.href = '<?= $res; ?>';
    
</script>
    <?php
            
   }
   return sanitize_text_field($_GET["normal"]);
    
}
}

global $wpdb;
    $wppersonalisor_name = $wpdb->prefix."wppersonalizer";
     
   $res = ( (!isset($_GET["normal"]))   || $_GET["normal"] == null)? 'Teknikforce': sanitize_text_field($_GET["normal"]);
    $myrows = $wpdb->get_results( "SELECT * FROM $wppersonalisor_name" );
    $myrows = json_encode($myrows, TRUE);
    $personalizer_textarea = json_decode($myrows,TRUE);

if($personalizer_textarea != NULL){
    
  foreach($personalizer_textarea as $k=>$v)
   {   
   
   add_shortcode('wppersonalizer_' . $v['personalisor_key'] , function($atts, $content){
    return $atts ['shortcode_text'];
    
});
   }
    
}
////////////////////////////////////////////////
add_shortcode('wppersonalizer_Upper_Case', 'wppersonalizer_Upper_Case');

if(!function_exists('wppersonalizer_Upper_Case'))
{

function wppersonalizer_Upper_Case($atts, $content) {
   
    global $post;
 $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
 $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
     if($protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == esc_url(get_permalink($post->ID)))
     {
            $res = get_option("personalizer_ppuri$post->ID"); 
    
             ?>
<script type="text/javascript"> 
    
        location.href = '<?= $res; ?>';
    
</script>
    <?php
            
   }
   return strtoupper(sanitize_text_field($_GET["normal"]));
    
}
}

add_shortcode('wppersonalizer_Lower_Case', 'wppersonalizer_Lower_Case');

if(!function_exists('wppersonalizer_Lower_Case'))
{
function wppersonalizer_Lower_Case($atts, $content) {
   
    global $post;
   
 $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
 $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
     if($protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == esc_url(get_permalink($post->ID)))
     {       $res = get_option("personalizer_ppuri$post->ID"); 
    
             ?>
<script type="text/javascript"> 
    
        location.href = '<?= $res; ?>';
    
</script>
    <?php
            
   }
   return strtolower(sanitize_text_field($_GET["normal"]));
    
}
}

add_shortcode('wppersonalizer_Proper_Case', 'wppersonalizer_Proper_Case');
if(!function_exists('wppersonalizer_Proper_Case'))
{

function wppersonalizer_Proper_Case($atts, $content) {
   
    global $post;
   
 $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
 $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
     if($protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ==esc_url( get_permalink($post->ID)))
     {
            $res = get_option("personalizer_ppuri$post->ID"); 
    
             ?>
<script type="text/javascript"> 
    
        location.href = '<?= $res; ?>';
    
</script>
    <?php
            
   }
   return ucwords(sanitize_text_field($_GET["normal"]));
    
}
}


require_once __DIR__.'/function/wppersonalisor_windows.php';
require_once __DIR__.'/function/wppersonalisor_browser.php';
require_once __DIR__.'/function/wppersonalisor_ip.php';
require_once __DIR__.'/function/wppersonalisor_city.php';
require_once __DIR__.'/function/wppersonalisor_region.php';
require_once __DIR__.'/function/wppersonalisor_country.php';


if(!function_exists('wppersonalizertnf_footer_admin'))
{
function wppersonalizertnf_footer_admin () {
    global $post;
     @$screen = get_current_screen();     
    if($screen->parent_file == 'WPPersonalizer'){
?>
<style>
.logocont{ margin-bottom: -50px;}
.logocont .tnfcreated{
   font-size:12px;
  
}
.logocont a{text-decoration: none;font-size:12px; color: #1b1b1b;}
.logocont a:hover{text-decoration: none !important;}
.logocont a:hover{color: #0073aa;}
</style>

     <div class="container-fluid logocont">
         <div class="tnfcreated"> 
             <div><a href="http://teknikforce.com/"><img class="tekink" src="<?= esc_url(plugins_url("asset/img/logo.png",__FILE__)); ?>" title="Teknikforce" alt="Teknikforce" style="cursor: pointer;outline:none;width: 160px;margin-bottom: 4px;" onclick="window.external.teknikforce();"></a></div>
             <div> </div> 
         </div>
     </div>   
    <?php
    }
}
}
add_filter('admin_footer_text', 'wppersonalizertnf_footer_admin');


add_action('wp_ajax_insertdatarequest','wppwesonalizer_do_insertdatarequest');
add_action('wp_ajax_nopriv_insertdatarequest','wppwesonalizer_do_insertdatarequest');

if(!function_exists('wppwesonalizer_do_insertdatarequest'))
{
function wppwesonalizer_do_insertdatarequest()
{
  require_once("ajax_insert.php");
  wp_die();
}
}


add_action('wp_ajax_deletedatarequest','wppwesonalizer_do_deletedatarequest');
add_action('wp_ajax_nopriv_deletedatarequest','wppwesonalizer_do_deletedatarequest');

if(!function_exists('wppwesonalizer_do_deletedatarequest'))
{
function wppwesonalizer_do_deletedatarequest()
{
  require_once("ajax_delete.php");
  wp_die();
}
}

add_action('wp_ajax_editdatarequest','wppwesonalizer_do_editdatarequest');
add_action('wp_ajax_nopriv_editdatarequest','wppwesonalizer_do_editdatarequest');

if(!function_exists('wppwesonalizer_do_editdatarequest'))
{
function wppwesonalizer_do_editdatarequest()
{
  require_once("ajax_edit.php");
  wp_die();
}
}



//editdatarequest


?>