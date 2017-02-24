<?php  
/**
 * Template Name: Hall of Fame
 *
 */

get_header(); $id = get_the_ID(); ?>

	<?php if (have_posts()) : ?>
		<div class="main_content">
			<?php while (have_posts()) : the_post(); ?>
				<div class="page-breadcrumb">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<?php if(function_exists('the_breadcrumbs')) the_breadcrumbs(); ?>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="page-content about-content">
					<div class="container">
						<div class="row">
							<div class="col-md-9 article">
								<h2 class="article-title"><?php echo ( get_field('show_custom_title', $id) ? get_field('title', $id) . (get_field('sub-title', $id) ? '<small>' . get_field('sub-title', $id) . '</small>' : '') : get_the_title() ); ?></h2>

								<?php the_content(); ?>
							</div>
							<div class="col-md-3 aside">
								<?php
									if( have_rows('page_widgets', $id) ):
										while ( have_rows('page_widgets', $id) ) : the_row();
											dynamic_sidebar( get_sub_field('sidebar_widget', $id) );
										endwhile;
									else :
											dynamic_sidebar('Default Page Sidebar');
									endif;
								?>	
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

	<?php else : ?>
	<?php endif; ?>
	
<?php wp_reset_query(); ?>

<?php get_footer(); ?>