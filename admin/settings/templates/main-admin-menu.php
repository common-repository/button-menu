<?php
	//General Options
	$container_bg = get_option('qc-btn-menu-container-bg') ? get_option('qc-btn-menu-container-bg') : '#f5f5f5';
	$button_bg = get_option('qc-btn-menu-button-bg') ? get_option('qc-btn-menu-button-bg') : '#fff';
	$button_color = get_option('qc-btn-menu-button-color') ? get_option('qc-btn-menu-button-color') : '#000';
	$button_hover_bg = get_option('qc-btn-menu-button-hover-bg') ? get_option('qc-btn-menu-button-hover-bg') : '#e9e9e9';
	$button_hover_color = get_option('qc-btn-menu-button-hover-color') ? get_option('qc-btn-menu-button-hover-color') : '#000';
?>
<div class="wrap">
	<h1><?php echo esc_html__('Button Menu', 'qc-btn-menu'); ?></h1>
	<?php require_once(QCBM_PATH . 'admin/templates/help.php');?>
	
	<form action="options.php" method="post">
		<?php settings_fields( 'qc_btn_menu_settings_options' ); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="qc-btn-menu-container-bg"><?php echo esc_html__('Container Background:', 'qc-btn-menu'); ?></label>
					</th>
					<td>
						<input type="text" id="qc-btn-menu-container-bg" name="qc-btn-menu-container-bg" value="<?php echo esc_attr($container_bg); ?>" class="qc-button-menu-color" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="qc-btn-menu-button-bg"><?php echo esc_html__('Button Background:', 'qc-btn-menu'); ?></label>
					</th>
					<td>
						<input type="text" id="qc-btn-menu-button-bg" name="qc-btn-menu-button-bg" value="<?php echo esc_attr($button_bg); ?>" class="qc-button-menu-color" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="qc-btn-menu-button-hover-bg"><?php echo esc_html__('Button Hover Background:', 'qc-btn-menu'); ?></label>
					</th>
					<td>
						<input type="text" id="qc-btn-menu-button-hover-bg" name="qc-btn-menu-button-hover-bg" value="<?php echo esc_attr($button_hover_bg); ?>" class="qc-button-menu-color" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="qc-btn-menu-button-color"><?php echo esc_html__('Button Color:', 'qc-btn-menu'); ?></label>
					</th>
					<td>
						<input type="text" id="qc-btn-menu-button-color" name="qc-btn-menu-button-color" value="<?php echo esc_attr($button_color); ?>" class="qc-button-menu-color" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="qc-btn-menu-button-hover-color"><?php echo esc_html__('Button Hover Color:', 'qc-btn-menu'); ?></label>
					</th>
					<td>
						<input type="text" id="qc-btn-menu-button-hover-color" name="qc-btn-menu-button-hover-color" value="<?php echo esc_attr($button_hover_color); ?>" class="qc-button-menu-color" />
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr('Save Changes'); ?>">
		</p>
	</form>
</div>