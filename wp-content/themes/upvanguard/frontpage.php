<?php  
/**
 * Template Name: Static Frontpage
 *
 */

get_header(); ?>

	<div class="main_content">
		<?php echo do_shortcode('[owl-carousel category="Home" singleItem="true" items="1" autoPlay="10000" navigation="true" navigationText="false" pagination="true" stopOnHover="true" rewindSpeed="10000" slideSpeed="1000" paginationSpeed="600"]'); ?>
		<section class="shibboleth">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3>Duty well performed, Honor untarnished, and Country above-self has been the shibboleth and clarion call of the UP Vanguard since its inception.</h3>
					</div>
					<div class="clearfix clear"></div>
				</div>
				<div class="clearfix clear"></div>
			</div>
		</section>
		<section class="headlines">
			<div class="container">
				<div class="row">
					<?php 
						$args = array(
							'posts_per_page' => 8,
							'post_type' =>	'news',
							'status'	=>	'publish',
							'orderby'	=>	'date',
							'order'	=>	'DESC'
						);

						$news = New WP_Query($args);
					?>
					<?php if ($news) : $i = 0; ?>
						<div class="col-md-12">
							<h3 class="section-title">In the Headlines</h3>
							<span class="more"><a href="<?php echo get_settings('home'); ?>/news/" rel="" title="More UP Vanguard News">UP Vanguard <strong>News</strong></a></span>
						</div>
						<div class="clearfix clear"></div>
						<?php  while ( $news->have_posts() ) : $news->the_post();
							$i++;
							$news_id = get_the_ID();
							$news_icon = '';
							$news_width = 300;
							$news_height = 300;
							if ( has_post_thumbnail() ) {
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($news_id), 'mediumrectangle-thumbnails' );
								$news_icon = $image_url[0];
								$news_width = $image_url[1];
								$news_height = $image_url[2];
							}
						?>
							<div class="col-md-3 col-sm-6 col-xs-12 headline">
								<div class="item">
									<a data-toggle="tooltip" data-placement="top" href="<?php the_permalink(); ?>" title="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" rel="bookmark"><img src="<?php echo $news_icon; ?>" title="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" alt="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" width="<?php echo $news_width; ?>" height="<?php echo $news_height; ?>" /></a><h4><a href="<?php the_permalink(); ?>" title="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" rel="bookmark"><?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) : get_the_title() ); ?></a> <small>Posted on <?php the_time('F j, Y') ?></small></h4>
								</div>
							</div>
						<?php endwhile; ?>
					<?php else :
						// no rows found
						endif;
					?>
					<div class="clearfix clear"></div>
				</div>
				<div class="clearfix clear"></div>
			</div>
		</section>
	</div>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>