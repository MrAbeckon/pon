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
          } else {
            echo wp_title('');
          }
          echo ' | Pomoc obetiam násilia'; ?>
        </title>

        <!-- START WP HEAD -->
        <?php wp_head(); ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- END WP HEAD -->

    </head>

    <body>
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
          <nav class="page-head-nav navbar navbar-expand-lg">
            <div class="page-head-nav-logo">
              <a class="navbar-brand" href="#">
                <img src="<?php echo get_template_directory_uri() ?>/images/logo.jpg" alt="POMOC OBETIAM LOGO" />
              </a>
              <div class="page-head-nav-headings">
                <h5>Pomoc Obetiam Násilia</h5>
                <p>Občianske združenie</p>
                <p>Victim Support Slovakia</p>
              </div>
              
            </div>
            <div class="collapse navbar-collapse justify-content-end">
              <ul class="page-head-nav-list navbar-nav">
                <?php
                $locations = get_nav_menu_locations();
                if ( isset( $locations['header']) ) {
                  $menu = get_term( $locations['header'], 'nav_menu');
                }
                if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
                  foreach ( $items as $item ) {
                    if ($item->menu_item_parent != 0) {
                      continue;
                    }
                    $curNavItemID = $item->ID;
                    $classList = implode(" ", $item->classes); 
                    $item_url = $item->url; ?>
                    
                    <li class="page-head-nav-list-item nav-item">
                      <a href="<?php echo $item_url ?>"><?php echo $item->title ?></a>

                    <?php if ( in_array('dropdown', $item->classes)) { ?>
                      
                      <ul class="page-head-nav-list-item-dropdown dropdown dropdown-menu <?php echo $item->classes[1]; ?>">
                        
                        <?php foreach($items as $subnav) {
                          $curSubItemID = $subnav->ID;
                          $item_url = $subnav->url;
                          if ( $subnav->menu_item_parent == $curNavItemID) { ?>
                              
                              <li class="dropdown-item">
                              <div class=""><a href="<?php echo $subnav->url ?>"><?php echo $subnav->title; ?></a></div>
                          
                          <?php if ( in_array('dropdown-list', $subnav->classes)) {?>
                                <ul class="dropdown-list style-none">
                              <?php foreach($items as $subsubnav) { 
                                    if ( $subsubnav->menu_item_parent == $curSubItemID ) { ?>
                                      <li>
                                        <a href="<?php echo $subsubnav->url ?>">
                                          <div class="menu-nadpisy-h5"><?php echo $subsubnav->title ?></div>
                                          <?php echo mb_strimwidth($subsubnav->description, 0, 100, "...") ?>
                                        </a>
                                      </li>
                              <?php } elseif ($subsubnav == end($items)) { ?>
                                    <li><a href="<?php echo $item_url; ?>">Více ...</a>
                              <?php }
                                  }
                                  echo "</ul>";
                                }
                              echo "</li>";
                              }
                            }
                          echo "</ul>";
                          } 
                        ?>
                      </li>
                    <?php  
                    } 
                  } else {
                    echo "MENU NOT FOUND";   
                    var_dump($locations);
                    var_dump($menu);
                        }
                      ?>
              </ul>
            </div>
          </nav>
        </header>

        <!-- START OF PAGE -->
        <?php 
        global $post;
        $page_title_class = $post->post_name ?? 'homepage';

        ?>
        <main class="page-main container <?php echo $page_title_class; ?>">
            <?php 

          // NOT HOME
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

            <section class="row">

            <?php
                if (!is_home()): ?>
                <div class="col-12">

                <?php
                else: ?>
                <div class="col-12">
                
                <?php
                endif; ?>














