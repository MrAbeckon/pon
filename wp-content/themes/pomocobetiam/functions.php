<?php
include 'acf.php';

// THEME SETUP
if ( ! function_exists( 'pomocobetiam_setup' ) ):
  function pomocobetiam_setup() {
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    // Add new Image Sizing
    add_image_size('detail', 260, 195, true);
    add_image_size('partners', 200, 122);
    // Creating medium cropping
    if (!get_option('medium_crop')) {
      add_option('medium_crop', '1');
    } else {
      update_option('medium_crop', '1');
    }
    // Register Navigation Menus
    register_nav_menus(
      array(
        'header' => 'hlmenu',
        )
    );
  }
endif;
add_action('after_setup_theme', 'pomocobetiam_setup');

// ENQUEUE
$js_v = '1.1';
$css_v = '1.1';
function enqueueGoogleApi(){
  // wp_enqueue_script ( 'google-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8wff3dxcoXHYSJHnZNGMiXTctffRYwzU', array());
}
function enqueue_admin_styles_scripts() {
  enqueueGoogleApi();
  // wp_enqueue_style ('admin-style', get_template_directory_uri().'/css/admin-style.css', array());
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles_scripts');
function enqueue_styles_scripts() {
  // scripts
  if(is_single() && ('custom_post_type' == get_post_type())):
    enqueueGoogleApi();
    wp_enqueue_script ( 'google-map', get_template_directory_uri() . '/js/google-map.js', array('jquery'), $js_v);
  endif;
  // wp_enqueue_script ('cookie-consent', 'https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js', array());
  wp_enqueue_script ( 'core-script', get_template_directory_uri() . '/js/core.min.js', array('jquery'), $js_v);
  wp_enqueue_script ( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js');
  wp_enqueue_script ( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'), $js_v);
  // styles
  wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/stylesheets/bootstrap.min.css');
  wp_enqueue_style ('style', get_template_directory_uri().'/stylesheets/main.css', array(), $css_v);
  // wp_enqueue_style ('style-career', get_template_directory_uri().'/css/style-career.css', array(), $css_v);
  wp_enqueue_style ('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css');
  wp_enqueue_style ('google-fonts', 'https://fonts.googleapis.com/css?family=Work+Sans:400,700&amp;subset=latin-ext');
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_scripts' );

// RESET DEFAULTS
// Skryti menu itemu pro spravce webu
function remove_default_post_type() {
  global $current_user;
  if (in_array('editor', $current_user->roles)) {
    remove_menu_page('wpcf7');
    remove_menu_page('tools.php');
    remove_submenu_page( 'index.php', 'update-core.php' );
  }
  remove_menu_page('edit.php');
  remove_submenu_page('tools.php', 'import.php');
  remove_submenu_page('options-general.php', 'options-discussion.php');
}
add_action('admin_menu','remove_default_post_type');

// favicon settings
function favicon($rootPath) {
  
  echo '<link rel="apple-touch-icon" sizes="57x57" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-57x57.png">';
  echo '<link rel="apple-touch-icon" sizes="60x60" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-60x60.png">';
  echo '<link rel="apple-touch-icon" sizes="72x72" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-72x72.png">';
  echo '<link rel="apple-touch-icon" sizes="76x76" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-76x76.png">';
  echo '<link rel="apple-touch-icon" sizes="114x114" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-114x114.png">';
  echo '<link rel="apple-touch-icon" sizes="120x120" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-120x120.png">';
  echo '<link rel="apple-touch-icon" sizes="144x144" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-144x144.png">';
  echo '<link rel="apple-touch-icon" sizes="152x152" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-152x152.png">';
  echo '<link rel="apple-touch-icon" sizes="180x180" href="/'. $rootPath .'wp-content/themes/pomocobetiam/apple-icon-180x180.png">';

  echo '<link rel="icon" type="image/png" sizes="192x192" href="/'. $rootPath .'wp-content/themes/pomocobetiam/android-icon-192x192.png">';
  echo '<link rel="icon" type="image/png" sizes="96x96" href="/'. $rootPath .'wp-content/themes/pomocobetiam/favicon-96x96.png">';
  echo '<link rel="icon" type="image/png" sizes="32x32" href="/'. $rootPath .'wp-content/themes/pomocobetiam/favicon-32x32.png">';
  echo '<link rel="icon" type="image/png" sizes="16x16" href="/'. $rootPath .'wp-content/themes/pomocobetiam/favicon-16x16.png">';

  echo '<link rel="manifest" href="/'. $rootPath .'wp-content/themes/pomocobetiam/manifest.json">';
  echo '<meta name="msapplication-TileColor" content="#ffffff">';
  echo '<meta name="msapplication-TileImage" content="/'. $rootPath .'wp-content/themes/pomocobetiam/ms-icon-144x144.png">';
  echo '<meta name="theme-color" content="#ffffff">';

}
add_action('admin_head', 'favicon');
add_action('wp_enqueue_scripts', 'favicon', '');

// Smazani roli a zmena nazvu
function majales_change_role_name() {
  global $wp_roles;

  if ( ! isset( $wp_roles ) )
    $wp_roles = new WP_Roles();

  remove_role("subscriber");
  remove_role("author");
  remove_role("contributor");

  $wp_roles->roles['editor']['name'] = 'Správce webu';
  $wp_roles->role_names['editor'] = 'Správce webu';
}
add_action('init', 'majales_change_role_name');

// Zrušíme detailní výpis kde je chyba při přihlašování
function no_wordpress_errors() {
  return 'Chybné údaje!';
}
add_filter('login_errors', 'no_wordpress_errors');

// Odstranění zbytečných tagů z <head>
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'gllr_add_for_ios', 10 ); //iOS inicializace Gallery
remove_action( 'wp_enqueue_scripts', 'gllr_wp_head',10 );//zbylé tagy od Gallery
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

//povolit při zapnutí debbugu
add_filter('show_admin_bar', '__return_false');

// POSTTYPES
/******************************  PREZENCNE KURZY  ******************************/
function faq() {
  $labels = array(
    'name' => 'Najčastejšie otázky',
    'singular_name' => 'Najčastejšia otázka',
    'add_new' => 'Pridať najčastejšiu otázku',
    'add_new_item' => 'Pridať novú najčastejšiu otázku',
    'edit_item' => 'Zmeniť najčastejšiu otázku',
    'new_item' => 'Pridať najčastejšiu otázku',
    'all_items' => 'Zoznam najčastejších otázok',
    'view_item' => 'Zobrazit otázku',
    'search_items' => 'Hľadať najčastejšie otázky',
    'not_found' => 'Najčastejšie otázky nenájdené',
    'not_found_in_trash' => 'Najčastejšie otázky nenájdené',
    'parent_item_colon' => '',
    'menu_name' => 'Najčastejšie otázky'
    );

  $info = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'najcastejsie-otazky'),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title'),
    'taxonomies' => array(),
    );

  register_post_type('najcastejsie-otazky', $info);

}
add_action('init', 'faq');
/******************************  end PREZENCNE KURZY  ******************************/

//Změna slova pro stránkování
  function my_custom_page_word() {
    global $wp_rewrite;
    $wp_rewrite->pagination_base = "strana";
  }
add_action('init', 'my_custom_page_word');

// function for sorting a dates for courses
function compareByTimeStamp($time1, $time2) 
{ 
    if (strtotime($time1) < strtotime($time2)) 
        return 1; 
    else if (strtotime($time1) > strtotime($time2))  
        return -1; 
    else
        return 0; 
} 

?>
