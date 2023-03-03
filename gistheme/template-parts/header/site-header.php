<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>

<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">

	<?php get_template_part( 'template-parts/header/site-branding' ); ?>
	<a href="https://satlokhanhhoa.com/" class="l-title cc">
		<span class="small-text">SỞ KHOA HỌC VÀ CÔNG NGHỆ TỈNH KHÁNH HÒA - ĐÀI KHÍ TƯỢNG THỦY VĂN KHU VỰC NAM TRUNG BỘ</span><span class="big-text">CÔNG CỤ GIÁM SÁT, CẢNH BÁO SẠT LỞ ĐẤT, ĐÁ DO MƯA TỈNH KHÁNH HÒA</span>
		
	</a>

	<?php get_template_part( 'template-parts/header/site-nav' ); ?>



</header><!-- #masthead -->
