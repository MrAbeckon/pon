<?php get_header(); ?>
    
    
    <div class="col-xs-12 col-lg-5">

		<div class="home-linka">
            <p class="text-uppercase ml-2 mb-2">
                nonstop linka
            </p>
            <h1 class="text-center"><a href="tel:<?php echo LINKA_POMOCI; ?>"><?php echo LINKA_POMOCI; ?></a></h1>
        </div>
        <?php get_template_part( 'components/otv_hodiny' ); ?>
        <p class="mt-4">
            <span class="font-weight-bold pink">PON Centrála (poštová adresa):</span> </br>
            <?php echo ADRESY[0]; ?>
            </br>
            <span class="font-weight-bold pink">Email:</span> </br>
            <?php 
            foreach( EMAILS as $key => $val ):?>
                <a href="mailto:<?php echo $val; ?>">
                    <?php 
                    echo $val;?>
                </a></br>
            <?php 
            endforeach; ?>
        </p>
    </div>
    <div class="col-xs-12 col-lg-6 offset-lg-1 mt-4 mt-lg-0">
        <h2 class="form-heading">Kontaktujte nás</h2>
		<div class="form">
			<?php echo do_shortcode( '[contact-form-7 id="41" title="Kontaktujte nás" html_class="form-support"]'); ?>
		</div>
    </div>
</section>

<section class="row block block-pink">
	<div class="col-xs-12 col-md-3 offset-md-1 mt-md-3">
		<h2>Iné Kontakty</h2>
	</div>
	<div class="col-xs-12 col-md-6 block-inner">
		<?php the_field('kto_je_obet'); ?>
	</div>
</section>

</main>

<section class="container-fluid p-0 map-container" id="map">
    
</section>

<?php get_footer(); ?>
