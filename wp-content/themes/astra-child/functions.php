<?php

/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

	wp_enqueue_script('tailwindcss', "https://cdn.tailwindcss.com");
	wp_enqueue_script('animated', "/wp-content/themes/astra-child/animated/animated.js");
	wp_enqueue_script('owl-carousel', "/wp-content/themes/astra-child/js/owl.carousel.min.js");
	wp_enqueue_style('astra-child-theme-css', '/wp-content/themes/astra-child/style.css');
	wp_enqueue_style('animated', '/wp-content/themes/astra-child/animated/animated.css');
	wp_enqueue_style('owl-carousel', '/wp-content/themes/astra-child/css/owl.theme.default.min.css');
	wp_enqueue_script('custom', "/wp-content/themes/astra-child/js/custom.js");
	//wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');
	//wp_enqueue_script('swiper', "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js");
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


function mind_defer_scripts($tag, $handle, $src)
{
	$defer = array(
		'animated',
		'custom',
		'owl-carousel',
	);
	if (in_array($handle, $defer)) {
		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
	}

	return $tag;
}
add_filter('script_loader_tag', 'mind_defer_scripts', 10, 3);

function get_navigation_menu($atts)
{
	ob_start();

	$file_path = 'templates/navigation-menu.php';
	include $file_path;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('call_navigation_menu', 'get_navigation_menu');

function register_custom_menu()
{
	register_nav_menu('custom-menu', __('Custom Menu'));
}
add_action('init', 'register_custom_menu');

function get_testimonials_carousel($atts)
{
	ob_start();

	$file_path = 'templates/testimonials.php';
	include $file_path;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('call_testimonials_carousel', 'get_testimonials_carousel');

function get_deseases_grid($atts)
{
	ob_start();

	$file_path = 'templates/deseases-grid.php';
	include $file_path;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('call_deseases_grid', 'get_deseases_grid');

function get_social_media($atts)
{
	ob_start();

	$file_path = 'templates/social-media.php';
	include $file_path;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('call_social_media', 'get_social_media');


function get_services($atts)
{
	ob_start();

	$file_path = 'templates/services.php';
	include $file_path;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('call_services', 'get_services');

function get_timeline_section($atts)
{
	ob_start();

	$file_path = 'templates/timeline_section.php';
	include $file_path;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('call_timeline_section', 'get_timeline_section');


function custom_partners_post_type()
{
	$labels = array(
		'name'               => _x('Parceiros', 'Nome geral do tipo de post'),
		'singular_name'      => _x('Parceiro', 'Nome singular do tipo de post'),
		'add_new'            => _x('Adicionar Novo', 'Adicionar novo item'),
		'add_new_item'       => __('Adicionar Novo Parceiro'),
		'edit_item'          => __('Editar Parceiro'),
		'new_item'           => __('Novo Parceiro'),
		'all_items'          => __('Todos os Parceiros'),
		'view_item'          => __('Ver Parceiro'),
		'search_items'       => __('Buscar Parceiros'),
		'not_found'          => __('Nenhum Parceiro encontrado'),
		'not_found_in_trash' => __('Nenhum Parceiro encontrado na Lixeira'),
		'parent_item_colon'  => '',
		'menu_name'          => 'Parceiros'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Tipo de post para Parceiro',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' 	=> 'dashicons-testimonial',
		'supports'      => array('title', 'thumbnail'),
		'has_archive'   => true,
	);

	register_post_type('partners', $args);
}

add_action('init', 'custom_partners_post_type');
