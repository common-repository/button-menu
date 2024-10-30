<?php
if( !class_exists('QCBM_Button_Menu_Admin_Pages') ){
	/**
	 * Register All Admin Pages from Here
	 */
	class QCBM_Button_Menu_Admin_Pages
	{

		private static $instance;

		public static function getInstance() {
	        if (!isset(self::$instance)) {
	            self::$instance = new QCBM_Button_Menu_Admin_Pages();
	        }
	        return self::$instance;
	    }
		
		function __construct() {
			add_action( 'admin_init', array($this, 'register_setting') ); 
			add_action('admin_menu', array($this, 'menu_page'));
		}

		public function menu_page(){
			global $submenu;
			add_menu_page(
				__('Button Menu', 'qc-btn-menu'),
				__('Button Menu', 'qc-btn-menu'),
				'manage_options',
				'qc_button_menu',
				array($this, 'menu_page_callback'),
				'dashicons-menu',
				25
			);
			add_submenu_page(
				'qc_button_menu',
				__('Duplicate Menu', 'qc-btn-menu'),
				__('Duplicate Menu', 'qc-btn-menu'),
				'manage_options',
				'qc_duplicate_button_menu',
				array($this, 'qc_button_menu_duplicate_options_screen')
			);

		}

		public function qc_button_menu_duplicate_options_screen(){

			$qc_btn_nav_menus = wp_get_nav_menus();

		?>
		    <div class="wrap">
		        <div id="icon-options-general" class="icon32"><br /></div>
		            <h2><?php _e( 'Duplicate Menu' ); ?> <span style="color: indianred;font-style: italic;background: #c3c4c7;padding: 0px 5px;font-size: 18px;line-height: 18px;border-radius: 4px;font-weight: bold;"><?php _e( 'Pro Feature' ); ?> </span></h2>

		            <?php 

		            if ( ! empty( $_POST ) && wp_verify_nonce( $_POST['qc_btn_menu_qc_btn_duplicate_menu_nonce'], 'qc_btn_duplicate_menu_nonce' ) ) : 

		                $new_menu_id = get_option('qc_button_menu_new_id');
		                update_option('qc_button_menu_new_id', '');
		            ?>

		                <div id="message" class="updated"><p>
		                    <?php if ( $new_menu_id ) : ?>
		                        <?php _e( 'Menu Duplicated' ) ?>. <a href="nav-menus.php?action=edit&amp;menu=<?php echo absint( $new_menu_id ); ?>"><?php _e( 'View' ) ?></a>
		                    <?php else: ?>
		                        <?php _e( 'There was a problem duplicating your menu. No action was taken.' ) ?>.
		                    <?php endif; ?>
		                </p></div>

		            <?php endif; ?>


		            <?php if ( empty( $qc_btn_nav_menus ) ) : ?>
		                <p><?php _e( "You haven't created any Menus yet." ); ?></p>
		            <?php else: ?>
		                <form method="post" action="">
		                    <?php wp_nonce_field( 'qc_btn_duplicate_menu_nonce','qc_btn_menu_qc_btn_duplicate_menu_nonce' ); ?>

		                    <table class="form-table">
		                        <tr valign="top">
		                            <th scope="row">
		                                <label for="qc_btn_menu_name"><?php _e( 'Duplicate this menu' ); ?>:</label>
		                            </th>
		                            <td>
		                                <select name="qc_btn_menu_name" disabled>
		                                    <?php foreach ( (array) $qc_btn_nav_menus as $qc_btn_nav_menu ) : ?>
		                                        <option value="<?php echo esc_attr($qc_btn_nav_menu->term_id) ?>">
		                                            <?php echo esc_html( $qc_btn_nav_menu->name ); ?>
		                                        </option>
		                                    <?php endforeach; ?>
		                                </select>
		                                <span style="display:inline-block; padding:0 10px;"><?php _e( 'and call it' ); ?></span>
		                                <input name="qc_btn_new_menu_name" type="text" id="qc_btn_new_menu_name" value="" class="regular-text" disabled />
		                            </td>
		                    </table>
		                    <p class="submit">
		                        <input type="submit" name="submit" id="submit" class="button-primary" value="Duplicate Menu" />
		                    </p>
		                </form>
		            <?php endif; ?>
		        </div>


		<?php 
			
		}

		public function menu_page_callback(){
			require_once('templates/main-admin-menu.php');
		}

		public function register_setting() {
		    register_setting( 'qc_btn_menu_settings_options', 'qc-btn-menu-container-bg' );
		    register_setting( 'qc_btn_menu_settings_options', 'qc-btn-menu-button-bg');
		    register_setting( 'qc_btn_menu_settings_options', 'qc-btn-menu-button-color');
		    register_setting( 'qc_btn_menu_settings_options', 'qc-btn-menu-button-hover-bg');
		    register_setting( 'qc_btn_menu_settings_options', 'qc-btn-menu-button-hover-color');
		}

	}

}

QCBM_Button_Menu_Admin_Pages::getInstance();