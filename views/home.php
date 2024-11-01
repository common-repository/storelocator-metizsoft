<!doctype html>
  <html lang="en">
  <head> 
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  </head>
  <body>
  
    <br>
    <div class="container-fluid">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#storelocator_metizsoft_connect"><?php echo esc_html( 'Connect' ); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="<?php echo esc_url(storelocator_metizsoft_support_url);?>" target="_blank"><?php echo esc_html( 'Support' ); ?></a>
        </li>
      </ul>

      <!-- Tab panes -->

      <div class="tab-content"> 
        <div id="storelocator_metizsoft_connect" class="container tab-pane active"><br>
         <?php
        global $wpdb;  
        global $current_user;
        get_currentuserinfo();

        $storelocator_metizsoft_email_home = (string) $current_user->user_email;
        $storelocator_metizsoft_name_home = (string) $current_user->user_login ;
         ?>
  


      <input type="hidden" name="storelocator_metizsoft_name_home" id="storelocator_metizsoft_name_home" value="<?php echo  esc_attr($storelocator_metizsoft_name_home);?>">
      <input type="hidden" name="storelocator_metizsoft_email_home" id="storelocator_metizsoft_email_home" value="<?php echo  esc_attr($storelocator_metizsoft_email_home);?>">
      <input type="hidden" name="storelocator_metizsoft_id_home" id="storelocator_metizsoft_id_home" value="<?php echo  esc_attr($storelocator_metizsoft_ids);?>">

      <center><h1 ><?php echo esc_html( 'Connect to Storelocator' ); ?></h1></center>

      <center><input type="submit" class="btn btn-primary" value="Connect" id="storelocator_metizsoft_storelocator_home"  ></center>
  
          <input type="hidden" name="storelocator_metizsoft_ajax_url_home
" id="storelocator_metizsoft_ajax_url_home" value="<?php echo esc_attr(storelocator_metizsoft_storelocator_url);?>">
          
      <script type="text/javascript">
       
        jQuery('#storelocator_metizsoft_storelocator_home').click(function($){
            var storelocator_metizsoft_ajax_home=jQuery('#storelocator_metizsoft_ajax_url_home').val();
            var storelocator_metizsoft_email_home =jQuery('#storelocator_metizsoft_email_home').val();
            var storelocator_metizsoft_name_home =jQuery('#storelocator_metizsoft_name_home').val();
            var storelocator_metizsoft_id_home =jQuery('#storelocator_metizsoft_id_home').val();
            var storelocator_metizsoft_from_home='wordpress';
            window.open(storelocator_metizsoft_ajax_home+'storelocator?id='+storelocator_metizsoft_id_home, '_blank');
            });
        </script>
        
        </div>
      <div id="storelocator_metizsoft_planstatus" class="container tab-pane fade"><br>
          <h3><?php echo esc_html( 'Plans Status' ); ?></h3>
		  <p><?php echo esc_html( 'Currently You are using free Plans' ); ?></p>
		  
        </div>
        <div id="storelocator_metizsoft_support" class="container tab-pane fade"><br>
          <h3><?php echo esc_html( 'Support' ); ?></h3>
		  
          <p></p>
        </div>
      </div>

    </div>

       


  </body>

</html>

