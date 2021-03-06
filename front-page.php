<?php get_header();?>


    <!------ CONTENT ------>
    <div class="content">
        <div class="wrapper">
            
            <?php
                   $background_images = array();
                   $cat = get_option(THEME_NAME.'_front_slider_category');
                   $args=array('cat' => $cat, 'post_status' => 'publish','posts_per_page' => 3, 'meta_key'=>'_thumbnail_id');

                   query_posts($args);
                   $i = 1;
                   $iposition = 0;
                   while (have_posts()) : the_post();
                   $img = "";
                   if (has_post_thumbnail()){
                       $imagedata = simplexml_load_string(get_the_post_thumbnail());
                       $img = $imagedata->attributes()->src;

                   $title = $post->post_title;
                        if ($title<>substr($title,0,30)) {
                            $dots = "...";
                        }else {
                            $dots = "";
                        }
                   $cont = substr($post->post_content,0,40);

                   $postslug = get_post_slug($post->ID);
                   if(!empty($img)){

                        if ($i%3==0) {
                            $lastclass="last";
                        }
                        else {
                            $lastclass ="";
                        }

                   $bg = 'bg'.$i;
                   $background_images[$i] = $img;
                   } }
                   endwhile;
                ?>
            
   <script type="text/javascript">
        jQuery(document).ready(function(){

             var current = 0;

                        var loaded  = 0;
                        for(var i = 1; i <4; ++i)
                                jQuery('<img />').load(function(){
                                        ++loaded;
                                        if(loaded == 3){
                                                jQuery('#bg1,#bg2,#bg3').mouseover(function(e){

                                                        var $this = jQuery(this);
                                                        var img_id = '.'+jQuery(this).attr('id');
                                                        var bg_img = jQuery(this).attr('rev');
                                                        
                                                        /* if we hover the current one, then don't do anything */
                                                        if($this.parent().index() == current)
                                                                return;

                                                        /* item is bg1 or bg2 or bg3, depending where we are hovering */
                                                        var item = e.target.id;

                                                        /*
                                                        this is the sub menu overlay. Let's hide the current one
                                                        if we hover the first <li> or if we come from the last one,
                                                        then the overlay should move left -> right,
                                                        otherwise right->left
                                                         */
                                                        if(item == 'bg1' || current == 2)
                                                                jQuery('#menu-slider .sub'+parseInt(current+1)).stop().animate({backgroundPosition:"(-311px 0)"},300,function(){
                                                                        jQuery(this).find('li').hide();
                                                                });
                                                        else
                                                                jQuery('#menu-slider .sub'+parseInt(current+1)).stop().animate({backgroundPosition:"(311px 0)"},300,function(){
                                                                        jQuery(this).find('li').hide();
                                                                });

                                                        if(item == 'bg1' || current == 2){
                                                                /* if we hover the first <li> or if we come from the last one, then the images should move left -> right */
                                                                jQuery('#menu-slider > li').animate({backgroundPosition:"(-935px 0)"},0).removeClass('bg1 bg2 bg3').addClass(item);
                                                                move(1,item);
                                                        }
                                                        else{
                                                                /* if we hover the first <li> or if we come from the last one, then the images should move right -> left */
                                                                jQuery('#menu-slider > li').animate({backgroundPosition:"(935px 0)"},0).removeClass('bg1 bg2 bg3').addClass(item);
                                                                move(0,item);
                                                        }

                                                        /*
                                                        We want that if we go from the first one to the last one (without hovering the middle one),
                                                        or from the last one to the first one, the middle menu's overlay should also slide, either
                                                        from left to right or right to left.
                                                         */
                                                        if(current == 2 && item == 'bg1'){
                                                                jQuery('#menu-slider .sub'+parseInt(current)).stop().animate({backgroundPosition:"(-311px 0)"},300);
                                                        }
                                                        if(current == 0 && item == 'bg3'){
                                                                jQuery('#menu-slider .sub'+parseInt(current+2)).stop().animate({backgroundPosition:"(311px 0)"},300);
                                                        }


                                                        /* change the current element */
                                                        current = $this.parent().index();

                                                        /* let's make the overlay of the current one appear */

                                                        jQuery('#menu-slider .sub'+parseInt(current+1)).stop().animate({backgroundPosition:"(0 0)"},300,function(){
                                                                jQuery(this).find('li').fadeIn();
                                                        });

                                                        jQuery(img_id).attr('style', bg_img);
                                                });
                                        }
                                }).attr('src','<?php echo get_template_directory_uri(); ?>/script/timthumb.php?src=<?php print $background_images[$i];?>&w=935&h=407&zc=1&q=100');


        /*
        dir:1 - move left->right
        dir:0 - move right->left
         */
        function move(dir,item){
            if(dir){
                jQuery('#bg1').parent().stop().animate({backgroundPosition:"(0 0)"},200);
                jQuery('#bg2').parent().stop().animate({backgroundPosition:"(-311px 0)"},300);
                jQuery('#bg3').parent().stop().animate({backgroundPosition:"(-622px 0)"},400,function(){
                    jQuery('#menuWrapper').removeClass('bg1 bg2 bg3').addClass(item);
                });
            }
            else{
                jQuery('#bg1').parent().stop().animate({backgroundPosition:"(0 0)"},400,function(){
                    jQuery('#menuWrapper').removeClass('bg1 bg2 bg3').addClass(item);
                });
                jQuery('#bg2').parent().stop().animate({backgroundPosition:"(-311px 0)"},300);
                jQuery('#bg3').parent().stop().animate({backgroundPosition:"(-622px 0)"},200);
            }
        }
});

            </script>



            
  <div class="slider-content left">
         
               
                <div id="menuWrapper" class="menuWrapper bg1">
                    <ul class="menu-slider" id="menu-slider">

                          <?php
                                   $current_page_id = get_ID_by_slug($post->post_name);
                                   $page = get_page_by_title($post->post_name);
                                   $meta = (get_post_meta($current_page_id,'',true));
                                   $background_images = array();
                                   $cat = get_option(THEME_NAME.'_front_slider_category');
                                   $args=array('cat' => $cat, 'post_status' => 'publish','posts_per_page' => 3, 'meta_key'=>'_thumbnail_id');

                                   query_posts($args);                                   
                                   $i = 1;
                                   $iposition = 0;
                                   while (have_posts()) : the_post();
                                    $data = get_post_meta( $post->ID, GD_THEME, true );
                                   $img = "";
                                   if (has_post_thumbnail()){
                                       $imagedata = simplexml_load_string(get_the_post_thumbnail());
                                       $img = $imagedata->attributes()->src;

                                   $title = $post->post_title;                                   
                                        if ($title<>substr($title,0,30)) {
                                            $dots = "...";
                                        }else {
                                            $dots = "";
                                        }
                                   $cont = substr($post->post_content,0,40);

                                   $postslug = get_post_slug($post->ID);
                                   if(!empty($img)){
                                       
                                        if ($i%3==0) {
                                            $lastclass="last";
                                        }
                                        else {
                                            $lastclass ="";
                                        }
                                   
                                   $bg = 'bg'.$i;
                                   $background_images[$i] = $img;
                            ?>
                        
                                      
                        <li class="bg1 <?php echo $lastclass;?>" style="background:url(<?php echo get_template_directory_uri(); ?>/script/timthumb.php?src=<?php print $background_images['1'];?>&w=935&h=407&zc=1&q=100)  no-repeat;background-position: <?php echo $iposition?>px 0px;">
                            <a href="<?php echo get_permalink(); ?>" id="<?php echo $bg; ?>" rev="background:url(<?php echo get_template_directory_uri(); ?>/script/timthumb.php?src=<?php print $background_images[$i];?>&w=935&h=407&zc=1&q=100)  no-repeat;" ><?php echo substr($title,0,22).$dots; ?></a>
                            <span>
                     <?php
                      if(!empty($data['page_headline'])) {
                                $data['page_headline'] ;
                                $headline = $data['page_headline'];

                               
                                 if ($headline<>substr($headline,0,42)) {
                                    $dots = "...";
                                }else {
                                    $dots = "";
                                }

                                echo substr($headline,0,42).$dots; }
                                ?></span>
                        </li>


                        <?php }}
                               $i++;
                               $iposition= $iposition - 311;
                           endwhile;
                           ?>
                    </ul>
                    
                </div>
      </div>


      <?php
          global $wpdb;
          $querystr = "SELECT SUM(mc_gross) FROM " . $wpdb->prefix . "paypal_transactions";
          $pageposts = $wpdb->get_results($querystr, ARRAY_A);
          $transaction_sum = $pageposts[0] ["SUM(mc_gross)"];        
          $transaction_sum = round($transaction_sum,0);
          $transaction_sum_str =(string)$transaction_sum;
          $transaction_array = str_split($transaction_sum_str);


          $currency  = get_option(THEME_NAME.'_currency');
          switch ($currency) {
            case 'AUD':
                $currency_symbol = '$';
                break;
            case 'CAD':
                $currency_symbol = '$';
                break;
            case 'EUR':
                $currency_symbol = '€';
                break;
            case 'GBP':
                $currency_symbol = '£';
                break;
            case 'JPY':
                $currency_symbol = '¥';
                break;
            case 'USD':
                $currency_symbol = '$';
                break;
            case 'NZD':
                $currency_symbol = '$';
                break;
            case 'CHF':
                $currency_symbol = '';
                break;
            case 'HKD':
                $currency_symbol = '';
                break;
            default:
                $currency_symbol = '';
        }
      ?>

            <div class="home-money-button left">

                <div class="home-money left">
                    
                    <ul>
                        <li class="home-money-one"><?php _e('You’ve Helped Raise…', tk_theme_name); ?></li>
                        <li><?php echo $currency_symbol; ?><div class="home-money-border left"></div></li>

                        <?php
                        $transactionlenght = strlen($transaction_sum_str);                      
                           if ($transactionlenght == 1) { ?>
                              <li>0<div class="home-money-border left"></div></li>
                              <li>0<div class="home-money-border left"></div></li>
                              <li>0<div class="home-money-border left"></div></li>
                              <li>0<div class="home-money-border left"></div></li>
                       <?php  }

                       elseif ($transactionlenght == 2) { ?>
                              <li>0<div class="home-money-border left"></div></li>                                
                              <li>0<div class="home-money-border left"></div></li>
                              <li>0<div class="home-money-border left"></div></li>
                       <?php  } 

                              elseif ($transactionlenght == 3) { ?>
                              <li>0<div class="home-money-border left"></div></li>
                              <li>0<div class="home-money-border left"></div></li>                              
                       <?php  }

                                   elseif ($transactionlenght == 4) { ?>
                              <li>0<div class="home-money-border left"></div></li>                              
                       <?php  } 
                             else { ?>
                            
                       <?php  } ?>
                      
                        <?php foreach ($transaction_array as $transaction) {  ?>                        
                        <li><?php if(empty($transaction)){ echo "0"; } else { echo $transaction;} ?><div class="home-money-border left"></div></li>                        
                        <?php } ?>
                    </ul>
                    
                </div><!--/home-money-->

                     <!--/LINK GENERATOR-->

                  <?php
                        $paypal_redirect   = '';
                        $paypal_email 	   = get_option(THEME_NAME.'_paypal_email');
                        $currency 		   = get_option(THEME_NAME.'_currency');
                        $notify_url 	   = home_url() .'/?paypal=1';
                        $return 		   = get_option(THEME_NAME.'_return_url');
                        $product_cost      = get_option(THEME_NAME.'_product_cost');
                        $product_name      = get_option(THEME_NAME.'_product_name');
                        $item_number       = '';
                        $subscription_key  = urlencode(strtolower(md5(uniqid())));
                        $item_name         = urlencode(''.$product_name.'');
                        $sandbox 		   = get_option(THEME_NAME.'_paypal_sandbox');

                        if($sandbox == '1'){
                            $sendbox_addon = 'sandbox.';
                        }else{
                            $sendbox_addon = '';
                        }

                        $custom_secret = md5(date('Y-m-d H:i:s').''.rand(1,10).''.rand(1,100).''.rand(1,1000).''.rand(1,10000));
                        $paypal_redirect  .= 'https://www.'.$sendbox_addon.'paypal.com/webscr?cmd=_xclick';
                        $paypal_redirect  .= '&business='.$paypal_email.'&item_name='.$item_name.'&no_shipping=1&no_note=1&item_number='.$subscription_key.'&currency_code='.$currency.'&charset=UTF-8&return='.urlencode($return).'&notify_url='.urlencode($notify_url).'&rm=2&custom='.$custom_secret.'&amount='.$product_cost;

                     ?>

                <div class="home-button left">
                    <a href="<?php echo $paypal_redirect; ?>">
                        <div class="home-button-left left"></div>
                        <div class="home-button-center left"><?php _e('Donate', tk_theme_name); ?></div>
                        <div class="home-button-right left"></div>
                    </a>
                </div>

            </div><!--/home-money-button-->
                 <div class="other-content">
                    	 <?php
					/* Run the loop to output the page.
					 * If you want to overload this in a child theme then include a file
					 * called loop-page.php and that will be used instead.
					 */
					//get_template_part( 'loop', 'page' );
					 wp_reset_query();
						if ( have_posts() ) : while ( have_posts() ) : the_post();
						the_content();
						 endwhile;
						else:
						endif;
					wp_reset_query();
					?>
                  </div>
            </div>
        </div><!--/wrapper-->

<?php get_footer(); ?>