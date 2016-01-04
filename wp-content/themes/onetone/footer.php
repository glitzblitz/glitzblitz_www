<?php
 $enable_footer_widget_area = esc_attr(onetone_option('enable_footer_widget_area',''));
?>
<!--Footer-->
		<footer>
        <?php if( $enable_footer_widget_area == '1' ):?>
			<div class="footer-widget-area">
				<div class="container">
					<div class="row">
							<div class="col-md-3 col-md-6">
							<?php
							if(is_active_sidebar("footer_widget_1")){
	                           dynamic_sidebar("footer_widget_1");
                                  	}
							?>
						</div>
						<div class="col-md-3 col-md-6">
				        <?php
							if(is_active_sidebar("footer_widget_2")){
	                           dynamic_sidebar("footer_widget_2");
                                  	}
							?>
						</div>
						<div class="col-md-3 col-md-6">
							<?php
							if(is_active_sidebar("footer_widget_3")){
	                           dynamic_sidebar("footer_widget_3");
                                  	}
							?>
						</div>
                        <div class="col-md-3 col-md-6">
							<?php
							if(is_active_sidebar("footer_widget_4")){
	                           dynamic_sidebar("footer_widget_4");
                                  	}
							?>
						</div>
                        
					</div>
				</div>
			</div>
            <?php endif;?>
			<div class="footer-info-area">
				
				<div class="container">	
					
					<!-- GP: social buttons -->
                        <div style="float:right"> 
                          <ul class="banner-sns" style="margin-top:0px">
                            <li><a href="https://www.facebook.com/thisisglitzblitz/?skip_nax_wizard=true" target="_blank"><i class="fa fa-2 fa-facebook" target="_blank"></i></a></li>

<li><a href="https://twitter.com/glitzblitz20153" target="_blank"><i class="fa fa-2 fa-twitter" target="_blank"></i></a></li>

                          <!--  <li><a href="#"><i class="fa fa-2 fa-skype" target="_blank"> </i></a></li> -->
 <li><a href="https://plus.google.com/102332603369473624111"  target="_blank"><i class="fa fa-2 fa-google-plus" target="_blank"></i></a></li>
<!--<li><a href="www.youtube.com"  target="_blank"><i class="fa fa-2 fa-youtube"  target="_blank"></i></a></li> -->

 
                            
                            <li><a href="https://in.linkedin.com/in/glitz-blitz-49206610a"  target="_blank"><i class="fa fa-2 fa-linkedin" target="_blank"></i></a></li>
                          
                          <!--  <li><a href="http://www.glitzblitz.in/feed/"><i class="fa fa-2 fa-rss"></i></a></li> -->

<!--<li><a href="#"  target="_blank"><i class="fa fa-2 fa-instagram" ></i></a></li> -->

                          </ul>
                        </div>
					<div class="site-info">
							<div>
						© 2015 Glitzblitz 
					</div>
					  <?php /* commented by GP
                      if( is_home() || is_front_page()){
                        printf(__('Designed by <a href="%s">MageeWP Themes</a>.','onetone'),esc_url('http://www.mageewp.com/'));
                      }else{
						 printf(__('Designed by MageeWP Themes.','onetone')); 
						  }
			*/	
                      ?>
					</div>
				</div>
			</div>			
		</footer>
	</div>
    <?php wp_footer();?>	
</body>
</html>