

    <div id="storelocator_metizsoft_re" class="storelocator_metizsoft_re"> </div>
  

  <input type="hidden" name="storelocator_metizsoft_id" id="storelocator_metizsoft_id" value="<?php echo esc_attr($storelocator_metizsoft_id);?>">
   
   <input type="hidden" name="storelocator_metizsoft_url" id="storelocator_metizsoft_url" value="<?php echo  esc_attr($site_url);?>">

  
    <input type="hidden" name="storelocator_metizsoft_ajax_url" id="storelocator_metizsoft_ajax_url" value="<?php echo 
esc_attr(storelocator_metizsoft_storelocator_url);?>">

    <img src="<?php echo  esc_url(plugin_dir_url( __FILE__ ) . 'assest/image/store_locator_loader.png'); ?>" class="store_locator_loader" id="storelocator_metizsoft_loader">

  
     
    <script type="text/javascript"> 
 
    jQuery( document ).ready(function( $ ) {
        var storelocator_metizsoft_id =jQuery('#storelocator_metizsoft_id').val();
        var storelocator_metizsoft_urls =jQuery('#storelocator_metizsoft_url').val(); 
        var storelocator_metizsoft_ajax=jQuery('#storelocator_metizsoft_ajax_url').val();
        jQuery.ajax({
        url:storelocator_metizsoft_ajax+"storelocator/googlemap?shop="+storelocator_metizsoft_urls+"&id="+storelocator_metizsoft_id,        
        data:{shop:storelocator_metizsoft_urls},
        type:"GET",
        success: function(result){
        $('#storelocator_metizsoft_re').html(result);
        $('#storelocator_metizsoft_loader').hide(); 
        }
    });
    });
    </script>