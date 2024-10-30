<?php
	$attr['echo'] = false;

	// var_dump($attr['show_breadcrumb']);
	// wp_die();

	$html  = '<div class="qc-menu-button-container">';

		if( $attr['show_breadcrumb'] == 'true' ){
			$html .= '<div class="qc-btn-menu-breadcrumb '.esc_attr('pd-menu-align-'.$attr['menu_align']).'" data-breadcrumb_separator="'. esc_attr($attr['breadcrumb_separator']) .'">';
			$html .= '</div>';
		}
	$html .= wp_nav_menu($attr);
	$html .= '</div>';

	echo $html;
?>