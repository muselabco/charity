<?php
$showlatest = get_option(THEME_NAME.'_hide_latest');
if(!empty($showlatest)) {
?>


<div class="home-blog-post">

                <div class="home-blog left">

                    <h2><?php _e('Latest Actions', tk_theme_name); ?></h2>



                        <?php //Options
                               wp_reset_query();
                                  $current_page_id = get_ID_by_slug($post->post_name);
                                    $page = get_page_by_title($post->post_name);
                                    $meta = (get_post_meta($current_page_id,'',true));
                                    $blog_category = get_option(THEME_NAME.'_our_actions_category');

                                     $categories = get_categories('orderby=name');
                                     $include_category = null;
                                     $slug = get_page_link();

                                     foreach ($blog_category as $category_list) {
                                                    $cat = 	$category_list.",";
                                                    $include_category = $include_category.$cat;
                                                    $cat_name = get_cat_name($category_list);}


                             
                                $args=array('cat' => $include_category, 'post_status' => 'publish', 'posts_per_page' => 2,  'order'=>'DESC');

                                query_posts($args);

                                $i=1;
				while (have_posts()) : the_post();
				$img = "";
				if (has_post_thumbnail()) {
					$imagedata = simplexml_load_string(get_the_post_thumbnail());
					$img = $imagedata->attributes()->src;
				}


                                $comments = get_comments("post_id=$post->ID");

                                $num_of_comments = 0;
                                foreach((get_the_category()) as $category) {
                                        $post_category = $category->cat_name;
                                        $post_category_id = $category->cat_ID;
                                        $cat_slug=get_cat_slug($post_category_id);
                                }

                                foreach($comments as $comm) :
                                    $num_of_comments++;
                                endforeach;
                                
                                $title = the_title('','',FALSE);
                                $title = strtoupper($title);
                                        if ($title<>substr($title,0,25)){ $dots = "...";}else{$dots = "";}

				$postslug = get_post_slug($post->ID);

                                  if ($i%4==0) {
                                    $lastclass="last-front";
                                  }
                                 else $lastclass="";

				if ($img !== "") {
				?>	
                    <div class="home-blog-one left">
                        
                     <div class="home-blog-images left">
                       <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail( 'footer-blog' );?></a>
                     </div>

                        <div class="home-blog-shadow left"></div>
                        <div class="home-blog-text left">
                            <a href="<?php echo get_permalink(); ?>"><?php echo substr($title,0,25).$dots; ?></a>
                            <span><?php echo get_the_date();?>  | <a class="comment-foot" href="<?php echo get_permalink(); ?>">Comments: <?php comments_number( '0', '1', '%' ); ?></a></span>
                            <div class="blog-text left">
                                <p>
                                    <?php truncate_post(220); ?>
                                    <a href="<?php echo get_permalink(); ?>"><?php _e('Read more', tk_theme_name); ?></a>
                                </p>
                            </div>
                        </div>
                    </div><!--/home-blog-one-->
                    
                    <?php } else {?>

                     <div class="home-blog-one left">
                        <div class="home-blog-text-no-image left">
                            <a href="<?php echo get_permalink(); ?>"><?php echo substr($title,0,40).$dots; ?></a>
                            <span><?php echo get_the_date();?>  |  <a class="comment-foot" href="<?php echo get_permalink(); ?>">Comments: <?php comments_number( '0', '1', '%' ); ?></a></span>
                            <div class="blog-text left">
                                <p>
                                    <?php truncate_post(430); ?>
                                    <a href="<?php echo get_permalink(); ?>"><?php _e('Read more', tk_theme_name); ?></a>
                                </p>
                            </div>
                        </div>
                    </div><!--/home-blog-one-->

                    <?php
                            }
                        $i++;
                        endwhile;
                    ?>

            </div><!--/home-blog-->

                <div class="home-images-right right">
                    <h2><?php _e('Where the money goes', tk_theme_name); ?></h2>
                   <?php
                            $latestimage = get_option(THEME_NAME.'_latest_image');
                            if(empty($latestimage)) {
                                $latestimage = get_template_directory_uri()."/style/img/home-images-right.png";
                            }?>

                    <div class="home-images right">
                        <div style="background-image: url(<?php echo $latestimage;?>); width: 100%; height: 453px;"></div>
                    </div>
                
                </div><!--/home-images-right-->

             </div><!-- ends-home-blog -->

        <?php } ?>
             
         <div class="wrapper">
            <div class="home-columns left">
                <div id="three-columns">
                    <div class="footer-widget-holder">
                                 <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                                <?php endif; ?>
                        </div>

                    <div class="footer-widget-holder">
                             <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                        <?php endif; ?>
                    </div>


                    <div class="footer-widget-holder" style="margin: 0pt!important;">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                        <?php endif; ?>
                    </div>
                </div><!--/three-columns-->
            </div>
             </div>


 <?php $copyright = get_option(THEME_NAME.'_footer_copyright');?>

    <!------ FOOTER ------>
    <div class="footer">
        <div class="wrapper">
            <div class="footer-content left">
                <div class="footer-copy lefgt">
                    
                <?php if (!empty($copyright)) { ?>
                <?php echo $copyright?>
                <?php } else { ?>
                    WordPress theme by <a href='http://www.themeskingdom.com'>Themes Kingdom</a>.</h3>&#169; 2012 Danko. All Rights Reserved.
                <?php } ?>

                </div>
                    <?php
                        $twitter_acc = get_option(THEME_NAME.'_twitter');
                        $facebook_acc = get_option(THEME_NAME.'_facebook');
                        $rss_acc = get_option(THEME_NAME.'_rss_feed');
                        $google_acc = get_option(THEME_NAME.'_google_plus');
                       ?>
                
                      <div class="footer-right right">
                            <ul>
                                <?php if(!empty ($twitter_acc)){?><li><a href="<?php echo 'http://twitter.com/'.$twitter_acc?>"><div class="footer-icon3"></div></a></li><?php }?>
                                <?php if(!empty ($facebook_acc)){?><li><a href="<?php echo 'http://www.facebook.com/'.$facebook_acc?>"><div class="footer-icon2"></div></a></li><?php }?>
                                <?php if(!empty ($rss_acc)){$echo_this = $rss_acc;}else{$echo_this = get_bloginfo('rss2_url');} ?><li><a href="<?php echo $echo_this?>"><div class="footer-icon1"></div></a></li>
                                <?php if(!empty ($google_acc)){?><li><a href="<?php echo 'https://plus.google.com/'.$google_acc?>"><div class="footer-icon4"></div></a></li><?php }?>
                            </ul>
                     </div> <!-- footer-right -->
       

            </div>
        </div><!--/wrapper-->
    </div><!--/footer-->
</div><!--/container-->
<?php wp_footer(); ?>
</body>
</html>