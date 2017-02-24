<?php  
/**
 * Template Name: News
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

				<div class="page-content news-content">
					<div class="container">
						<div class="row">
							<div class="col-md-9 article">
								<h2 class="article-title"><?php echo ( get_field('show_custom_title', $id) ? get_field('title', $id) . (get_field('sub-title', $id) ? '<small>' . get_field('sub-title', $id) . '</small>' : '') : get_the_title() ); ?></h2>

								<?php the_content(); ?>

								<div class="row headlines" style="background-color:transparent;">
									<?php 

										$news = $wp_query;
										$wp_query = null;
										$args = array(
											'paged'=>$paged,
											'posts_per_page' => 6,
											'post_type' =>	'news',
											'status'	=>	'publish',
											'orderby'	=>	'date',
											'order'	=>	'DESC'
										);
										$wp_query = new WP_Query($args);
										//$wp_query->query('showposts=10&cat=25&orderby=date&order=desc'.'&paged='.$paged);
										

									?>
									<?php if (have_posts()) : $i = 0; ?>
										<?php  while ( have_posts() ) : the_post();
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
											<div class="col-md-6 col-sm-6 col-xs-12 news headline">
												<div class="news-item item">
													<a data-toggle="tooltip" data-placement="top" href="<?php the_permalink(); ?>" title="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" rel="bookmark"><img src="<?php echo $news_icon; ?>" title="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" alt="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" width="<?php echo $news_width; ?>" height="<?php echo $news_height; ?>" /></a><h4><a href="<?php the_permalink(); ?>" title="<?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) . (get_field('sub-title', $news_id) ? ': ' . get_field('sub-title', $news_id) : '') : get_the_title() ); ?>" rel="bookmark"><?php echo ( get_field('show_custom_title', $news_id) ? get_field('title', $news_id) : get_the_title() ); ?></a> <small>Posted on <?php the_time('F j, Y') ?></small></h4>
												</div>
											</div>
											<?php echo(($i%2)==0 ? '<div class="clearfix clear"></div>' : ''); ?>
										<?php endwhile; ?>
										<?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
									<?php else : endif; $wp_query = null; $wp_query = $news; ?>
									<div class="clearfix clear"></div>
								</div>
								<div class="clearfix clear"></div>
								
							</div>
							<div class="col-md-3 aside">
								<?php
									if( have_rows('page_widgets', $id) ):
										while ( have_rows('page_widgets', $id) ) : the_row();
											dynamic_sidebar( get_sub_field('sidebar_widget', $id) );
										endwhile;
									else :
											dynamic_sidebar('Default News Sidebar');
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