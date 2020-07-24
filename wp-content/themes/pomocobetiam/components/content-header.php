<?php

$podpora = is_page('podporte-nas');
$kontakt = is_page('kontakt');
$podpora_detail = "podporte-nas" == get_post_type();

if ($podpora):

    // include the podporte nas header
    // ludialudom - mame otvorenu vyzvu
    // include()

elseif($kontakt):
    // nothing
elseif($podpora_detail):
    // echo get_the_title( get_the_ID() );
else:
endif;



?>