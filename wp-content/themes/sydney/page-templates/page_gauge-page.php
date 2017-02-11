<?php
/*
Template Name: Gauge Page
*/

get_header('gauge'); ?>

	<div id="primary" class="fp-content-area">
		<main id="main" class="site-main" role="main">

			<div class="entry-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div><!-- .entry-content -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<div id="donutchart" style="width: 900px; height: 500px;"></div>

<?php get_footer(); ?>
