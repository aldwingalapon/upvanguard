<?php get_header(); ?>

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

				<div class="page-content 404-content">
					<div class="container">
						<div class="row">
							<div class="col-md-9 article">
								<?php the_content(); ?>
							</div>
							<div class="col-md-3 aside">

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