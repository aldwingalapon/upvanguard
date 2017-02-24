		<footer id="main_footer">
			<div class="container">
				<div class="row">
					<div class="col-md-2 static">
						<a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo('name'); ?>" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_sm.png" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>" width="250" height="250" /></a>
					</div>
					<div class="col-md-10 sidebars col-xs-12">
						<div class="col-sm-4 col-xs-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Footer One') ) : ?>
							<?php endif; ?>
						</div>
						<div class="col-sm-3 col-xs-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Footer Two') ) : ?>
							<?php endif; ?>
						</div>
						<div class="col-sm-2 col-xs-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Footer Three') ) : ?>
							<?php endif; ?>
						</div>
						<div class="col-sm-3 col-xs-6">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Footer Four') ) : ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix clear"></div>
					<div class="col-md-5 col-xs-12">
						<p>Copyright &copy; 2008 - <?php echo date('Y'); ?> <a href="<?php echo get_settings('home'); ?>">UP Vanguard Incorporated</a>. All rights reserved. Powered by <a href="http://www.jamediasolutions.com/" target="_blank">jamediasolutions.com</a>. This site is brought to you by the UP Vanguard University Chapter.</p>
					</div>
					<div class="col-md-7 col-xs-12 footer-menu-link">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Footer Menu Link') ) : ?>
						<?php endif; ?>
					</div>
					<div class="clearfix clear"></div>
				</div>
				<div class="clearfix clear"></div>
			</div>
		</footer>
	</div>

	<?php wp_footer(); ?>

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr-2.0.6.min.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.lazy.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/lightbox.min.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modal.js" defer></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/classie.js" defer></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js" defer></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.simplemodal.js" defer></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/scripts.js" defer></script>

</div>
</body>
</html>