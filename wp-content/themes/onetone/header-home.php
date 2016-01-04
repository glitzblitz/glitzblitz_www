<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri().'/js/html5.js' ); ?>"></script>
	<![endif]-->
<?php wp_head(); ?>
</head>
<?php

  global  $page_meta;
  $detect                      = new Mobile_Detect;
  $display_top_bar             = onetone_option('display_top_bar','yes');
  $header_background_parallax  = onetone_option('header_background_parallax','');
  $header_top_padding          = onetone_option('header_top_padding','');
  $header_bottom_padding       = onetone_option('header_bottom_padding','');
  $header_background_parallax  = $header_background_parallax=="yes"?"parallax-scrolling":"";
  $top_bar_left_content        = onetone_option('top_bar_left_content','info');
  $top_bar_right_content       = onetone_option('top_bar_right_content','info');
  
  $logo               = onetone_option('logo','');

  $logo_retina        = onetone_option('logo_retina');
  $logo               = ( $logo == '' ) ? $logo_retina : $logo;

  $sticky_logo        = onetone_option('sticky_logo',$logo);
  $sticky_logo_retina = onetone_option('sticky_logo_retina');
  $sticky_logo        = ( $sticky_logo == '' ) ? $sticky_logo_retina : $sticky_logo;
  
  $header_overlay               = onetone_option('header_overlay','no');
 
  $overlay = '';
  if( $header_overlay == 'yes')
  $overlay = 'overlay';
  
  //sticky
  $enable_sticky_header         = onetone_option('enable_sticky_header','yes');
  $enable_sticky_header_tablets = onetone_option('enable_sticky_header_tablets','yes');
  $enable_sticky_header_mobiles = onetone_option('enable_sticky_header_mobiles','yes');
   
 if(isset($page_meta['nav_menu']) && $page_meta['nav_menu'] !='')
 $theme_location = $page_meta['nav_menu'];
 else
 $theme_location = 'primary';
 
 $body_class  = '';
 if(is_home() || is_front_page() )
 $body_class  = 'page homepage';
?>
<body <?php body_class($body_class); ?>>
	<div class="wrapper">
		<div class="top-wrap">
            <!--Header-->
            <header class="header-wrap logo-left home-header <?php echo $overlay; ?>">
             <?php if( $display_top_bar == 'yes' ):?>
                <div class="top-bar">
                    <div class="container">
                        <div class="top-bar-left">
                            <?php  onetone_get_topbar_content( $top_bar_left_content );?>                      
                        </div>
                        <div class="top-bar-right">
                          <?php onetone_get_topbar_content( $top_bar_right_content );?>
			  	
                        </div>
                    </div>
                </div>
                 <?php endif;?>


                
                <div class="main-header <?php echo $header_background_parallax; ?>">
                    <div class="container">
                        <div class="logo-box">
                        <?php if( $logo ):?>
                        
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img class="site-logo normal_logo" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo); ?>" />
                            </a>
                             <?php
							
					if( $logo_retina ):
					$pixels ="";
					if(is_numeric(onetone_option('retina_logo_width')) && is_numeric(onetone_option('retina_logo_height'))):
					$pixels ="px";
					endif; ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo $logo_retina; ?>" alt="<?php bloginfo('name'); ?>" style="width:<?php echo onetone_option('retina_logo_width').$pixels; ?>;max-height:<?php echo onetone_option('retina_logo_height').$pixels; ?>; height: auto !important" class="site-logo retina_logo" />
					 </a>
                     <?php endif;?>
                            <?php else: ?>
                            <div class="name-box" style=" display:block;">
                                <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-name"><?php bloginfo('name'); ?></h1></a>
                                <span class="site-tagline"><?php bloginfo('description'); ?></span>
                            </div>
                             <?php endif;?>
                        </div>
                        <button class="site-nav-toggle">
                            <span class="sr-only"><?php _e( 'Toggle navigation', 'onetone' );?></span>
                            <i class="fa fa-bars fa-2x"></i>
                        </button>

                       <!-- GP: social buttons -->
                        <div style="clear:right;">       
                         <div style="float:right;padding-left:35px">
                          <ul class="banner-sns">
                            <li><a href=" https://www.facebook.com/thisisglitzblitz/?skip_nax_wizard=true"  target="_blank" ><i class="fa fa-2 fa-facebook"></i></a></li>

 <li><a href=" https://twitter.com/glitzblitz20153"  target="_blank"><i class="fa fa-2 fa-twitter"></i></a></li>

                          <!--  <li><a href="#"><i class="fa fa-2 fa-skype"></i></a></li> -->

  <li><a href=" https://plus.google.com/102332603369473624111"  target="_blank"><i class="fa fa-2 fa-google-plus"></i></a></li>

<!--<li><a href="www.youtube.com"  target="_blank"><i class="fa fa-2 fa-youtube"></i></a></li> -->


                           
<li><a href="https://in.linkedin.com/in/glitz-blitz-49206610a"  target="_blank"><i class="fa fa-2 fa-linkedin"></i></a></li>
                          
                          <!--  <li><a href="http://www.glitzblitz.in/feed/"  target="_blank"><i class="fa fa-2 fa-rss"></i></a></li> -->
<li><!--<a href="#"  target="_blank"><i class="fa fa-2 fa-instagram"></i></a></li> -->

                          </ul>
                        </div>
                         <div style="float:right;margin-top:15px;">
                        <nav class="site-nav" role="navigation">
                            <?php

							 $onepage_menu = '';
							 $section_num = onetone_option( 'section_num' ); 
							 if(isset($section_num) && is_numeric($section_num ) && $section_num >0):
							 for( $i = 0; $i < $section_num ;$i++){
							
							 $section_menu = onetone_option( 'menu_title_'.$i );
							 $section_slug = onetone_option( 'menu_slug_'.$i );
							  if( $section_slug )
							  $section_slug =  sanitize_title($section_slug );
							
							 if(isset($section_menu) && $section_menu !=""){
							 $sanitize_title = 'section-'.($i+1);
							 
							 $section_menu = onetone_option( 'menu_title_'.$i );
							 if(trim($section_slug) !=""){
								 $sanitize_title = $section_slug; 
								 }
							 $onepage_menu .= '<li  class="onetone-menuitem"><a id="onetone-'.$sanitize_title.'" href="#'.$sanitize_title.'" >
							 <span>'.$section_menu.'</span></a></li>';
							 }
							 }
							endif;
							if ( has_nav_menu( "home_menu" ) ) {
							 wp_nav_menu(array('theme_location'=>'home_menu','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">'.$onepage_menu.'%3$s</ul>'));
							}
							else{
							echo '<ul>'.$onepage_menu.'</ul>';
							}
							?>
                        </nav>
                      </div>
                       
                    </div>
                </div>
                   
            <?php if( (!$detect->isTablet() && $enable_sticky_header == 'yes') || ( $detect->isTablet() && $enable_sticky_header_tablets == 'yes' ) || ( $detect->isMobile() && !$detect->isTablet() && $enable_sticky_header_mobiles == 'yes' )  ):?>
            
                <div class="fxd-header">
                    <div class="container">

                      <!-- GP: social buttons -->
                        <div style="clear:right;float:right"> 
                          <ul class="banner-sns">
                            <li><a href="#"><i class="fa fa-2 fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-2 fa-skype"></i></a></li>
                            <li><a href="#"><i class="fa fa-2 fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-2 fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-2 fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-2 fa-rss"></i></a></li>
                          </ul>
                        </div>
                        <div class="logo-box">
                        <?php if( $sticky_logo ):?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><img class="site-logo normal_logo" src="<?php echo esc_url($sticky_logo); ?>"></a>
                            
                               <?php
					if( $sticky_logo_retina ):
					$pixels ="";
					if( is_numeric(onetone_option('sticky_logo_width_for_retina_logo')) && is_numeric(onetone_option('sticky_logo_height_for_retina_logo')) ):
					$pixels ="px";
					endif; ?>
					<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo $sticky_logo_retina; ?>" alt="<?php bloginfo('name'); ?>" style="width:<?php echo onetone_option('sticky_logo_width_for_retina_logo').$pixels; ?>;max-height:<?php echo onetone_option('sticky_logo_height_for_retina_logo').$pixels; ?>; height: auto !important" class="site-logo retina_logo" /></a>
					<?php endif; ?>
                    
                            <?php else: ?>
                            <div class="name-box" style=" display:block;">
                                <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-name"><?php bloginfo('name'); ?></h1></a>
                                <span class="site-tagline"><?php bloginfo('description'); ?></span>
                            </div>
                            <?php endif;?>
                        </div>
                        <button class="site-nav-toggle">
                            <span class="sr-only"><?php _e( 'Toggle navigation', 'onetone' );?></span>
                            <i class="fa fa-bars fa-2x"></i>
                        </button>
                        <nav class="site-nav" role="navigation">
                          <?php

						  if ( has_nav_menu( "home_menu" ) ) {
						   wp_nav_menu(array('theme_location'=>'home_menu','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">'.$onepage_menu.'%3$s</ul>'));
						  }
						  else{
						  echo '<ul>'.$onepage_menu.'</ul>';
						  }
						  ?>
                        </nav>
                       
                    </div>
                </div>

             <?php endif; ?>
             
            </header>
            <div class="slider-wrap"></div>
        </div>