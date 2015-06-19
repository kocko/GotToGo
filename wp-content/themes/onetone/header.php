<?php
/**
 * The header for home page.
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('|', true, 'right'); ?></title>
<link href="<?= get_site_url(); ?>/wp-includes/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<script type="application/javascript" src="<?= get_site_url(); ?>/wp-includes/bootstrap/js/bootstrap.min.js"></script>
<?php if(is_home()){$wrap_class = "home-site";}else{$wrap_class = "site";}?>
<div class="<?php echo $wrap_class;?>">
	<header class="home-header">
		<div class="home-logo onetone-logo ">
        	<a href="<?php echo esc_url(home_url('/')); ?>">
        <?php if ( onetone_options_array('logo')!="") { ?>
        <img src="<?php echo onetone_options_array('logo'); ?>" alt="<?php bloginfo('name'); ?>" />
        <?php }else{ ?>
        <span class="site-name">
        <?php bloginfo('name'); ?>
        </span>
        <?php }?>
        </a>
        <?php if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){?>
        <div class="site-description "><?php bloginfo('description'); ?></div>
        <?php }?>
        </div>
        
        <a class="home-navbar navbar" href="javascript:;"></a>
        <nav class="home-navigation top-nav">
<?php
$bulgarian_mapping = array( "home" => "Начало",
                            "login" => "Вход",
                            "whats-next" => "Какво следва?",
                            "useful" => "Полезно",
                            "feedback" => "Обратна връзка",
                            "about-this-site" => "За сайта");
 $onepage_menu = '';
 $section_num = onetone_options_array( 'section_num' ); 
 if(isset($section_num) && is_numeric($section_num ) && $section_num >0):
 for( $i = 0; $i < $section_num ;$i++){

 $section_menu = onetone_options_array( 'menu_title_'.$i );
 $section_slug = onetone_options_array( 'menu_slug_'.$i );
  if( $section_slug )
  $section_slug =  sanitize_title($section_slug );

 if(isset($section_menu) && $section_menu !=""){
 $sanitize_title = sanitize_title($section_menu);
 $section_menu = onetone_options_array( 'menu_title_'.$i );
 if(trim($section_slug) !=""){
	 $sanitize_title = $section_slug; 
	 }
     $bulgarian = "";
     if (strcmp($sanitize_title, "home") == 0) {
         $bulgarian = "Начало";
     }
 $onepage_menu .= '<li  class="onetone-menuitem"><a id="onetone-'.$sanitize_title.'" href="#'.$sanitize_title.'" >
 <span>'.$bulgarian_mapping[$sanitize_title].'</span></a></li>';
 }
 }
endif;
if ( has_nav_menu( "home_menu" ) ) {
 wp_nav_menu(array('theme_location'=>'home_menu','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">'.$onepage_menu.'%3$s</ul>'));
}
else{
echo '<ul>'.$onepage_menu.'</ul>';
}
?>
        </nav>
		<div class="clear"></div>
	</header>    
	<!--header-->