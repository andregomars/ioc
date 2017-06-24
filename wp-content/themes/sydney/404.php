<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Sydney
 */
$url= $_SERVER['REQUEST_URI'];
if (preg_match("/index.php\/hams/i", $url)) {
	status_header("200");
	get_template_part('page-templates/page_hams','page'); 
}
else {
	status_header("404");
	get_header(); 
?>

	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'sydney' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sydney' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	get_footer(); 
}
?>
