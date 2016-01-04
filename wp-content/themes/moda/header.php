<?php
	global $SMTheme;
	
	
	if ( isset($_POST['ajaxpage'])&&$_POST['ajaxpage']=='1' ) {
		ob_start();
		get_template_part('theloop');
		get_template_part('navigation');
		$return['content']=ob_get_contents();
		ob_end_clean();
		header('Content-type: application/json');
		echo json_encode($return);
		die();
	}
	$SMTheme->get_layout();
	

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php wp_title( false ); ?></title>
	
	<?php	$SMTheme->seo(); ?>

	<?php  wp_head(); ?>
	
	<style type="text/css">
		<?php echo $SMTheme->get( 'integration','css' )?>
	</style>
	
	<?php echo $SMTheme->get( 'integration','headcode' ); ?>
	
</head>



<body <?php $class=$SMTheme->block_slider_css(); $class.=' '.$SMTheme->sidebars_type; body_class( $class ); ?> layout='<?php echo $SMTheme->layout; ?>'>

	<div id='scrollUp'><img src='<?php echo get_template_directory_uri().'/images/smt/arrow-up.png';?>' alt='Up' title='Scroll window up' /></div>
		
	<div id='all'>
	
		<div id='header'>
			
			<div class="header-top">
				<div class='container clearfix'>
			
					<!-- Logo -->
					<div id="logo">
					<?php $SMTheme->block_logo();?>
														
					</div>
					<!-- / Logo -->
					
					
					<!-- Top Menu -->
					<div id='top-menu'>
		
						<?php wp_nav_menu(array( 
							'depth'=>0,
							'theme_location' => 'sec-menu',
							'menu_class'    => 'menus menu-topmenu',
							'fallback_cb'=>'block_sec_menu'
						));	?>
					</div>	
					<!-- / Top Menu -->
					
					
					<!-- Search -->
					<div class="headersearch" title="">
						<?php $search_text = empty($_GET['s']) ? $SMTheme->_('search') : get_search_query(); ?> 
						<div class="searchform" title="">
							<form method="get" ifaviconffd="searchform" action="<?php echo home_url( '/' ); ?>"> 
								<input type="text" value="<?php echo $search_text; ?>" class='searchtxt' 
									name="s" id="s"  onblur="if (this.value == '')  {this.value = '<?php echo $search_text; ?>';}"  
									onfocus="if (this.value == '<?php echo $search_text; ?>') {this.value = '';}" 
								/>
								<input type="submit" class="searchbtn" id="searchsubmit" value="">
								<div style='clear:both'></div>
							</form>
						</div><!-- #search -->
						<div class="search-trigger"></div>
						<script>
							jQuery( document ).on( 'click', '.search-trigger', function() {
								if ( jQuery( this ).hasClass( 'active' ) ) {
									jQuery( this ).removeClass( 'active' );
									jQuery( '.headersearch .searchform' ).slideUp();
								} else {
									jQuery( this ).addClass( 'active' );
									jQuery( '.headersearch .searchform' ).slideDown();
								}
								
								
							});
						</script>
					</div>
					<!-- / Search -->
					
					<div class="clear"></div>
					
				</div>
			</div>
			
			
					
				
					
					
					<?php smt_mobile_menu('sec-menu'); ?>
					<?php smt_mobile_menu('main-menu'); ?>
				
					<!-- Main Menu -->
					<div class="main-menu-container">
						<div id='main-menu'>
							<?php wp_nav_menu(array(
								'depth'=>0,
								'theme_location'=>'main-menu',
								'menu_class'=>'menus menu-primary',
								'fallback_cb'=>'block_main_menu'
							)); ?>
						</div>
						<div class="clear"></div>
					</div>
					<!-- / Main Menu -->
					
					
					<!-- Slider -->
					
					<?php
					if ((is_front_page()&&$SMTheme->get( 'slider', 'homepage'))||(!is_front_page()&&$SMTheme->get( 'slider', 'innerpage'))) {
						get_template_part( 'slider' );
						} ?>
					
					<!-- / Slider -->
					
					
					
					
			
		</div>

		<div id='content'>
			<div class='container clearfix'>
				<?php get_sidebar(); ?> 
				<div id="main_content">