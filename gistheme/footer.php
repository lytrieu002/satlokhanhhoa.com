<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->


	<footer id="colophon" class="site-footer">
	
	</footer><!-- #colophon -->

</div><!-- #page -->
<script>
jQuery( document ).ready(function($) {
$('.thuongxuyen a').click(function(e){
      var kb1= $(this).attr( "title" );
      console.log(kb1);
      e.preventDefault;
    });
	$('.kothuongxuyen2020 a').click(function(e){
      var kb2= $(this).attr( "title" );
      console.log(kb2);
      e.preventDefault;
    });
	$('.kothuongxuyen2030 a').click(function(e){
      var kb3= $(this).attr( "title" );
      console.log(kb3);
      e.preventDefault;
    });
	$('.bdkh_rcp60 a').click(function(e){
      var kb4= $(this).attr( "title" );
      console.log(kb4);
      e.preventDefault;
    });
	$('.bdkh_rcp85 a').click(function(e){
      var kb5= $(this).attr( "title" );
      console.log(kb5);
      e.preventDefault;
    });
});
</script>
<?php wp_footer(); ?>

</body>
</html>
