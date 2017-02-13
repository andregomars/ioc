<?php
/*
Template Name: HAMS Page
*/

get_header(); ?>

	<div class="fullwidth">
			<div class="container" style="margin-left: 0px; margin-right: 0px; width: 100%">
				<div class="row">
					<div class="col-md-1">
						<?php dynamic_sidebar( 'sidebar-hams' ); ?>
					</div>
					<div class="entry-content col-md-11">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					</div><!-- .entry-content -->	
				</div>
			</div>
	</div><!-- #primary -->

<?php get_footer(); ?>
