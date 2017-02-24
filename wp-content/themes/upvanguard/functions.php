<?php

/*	@desc attach custom admin login CSS file	*/

function custom_login_css() {

  echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login.css" />';

}

add_action('login_head', 'custom_login_css');



/*	@desc update logo URL to point towards Homepage	*/

function custom_login_header_url($url) {

  return get_option('home');

}

add_filter( 'login_headerurl', 'custom_login_header_url' );



function custom_login_header_title($title) {

  $blog_title = get_bloginfo('name');

  return $blog_title;

}



add_filter( 'login_headertitle', 'custom_login_header_title' );

/*	@desc update admin icon to client icon	*/

function custom_admin_icon_css() {

  echo '<link rel="shortcut icon" href="'.get_stylesheet_directory_uri().'/images/logo.ico" />';

}

add_action('admin_head', 'custom_admin_icon_css');



function remove_footer_admin () {

    echo '<span id="footer-thankyou">Template implemented and developed by <a href="http://www.jamediasolutions.com/" target="_blank" title="JA Media Solutions">JA Media Solutions</a>.</span>';

}

add_filter('admin_footer_text', 'remove_footer_admin');



// Disable Admin Bar for all users

//add_filter('show_admin_bar', '__return_false');



function upvi_remove_version() {return '';}

add_filter('the_generator', 'upvi_remove_version');



//Making jQuery Google API

function modify_jquery() {

	if (!is_admin()) {

		wp_deregister_script('jquery');

		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');

		wp_enqueue_script('jquery');

	}

}

//add_action('init', 'modify_jquery');



// custom menu support

add_theme_support( 'menus' );

if (function_exists( 'register_nav_menus')) {register_nav_menus(array('primary_navigation' => 'Primary Navigation', 'secondary_navigation' => 'Secondary Navigation', 'utility_navigation' => 'Utility Navigation'));}



if ( function_exists('register_sidebar') )

register_sidebar(array('id'=>'default-sidebar','name'=>'Default Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-news-sidebar','name'=>'Default News Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-articles-sidebar','name'=>'Default Articles Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-events-sidebar','name'=>'Default Events Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-blog-sidebar','name'=>'Default Blog Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-media-sidebar','name'=>'Default Media Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-page-sidebar','name'=>'Default Page Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'default-member-sidebar','name'=>'Default Members Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));

register_sidebar(array('id'=>'home-top-footer-one','name'=>'Home Top Footer One','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-top-footer-two','name'=>'Home Top Footer Two','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-top-footer-three','name'=>'Home Top Footer Three','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-top-footer-four','name'=>'Home Top Footer Four','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-bottom-footer-one','name'=>'Home Bottom Footer One','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-bottom-footer-two','name'=>'Home Bottom Footer Two','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-bottom-footer-three','name'=>'Home Bottom Footer Three','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-bottom-footer-four','name'=>'Home Bottom Footer Four','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-bottom-footer-copyright','name'=>'Home Bottom Footer Copyright','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));

register_sidebar(array('id'=>'home-bottom-footer-menu-link','name'=>'Home Bottom Footer Menu Link','before_widget' => '','after_widget' => '','before_title' => '<h4>','after_title' => '</h4>',));





// thumbnail support

add_theme_support('post-thumbnails'); 

add_image_size('large-thumbnails', 500, 500, true);

add_image_size('medium-thumbnails', 300, 300, true);

add_image_size('mediumrectangle-thumbnails', 300, 200, true);

add_image_size('small-thumbnails', 200, 200, true);



add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;



function custom_oembed_filter($html, $url, $attr, $post_ID) {

    $return = '<div class="video-container">'.$html.'</div>';

    return $return;

}



// Remove Query String

function _remove_script_version( $src ){

$parts = explode( '?ver', $src );

return $parts[0];

}

add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );

add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );



// Add a unique id attribute to the body tag of an HTML page

function id_the_body() {

        global $post, $wp_query, $wpdb;

        $post = $wp_query->post;

	$body_id = "";

        if ($post->post_type == 'page') $body_id = 'page-' . $post->ID;

        if ($post->post_type == 'post') $body_id = 'post-' . $post->ID;

        if ( is_front_page() ) $body_id = 'home';

        if ( is_home() ) $body_id = 'home';

        if ( is_category() ) $body_id = 'category-' . get_query_var('cat');

        if ( is_tag() ) $body_id = 'tag-' . get_query_var('tag');

        if ( is_author() ) $body_id = 'author-' . get_query_var('author');

        if ( is_date() ) $body_id = 'date-archive';

        if (is_search()) $body_id = 'search-archive';

        if (is_404()) $body_id = '404-error';

        if ($body_id) echo "id=\"$body_id\"";

}

// Add special class names for the parents of the page

function class_the_body($more_classes='') {

        global $post, $wp_query, $wpdb;

        $post = $wp_query->post;

		$parent_id_string = "";

        if ($post->ancestors) {

                /* reverse the order of the array elements b/c we want the immediate parent to be last in the class list */

                $parent_array = array_reverse($post->ancestors);

                foreach ($parent_array as $key => $parent_id) {

                        $parent_id_string = $parent_id_string . ' childof-' . 

$parent_id;

                }

        }

	$type = "";

        if ($post->post_type == 'page') $type = 'page';

        if ($post->post_type == 'post') $type = 'single';

        // these 2 are not needed since we id the body with home

        //if (is_home()) $type = 'home';

        //if (is_front_page()) $type = 'front';

        if (is_category()) $type = 'archive category-archive';

        if (is_tag()) $type = 'archive tag-archive';

        if (is_author()) $type = 'archive author-archive';

        // again, these 3 are not needed since we id the body with these

        if (is_date()) $type = 'archive date-archive';

        if (is_search()) $type = 'archive search-archive';

        if (is_404()) $type = '404-error';

        // need a lot of trimming b/c any combination of these could be blank

		if($parent_id_string) {

			$classes = trim($parent_id_string . ' ' . $more_classes);

		}else{

			$classes = trim($more_classes);

		}

        if ($type) $classes = $type . ' ' . $classes;

        $classes = trim($classes);

        if ($classes) echo " class=\"$classes\"";

}



//add_filter( 'bbp_no_breadcrumb', '__return_true' );



function the_breadcrumbs() {

	global $post;

	echo "<p class='trail'>";

	if (!is_home()) {

		echo "<span class='home-page'><a href='".get_option('home')."'>Home</a></span>";



		if (is_category() || is_singular( 'post' )) {

			if (bp_is_blog_page()){

				echo " <span class='sep'></span> ";

			}



			$post_object = get_field('blogs_page', 'option');

			if( $post_object ){

				$post = $post_object;

				setup_postdata( $post ); 



				echo "<span><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";



				wp_reset_postdata();

			}



			if (is_category()) {

				echo " <span class='sep'></span> <span class='single-category'>".single_cat_title( '', false )."</span>";

			}



			if (is_singular( 'post' ) && bp_is_blog_page()) {

				echo " <span class='sep'></span> <span class='single-post-".$post->ID."'>".get_the_title()."</span>";

			}

			

			if(!bp_is_blog_page() ){

				if(bp_is_group() && !bp_is_group_home()){

				?>

					<span class="sep"></span> <span class="buddypress-all-groups"><a href="<?php echo bp_groups_directory_permalink(); ?>" title="All Groups">Groups</a></span>

				<?php

					echo " <span class='sep'></span> <span class='single-group-".$post->ID."'>".get_the_title()."</span>";

				} else {

					echo ' <span class="sep"></span> <span class="buddypress-user">' . bp_core_get_userlink(bp_current_user_id()) . '</span>';



					if(bp_is_activity_component()){

						echo " <span class='sep buddypress-component'></span> <span>Activity</span>";

					}

					if(bp_is_profile_component()){

						echo " <span class='sep buddypress-component'></span> <span>Profile</span>";

					}

					if(bp_is_blogs_component()){

						echo " <span class='sep buddypress-component'></span> <span>Blogs</span>";

					}

					if(bp_is_messages_component()){

						echo " <span class='sep buddypress-component'></span> <span>Messages</span>";

					}

					if(bp_is_current_component('notifications')){

						echo " <span class='sep buddypress-component'></span> <span>Notifications</span>";

					}

					if(bp_is_friends_component()){

						echo " <span class='sep buddypress-component'></span> <span>Friends</span>";

					}

					if(bp_is_groups_component()){

						echo " <span class='sep buddypress-component'></span> <span>Groups</span>";

					}

					if(bp_is_current_component('forums')){

						echo " <span class='sep buddypress-component'></span> <span>Forums</span>";

					}

					if(bp_is_current_component('following')){

						echo " <span class='sep buddypress-component'></span> <span>Following</span>";

					}

					if(bp_is_current_component('followers')){

						echo " <span class='sep buddypress-component'></span> <span>Followers</span>";

					}

					if(bp_is_current_component('compliments')){

						echo " <span class='sep buddypress-component'></span> <span>Compliments</span>";

					}

					if(bp_is_current_component('links')){

						echo " <span class='sep buddypress-component'></span> <span>Links</span>";

					}

					if(bp_is_current_component('media')){

						echo " <span class='sep buddypress-component'></span> <span>Media</span>";

					}

					if(bp_is_settings_component()){

						echo " <span class='sep buddypress-component'></span> <span>Settings</span>";

					}

				}

			}

		} elseif( is_bbpress() ) {

			if(!bp_is_user()){

				$args = array('include_home' => 0, 'before' => '', 'after' => '', 'sep_before' => ' <span class="sep">', 'sep_after' => '</span> ', 'current_before' => '<span class="bbp-breadcrumb-current">', 'current_after' => '</span>');

				echo ' <span class="sep"></span> '. bbp_get_breadcrumb($args);

			} else{

				echo ' <span class="sep"></span> <span class="buddypress-user">' . bp_core_get_userlink(bp_current_user_id()) . '</span>';

			}

		} elseif (is_page()) {

			if($post->post_parent){

				$anc = get_post_ancestors( $post->ID );

				krsort($anc);

				//$anc_link = get_page_link( $post->post_parent );



				foreach ( $anc as $ancestor ) {

					echo " <span class='sep'></span> <span class='page-ancestor'><a href=" . get_page_link( $ancestor ) . ">".get_the_title($ancestor)."</a></span> ";

				}



				echo " <span class='sep'></span> <span class='child-page'>".get_the_title()."</span>";

			} else {

				echo " <span class='sep'></span> ";

				echo "<span class='top-page'>".get_the_title()."</span>";

			}

		} elseif (is_singular( 'news' )) {

			echo " <span class='sep'></span> ";



			$post_object = get_field('news_page', 'option');

			if( $post_object ){

				$post = $post_object;

				setup_postdata( $post ); 



				echo "<span><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";



				wp_reset_postdata();

			}



			if (is_singular( 'news' )) {

				echo " <span class='sep'></span> <span class='single-news-".$post->ID."'>".get_the_title()."</span>";

			}

		} elseif (tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' )) {

			echo " <span class='sep'></span> ";

		

			$events_page = get_field('events_page', 'option');

			if( $events_page ){

				echo "<span><a href='".get_field('events_page', 'option')."'>Events</a></span>";

			}



			if (is_singular( 'tribe_events' )) {

				echo " <span class='sep'></span> <span class='single-event-".$post->ID."'>".get_the_title()."</span>";

			}

		} elseif (is_search()) {

			echo " <span class='sep'></span> <span>Search results</span>";; 

		}

	} elseif (is_tag()) {

		single_tag_title();

	} elseif (is_day()) {

		echo "<span>Archive: "; get_the_time('F jS, Y'); echo '</span>';

	} elseif (is_month()) {

		echo "<span>Archive: "; get_the_time('F, Y'); echo '</span>';

	} elseif (is_year()) {

		echo "<span>Archive: "; get_the_time('Y'); echo '</span>';

	} elseif (is_author()) {

		echo "<span>Author's archive: "; echo '';

	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {

		echo "<span>Archive: "; echo '</span>';

	}

	echo "</p>";

}



function set_upvi_post_views($postID) {

    $count_key = 'upvi_post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if($count==''){

        $count = 0;

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

    }else{

        $count++;

        update_post_meta($postID, $count_key, $count);

    }

}

//To keep the count accurate, lets get rid of prefetching

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



function get_upvi_post_views($postID){

    $count_key = 'upvi_post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if($count==''){

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

        return "0 View";

    }

    return $count.' Views';

}



function limit_words($string, $word_limit) {

	$words = explode(' ', $string);



	return implode(' ', array_slice($words, 0, $word_limit));

}



remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);



add_action('woocommerce_before_main_content', 'upvi_wrapper_start', 10);

add_action('woocommerce_after_main_content', 'upvi_wrapper_end', 10);



function upvi_wrapper_start() {

  echo '<section id="shop">';

}



function upvi_wrapper_end() {

  echo '</section>';

}



add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {

    add_theme_support( 'woocommerce' );

}



class bootstrap_walker_nav_menu extends Walker_Nav_Menu {



        // <ul> elements

        function start_lvl( &$output, $depth = 0, $args = array() ) {

          

                // code indentation

                $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); 

                

                // build classes

                $classes = array(

                                    // only the top level will have dropdowns

                                    $depth == 0 ? 'dropdown-menu' : '',

                                    // assign a class to items nested deeper

                                    $depth >= 1 ? 'sub-menu' : ''

                                );

                $class_names = implode( ' ', $classes );

                

                // build html - <ul> becomes <div> at top levels

                if ( $depth == 0 )  $output .= "\n" . $indent . '<div class="' . $class_names . '">' .  "\n" . $indent . '<div class="frame">' . "\n";

                else $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";

                

            

        }



        // <li> elements and <a> links

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		

                // code indentation

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

 

                // prepare

		$li_attributes = '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		

		// build classes and attributes for <li> elements that have nested <ul> 

		if ( $args->has_children && $depth == 0 ) {

                    

                        $classes[] = 'dropdown';

			$li_attributes .= 'data-dropdown="dropdown"';

                        

		}

		$classes[] = 'menu-item-' . $item->ID;

		// if we are on the current page, add the active class to that menu item

		// $classes[] = ($item->current) ? 'active' : '';

		// add all of the wordpress classes, including those set by user in Wordpress

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		$class_names = ' class="' . esc_attr( $class_names ) . '"';

                

                // add id to <li> elements

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

                

                // build html - the <li> elements at top level become <div>

                if ( $depth == 0 ) $output .= $indent . '<li>' . "\n" . $indent . '<div ' . $id . $value . $class_names . $li_attributes . '>';

                // 

                elseif ( $depth == 1 ) $output .= $indent . '<div class="column">';

		else $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

 

		// build attributes and classes for <a> link elements

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';

		$attributes .= ! empty( $item->target ) ? ' target="'. esc_attr( $item->target ) .'"' : '';

		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';

		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$attributes .= ( $args->has_children && $depth == 0 ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : ''; 

 

                // build <a> link html

		$item_output = $args->before;

		$item_output .= '<a'. $attributes .'>';

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                // add a bootstrap "caret" to top level dropdowns toggles

		$item_output .= ( $args->has_children && $depth == 0 ) ? ' <b class="caret"></b> ' : ''; 

		$item_output .= '</a>';

		$item_output .= $args->after;

 

                // final html output

                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

                

	}

        

        function end_el( &$output, $item, $depth = 0, $args = array() ) {

            

                // closes elements opened in start_el

                if ( $depth == 0 ) $output .= '</div>' . "\n" . '</li>' . "\n";

                elseif ( $depth == 1 ) $output .= '</div>' . "\n";

		else $output .= "</li>\n";

                

	}

        

        function end_lvl( &$output, $depth = 0, $args = array() ) {

            

                // code indentation

		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' );

                

                // closes elements opened in start_lvl

                if ( $depth == 0 ) $output .= $indent . '</div>' . "\n" . $indent . '</div>' . "\n";

		else $output .= $indent . '</ul>' . "\n";

                

	}

        

        // Overwrite display_element function to add has_children attribute @since WP 3.4

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		

		if ( !$element )

			return;

		

		$id_field = $this->db_fields['id'];

 

		//display this element

		if ( is_array( $args[0] ) ) 

			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

		else if ( is_object( $args[0] ) ) 

			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 

		$cb_args = array_merge( array(&$output, $element, $depth), $args);

		call_user_func_array(array(&$this, 'start_el'), $cb_args);

 

		$id = $element->$id_field;

 

		// descend only when the depth is right and there are children for this element

		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

 

			foreach( $children_elements[ $id ] as $child ){

 

				if ( !isset($newlevel) ) {

					$newlevel = true;

					//start the child delimiter

					$cb_args = array_merge( array(&$output, $depth), $args);

					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);

				}

				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );

			}

				unset( $children_elements[ $id ] );

		}

 

		if ( isset($newlevel) && $newlevel ){

			//end the child delimiter

			$cb_args = array_merge( array(&$output, $depth), $args);

			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);

		}

 

		//end this element

		$cb_args = array_merge( array(&$output, $element, $depth), $args);

		call_user_func_array(array(&$this, 'end_el'), $cb_args);

		

	}



}



class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**

	 * @see Walker::start_lvl()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param int $depth Depth of page. Used for padding.

	 */

	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";

	}

	/**

	 * @see Walker::start_el()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param object $item Menu item data object.

	 * @param int $depth Depth of menu item. Used for padding.

	 * @param int $current_page Menu item ID.

	 * @param object $args

	 */

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**

		 * Dividers, Headers or Disabled

		 * =============================

		 * Determine whether the item is a Divider, Header, Disabled or regular

		 * menu item. To prevent errors we use the strcasecmp() function to so a

		 * comparison that is not case sensitive. The strcasecmp() function returns

		 * a 0 if the strings are equal.

		 */

		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {

			$output .= $indent . '<li role="presentation" class="divider">';

		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {

			$output .= $indent . '<li role="presentation" class="divider">';

		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {

			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );

		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {

			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';

		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )

				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )

				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();

			$atts['title']  = ! empty( $item->title )	? $item->title	: '';

			$atts['target'] = ! empty( $item->target )	? $item->target	: '';

			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.

			if ( $args->has_children && $depth === 0 ) {

				$atts['href']   		= '#';

				$atts['data-toggle']	= 'dropdown';

				$atts['class']			= 'dropdown-toggle';

				$atts['aria-haspopup']	= 'true';

			} else {

				$atts['href'] = ! empty( $item->url ) ? $item->url : '';

			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';

			foreach ( $atts as $attr => $value ) {

				if ( ! empty( $value ) ) {

					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

					$attributes .= ' ' . $attr . '="' . $value . '"';

				}

			}

			$item_output = $args->before;

			/*

			 * Glyphicons

			 * ===========

			 * Since the the menu item is NOT a Divider or Header we check the see

			 * if there is a value in the attr_title property. If the attr_title

			 * property is NOT null we apply it as the class name for the glyphicon.

			 */

			if ( ! empty( $item->attr_title ) )

				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';

			else

				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';

			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

	}

	/**

	 * Traverse elements to create list from elements.

	 *

	 * Display one element if the element doesn't have any children otherwise,

	 * display the element and its children. Will only traverse up to the max

	 * depth and no ignore elements under that depth.

	 *

	 * This method shouldn't be called directly, use the walk() method instead.

	 *

	 * @see Walker::start_el()

	 * @since 2.5.0

	 *

	 * @param object $element Data object

	 * @param array $children_elements List of elements to continue traversing.

	 * @param int $max_depth Max depth to traverse.

	 * @param int $depth Depth of current element.

	 * @param array $args

	 * @param string $output Passed by reference. Used to append additional content.

	 * @return null Null on failure with no changes to parameters.

	 */

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

        if ( ! $element )

            return;

        $id_field = $this->db_fields['id'];

        // Display this element.

        if ( is_object( $args[0] ) )

           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

	/**

	 * Menu Fallback

	 * =============

	 * If this function is assigned to the wp_nav_menu's fallback_cb variable

	 * and a manu has not been assigned to the theme location in the WordPress

	 * menu manager the function with display nothing to a non-logged in user,

	 * and will add a link to the WordPress menu manager if logged in as an admin.

	 *

	 * @param array $args passed from the wp_nav_menu function.

	 *

	 */

	public static function fallback( $args ) {

		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {

				$fb_output = '<' . $container;

				if ( $container_id )

					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )

					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';

			}

			$fb_output .= '<ul';

			if ( $menu_id )

				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )

				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';

			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';

			$fb_output .= '</ul>';

			if ( $container )

				$fb_output .= '</' . $container . '>';

			echo $fb_output;

		}

	}

}



add_filter( 'wp_nav_menu_items', 'primary_navigation_search_menu_item', 10, 2 );

function primary_navigation_search_menu_item( $items, $args ) {

    if ($args->theme_location == 'primary_navigation') {

        $items .= '<li class="search-menu-item" data-toggle="collapse" data-target="#menu_searchform"><i class="fa fa-search" aria-hidden="true"></i></li>';

    }

    return $items;

}



add_filter( 'wp_nav_menu_items', 'utility_navigation_hamburger_menu_item', 10, 2 );

function utility_navigation_hamburger_menu_item( $items, $args ) {

    if ($args->theme_location == 'utility_navigation') {

        $items .= '<li class="search-menu-item"><button class="c-hamburger c-hamburger--htx"><span>toggle menu</span></button></li>';

    }

    return $items;

}



?>