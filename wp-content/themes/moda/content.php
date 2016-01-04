	<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
 
global $SMTheme;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	
	
	
	<!-- ========== Post Title ========== -->
	<?php  //Title
		if (!is_single()&&!is_page()) { ?>
			<h2 class='entry-title'><a href="<?php the_permalink(); ?>" title="<?php printf( $SMTheme->_( 'permalink' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
		<?php } else { ?>
			<h1 class='entry-title'><?php the_title(); ?></h1>
	<?php } ?>
	
	
	
	
	
	<!-- ========== Post Meta ========== -->
	<div class="entry-meta-container">
		<div class="entry-meta">
			<div class="entry-meta-inner">
				<?php
					echo sprintf( '<span class="meta-author vcard"><img src="'.get_template_directory_uri().'/images/meta-author.png" alt="Author" /><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_attr( sprintf( __( 'View all posts by %s', 'letheme' ), get_the_author() ) ),
						get_the_author()
					);
				?>
				
				<?php
					echo sprintf( '<span class="meta-date"><img src="'.get_template_directory_uri().'/images/meta-date.png" alt="Date" /><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
						esc_url( get_permalink() ),
						esc_attr( get_the_time() ),
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() )
					);
				?>
			
				
				<?php if(comments_open( get_the_ID() ))  { ?> 
					<span class='meta-comments'>
						<img src="<?php echo get_template_directory_uri(); ?>/images/meta-comments.png" alt="Comments" />
						<?php comments_popup_link( $SMTheme->_( 'noresponses' ), $SMTheme->_( 'oneresponse' ), $SMTheme->_( 'multiresponse' ) ); ?>
					</span>
				<?php } ?>
			</div>
		</div>
	</div>
	
	
	
	
	
	<!-- ========== Post Featured Image ========== -->
	<?php the_post_thumbnail(
				'post-thumbnail',
				array("class" => $SMTheme->get( 'layout','imgpos' ) . " featured_image")
	); ?>
	
	
	
	
	
	<!-- ========== Post content  ========== -->
	<?php if ( !is_single() ) : ?>
		
		<!-- ========== Post content in posts feed ========== -->
		<div class="entry-summary">
			<?php smtheme_excerpt('echo=1');?>
			<a href='<?php the_permalink(); ?>' class='readmore'><?php echo $SMTheme->_( 'readmore' ); ?></a>
		</div><!-- .entry-summary -->
	
	<?php else : ?>
	
		<!-- ========== Post content in single post page ========== -->
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'letheme' ) );
				wp_link_pages( array(	
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'letheme' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
		
	<?php endif; ?>
	
	
	
	
	
	
	
	<div class="clear"></div>
</article><!-- #post-## -->
