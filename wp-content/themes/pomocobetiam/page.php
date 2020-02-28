<?php get_header(); ?>
	</div>
</section>

<!-- END OF CATEGORY HEADER -->
<!-- START OF PAGE -->
<section class="">
	<?php 
	if(have_posts()):
		while(have_posts()):
			the_post(); ?>
			<?php the_content(); 
		endwhile; 
	endif; ?>
</section>

<?php get_footer(); ?>