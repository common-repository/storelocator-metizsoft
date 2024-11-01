<?php
/*
   Plugin Name: StoreLocator Metizsoft
   Description: Connecting with shopify storelocator
   Author: Metizsoft
   Author URI: https://www.metizsoft.com/
   License: GPL3 https://www.gnu.org/licenses/gpl-3.0.html
   Text Domain:           storeLocator-metizsoft
   Requires at least:     5.9
   Requires PHP:          7.1
   WC requires at least:  5.8.0
   WC tested up to:       5.8.0
   Version:               1.0
*/

include_once 'config.php';
add_action( 'admin_init', 'storelocator_metizsoft_admin_init' );
    function storelocator_metizsoft_admin_init() {
        wp_enqueue_script( 'popper-min', plugin_dir_url( __FILE__ ) . 'views/assest/js/popper.min.js' );
        wp_enqueue_script( 'bootstrap-min', plugin_dir_url( __FILE__ ) . 'views/assest/js/bootstrap.min.js' );
        $server= sanitize_text_field($_SERVER['SERVER_NAME']); 
        $site_url =site_url();

        if($server=="localhost" || $server=="127.0.0.1"){
        deactivate_plugins( plugin_basename( __FILE__ ), true );
        wp_enqueue_style( 'errors', plugin_dir_url( __FILE__ ) . 'includes/assest/css/error.css' );
        wp_enqueue_style( 'errors', plugin_dir_url( __FILE__ ) . 'includes/assest/css/error.css' );
        include_once "includes/errors.php";
        }
    } 
add_action('admin_menu', 'storelocator_metizsoft_plugin_setup_menu');

    function storelocator_metizsoft_plugin_setup_menu(){

        add_menu_page( 'StoreLocator', 'StoreLocator', 'manage_options', 'new-store-connector', 'storelocator_metizsoft_home' ,
        plugin_dir_url( __FILE__ ) .'images/store-2.png',90);
    }

    function storelocator_metizsoft_home(){
        wp_enqueue_style( 'errors', plugin_dir_url( __FILE__ ) . 'includes/assest/css/home.css' );

        wp_enqueue_style('bootstrap-min-css', plugin_dir_url( __FILE__ ) . 'views/assest/css/bootstrap.min.css' );
        if (get_page_by_title('storelocator', OBJECT, 'page')) {
        }else{
        $wordpress_page = array(
        'post_title'    => 'storelocator',
        'post_content'  => '[storelocator_page_content]', 
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type' => 'page'
        );

wp_insert_post( $wordpress_page );  
    }

wp_deregister_style( 'parent-style' );
        $site_url =site_url();
        $url = esc_url(storelocator_metizsoft_storelocator_url.'storelocator/wordpress/shortcode.php');
        $args = array(    
        'shop_url' =>$site_url
        );
         
        $response = wp_remote_post($url, array('body' =>  $args));
        $datas1 = json_decode(sanitize_text_field($response['body']));
        $storelocator_metizsoft_ids= $datas1->id;
        $api=$datas1->key;
        include_once "views/home.php";


    }

register_deactivation_hook( __FILE__, 'storelocator_metizsoft_deactivate' );
    function storelocator_metizsoft_deactivate(){
        $site_url =site_url();
        $url = esc_url(storelocator_metizsoft_storelocator_url.'storelocator/wordpress/deactivate.php');
        $args = array(    
        'shop_url' =>$site_url,
        'name' =>$name,
        'email'=>$email,
        'status'=>0,
        'store_type'=>'wordpress',
        'plan_type'=>'business'
        );       
        $response = wp_remote_post($url, array('body' =>  $args));

    }

register_activation_hook( __FILE__, 'storelocator_metizsoft_activate' );

    function storelocator_metizsoft_activate(){
        $site_url =site_url();
        global $wpdb;
        global $current_user;
        get_currentuserinfo();
        $email = (string) $current_user->user_email;
        $name = (string) $current_user->user_login ;
        $url = esc_url(storelocator_metizsoft_storelocator_url.'storelocator/wordpress/');
        $args = array(    
        'shop_url' =>$site_url,
        'name' =>$name,
        'email'=>$email,
        'status'=>1,
        'store_type'=>'wordpress',
        'plan_type'=>'business'
        );
       
        $response = wp_remote_post($url, array('body' =>  $args));
    }
 

    function storelocator_metizsoft_shortcode(){
        ob_start();
        $site_url =site_url();
        $url = esc_url(storelocator_metizsoft_storelocator_url.'storelocator/wordpress/shortcode.php');
        $args = array(    
        'shop_url' =>$site_url 
        );
        
        $response = wp_remote_post($url, array('body' =>  $args));
        $datas = json_decode(sanitize_text_field($response['body']));
      
        $storelocator_metizsoft_id= $datas->id;
        $api=$datas->key;
        $map_provider=$datas->map_provider;
        wp_enqueue_style('shortcode-c11', plugin_dir_url( __FILE__ ) . 'includes/assest/css/shortcode.css');
        if($map_provider=="MapBox"){
        wp_enqueue_script( 'shortcode-js-assign', plugin_dir_url( __FILE__ ) . 'includes/assest/js/shortcode-assign.js' );
        }else{
        wp_deregister_script('shortcode-js-assign'); 

        }    

       wp_enqueue_script( 'google-map-js-for-map', ''.storelocator_metizsoft_map_js_url.'?key='.$api.'&libraries=places', false, NULL );
    wp_enqueue_style('front', plugin_dir_url( __FILE__ ) . 'includes/assest/css/front.css');

        include_once "includes/shortcode.php";
        return ob_get_clean(); 
  

    } 
 
add_shortcode( 'storelocator_page_content', 'storelocator_metizsoft_shortcode' );
 
function storelocator_metizsoft_frontend(){
    wp_enqueue_script( 'vanilaselectbox-js', plugin_dir_url( __FILE__ ) . 'includes/assest/js/vanillaSelectBox.js' );
    wp_enqueue_script( 'mapbox-gl-js', plugin_dir_url( __FILE__ ) . 'includes/assest/js/mapbox-gl.js' );
    wp_enqueue_script( 'mapbox-gl-geoder-js', plugin_dir_url( __FILE__ ) . 'includes/assest/js/mapbox-gl-geocoder.min.js' );
    wp_enqueue_script( 'mapbox-sdk', plugin_dir_url( __FILE__ ) . 'includes/assest/js/mapbox-sdk.min.js' );

    
    wp_enqueue_style('vanila-selctboxc', plugin_dir_url( __FILE__ ) . 'includes/assest/css/vanillaSelectBox' );

    wp_enqueue_style('mapbox-glc', plugin_dir_url( __FILE__ ) . 'includes/assest/css/mapbox-gl.css' );
    wp_enqueue_style('mapbox-gl-geocoderc', plugin_dir_url( __FILE__ ) . 'includes/assest/css/mapbox-gl-geocoder.css' );
  
    wp_enqueue_style('mapbox-gl-geocoderc', plugin_dir_url( __FILE__ ) . 'includes/assest/css/mapbox-sdk.min.js' );
    wp_enqueue_script('jquery');


}

add_action('init','storelocator_metizsoft_frontend');
