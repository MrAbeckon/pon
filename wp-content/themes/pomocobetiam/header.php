<!DOCTYPE html>
<html class="js-off">
    <head>
        <meta charset="<?php bloginfo("charset"); ?>">
        <!-- <meta name="author" content="SUS Ostrava">
        <meta name="copyright" content="SUS Ostrava, <?php //date("Y") ?>">-->

        <meta name="keywords" content="" />
        <meta name="author" content=""/>
        <meta name="description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- change when needed -->
        <meta name="robots" content="noindex, nofollow">

        <title>
          <?php 
          if(is_front_page() || is_home()){
            echo "Pomoc Obetiam Násilia";
          } else{
            echo wp_title('');
          }
          echo ' | Pomoc obetiam násilia'; ?>
        </title>

        <!-- START WP HEAD -->
        <?php wp_head(); ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- END WP HEAD -->

    </head>

    <body class="">
        <?php
        $current_uri = home_url(add_query_arg(NULL, NULL));

        $isHome = is_home();
        $isPruvod = is_page("pruvod");
        $isDoprovod = is_page("doprovodak");
        $isMedia = strpos($current_uri, "/media/") !== false;

        $headerClasses = array();
        if (!$isHome) {
            $headerClasses[] = "no-hp";
        }
        if ($isProgram || $isPruvod || $isDoprovod || $isMedia) {
            $headerClasses[] = "programPage";
        }
        ?>
        <script type="text/javascript">
          document.getElementsByTagName("html")[0].classList.remove('js-off');
        </script>

        <!-- NAVIGATION BAR -->
        <header class="page-head">
          <nav>
            <ul>
              <li>menu</li>
            </ul>
          </nav>
        </header>

        <!-- START OF PAGE -->
        <main class="page-main">
            <?php 

          // HEADER_IMAGE OR
          if(!is_home()) { ?>
            <section class="header-image section-40 section-sm-40 section-md-66 bg-gray-dark page-title-wrap">
              <div class="shell">
                <div class="page-title">
                  <h1 id="course-title">
                    <?php 
                    if ( 'custom-taxonomy' == get_query_var( 'taxonomy' )) {
                      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
                      echo $term->name;
                    } else {
                      the_title();
                    } ?>
                  </h1>
                </div>
              </div>
            </section>

          <!--OR CAROUSEL -->
        <?php } else { 
            // get_template_part('components/home', 'carousel');    
          } 
             
        // START OF LAYOUT ?>

            <section>

            <?php
                if (!is_home()): ?>
                <div class="">

                <?php
                else: ?>
                <div class="">
                
                <?php
                endif; ?>














