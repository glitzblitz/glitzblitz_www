<?php
/**
* The main template file.
*
*/
 ?>
<?php
if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) :
get_header(); 
else:
get_header('home'); 
endif;
?>
<?php
if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) :

$left_sidebar   = onetone_option('left_sidebar_blog_archive','');
$right_sidebar  = onetone_option('right_sidebar_blog_archive','');
$aside          = 'no-aside';
if( $left_sidebar !='' )
$aside          = 'left-aside';
if( $right_sidebar !='' )
$aside          = 'right-aside';
if(  $left_sidebar !='' && $right_sidebar !='' )
$aside          = 'both-aside';
?>

<div class="post-wrap">
            <div class="container">
                <div class="post-inner row <?php echo $aside; ?>">
                    <div class="col-main">
                        <section class="post-main" role="main" id="content">                        
                            <article class="page type-page" id="">
                            <?php if (have_posts()) :?>
                                <!--blog list begin-->
                                <div class="blog-list-wrap">
                                
                                <?php while ( have_posts() ) : the_post();?>
                                <?php get_template_part("content",get_post_format() ); ?>
                                <?php endwhile;?>
                                </div>
                                <?php endif;?>
                                <!--blog list end-->
                                <!--list pagination begin-->
                                <nav class="post-list-pagination" role="navigation">
                                    <?php if(function_exists("onetone_native_pagenavi")){onetone_native_pagenavi("echo",$wp_query);}?>
                                </nav>
                                <!--list pagination end-->
                            </article>
                            
                            
                            <div class="post-attributes"></div>
                        </section>
                    </div>
                    <?php if( $left_sidebar !='' ):?>
                    <div class="col-aside-left">
                        <aside class="blog-side left text-left">
                            <div class="widget-area">
                                <?php get_sidebar('archiveleft');?> 
                            </div>
                        </aside>
                    </div>
                    <?php endif; ?>
                    <?php if( $right_sidebar !='' ):?>
                    <div class="col-aside-right">
                       <?php get_sidebar('archiveright');?>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>  
        </div>
<?php else: ?>
<div class="post-wrap">
  <div class="container-fullwidth">
    <div class="page-inner row no-aside" style="padding-top: 0; padding-bottom: 0;">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="page type-page homepage" id="">
            <?php
 global $onetone_options, $allowedposttags ;
 $allowedposttags['input']  = array ( 'class' => 1, 'id'=> 1, 'style' => 1, 'type' => 1, 'value' => 1 ,'placeholder'=> 1,'size'=> 1,'tabindex'=> 1,'aria-required'=> 1);
 $allowedposttags['iframe'] = array(
					'align' => true,
					'width' => true,
					'height' => true,
					'frameborder' => true,
					'name' => true,
					'src' => true,
					'id' => true,
					'class' => true,
					'style' => true,
					'scrolling' => true,
					'marginwidth' => true,
					'marginheight' => true,
					
  );
					 
 
 $video_array               = array();
 $section_num               = onetone_option( 'section_num',7 ); 
 $section_background_video  = onetone_option( 'section_background_video_0' ,'ab0TSkLe-E0');
 $video_background_section  = onetone_option( 'video_background_section',1 );
 $video_background_section  = $video_background_section == ""?1:$video_background_section;
 $video_controls            = onetone_option( 'video_controls' ,1);
 $video_controls            = $video_controls == ""?1:$video_controls;
 $section_1_content         = onetone_option( 'section_1_content' ,'content');
 
 
 // default home page sections data
 $default_options = array(
				  //section 1
				  array(
						'section_title'=>'',
						'menu_title'=>'Home',
						'menu_slug'=>'home',
						'section_background'=>array(
											  'color' => '',
											  'image' => ONETONE_THEME_BASE_URL.'/images/home-bg01.jpg',
											  'repeat' => 'repeat',
											  'position' => 'top left',
											  'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'section-banner',
						'section_padding'=>'',
						'text_align'=>'left',
						'section_content'=>'<div class="banner-box">

&nbsp;
<h1>TARAY BOGRILOYAT srians</h1>
<div class="sub-title">CRAS URNA LEO, FRINGILLA NEC ALIQUAM AC, VARIUS IN ENIM. MAECENAS NON FELIS AUGUE,
QUIS SAGITTIS JUSTO. DONEC GRAVIDA, ARCU IN ALIQUET CONVALLIS</div>
<div class="banner-scroll"><a class="scroll" href="#about-us" data-section="about-us"><img src="'.esc_url('http://www.mageewp.com/onetone/wp-content/themes/onetone/images/down.png').'" alt="" /></a></div>
<div class="banner-sns">
<ul class="">
	<li><a href="#"><i class="fa fa-2 fa-facebook">&nbsp;</i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-skype">&nbsp;</i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-twitter">&nbsp;</i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-linkedin">&nbsp;</i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-google-plus">&nbsp;</i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-rss">&nbsp;</i></a></li>
</ul>
</div>
</div>',
						),
				  
				  //section 2
				  array(
						'section_title'=>'About Us',
						'menu_title'=>'About Us',
						'menu_slug'=>'about-us',
						'section_background'=>array(
											  'color' => '',
											  'image' => ONETONE_THEME_BASE_URL.'/images/home-bg02.jpg',
											  'repeat' => 'repeat',
											  'position' => 'top left',
											  'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'section-about',
						'section_padding'=>'50px 0',
						'text_align'=>'left',
						'section_content'=>'<div class="two_third">
<h3>Biography</h3>
Morbi rutrum, elit ac fermentum egestas, tortor ante vestibulum est, eget
scelerisque nisl velit eget tellus. Fusce porta facilisis luctus. Integer neque
dolor, rhoncus nec euismod eget, pharetra et tortor. Nulla id pulvinar nunc.
Vestibulum auctor nisl vel lectus ullamcorper sed pellentesque dolor
eleifend. Praesent lobortis magna vel diam mattis sagittis.Mauris porta odio
eu risus scelerisque id facilisis ipsum dictum vitae volutpat. Lorem ipsum
dolor sit amet, consectetur adipiscing elit. Sed pulvinar neque eu purus
sollicitudin et sollicitudin dui ultricies. Maecenas cursus auctor tellus sit
amet blandit. Maecenas a erat ac nibh molestie interdum. Class aptent
taciti sociosqu ad litora torquent per conubia nostra, per inceptos
himenaeos. Sed lorem enim, ultricies sed sodales id, convallis molestie
ipsum. Morbi eget dolor ligula. Vivamus accumsan rutrum nisi nec
elementum. Pellentesque at nunc risus. Phasellus ullamcorper
bibendum varius. Quisque quis ligula sit amet felis ornare porta. Aenean
viverra lacus et mi elementum mollis. Praesent eu justo elit.

</div>
<div class="one_third last">
<h3>Personal Info</h3>
<ul>
	<li class="info-phone">+1123 2456 689</li>
	<li class="info-address">3301 Lorem Ipsum, Dolor Sit St</li>
	<li class="info-email"><a href="#">support@mageewp.com. </a></li>
	<li class="info-website"><a href="#">Mageewp.com</a></li>
</ul>
</div>',
						),
				  
				  
				  //section 3
				  array(
						'section_title'=>'Services',
						'menu_title'=>'Services',
						'menu_slug'=>'services',
						'section_background'=> array(
												  'color' => '',
												  'image' => ONETONE_THEME_BASE_URL.'/images/home-bg03.jpg',
												  'repeat' => 'repeat',
												  'position' => 'top left',
												  'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'',
						'section_padding'=>'50px 0',
						'text_align'=>'center',
						'section_content'=>' <div class=" col-md-4" id="">
<style type="text/css">.feature-box-5639bfc9001ce h3 {font-size:24px;}.feature-box-5639bfc9001ce .icon-box{color:#666;}.feature-box-5639bfc9001ce .icon-box{font-size:4em;}</style><div class="magee-feature-box style1  feature-box-5639bfc9001ce" id="" data-os-animation="fadeOut"><div class="icon-box " data-animation=""> <i class="feature-box-icon fa fa-desktop  fa-fw"></i></div><h3>Service 1</h3><div class="feature-content"><p>

Donec in vehicula augue. Sed et 
					nisi sem, at semper dolor. 
					Pellentesque habitant morbi 
					tristique senectus et netu..

</p><a href="" target="_blank" class="feature-link">Read More</a></div></div>
</div>

<div class=" col-md-4" id="">
<style type="text/css">.feature-box-5639bfc90041c h3 {font-size:24px;}.feature-box-5639bfc90041c .icon-box{color:#666;}.feature-box-5639bfc90041c .icon-box{font-size:4em;}</style><div class="magee-feature-box style1  feature-box-5639bfc90041c" id="" data-os-animation="fadeOut"><div class="icon-box " data-animation=""> <i class="feature-box-icon fa fa-comments-o  fa-fw"></i></div><h3>Service 2</h3><div class="feature-content"><p>

Donec in vehicula augue. Sed et 
					nisi sem, at semper dolor. 
					Pellentesque habitant morbi 
					tristique senectus et netu..

</p><a href="" target="_blank" class="feature-link">Read More</a></div></div>
</div>

<div class=" col-md-4" id="">
<style type="text/css">.feature-box-5639bfc900655 h3 {font-size:24px;}.feature-box-5639bfc900655 .icon-box{color:#666;}.feature-box-5639bfc900655 .icon-box{font-size:4em;}</style><div class="magee-feature-box style1  feature-box-5639bfc900655" id="" data-os-animation="fadeOut"><div class="icon-box " data-animation=""> <i class="feature-box-icon fa fa-search  fa-fw"></i></div><h3>Service 3</h3><div class="feature-content"><p>

Donec in vehicula augue. Sed et 
					nisi sem, at semper dolor. 
					Pellentesque habitant morbi 
					tristique senectus et netu..

</p><a href="" target="_blank" class="feature-link">Read More</a></div></div>
</div>',
						),
				  
				    //section 4
				  array(
						'section_title'=>'Gallery',
						'menu_title'=>'Gallery',
						'menu_slug'=>'gallery',
						'section_background'=> array(
												'color' => '',
												'image' => ONETONE_THEME_BASE_URL.'/images/home-bg02.jpg',
												'repeat' => 'repeat',
												'position' => 'top left',
												'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'',
						'section_padding'=>'50px 0',
						'text_align'=>'left',
						'section_content'=>'<div class="portfolio-list">
        		<ul>
            		<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg"></a></li>
                	<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g2.jpg"></a></li>
               		<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g3.jpg"></a></li>
               		<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g4.jpg"></a></li>
               		<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g5.jpg"></a></li>
               		<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g6.jpg"></a></li>
               		<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g7.jpg"></a></li>
                	<li><a href="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg" rel="portfolio-image"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g8.jpg"></a></li>
            	</ul>
        	</div>',
			
						),
				 
				 //section 5
				  array(
						'section_title'=>'Contact',
						'menu_title'=>'Contact',
						'menu_slug'=>'contact',
						'section_background'=> array(
											  'color' => '',
											  'image' => ONETONE_THEME_BASE_URL.'/images/home-bg03.jpg',
											  'repeat' => 'repeat',
											  'position' => 'top left',
											  'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'',
						'section_padding'=>'50px 0',
						'text_align'=>'left',
						'section_content'=>'<p class="contact-text">INTEGER ALIQUET ARCU SIT AMET SEM PORTA FACILISIS. CURABITUR SAPIEN SAPIEN, 
				BLANDIT IN MOLESTIE ET, SAGITTIS ID LOREM. NULLA MALESUADA MAURIS ID TURPIS</p>
			<div class="contact-area">
			  <form class="contact-form" method="post" action="">
			   <input type="text" name="name" id="name" value="" placeholder="Name" size="22" tabindex="1" aria-required="true">
			   <input type="text" name="email" id="email" value="" placeholder="Email" size="22" tabindex="2" aria-required="true"> 
			   <textarea name="message" id="message" cols="39" rows="7" tabindex="4" placeholder="Message"></textarea>
			   <p class="noticefailed"></p>
			   <input type="hidden" name="sendto" id="sendto" value="YOUR EMAIL HERE(Default Admin Email)">
			   <input type="button" name="submit" id="submit" value="Post">
			  </form>
			 </div>',
			
						),
				  
				  
				  //section 6
				  array(
						'section_title'=>'Custom Section',
						'menu_title'=>'Custom Section',
						'menu_slug'=>'custom-section',
						'section_background'=> array(
												'color' => '',
												'image' => ONETONE_THEME_BASE_URL.'/images/home-bg02.jpg',
												'repeat' => 'repeat',
												'position' => 'top left',
												'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'',
						'section_padding'=>'50px 0',
						'text_align'=>'left',
						'section_content'=>'<p>Donec in vehicula augue. Sed et nisi sem, at semper dolor. Pellentesque habitant morbi tristique 
			senectus et netus et malesuada fames ac turpis egestas. Mauris ut urna nibh, a semper 
			neque. Mauris ultrices tempus nisi, et porttitor nulla varius a. Ut turpis magna, 
			feugiat quis ultrices tristique, rhoncus eu leo. In eu quam lacus. Praesent
			Vehicula augue. Sed et nisi sem, at semper dolor. Pellentesque habitant morbi tristique 
			senectus et netus et malesuada fames ac turpis egestas. Mauris ut urna nibh, a semper 
			anews sed ovref neque. Mauris ultrices tempus nisi, et porttitor nulla varius a. Ut turpis magna, 
			feugiat quis ultrices tristique, rhoncus eu leo. In eu quam lacus. dear Praesent Donec in vehicula augue. 
			Sed et nisi sem, at semper dolor. Pellentesque habitant morbi tristique 
			senectus et netus et malesuada fames ac turpis egestas. Mauris ut urna nibh, a semper 
			neque. Mauris ultrices tempus nisi, et porttitor nulla varius a. Ut turpis magna, 
			feugiat quis ultrices tristique, rhoncus eu leo. In eu quam lacus. Praesent
			Vehicula augue. Sed et nisi sem, at semper dolor. Pellentesque habitant morbi tristique 
			senectus et netus et malesuada fames ac turpis egestas. Mauris ut urna nibh, a semper 
			anews sed ovref neque. Mauris ultrices tempus nisi, et porttitor nulla varius a. Ut turpis magna, 
			feugiat quis ultrices tristique, rhoncus eu leo. In eu quam lacus. dear Praesent</p>',
			
						),
				  
				  //section 7
				  array(
						'section_title'=>'',
						'menu_title'=>'',
						'menu_slug'=>'clients',
						'section_background'=>  array(
												  'color' => '#dddddd',
												  'image' => '',
												  'repeat' => 'repeat',
												  'position' => 'top left',
												  'attachment'=>'scroll' ),
						'parallax_scrolling'=>'no',
						'section_css_class'=>'',
						'section_padding'=>'30px 0',
						'text_align'=>'center',
						'section_content'=>'<div class="one_fifth"><a href="#"><img src="'.esc_url('http://www.mageewp.com/onetone/wp-content/uploads/sites/17/2015/04/c1.png').'" alt="HTML5" title="HTML5"></a></div>
<div class="one_fifth"><a href="#"><img src="'.esc_url('http://www.mageewp.com/onetone/wp-content/uploads/sites/17/2015/04/c2.png').'" alt="CSS3" title="CSS3"></a></div>
<div class="one_fifth"><a href="#"><img src="'.esc_url('http://www.mageewp.com/onetone/wp-content/uploads/sites/17/2015/04/c3.png').'" alt="Bootstra
p" title="Bootstrap"></a></div>
<div class="one_fifth"><a href="#"><img src="'.esc_url('http://www.mageewp.com/onetone/wp-content/uploads/sites/17/2015/04/c4.png').'" alt="jQuery" title="jQuery"></a></div>
<div class="one_fifth last_column"><a href="#"><img src="'.esc_url('http://www.mageewp.com/onetone/wp-content/uploads/sites/17/2015/04/c5.png').'" alt="WordPress" title="WordPress"></a></div>',
			
						),
				  
				  );
 

 if(isset($section_num) && is_numeric($section_num ) && $section_num >0):
 for( $i = 0; $i < $section_num ;$i++){
	 
	 if( $section_1_content == 'slider' && $i == 0 ){
		 
		echo onetone_get_default_slider(); 
		 
		 }else{
 
 $section_title       = onetone_option( 'section_title_'.$i ,isset($default_options[$i]['section_title'])?$default_options[$i]['section_title']:'');
 $section_menu        = onetone_option( 'menu_title_'.$i ,isset($default_options[$i]['menu_title'])?$default_options[$i]['menu_title']:'');
 $section_background  = onetone_option( 'section_background_'.$i,isset($default_options[$i]['section_background'])?$default_options[$i]['section_background']:'' );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i,isset($default_options[$i]['parallax_scrolling'])?$default_options[$i]['parallax_scrolling']:'' );
 $section_css_class   = onetone_option( 'section_css_class_'.$i ,isset($default_options[$i]['section_css_class'])?$default_options[$i]['section_css_class']:'');
 $section_content     = onetone_option( 'section_content_'.$i ,isset($default_options[$i]['section_content'])?$default_options[$i]['section_content']:onetone_option( 'sction_content_'.$i ));

 $section_slug        = onetone_option( 'menu_slug_'.$i ,isset($default_options[$i]['menu_slug'])?$default_options[$i]['menu_slug']:'');
 $section_padding     = onetone_option( 'section_padding_'.$i ,isset($default_options[$i]['section_padding'])?$default_options[$i]['section_padding']:'50px 0');
 $text_align          = onetone_option( 'text_align_'.$i,isset($default_options[$i]['text_align'])?$default_options[$i]['text_align']:'');

 if( $section_slug )
  $section_slug =  sanitize_title($section_slug );
  else
  $section_slug = 'section-'.($i+1);
  
 $section_css = '';
 $background  = onetone_get_background($section_background);
 
 $sanitize_title = $section_slug; 
 
 $css_class = isset($section_css_class)?$section_css_class:"";
 
  $background_video = '';
  $video_wrap = '';
  $video_enable = 0;
  $detect = new Mobile_Detect;
  if($section_background_video != "" && $video_background_section == ($i+1) && !$detect->isMobile() && !$detect->isTablet() ){
	$video_enable = 1;  
  }
  
  if( $parallax_scrolling == "yes" ){
	 $css_class  .= ' onetone-parallax';
	 $section_css .= 'background-attachment:fixed;background-position:50% 0;background-repeat:no-repeat;';
	 }
  
 if($video_enable == 1){

    $background_video  = array("videoId"=>$section_background_video,"mute"=>false,"start"=>3 ,"container" =>"section.onetone-".$sanitize_title,"playerid"=>$sanitize_title);
    $video_section_item = "section.onetone-".$sanitize_title;
    $video_array[]  =  array("options"=>$background_video,  "video_section_item"=>$video_section_item );
	$background = "";
	$video_wrap = "video-section";
	}
	$section_css .= $background;
	if( $section_padding )
    $section_css .= 'padding:'.$section_padding.';';
	
	if( $text_align )
    $section_css .= 'text-align:'.$text_align.';';

 ?>
            <section id="<?php echo $section_slug;?>" class="section <?php echo esc_attr($css_class);?> onetone-<?php echo $sanitize_title;?> <?php echo $video_wrap;?>"  style=" <?php echo $section_css; ?>">
              <div class="home-container container" >
                <?php if($section_title){?>
                <h1 class="section-title"><?php echo esc_attr($section_title);?></h1>
                <?php } ?>
                <?php echo do_shortcode(wp_kses( $section_content, $allowedposttags  ));?> </div>
              <div class="clear"></div>
              <?php 
	  if( $video_enable == 1 && $video_controls == 1 ){
		   $background = "";
		if(  !$detect->isMobile() && !$detect->isTablet() ){
		
	  echo '<p class="black-65" id="video-controls">
		  <a class="tubular-play" href="#"><i class="fa fa-play "></i></a>&nbsp; &nbsp;&nbsp;&nbsp;
		  <a class="tubular-pause" href="#"><i class="fa fa-pause "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a class="tubular-volume-up" href="#"><i class="fa fa-volume-up "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a class="tubular-volume-down" href="#"><i class="fa fa-volume-off "></i></a> 
	  </p>';
		}
	 }
	 ?>
            </section>
            <?php
 }
 }
  if($video_array !="" && $video_array != NULL ){
  wp_localize_script( 'onetone-bigvideo', 'onetone_bigvideo',$video_array);
  
		}

 endif;
 ?>
            <div class="clear"></div>
          </article>
        </section>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<?php get_footer();?>
