<?php
/**
* Plugin Name: Button Menu
* Plugin URI: https://www.wordpress.org/button-menu
* Description: Button Menu
* Version: 0.9.4
* Author: dna88
* Author URI: https://www.dna88.com/
* Requires at least: 4.6
* Tested up to: 5.9
* Text Domain: qc-btn-menu
* Domain Path: /lang/
* License: GPL2
*/

defined('ABSPATH') or die("No direct script access!");

/**
 * Main Class
 */
class QCBM_Button_Menu
{
	
	function __construct()
	{
		define( 'QCBM_VERSION', '0.9.2' );
		define( 'QCBM_PATH', plugin_dir_path(__FILE__) );
		define( 'QCBM_URL', plugin_dir_url(__FILE__) );
		add_action('wp_enqueue_scripts', [$this, 'scripts_n_styles'] );
		add_action('admin_enqueue_scripts', [$this, 'admin_scripts_n_styles'] );

		add_action('nav_menu_link_attributes', [$this, 'nav_menu_link_attributes'], 10, 4 );
		$this->includes();
		$this->shortcodes();
	}

	public function admin_scripts_n_styles(){
		wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script('qc-menu-button', QCBM_URL . 'assets/js/admin-scripts.js', array('jquery'), QCBM_URL, false);
	}

	public function scripts_n_styles(){
		$container_bg = get_option('qc-btn-menu-container-bg') ? get_option('qc-btn-menu-container-bg') : '#f5f5f5';
		$button_bg = get_option('qc-btn-menu-button-bg') ? get_option('qc-btn-menu-button-bg') : '#fff';
		$button_color = get_option('qc-btn-menu-button-color') ? get_option('qc-btn-menu-button-color') : '#000';

		$button_hover_bg = get_option('qc-btn-menu-button-hover-bg') ? get_option('qc-btn-menu-button-hover-bg') : '#e9e9e9';
		$button_hover_color = get_option('qc-btn-menu-button-hover-color') ? get_option('qc-btn-menu-button-hover-color') : '#000';
		$style = "
                .qc-menu-button-container {
                        background: {$container_bg};
                }
                .qc-menu-button-container li a{
                        background: {$button_bg};
                        color: {$button_color};
                }
                .qc-menu-button-container li a:hover{
					color: {$button_hover_color};
				}
				.qc-menu-button-container li a:before{
					background: {$button_hover_bg};
				}";

		wp_enqueue_style('qc-fontawesome-picker', QCBM_URL . 'assets/vendors/fontawesome/css/all.min.css', array(), QCBM_VERSION, 'all');
		wp_enqueue_style( 'qc-menu-button',  QCBM_URL . 'assets/css/style.css', array(), QCBM_VERSION, 'all');
		wp_add_inline_style( 'qc-menu-button', $style );

		wp_enqueue_script('qc-menu-button', QCBM_URL . 'assets/js/scripts.js', array('jquery'), QCBM_URL, false);
	}

	public function includes(){
		if( is_admin() ){
			require_once(QCBM_PATH . 'admin/settings/settings-page.php');
		}
	}

	public function shortcodes(){
		add_shortcode( 'qc-button-menu', [$this, 'qc_button_menu_shortcode'] );
	}

	public function qc_button_menu_shortcode($atts){

		$menu_list = wp_get_nav_menu_object($atts['menu']);
		$menu_id = $menu_list->term_id;

		$breadcrumb = $attr['breadcrumb'] == 'true' ? true: true;

		$attr = array(
			'menu'	=> $menu_id,
			'container' => '',
			'depth' => 3,
			'show_breadcrumb' => $breadcrumb,
			'breadcrumb_separator' => '/',
			'menu_align' => 'center',
			'menu_class' => 'qc-btn-menu-ul',
		);
		
		ob_start();
			require( QCBM_PATH . 'templates/shortcode.php' );
		return ob_get_clean();
	}



	public function nav_menu_link_attributes( $atts, $item, $args, $depth ){
		
		if( preg_match('/\bqc-btn-menu-ul\b/', $args->menu_class) ){
			$item_id = $item->ID;
			
			$button_icon = '';

			$submenu_icon = 'fas fa-arrow-right';

			$atts['data-link-item-id'] = $item_id;

			if (in_array('menu-item-has-children', $item->classes)) {
			    $atts['data-submenu-indicator'] = $submenu_icon;
			}

			if( $button_icon ){
				$atts['data-qc-btn-icon'] = $button_icon;
			}
			
		}
	

		return $atts;
	}





}

new QCBM_Button_Menu();

include_once('class-dna88-free-plugin-upgrade-notice.php');