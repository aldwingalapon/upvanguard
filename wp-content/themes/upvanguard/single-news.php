<?php  
/**
 * Template Name: Single News
 *
 */

get_header(); $id = get_the_ID();
set_upvi_post_views($id);

function getFacebookDetails($url){
    $rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=".urlencode($url);
    $json = json_decode(file_get_contents($rest_url),true);
return $json;
}
$data = getFacebookDetails("<?php echo get_permalink($id); ?>");
$shares = $data[0]['share_count'];
$comments = $data[0]['comment_count'];

?>

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
				<div class="page-content single-news-content">
					<div class="container">
						<div class="row">
							<div class="col-md-9 article">
								<h2 class="article-title"><?php echo ( get_field('show_custom_title', $id) ? get_field('title', $id) . (get_field('sub-title', $id) ? '<small>' . get_field('sub-title', $id) . '</small>' : '') : get_the_title() ); ?></h2>
								<div class="post-meta-data">
									<span class="post-details"><?php the_time('F j, Y') ?><?php echo ($shares ?  '  |  ' . $shares : '' ); ?><?php echo (get_field('author', $id) ?  '  |  ' . get_field('author', $id) :   '  |  ' . get_the_author()) ?><?php echo (get_field('source', $id) ?  ' (' . (get_field('source_url', $id) ? '<a href="' . get_field('source_url', $id) . '" rel="nofollow" target="_blank">' : '') . get_field('source', $id) . (get_field('source_url', $id) ? '</a>' : '') . ') ' : ''); ?></span>
									<span class="social-links">
										<span class="share-this">SHARE THIS</span>
										<span><a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink($id); ?>" title="Share in Facebook" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa fa-facebook"></i></a></span>
										<span><a href="https://twitter.com/share?url=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"><i class="fa fa-twitter"></i></a></span>
										<span><a href="https://plus.google.com/share?url=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a></span>
										<span><a href="https://www.rss.com//shareArticle?url=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-rss"></i></a></span>
										<span><a href="mailto:?subject=<?php echo get_permalink($id); ?>" title="" rel="nofollow" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"><i class="fa fa-envelope"></i></a></span>
									</span>
									<span class="edit-link"><?php edit_post_link('Edit this news', ' | ', ''); ?></span>
								</div>

								<?php the_content(); ?>
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