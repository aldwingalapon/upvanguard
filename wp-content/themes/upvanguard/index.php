<?php get_header(); ?>

	<?php echo do_shortcode('[owl-carousel category="Home" singleItem="true" items="1" autoPlay="true" navigation="false" pagination="false" stopOnHover="true" slideSpeed="2000" paginationSpeed="4000"]'); ?>
	<div class="main_content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
		</div>
	</div>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>