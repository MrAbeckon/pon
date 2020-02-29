<?php get_header(); ?>

	<!-- END OF CATEGORY HEADER -->
	<!-- START OF PAGE CONTENT-->
	<?php 
	if(have_posts()):
		while(have_posts()):
			the_post(); ?>
			<?php the_content(); 
		endwhile; 
	endif; ?>
	
	</div>
</section>

<?php get_footer(); ?>