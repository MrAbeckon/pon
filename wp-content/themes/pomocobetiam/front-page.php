<?php get_header(); ?>

	<!-- INTRO SECTION -->
		<div class="home-linka">
			<p>
				nonstop
				</br>
				linka pomoci obetiam
			</p>
			<h1 class="text-center"><?php the_field('linka_pomoci'); ?></h1>
		</div>
	</div>
	<div class="col-6 offset-3 text-center">
		<div class="home-intro">
			<p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem molestias quod vel porro voluptatibus? Porro dolor sapiente maxime provident adipisci labore obcaecati temporibus corporis laboriosam quis? Id doloribus aliquid assumenda?
			</p>
			<button class="button button-pink" type="button">
				požiadajte o podporu online
			</button>
		</div>
	</div>
</section>

<section class="row block block-pink">
	<div class="col-3 offset-1 mt-3">
		<h2>Kto je obeť?</h2>
	</div>
	<div class="col-6 block-inner">
		<?php the_field('kto_je_obet'); ?>
	</div>
</section>

<section class="row block block-blue">
	<div class="col-3 offset-1 mt-3">
		<h2>Kto sme my?</h2>
	</div>
	<div class="col-6 block-inner">
		<?php the_field('kto_sme_my'); ?>
	</div>
	<!-- <div class="col-6 offset-4 block-inner">
		<h3>Lorem</h3>
		<p>
			Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque fugiat aspernatur odit harum nulla velit minima obcaecati eveniet, nesciunt omnis molestias, sunt ratione fuga temporibus architecto magnam aut dolores. Facilis!
		</p>
		<p>
			Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque fugiat aspernatur odit harum nulla velit minima obcaecati eveniet, nesciunt omnis molestias, sunt ratione fuga temporibus architecto magnam aut dolores. Facilis!
		</p>
	</div> -->
	<div class="col-6 offset-4 block-inner">
		<button class="button button-blue" type="button">
			<i class="fas fa-external-link-alt"></i>
			Kontaktujte nás
		</button>
		<div class="contact-info">
			<div class="phone contact-info-item">
				<a href="#">	
					<i class="fas fa-phone"></i>
					<?php the_field('linka_pomoci'); ?>
				</a>
			</div>
			<div class="mail contact-info-item">				
				<a href="#">
					<i class="far fa-envelope"></i>
					info@pomocobetiam.sk
				</a>
			</div>
		</div>
	</div>
</section>

<section class="row block block-transparent">
	<div class="col-3 offset-1 mt-3">
		<h2>Iné kontakty</h2>	
	</div>
	<div class="col-6 block-inner">
		<?php the_field('ine_kontakty'); ?>
	</div>
	<!-- <div class="col-6 offset-4 block-inner">
		<h3>Lorem</h3>
		<p>
			Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque fugiat aspernatur odit harum nulla velit minima obcaecati eveniet, nesciunt omnis molestias, sunt ratione fuga temporibus architecto magnam aut dolores. Facilis!
		</p>
	</div>
	<div class="col-12 block-inner">
		<div class="block-inner-list">

		</div>
	</div>
	<div class="col-6 offset-4">
		<button class="button button-blue" type="button">
			Kontaktujte nás
		</button>
	</div> -->
</section>

<section class="row block block-blue" id="faq">
	<?php
	$args = array(
		'post_type' => __('najcastejsie-otazky'),
		'posts_per_page' => 6,
	);
	$the_query = new WP_Query( $args ); ?>

	<div class="col-8 offset-2 block-inner">
		<h2>Lorem</h2>
		
		<?php
		if ($the_query->have_posts()):
			while ( $the_query->have_posts() ): $the_query->the_post(); ?>
				
		<div class="question">
			<h4><?php the_title(); ?></h4>
			<p>
				<?php the_field('odpoved'); ?>
			</p>
		</div>
			<?php 
			endwhile;
		endif;?>
	</div>
	<?php 
	wp_reset_postdata();?>
</section>

<section class="row block block-pink">
	<div class="col-8 offset-2 block-inner">
		<?php the_field('podpora'); ?>
		<div class="document contact-info-item">
			<a href="#">
				<i class="far fa-file-alt"></i>
				výročné správy
			</a>
		</div>
		<div class="form">
			<?php echo do_shortcode( '[contact-form-7 id="41" title="Kontaktujte nás" html_class="form-support"]'); ?>
		</div>
	</div>
	<!-- <div class="col-4 offset-2 block-inner">
		<h4>Lorem</h4>
		<p>
			Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque fugiat aspernatur odit harum nulla velit minima obcaecati eveniet, nesciunt omnis molestias, sunt ratione fuga temporibus architecto magnam aut dolores. Facilis!
		</p>
		<button class="button button-pink" type="button">
			požiadajte o podporu online
		</button>
	</div>
	<div class="col-4 block-inner">
		<h4>Lorem</h4>
		<p>
			Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque fugiat aspernatur odit harum nulla velit minima obcaecati eveniet, nesciunt omnis molestias, sunt ratione fuga temporibus architecto magnam aut dolores. Facilis!
		</p>
		<button class="button button-pink" type="button">
			požiadajte o podporu online
		</button>
		<div class="document contact-info-item">
			<a href="#">
				<i class="far fa-file-alt"></i>
				výročné správy
			</a>
		</div>
	</div> -->
</section>


<?php get_footer(); ?>