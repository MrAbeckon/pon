<?php 

	while ( have_posts() ) : 
		the_post(); 

?>
 
<h3><?php the_title(); ?></h3>
 
<?php the_content(); ?>
<?php wp_link_pages(); ?>
<?php edit_post_link(); ?>
 
<?php endwhile; ?>
 

