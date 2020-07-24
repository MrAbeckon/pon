<?php get_header(); ?>

</section>

<section class="row block block-pink">
    <div class="col-xs-12 col-md-3 offset-md-1 mt-3">
		<h2>Som zamestnanec</h2>
	</div>
	<div class="col-xs-12 col-md-6 block-inner">
        <?php the_field('som_zamestnanec'); ?>
	</div>
</section>

<section class="row block block-pink">
    <div class="col-xs-12 col-md-3 offset-md-1 mt-3">
		<h2>Som fyzická osoba – podnikateľ</h2>
	</div>
	<div class="col-xs-12 col-md-6 block-inner">
        <?php the_field('som_fyzicka_osoba_podnikatel'); ?>
	</div>
</section>

<section class="row block block-pink">
    <div class="col-xs-12 col-md-3 offset-md-1 mt-3">
		<h2>Som právnická osoba</h2>
	</div>
	<div class="col-xs-12 col-md-6 block-inner">
        <?php the_field('som_pravnicka_osoba'); ?>
	</div>
</section>

<section class="row block block-pink">
    <div class="col-xs-12 col-md-3 offset-md-1 mt-3">
		<h2>Dôležité termíny</h2>
	</div>
	<div class="col-xs-12 col-md-6 block-inner">
        <?php the_field('dolezite_terminy'); ?>
	</div>
</section>

<?php get_footer(); ?>