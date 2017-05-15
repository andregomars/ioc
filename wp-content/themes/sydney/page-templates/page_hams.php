<?php
/*
Template Name: HAMS Page
*/

// get_header(); 
get_template_part('header-hams'); 
?>

	<div class="fullwidth">
			<div class="container" style="margin-left: 0px; margin-right: 0px; width: 100%">
				<div class="row">
					<div class="entry-content col">
						  <app-root>Loading...</app-root>
					</div><!-- .entry-content -->	
				</div>
			</div>
	</div><!-- #primary -->
  <script type="text/javascript" src="<?php echo esc_url(includes_url())?>assets/scripts/inline.bundle.js"></script>
  <script type="text/javascript" src="<?php echo esc_url(includes_url())?>/assets/scripts/polyfills.bundle.js"></script>
  <script type="text/javascript" src="<?php echo esc_url(includes_url())?>/assets/scripts/main.bundle.js"></script></body>


<?php get_footer(); ?>
