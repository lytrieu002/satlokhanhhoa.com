<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<'))
{
    require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twenty_twenty_one_setup'))
{
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Twenty Twenty-One 1.0
     *
     * @return void
     */
    function twenty_twenty_one_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Twenty-One, use a find and replace
         * to change 'twentytwentyone' to the name of your theme in all the template files.
        */
        load_theme_textdomain('twentytwentyone', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * This theme does not use a hard-coded <title> tag in the document head,
         * WordPress will provide it for us.
        */
        add_theme_support('title-tag');

        /**
         * Add post-formats support.
         */
        add_theme_support('post-formats', array(
            'link',
            'aside',
            'gallery',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        ));

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1568, 9999);

        register_nav_menus(array(
            'primary' => esc_html__('Primary menu', 'twentytwentyone') ,
            'footer' => esc_html__('Secondary menu', 'twentytwentyone') ,
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        ));

        /*
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
        */
        $logo_width = 300;
        $logo_height = 100;

        add_theme_support('custom-logo', array(
            'height' => $logo_height,
            'width' => $logo_width,
            'flex-width' => true,
            'flex-height' => true,
            'unlink-homepage-logo' => true,
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');
        $background_color = get_theme_mod('background_color', 'D1E4DD');
        if (127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex($background_color))
        {
            add_theme_support('dark-editor-style');
        }

        $editor_stylesheet_path = './assets/css/style-editor.css';

        // Note, the is_IE global variable is defined by WordPress and is used
        // to detect if the current browser is internet explorer.
        global $is_IE;
        if ($is_IE)
        {
            $editor_stylesheet_path = './assets/css/ie-editor.css';
        }

        // Enqueue editor styles.
        add_editor_style($editor_stylesheet_path);

        // Add custom editor font sizes.
        add_theme_support('editor-font-sizes', array(
            array(
                'name' => esc_html__('Extra small', 'twentytwentyone') ,
                'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone') ,
                'size' => 16,
                'slug' => 'extra-small',
            ) ,
            array(
                'name' => esc_html__('Small', 'twentytwentyone') ,
                'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone') ,
                'size' => 18,
                'slug' => 'small',
            ) ,
            array(
                'name' => esc_html__('Normal', 'twentytwentyone') ,
                'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone') ,
                'size' => 20,
                'slug' => 'normal',
            ) ,
            array(
                'name' => esc_html__('Large', 'twentytwentyone') ,
                'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone') ,
                'size' => 24,
                'slug' => 'large',
            ) ,
            array(
                'name' => esc_html__('Extra large', 'twentytwentyone') ,
                'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone') ,
                'size' => 40,
                'slug' => 'extra-large',
            ) ,
            array(
                'name' => esc_html__('Huge', 'twentytwentyone') ,
                'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone') ,
                'size' => 96,
                'slug' => 'huge',
            ) ,
            array(
                'name' => esc_html__('Gigantic', 'twentytwentyone') ,
                'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone') ,
                'size' => 144,
                'slug' => 'gigantic',
            ) ,
        ));

        // Custom background color.
        add_theme_support('custom-background', array(
            'default-color' => 'd1e4dd',
        ));

        // Editor color palette.
        $black = '#000000';
        $dark_gray = '#28303D';
        $gray = '#39414D';
        $green = '#D1E4DD';
        $blue = '#D1DFE4';
        $purple = '#D1D1E4';
        $red = '#E4D1D1';
        $orange = '#E4DAD1';
        $yellow = '#EEEADD';
        $white = '#FFFFFF';

        add_theme_support('editor-color-palette', array(
            array(
                'name' => esc_html__('Black', 'twentytwentyone') ,
                'slug' => 'black',
                'color' => $black,
            ) ,
            array(
                'name' => esc_html__('Dark gray', 'twentytwentyone') ,
                'slug' => 'dark-gray',
                'color' => $dark_gray,
            ) ,
            array(
                'name' => esc_html__('Gray', 'twentytwentyone') ,
                'slug' => 'gray',
                'color' => $gray,
            ) ,
            array(
                'name' => esc_html__('Green', 'twentytwentyone') ,
                'slug' => 'green',
                'color' => $green,
            ) ,
            array(
                'name' => esc_html__('Blue', 'twentytwentyone') ,
                'slug' => 'blue',
                'color' => $blue,
            ) ,
            array(
                'name' => esc_html__('Purple', 'twentytwentyone') ,
                'slug' => 'purple',
                'color' => $purple,
            ) ,
            array(
                'name' => esc_html__('Red', 'twentytwentyone') ,
                'slug' => 'red',
                'color' => $red,
            ) ,
            array(
                'name' => esc_html__('Orange', 'twentytwentyone') ,
                'slug' => 'orange',
                'color' => $orange,
            ) ,
            array(
                'name' => esc_html__('Yellow', 'twentytwentyone') ,
                'slug' => 'yellow',
                'color' => $yellow,
            ) ,
            array(
                'name' => esc_html__('White', 'twentytwentyone') ,
                'slug' => 'white',
                'color' => $white,
            ) ,
        ));

        add_theme_support('editor-gradient-presets', array(
            array(
                'name' => esc_html__('Purple to yellow', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
                'slug' => 'purple-to-yellow',
            ) ,
            array(
                'name' => esc_html__('Yellow to purple', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
                'slug' => 'yellow-to-purple',
            ) ,
            array(
                'name' => esc_html__('Green to yellow', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
                'slug' => 'green-to-yellow',
            ) ,
            array(
                'name' => esc_html__('Yellow to green', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
                'slug' => 'yellow-to-green',
            ) ,
            array(
                'name' => esc_html__('Red to yellow', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
                'slug' => 'red-to-yellow',
            ) ,
            array(
                'name' => esc_html__('Yellow to red', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
                'slug' => 'yellow-to-red',
            ) ,
            array(
                'name' => esc_html__('Purple to red', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
                'slug' => 'purple-to-red',
            ) ,
            array(
                'name' => esc_html__('Red to purple', 'twentytwentyone') ,
                'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
                'slug' => 'red-to-purple',
            ) ,
        ));

        /*
         * Adds starter content to highlight the theme on fresh sites.
         * This is done conditionally to avoid loading the starter content on every
         * page load, as it is a one-off operation only needed once in the customizer.
        */
        if (is_customize_preview())
        {
            require get_template_directory() . '/inc/starter-content.php';
            add_theme_support('starter-content', twenty_twenty_one_get_starter_content());
        }

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Add support for custom line height controls.
        add_theme_support('custom-line-height');

        // Add support for experimental link color control.
        add_theme_support('experimental-link-color');

        // Add support for experimental cover block spacing.
        add_theme_support('custom-spacing');

        // Add support for custom units.
        // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
        add_theme_support('custom-units');

        // Remove feed icon link from legacy RSS widget.
        add_filter('rss_widget_feed_link', '__return_false');
    }
}
add_action('after_setup_theme', 'twenty_twenty_one_setup');

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Footer', 'twentytwentyone') ,
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'twenty_twenty_one_widgets_init');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
}
add_action('after_setup_theme', 'twenty_twenty_one_content_width', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts()
{
    // Note, the is_IE global variable is defined by WordPress and is used
    // to detect if the current browser is internet explorer.
    global $is_IE, $wp_scripts;
    if ($is_IE)
    {
        // If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
        wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array() , wp_get_theme()->get('Version'));
    }
    else
    {
        // If not IE, use the standard stylesheet.
        wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array() , wp_get_theme()
            ->get('Version'));
    }

    // RTL styles.
    wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');

    // Print styles.
    wp_enqueue_style('twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array() , wp_get_theme()
        ->get('Version') , 'print');

    // Threaded comment reply styles.
    if (is_singular() && comments_open() && get_option('thread_comments'))
    {
        wp_enqueue_script('comment-reply');
    }

    // Register the IE11 polyfill file.
    wp_register_script('twenty-twenty-one-ie11-polyfills-asset', get_template_directory_uri() . '/assets/js/polyfills.js', array() , wp_get_theme()
        ->get('Version') , true);

    // Register the IE11 polyfill loader.
    wp_register_script('twenty-twenty-one-ie11-polyfills', null, array() , wp_get_theme()
        ->get('Version') , true);
    wp_add_inline_script('twenty-twenty-one-ie11-polyfills', wp_get_script_polyfill($wp_scripts, array(
        'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
    )));

    // Main navigation scripts.
    if (has_nav_menu('primary'))
    {
        wp_enqueue_script('twenty-twenty-one-primary-navigation-script', get_template_directory_uri() . '/assets/js/primary-navigation.js', array(
            'twenty-twenty-one-ie11-polyfills'
        ) , wp_get_theme()->get('Version') , true);
    }

    // Responsive embeds script.
    wp_enqueue_script('twenty-twenty-one-responsive-embeds-script', get_template_directory_uri() . '/assets/js/responsive-embeds.js', array(
        'twenty-twenty-one-ie11-polyfills'
    ) , wp_get_theme()
        ->get('Version') , true);
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_scripts');

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script()
{

    wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js') , array(
        'wp-blocks',
        'wp-dom'
    ) , wp_get_theme()
        ->get('Version') , true);
}

add_action('enqueue_block_editor_assets', 'twentytwentyone_block_editor_script');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix()
{

    // If SCRIPT_DEBUG is defined and true, print the unminified file.
    if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG)
    {
        echo '<script>';
        include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
        echo '</script>';
    }
    else
    {
        // The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
        
?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
    }
}
add_action('wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix');

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages()
{
    $custom_css = twenty_twenty_one_get_non_latin_css('front-end');

    if ($custom_css)
    {
        wp_add_inline_style('twenty-twenty-one-style', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages');

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init()
{
    wp_enqueue_script('twentytwentyone-customize-helpers', get_theme_file_uri('/assets/js/customize-helpers.js') , array() , wp_get_theme()->get('Version') , true);

    wp_enqueue_script('twentytwentyone-customize-preview', get_theme_file_uri('/assets/js/customize-preview.js') , array(
        'customize-preview',
        'customize-selective-refresh',
        'jquery',
        'twentytwentyone-customize-helpers'
    ) , wp_get_theme()
        ->get('Version') , true);
}
add_action('customize_preview_init', 'twentytwentyone_customize_preview_init');

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts()
{

    wp_enqueue_script('twentytwentyone-customize-helpers', get_theme_file_uri('/assets/js/customize-helpers.js') , array() , wp_get_theme()
        ->get('Version') , true);
}
add_action('customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts');

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes()
{
    /**
     * Filters the classes for the main <html> element.
     *
     * @since Twenty Twenty-One 1.0
     *
     * @param string The list of classes. Default empty string.
     */
    $classes = apply_filters('twentytwentyone_html_classes', '');
    if (!$classes)
    {
        return;
    }
    echo 'class="' . esc_attr($classes) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class()
{
?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action('wp_footer', 'twentytwentyone_add_ie_class');

function pi_gis_scripts()
{
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(
        'jquery'
    ));
    wp_enqueue_script('fine-uploader', get_stylesheet_directory_uri() . '/assets/js/fine-uploader.js', array(
        'jquery'
    ));
    wp_enqueue_script('ol-script', get_stylesheet_directory_uri() . '/assets/js/ol.js', array(
        'jquery'
    ));
    wp_enqueue_script('layerswitcher-script', get_stylesheet_directory_uri() . '/assets/js/ol3-layerswitcher.js', array(
        'jquery'
    ));
    wp_enqueue_script('popup-script', get_stylesheet_directory_uri() . '/assets/js/ol-popup.js', array(
        'jquery'
    ));
    wp_enqueue_script('slick-script', get_stylesheet_directory_uri() . '/assets/js/slick.js', array(
        'jquery'
    ));

    wp_register_style('custom-styles', get_template_directory_uri() . '/assets/css/custom.css', 'all');
    wp_register_style('fine-uploader-new', get_template_directory_uri() . '/assets/css/fine-uploader-new.css', 'all');
    wp_register_style('ol-styles', get_template_directory_uri() . '/assets/css/ol.css', 'all');
    wp_register_style('layerswitcher-styles', get_template_directory_uri() . '/assets/css/ol3-layerswitcher.css', 'all');
    wp_register_style('ol-ext-styles', get_template_directory_uri() . '/assets/css/ol-ext.css', 'all');
    wp_register_style('slick-styles', get_template_directory_uri() . '/assets/css/slick.css', 'all');
    wp_enqueue_style('slick-styles');
    wp_enqueue_style('ol-ext-styles');
    wp_enqueue_style('custom-styles');
    wp_enqueue_style('fine-uploader-new');
    wp_enqueue_style('ol-styles');
    wp_enqueue_style('layerswitcher-styles');
}
add_action('wp_enqueue_scripts', 'pi_gis_scripts');

/*Thay đổi logo trang đăng nhập*/
function login_page_logo()
{
    echo '<style>.login h1 a {
background-repeat: no-repeat;
background-image: url(https://satlokhanhhoa.com/wp-content/uploads/2023/02/Logo_bd9c6_b496f.png);
background-position: center center;
background-size: contain !important;
width: 100% !important;
}
</style>';
}
add_action('login_head', 'login_page_logo');

/*Thay đổi link url logo trang đăng nhập*/
function login_page_URL($url)
{
    $url = home_url('/');
    return $url;
}
add_filter('login_headerurl', 'login_page_URL');

show_admin_bar(false);

 function admin_default_page() {
 	return '/quan-ly/';
   }
   add_filter('login_redirect', 'admin_default_page');

/**
 * Create A Simple Theme Options Panel
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
{
    exit;
}

// Start Class
if (!class_exists('WPEX_Theme_Options'))
{

    class WPEX_Theme_Options
    {

        public function __construct()
        {

            // We only need to register the admin panel on the back-end
            if (is_admin())
            {
                add_action('admin_menu', array(
                    'WPEX_Theme_Options',
                    'add_admin_menu'
                ));
                add_action('admin_init', array(
                    'WPEX_Theme_Options',
                    'register_settings'
                ));
            }

        }

        public static function get_theme_options()
        {
            return get_option('theme_options');
        }

        public static function get_theme_option($id)
        {
            $options = self::get_theme_options();
            if (isset($options[$id]))
            {
                return $options[$id];
            }
        }

        public static function add_admin_menu()
        {
            add_menu_page(esc_html__('Theme Settings', 'text-domain') , esc_html__('Theme Settings', 'text-domain') , 'manage_options', 'theme-settings', array(
                'WPEX_Theme_Options',
                'create_admin_page'
            ));
        }

        public static function register_settings()
        {
            register_setting('theme_options', 'theme_options', array(
                'WPEX_Theme_Options',
                'sanitize'
            ));
        }

        public static function sanitize($options)
        {

            // If we have options lets sanitize them
            if ($options)
            {

                // Checkbox
                if (!empty($options['checkbox_khancap']))
                {
                    $options['checkbox_khancap'] = 'on';
                }
                else
                {
                    unset($options['checkbox_khancap']); // Remove from options if not checked
                    
                }

            }

            // Return sanitized options
            return $options;

        }

        public static function create_admin_page()
        { ?>

			<div class="wrap">

				<h1><?php esc_html_e('Theme Options', 'text-domain'); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields('theme_options'); ?>

					<table class="form-table wpex-custom-admin-login-table">

						<?php // Checkbox example
             ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e('Ngập lụt khẩn cấp', 'text-domain'); ?></th>
							<td>
								<?php $value = self::get_theme_option('checkbox_khancap'); ?>
								<input type="checkbox" name="theme_options[checkbox_khancap]" <?php checked($value, 'on'); ?>> <?php esc_html_e('Check vào đây để bật trạng thái báo sạt lở.', 'text-domain'); ?>
							</td>
						</tr>


					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php
        }

    }
}
new WPEX_Theme_Options();

// Helper function to use in your theme to return a theme option value
function myprefix_get_theme_option($id = '')
{
    return WPEX_Theme_Options::get_theme_option($id);
}

function so_lieu_create()
{

    global $wpdb;
    $table_name = $wpdb->prefix . "so_lieu";
    global $charset_collate;
    $charset_collate = $wpdb->get_charset_collate();
    global $db_version;

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name)
    {
        $create_sql_sl = "CREATE TABLE " . $table_name . " (
					so_lieu_id INT(11) NOT NULL auto_increment,
					so_lieu_url varchar(255) DEFAULT NULL ,
					create_date datetime NOT NULL,
					PRIMARY KEY (so_lieu_id))$charset_collate;";
    }
    require_once (ABSPATH . "wp-admin/includes/upgrade.php");
    dbDelta($create_sql_sl);

    //register the new table with the wpdb object
    if (!isset($wpdb->so_lieu))
    {
        $wpdb->so_lieu = $table_name;
        //add the shortcut so you can use $wpdb->stats
        $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
    }

}
add_action('init', 'so_lieu_create');

function aff_upload_images_dir($dir)
{
    return array(
        'path' => $dir['basedir'] . '/gis_solieu',
        'url' => $dir['baseurl'] . '/gis_solieu',
        'subdir' => '/gis_solieu',
    ) + $dir;
}

if (!function_exists('wpcfu_output_file_upload_form'))
{

    /**
     * Output the form.
     *
     * @param      array  $atts   User defined attributes in shortcode tag
     */
    function wpcfu_output_file_upload_form($atts)
    {
        $atts = shortcode_atts(array() , $atts);

        $html = '';

        $html = '<div class="display-ql">';
        $html .= '<form name="wpcfu-form" class="wpcfu-form" action="#" method="POST" enctype="multipart/form-data">';
        $html .= '<p class="form-field first-xl">';
        $html .= '<input type="file" name="wpcfu_file" id="wpcfu_file" required accept=".xlsx">';
        $html .= '</p>';
        $html .= '<p class="form-field last-xl">';
        // Output the nonce field
        $html .= wp_nonce_field('upload_wpcfu_file', 'wpcfu_nonce', true, false);
        $html .= '<input type="submit" class="but-xl-bot" name="submit_wpcfu_form" value="' . esc_html__('Đọc dữ liệu', 'theme-text-domain') . '">';
        $html .= '</form>';




        $html .= '<form id="hieuchinh-form" name="hieuchinh-form" class="hieuchinh-form" action="#" method="POST" enctype="multipart/form-data">';
        $html .= '<p class="form-field first-xl">';
        $html .= '<label for="correctionValue">Nhập số hiệu chỉnh (mm):</label>';
        $html .= '<input type="number" id="correctionValue" name="correctionValue" value="0">';
        $html .= '</p>';
        $html .= '<p class="form-field last-xl">';
        $html .= '<input type="submit" class="but-xl-bot" id="submit_data" name="submit_data" value="Hiệu chỉnh và lưu dữ liệu mưa">';
        $html .= '</p>';
        $html .= '</form>';
        


        $html .= '<form id="generatemaps-form" name="generatemaps-form" class="generatemaps-form" action="#" method="POST" enctype="multipart/form-data">';
        $html .= '<input type="submit" class="but-xl-bot" id="submit_read_data" name="submit_read_data" value="Truy vấn dữ liệu mưa">';
        //$html .= '<p class="form-field first-xl">';
        $html .= '<label class="myLabel"><input type="checkbox" id="sure" name="sure" onClick="document.getElementById(' . "'submit_calculate_shapefile'" . ').disabled = !document.getElementById(' . "'sure'" . ').checked;"> Đã kiểm tra và xác nhận dữ liệu chính xác</label><br>';
        //$html .= '</p>';
        $html .= '<p class="form-field last-xl">';
        $html .= '<input type="submit" class="but-xl-bot" id="submit_calculate_shapefile" name="submit_calculate_shapefile" value="Tính toán và cập nhật lên bản đồ" disabled>';

        $html .= '</p>';
        $html .= '</form>';
        $html .= '</div>';

        echo $html;
    }
}

/**
 * Add the shortcode '[wpcfu_form]'.
 */
add_shortcode('wpcfu_form', 'wpcfu_output_file_upload_form');

// Insert when submission GIS new
add_shortcode('show_table', 'submission_solieu_new_func');
function build_table($array, $keys = []){
    $html = '<table class="styled-table">';
    $html .= '<thead>';
    $html .= '<tr>';
    if (count($keys) > 0){
        foreach($keys as $value){
                $html .= '<th>' . htmlspecialchars($value) . '</th>';
        }
    }
    else{
        for ($i = 1; $i <= count($array[0]); $i++){
            $html .= '<th>Collumn_' . $i . '</th>';
        }
    }
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';
    return $html;
};
function secondsToTime($s){
    $h = floor($s / 3600);
    $s -= $h * 3600;
    $m = floor($s / 60);
    $s -= $m * 60;
    return ($h == 0)? (($m == 0)? sprintf('%02ds', $s): sprintf('%02dm', $m).':'.sprintf('%02ds', $s)): $h.'h:'.sprintf('%02dm', $m).':'.sprintf('%02ds', $s);
}
function logX($tmp){
    $milliseconds = date('Y-m-d  H:i:s.') . substr(gettimeofday()['usec'],0,2);
    echo $milliseconds . ': ' . $tmp . '<br>';
}
function submission_solieu_new_func()
{
    global $wpdb;
    $path_p = 'C:/WebGIS-OpenSource/satlokhanhhoa.com';
    if (isset($_POST['submit_wpcfu_form'])){
        echo "<hr>";
        $table_name_sp = $wpdb->prefix . 'so_lieu';

        $so_lieu_create_date = date('dmy');
        //$so_lieu_url = $_POST['wpcfu_file'];
        //var_dump($so_lieu_create_date);
        $file = $_FILES['wpcfu_file']['name'];

        //Lấy phần mở rộng của file (txt, jpg, png,...)
        $fileType = pathinfo($file, PATHINFO_EXTENSION);
        //Những loại file được phép upload
        $allowtypes    = array('xlsx');
        //2. Kiểm tra loại file upload có được phép không?
        if (!in_array($fileType, $allowtypes )) {
            echo "<br>Only allow for uploading .xlsx";
            return 'FILE_EXTENSION_ERROR';
        //$allowUpload = false;
        }else{
            //var_dump($file);
            if (!function_exists('wp_handle_upload'))
            {
                require_once (ABSPATH . 'wp-admin/includes/file.php');
            }
            add_filter('upload_dir', 'aff_upload_images_dir');
            $upload_overrides = array(
                'test_form' => false,
                'unique_filename_callback' => 'my_cust_filename'
            );
            $result = wp_handle_upload($_FILES['wpcfu_file'], array(
                'test_form' => false
            ));

            if ($result && !isset($result['error']))
            {
                $filename = $result['file'];
                $so_lieu_url = basename($filename);
            }

            remove_filter('upload_dir', 'aff_upload_images_dir');

            // Log for order completed
            $wpdb->insert($table_name_sp, array(
                'create_date' => $so_lieu_create_date,
                'so_lieu_url' => '/wp-content/uploads/gis_solieu/' . $so_lieu_url,
            ));

            //echo '<p class="bt-name-file-new" style="display:none;">File tải lên mới nhất: ' . $so_lieu_url . '</p>';
        }

        //Nhúng file PHPExcel
        //require_once (ABSPATH . 'wp-content/themes/gistheme/PHPExcel/Classes/PHPExcel.php');
        require_once (ABSPATH . 'wp-content/themes/gistheme/vendor/autoload.php');
        //Read EXCEL FILE
        $p_dulieu = $wpdb->get_results("SELECT so_lieu_url FROM wp_so_lieu ORDER BY so_lieu_id DESC LIMIT 1", 'ARRAY_A');
		logX('File name: ' . $so_lieu_url);
        
        //Đường dẫn file
		$p_dulieu1 = $p_dulieu[0];
        $file = $path_p . '' . $p_dulieu1['so_lieu_url'];
		$inputFileName = $file;
		/** Load $inputFileName to a Spreadsheet Object  **/
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		logX('Reading data...');
		$sheetCount = $spreadsheet->getSheetCount(); 
		$sheetNames = $spreadsheet->getSheetNames();
		logX('Sheet count: ' . $sheetCount);
        $sheetName = 'X1hKhanhHoa';
        $sheet = $spreadsheet->getSheetByName($sheetName);
        if ($sheet === null){
            logX('ERROR: Sheet ' . $sheetName . ' not found!');
            return 'READ_FILE_ERROR';
        }
        else{
            logX('Sheet ' . $sheetName .' found! Sheet index: ' . $spreadsheet->getIndex($sheet));
        }
        $sheetData = array();
        //Lấy ra số dòng cuối cùng
        $Totalrow = $sheet->getHighestDataRow();
        //Lấy ra tên cột cuối cùng
        $LastColumn = $sheet->getHighestDataColumn();
        logX('Total row: ' . $Totalrow . ' - Last collumn: ' . $LastColumn);
        logX('Reading data from range [A1:' . $LastColumn . $Totalrow . ']');
        $sheetData = $sheet->rangeToArray('A1:' . $LastColumn . $Totalrow, null, false, false, false);

        $tempX = $sheetData[0];
        $LastColumnDataIndex = count($tempX) - 1;
        while ($tempX[$LastColumnDataIndex] == null){
            $LastColumnDataIndex -= 1;
        }
        
        logX('LastColumnDataIndex: ' . $LastColumnDataIndex);
        $LastColumnDataIndex -= 1;
        logX('LastColumnDataIndex to calculate: ' . $LastColumnDataIndex);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        logX('Set zone name: ' . date_default_timezone_get() . '. Time is: ' . date('d/m/Y h:i:s A', time()));

        $timeToCalculate = substr($tempX[$LastColumnDataIndex],2, 2) . ':00 ' . substr($tempX[$LastColumnDataIndex], 0, 2) . date('/m/Y', time());
        //logX('Time to calculate: ' . $timeToCalculate);
        $rainfallData = array();
        $calcutaionID = date('YmdHis');
        $rainfallValues = '';
        for ($i = 1; $i < count($sheetData); $i++){
            $rainfallData[$i][0] = $sheetData[$i][0]; //ID
            $rainfallData[$i][1] = $sheetData[$i][1]; //Name
            $rainfallData[$i][2] = $sheetData[$i][2]; //Addr
            $_1hour = 0;
            $_6hours = 0;
            $_1day = 0;
            $_5days = 0;

            $stationID = $rainfallData[$i][0];
            $_1hour = $sheetData[$i][$LastColumnDataIndex];

            $j = 1;
            $_6hours = $_1hour;
            while ($j < 6){
                $_6hours += $sheetData[$i][$LastColumnDataIndex - $j];
                $j += 1;
            }
            $_1day = $_6hours;
            while ($j < 24){
                $_1day += $sheetData[$i][$LastColumnDataIndex - $j];
                $j += 1;
            }
            $_5days = $_1day;
            //Uncomment when data is OK
            while ($j < 24 * 5){
                if($LastColumnDataIndex - $j >= 3){
                    $_5days += $sheetData[$i][$LastColumnDataIndex - $j];
                    $j += 1;
                }
                else{
                    break;
                }
            }
            $rainfallData[$i][3] = $_1hour;
            $rainfallData[$i][4] = $_6hours;
            $rainfallData[$i][5] = $_1day;
            $rainfallData[$i][6] = $_5days;

            $rainfallValues .= "('" . $stationID . "', '" . $calcutaionID . "', " . $_1hour . ", " . $_6hours . ", " . $_1day . ", " . $_5days . "), ";
        }
        if ($LastColumnDataIndex - 24 * 5 < 3){
            logX('WARNING: Data is not enough for 5 days rainfall calculation!');
        }

        $columns = 'stationID, calculationID, rainfall1hour, rainfall6hours, rainfall1day, rainfall5days';
        $rainfallValues = rtrim($rainfallValues,", ");
        //Delete all old data
        $sql = "TRUNCATE wp_rainfall_data_tmp;";
        $resultX = $wpdb->query($sql);
        //Insert new data
        $sql = "INSERT INTO wp_rainfall_data_tmp($columns) VALUES $rainfallValues;";
        $resultX = $wpdb->query($sql);
        //logX($sql);
        //logX('Insert: ' . $resultX);
        logX('calcutaion ID: ' . $calcutaionID);
        if ($resultX === false){
            logX('ERROR: Cannot insert rainfall data to database!');
            return 'INSERT_DATA_ERROR';
        }
        elseif($resultX < count($rainfallData)){
            logX('Number of record in Excel: ' . count($rainfallData));
            logX('Number of record inserted: ' . $resultX);
            logX('ERROR: ' . count($rainfallData) - $resultX . 'record(s) were not inserted to database!');
        }
        else{
            logX('SUCCESS: Number of record inserted: ' . $resultX);
        }

        $sql = "SELECT wp_station_list.stationID, 
                wp_station_list.stationName2, 
                wp_station_list.stationLong, 
                wp_station_list.stationLat, 
                wp_rainfall_data_tmp.calculationID, 
                wp_rainfall_data_tmp.rainfall1hour, 
                wp_rainfall_data_tmp.rainfall6hours, 
                wp_rainfall_data_tmp.rainfall1day, 
                wp_rainfall_data_tmp.rainfall5days 
                
                FROM wp_station_list, wp_rainfall_data_tmp 
                WHERE wp_rainfall_data_tmp.stationID = wp_station_list.stationID;";

        $queryRainfallData = $wpdb->get_results($sql, 'ARRAY_A');
        //logX($sql);
        echo build_table($queryRainfallData,['stationID', 'stationName', 'Long', 'Lat', 'calculationID', 'rainfall1hour', 'rainfall6hours', 'rainfall1day', 'rainfall5days']);
        return 'READ_FILE_SUCCESS';

    }
    elseif (isset($_POST['submit_data'])){
        echo "<hr>";

        //Delete old data has the same calculationID with tmp from main table
        $lastestID = $wpdb->get_var('SELECT calculationID FROM wp_rainfall_data_tmp LIMIT 1;');
        logX('Lastest calculation ID: ' . $lastestID);
        $sql = "DELETE FROM wp_rainfall_data
                WHERE calculationID = $lastestID";
        $rs = $wpdb->query($sql);
        if($rs === false){
            logX('ERROR: Cannot delete old data from main table which has calculationID = ' . $lastestID);
            return 'DELETE_OLD_RECORD_ERROR';
        }
        logX('INFO: ' . $rs . ' old record(s) with calculation iD ' . $lastestID . ' has been deleted from main table!');

        //Set the correction values
        $correctionValue = 0;
        $correctionValue = $_POST['correctionValue'];
        logX('correctionValue: ' . $correctionValue);
        $sql = "UPDATE wp_rainfall_data_tmp SET 
                rainfall1hour = rainfall1hour + $correctionValue,
                rainfall6hours = rainfall6hours + $correctionValue,
                rainfall1day = rainfall1day + $correctionValue,
                rainfall5days = rainfall5days + $correctionValue;";
        logx("Updating data to main table...");
        $queryRainfallData = $wpdb->query($sql);
        if ($queryRainfallData === false){
            logX('ERROR: Cannot update data from tmp table!');
            return 'UPDATE_DATA_ERROR';
        }
        //Push all data from tmp table to main table
        //Please ensure that 2 tables have the same structure
        $sql = "INSERT INTO wp_rainfall_data (stationID, calculationID, rainfall1hour, rainfall6hours, rainfall1day, rainfall5days)
                SELECT stationID, calculationID, rainfall1hour, rainfall6hours, rainfall1day, rainfall5days
                FROM wp_rainfall_data_tmp;";
        $queryRainfallData = $wpdb->query($sql);
        if ($queryRainfallData === false){
            logX('ERROR: Cannot push data to main table!');
            return 'PUSH_DATA_ERROR';
        }
        //Get the latest data from main table
        $sql = "SELECT wp_station_list.stationID, 
                wp_station_list.stationName2, 
                wp_station_list.stationLong, 
                wp_station_list.stationLat, 
                wp_rainfall_data.calculationID, 
                wp_rainfall_data.rainfall1hour, 
                wp_rainfall_data.rainfall6hours, 
                wp_rainfall_data.rainfall1day, 
                wp_rainfall_data.rainfall5days 
                
                FROM wp_station_list, wp_rainfall_data 
                WHERE wp_rainfall_data.stationID = wp_station_list.stationID AND  
                wp_rainfall_data.calculationID = (SELECT MAX(calculationID) FROM wp_rainfall_data);";
        //logX($sql);
        logX('SUCCESS: Updated data to main table! The lastest data below: ');
        $queryRainfallData = $wpdb->get_results($sql, 'ARRAY_A');
        echo build_table($queryRainfallData,['stationID', 'stationName', 'Long', 'Lat', 'calculationID', 'rainfall1hour', 'rainfall6hours', 'rainfall1day', 'rainfall5days']);
        return 'UPDATE_DATA_SUCESS';
    }
    elseif (isset($_POST['submit_read_data'])){
        echo "<hr>";

        logX('Loading rainfall information from database...');
        $rainfallData = $wpdb->get_results("
            SELECT wp_station_list.stationID, 
            wp_station_list.stationName2, 
            wp_station_list.stationLong, 
            wp_station_list.stationLat, 
            wp_rainfall_data.calculationID, 
            wp_rainfall_data.rainfall1hour, 
            wp_rainfall_data.rainfall6hours, 
            wp_rainfall_data.rainfall1day, 
            wp_rainfall_data.rainfall5days 
            
            FROM wp_station_list, wp_rainfall_data 
            WHERE wp_rainfall_data.stationID = wp_station_list.stationID AND  
            wp_rainfall_data.calculationID = (SELECT MAX(calculationID) FROM wp_rainfall_data);", 'ARRAY_A');
        if ($rainfallData === false){
            logX('There is no record in database!');
            return 'NO_RECORD_ERROR';
        };
        echo build_table($rainfallData,['stationID', 'stationName', 'Long', 'Lat', 'calculationID', 'rainfall1hour', 'rainfall6hours', 'rainfall1day', 'rainfall5days']);
        return 'READ_DATA_SUCCESS';
    }
    elseif (isset($_POST['submit_calculate_shapefile'])){
        echo "<hr>";
        $starttime = microtime(true);
        //Calculate CapdoRR
        logX('Loading rainfall information from database...');
        $rainfallData = $wpdb->get_results("
            SELECT wp_station_list.stationID, 
            wp_station_list.stationName2, 
            wp_station_list.stationLong, 
            wp_station_list.stationLat, 
            wp_rainfall_data.rainfall1hour, 
            wp_rainfall_data.rainfall6hours, 
            wp_rainfall_data.rainfall1day, 
            wp_rainfall_data.rainfall5days 
            
            FROM wp_station_list, wp_rainfall_data 
            WHERE wp_rainfall_data.stationID = wp_station_list.stationID AND  
            wp_rainfall_data.calculationID = (SELECT MAX(calculationID) FROM wp_rainfall_data);", 'ARRAY_A');
        if ($rainfallData === false){
            logX('There is an error when getting data from database!');
            return 'GET_DATA_ERROR';
        };
        if ($rainfallData === 0){
            logX('There is no record in database!');
            return 'NO_RECORD_ERROR';
        };

        $basePath   = 'C:\WebGIS-OpenSource\DataWebGIS\SatLoKhanhHoa\baseMap.shp';
        //$basePath   = 'C:\WebGIS-OpenSource\DataWebGIS\SatLoKhanhHoa\baseMapDropedZM.shp';
        //$basePath2   = 'C:\WebGIS-OpenSource\DataWebGIS\SatLoKhanhHoa\baseMap2.shp';
        $targetPath = 'C:\WebGIS-OpenSource\DataWebGIS\SatLoKhanhHoa\calculatedMap.shp';
        logX('Reading shapefile...');

        require_once(ABSPATH . 'wp-content\themes\gistheme\vendor\php-shapefile\src\Shapefile\ShapefileAutoloader.php');
        \Shapefile\ShapefileAutoloader::register();

        try {
            // Open Shapefile
            $Shapefile = new \Shapefile\ShapefileReader($basePath, 
            [\Shapefile\Shapefile::OPTION_POLYGON_CLOSED_RINGS_ACTION => \Shapefile\Shapefile::ACTION_FORCE,
            \Shapefile\Shapefile::OPTION_DBF_NULL_PADDING_CHAR => '',
            ]);
            $tot = $Shapefile->getTotRecords();
            logX('Total records: ' . $tot);

            $targetShapefile = new \Shapefile\ShapefileWriter($targetPath, [
                \Shapefile\Shapefile::OPTION_EXISTING_FILES_MODE => \Shapefile\Shapefile::MODE_OVERWRITE,
                \Shapefile\Shapefile::OPTION_ENFORCE_GEOMETRY_DATA_STRUCTURE => false,
                \Shapefile\Shapefile::OPTION_BUFFERED_RECORDS => 500, 
            ]);
            logX('Setting shape type...');
            $targetShapefile->setShapeType($Shapefile->getShapeType());
 
            logX('Setting bounding box...');
            $targetShapefile->setCustomBoundingBox($Shapefile->getBoundingBox());
            logX('Setting PRJ...');
            $targetShapefile->setPRJ($Shapefile->getPRJ());
            $fns = $Shapefile->getFields();

            logX('Adding fields...');
            foreach ($fns as $key=>$value){
                $targetShapefile->addField($key, $value['type'], $value['size'], $value['decimals']);
            }
            
            logX('Calculating fields...');
            for ($i = 1; $i <= $tot; $i++) {
            //foreach ($Shapefile as $i => $Geometry) {
                try {
                    // Manually set current record. Don't forget this!
                    $Shapefile->setCurrentRecord($i);
                    // Fetch a Geometry
                    try{
                        $Geometry = $Shapefile->fetchRecord();
                        // Skip deleted records
                        if ($Geometry->isDeleted()) {
                            //logX(' > Deleted!');
                            continue;
                        }
                        else{
                            // if ($i % 1000 == 0 || $i == $tot){
                            //     logX('Calculating... ' . $i);
                            // }

                            //Get feature info
                            $Kinhdo    = $Geometry->getData('KINHDO');
                            $Vido      = $Geometry->getData('VIDO');
                            $Tinhnhay  = $Geometry->getData('TINHNHAY');
                            $Chongchiu = $Geometry->getData('CHONGCHIU');
                            $Phoinhiem = $Geometry->getData('PHOINHIEM');
                            $CsDoc     = $Geometry->getData('CSDOC');
                            $CsTnhuong = $Geometry->getData('CSTNHUONG');
                            $CsDc      = $Geometry->getData('CSDC');

                            //----------------------------------------------------------------------------------
                            //Calculate rainfall base on Invert distance weight
                            //----------------------------------------------------------------------------------
                            //1. Calculate total invert distance: totalInvertDistance = 1/d1 + 1/d2 + 1/d3 + ...
                            $totalInvertDistance = 0;
                            $distance = 0;
                            foreach ($rainfallData as $rfData){
                                $distance = sqrt(pow($Kinhdo - $rfData['stationLong'], 2) + pow($Vido - $rfData['stationLat'], 2)); 
                                $totalInvertDistance += 1.0 / $distance;
                            }
                            //2. Calculate correction rainfall: Rainfall = p1 * alpha1 + p2 * alpha2 + ...
                            $alpha = 0;
                            $_1hour = 0;
                            $_6hours = 0;
                            $_1day = 0;
                            $_5days = 0;
                            foreach ($rainfallData as $rfData){
                                $distance = sqrt(pow($Kinhdo - $rfData['stationLong'], 2) + pow($Vido - $rfData['stationLat'], 2)); 
                                $alpha = (1.0 / $distance) / $totalInvertDistance;
                                $_1hour += $alpha * $rfData['rainfall1hour'];
                                $_6hours += $alpha * $rfData['rainfall6hours'];
                                $_1day += $alpha * $rfData['rainfall1day'];
                                $_5days += $alpha * $rfData['rainfall5days'];
                            }
                            //3. Calculate CsMua, Hiemhoa, CapdoRR
                            $CsMua = 0.1 * ($_5days / 1500) + 0.3 * ($_1day / 1000) + 0.4 * ($_6hours / 600) + 0.2 * ($_1hour / 350);
                            $Hiemhoa =  0.2 * $CsDoc + 0.1 * $CsTnhuong + 0.35 * $CsDc + 0.35 * $CsMua;
                            $Tonthuong = 0.6 * $Tinhnhay + 0.4 * $Chongchiu;
                            $CsRR = 0.25 * $Tonthuong + 0.35 * $Hiemhoa + 0.4 * $Phoinhiem;
                            //4. Calculate CapdoRR
                            $CapdoRR = 3;   //default value
                            if ($CsRR < 0.1){
                                $CapdoRR = 0;
                            }
                            elseif($CsRR < 0.3){
                                $CapdoRR = 1;
                            }
                            elseif($CsRR < 0.7){
                                $CapdoRR = 2;
                            };
                            //5. Update calculated data to shapefile
                            $Geometry->setData('X5ngay', round($_5days,3));
                            $Geometry->setData('X1ngay', round($_1day,3));
                            $Geometry->setData('X6gio', round($_6hours,3));
                            $Geometry->setData('X1gio', round($_1hour,3));
                            $Geometry->setData('CsMua', round($CsMua,3));
                            $Geometry->setData('Hiemhoa', round($Hiemhoa,3));
                            $Geometry->setData('Tonthuong', round($Tonthuong,3));
                            $Geometry->setData('CsRR', round($CsRR,3));
                            $Geometry->setData('CapdoRR', $CapdoRR);
                            $targetShapefile->writeRecord($Geometry);
                        }
                    }
                    catch (\Shapefile\ShapefileException $e) {
                        logX('Domething is wrong1!');
                        logX("Error Type: " . $e->getErrorType());
                        logX("Error Message: " . $e->getMessage());
                        logX("Error Details: " . $e->getDetails());
                        return $e->getErrorType() . "_ERROR1";
                    }
                } catch (\Shapefile\ShapefileException $e) {
                    // Handle some specific errors types or fallback to default
                    logX('Something is wrong 2!');
                    switch ($e->getErrorType()) {
                        // We're crazy and we don't care about those invalid geometries... Let's skip them!
                        case \Shapefile\Shapefile::ERR_GEOM_RING_AREA_TOO_SMALL:
                        case \Shapefile\Shapefile::ERR_GEOM_RING_NOT_ENOUGH_VERTICES:
                            // The following "continue" statement is just syntactic sugar in this case
                            continue;
                            break;
                        // Let's handle this case differently... :)
                        case \Shapefile\Shapefile::ERR_GEOM_POLYGON_WRONG_ORIENTATION:
                            exit("Do you want the Earth to change its rotation direction?!?");
                            break;
                            
                        // A fallback is always a nice idea
                        default:
                            exit(
                                "Error Type: "  . $e->getErrorType()
                                . "\nMessage: " . $e->getMessage()
                                . "\nDetails: " . $e->getDetails()
                            );
                            break;
                    }
                    return $e->getErrorType() . "_ERROR2";
                }
            }

        } catch (\Shapefile\ShapefileException $e) {
            logX('Something is wrong 3!');
            logX("Error Type: " . $e->getErrorType());
            logX("Error Message: " . $e->getMessage());
            logX("Error Details: " . $e->getDetails());
            return $e->getErrorType() . "_ERROR3";
        }

        $targetShapefile = null;

        $endtime = microtime(true);
        logX('Time to process: ' . secondsToTime($endtime - $starttime));

        return 'UPDATE_SHAPEFILE_SUCCESS';
    }
    elseif (isset($_POST['submit_calculate'])){
        echo "<hr>";
        return 'JSON_NOT_SUPPORT_ERROR';
        $starttime = microtime(true);
        //Calculate CapdoRR
        logX('Loading rainfall information from database...');
        $rainfallData = $wpdb->get_results("
            SELECT wp_station_list.stationID, 
            wp_station_list.stationName2, 
            wp_station_list.stationLong, 
            wp_station_list.stationLat, 
            wp_rainfall_data.rainfall1hour, 
            wp_rainfall_data.rainfall6hours, 
            wp_rainfall_data.rainfall1day, 
            wp_rainfall_data.rainfall5days 
            
            FROM wp_station_list, wp_rainfall_data 
            WHERE wp_rainfall_data.stationID = wp_station_list.stationID AND  
            wp_rainfall_data.calculationID = (SELECT MAX(calculationID) FROM wp_rainfall_data);", 'ARRAY_A');
        if ($rainfallData === false){
            logX('There is no record in database!');
            return 'NO_RECORD_ERROR';
        };
        $basePath = $path_p . '/wp-content/uploads/mapdata/base.geojson';
        $targetPath = $path_p . '/wp-content/uploads/mapdata/target.geojson';
        logX('Reading json file...');
        $json = json_decode(file_get_contents($basePath),TRUE);
        $totalFeature = count($json['features']);
        logX('Number of feature: ' . $totalFeature);
        logX('Calculating data...');
        
        $ii = 0;
        foreach ($json['features'] as $feature){
            //Get feature info
            $Kinhdo    = $feature['properties']['Kinhdo'];     
            $Vido      = $feature['properties']['Vido'];
            $Tinhnhay  = $feature['properties']['Tinhnhay'];
            $Chongchiu = $feature['properties']['Chongchiu'];
            $Phoinhiem = $feature['properties']['Phoinhiem'];
            $CsDoc     = $feature['properties']['CsDoc'];
            $CsTnhuong = $feature['properties']['CsTnhuong'];
            $CsDc      = $feature['properties']['CsDc'];
            //----------------------------------------------------------------------------------
            //Calculate rainfall base on Invert distance weight
            //----------------------------------------------------------------------------------
            //1. Calculate total invert distance: totalInvertDistance = 1/d1 + 1/d2 + 1/d3 + ...
            $totalInvertDistance = 0;
            $distance = 0;
            foreach ($rainfallData as $rfData){
                $distance = sqrt(pow($Kinhdo - $rfData['stationLong'], 2) + pow($Vido - $rfData['stationLat'], 2)); 
                $totalInvertDistance += 1.0 / $distance;
            }
            //2. Calculate correction rainfall: Rainfall = p1 * alpha1 + p2 * alpha2 + ...
            $alpha = 0;
            $_1hour = 0;
            $_6hours = 0;
            $_1day = 0;
            $_5days = 0;
            foreach ($rainfallData as $rfData){
                $distance = sqrt(pow($Kinhdo - $rfData['stationLong'], 2) + pow($Vido - $rfData['stationLat'], 2)); 
                $alpha = (1.0 / $distance) / $totalInvertDistance;
                $_1hour += $alpha * $rfData['rainfall1hour'];
                $_6hours += $alpha * $rfData['rainfall6hours'];
                $_1day += $alpha * $rfData['rainfall1day'];
                $_5days += $alpha * $rfData['rainfall5days'];
            }
            //3. Calculate CsMua, Hiemhoa, CapdoRR
            $CsMua = 0.1 * ($_5days / 1500) + 0.3 * ($_1day / 1000) + 0.4 * ($_6hours / 600) + 0.2 * ($_1hour / 350);
            $Hiemhoa =  0.2 * $CsDoc + 0.1 * $CsTnhuong + 0.35 * $CsDc + 0.35 * $CsMua;
            $Tonthuong = 0.6 * $Tinhnhay + 0.4 * $Chongchiu;
            $CsRR = 0.25 * $Tonthuong + 0.35 * $Hiemhoa + 0.4 * $Phoinhiem;
            //4. Calculate CapdoRR
            $CapdoRR = 3;   //default value
            if ($CsRR < 0.1){
                $CapdoRR = 0;
            }
            elseif($CsRR < 0.3){
                $CapdoRR = 1;
            }
            elseif($CsRR < 0.7){
                $CapdoRR = 2;
            };
            //5. Update calculated data to json
            $json['features'][$ii]['properties']['X5ngay'] = $_5days;
            $json['features'][$ii]['properties']['X1ngay'] = $_1day;
            $json['features'][$ii]['properties']['X6gio'] = $_6hours;
            $json['features'][$ii]['properties']['X1gio'] = $_1hour;
            $json['features'][$ii]['properties']['CsMua'] = $CsMua;
            $json['features'][$ii]['properties']['Hiemhoa'] = $Hiemhoa;
            $json['features'][$ii]['properties']['Tonthuong'] = $Tonthuong;
            $json['features'][$ii]['properties']['CsRR'] = $CsRR;
            $json['features'][$ii]['properties']['CapdoRR'] = $CapdoRR;

            $ii += 1;
        }

        $endtime1 = microtime(true);
        logX('Time to calculate: ' . secondsToTime($endtime1 - $starttime));

        logX('Writing data to json file...');
        $rs = file_put_contents($targetPath, json_encode($json));

        if ($rs === false){
            logX('Failed to write JSON file!');
            return 'UPDATE_JSON_ERROR';
        }
        logX('Success! New JSON file size: ' . round($rs / 1024 / 1024, 3) . ' MB.');
        $endtime2 = microtime(true);
        logX('Time to write JSON file: ' . secondsToTime($endtime2 - $endtime1));
        logX('Total processing time: ' . secondsToTime($endtime2 - $starttime));
        return 'UPDATE_JSON_SUCCESS';
    }
    
}

//                       _oo0oo_
//                      o8888888o
//                      88" . "88
//                      (| -_- |)
//                      0\  =  /0
//                    ___/`---'\___
//                  .' \\|     |// '.
//                 / \\|||  :  |||// \
//                / _||||| -:- |||||- \
//               |   | \\\  -  /// |   |
//               | \_|  ''\---/''  |_/ |
//               \  .-\__  '-'  ___/-. /
//             ___'. .'  /--.--\  `. .'___
//          ."" '<  `.___\_<|>_/___.' >' "".
//         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
//         \  \ `_.   \_ __\ /__ _/   .-` /  /
//     =====`-.____`.___ \_____/___.-`___.-'=====
//                       `=---='
//
//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//            Phật phù hộ, không bao giờ BUG
//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~