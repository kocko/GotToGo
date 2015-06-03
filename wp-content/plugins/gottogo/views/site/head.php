<?php
require_once("../../../../../wp-load.php");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link href="/go/wp-includes/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<script type="application/javascript" src="/go/wp-includes/bootstrap/js/bootstrap.min.js"></script>
<?php if (is_home()) {
    $wrap_class = "home-site";
} else {
    $wrap_class = "site";
} ?>
<div class="<?php echo $wrap_class; ?>">
    <header class="home-header">
        <div class="home-logo onetone-logo ">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php if (onetone_options_array('logo') != "") { ?>
                    <img src="<?php echo onetone_options_array('logo'); ?>" alt="<?php bloginfo('name'); ?>"/>
                <?php } else { ?>
                    <span class="site-name">
        <?php bloginfo('name'); ?>
        </span>
                <?php } ?>
            </a>
            <?php if ('blank' != get_header_textcolor() && '' != get_header_textcolor()) { ?>
                <div class="site-description "><?php bloginfo('description'); ?></div>
            <?php } ?>
        </div>

        <a class="home-navbar navbar" href="javascript:;"></a>
        <nav class="home-navigation top-nav">
            <ul>
                <li class="onetone-menuitem"><a id="onetone-home" href="#home"><span>Начало</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-whats-next" href="#whats-next"><span>Какво следва?</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-useful" href="#useful"><span>Полезно</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-feedback" href="#feedback"><span>Обратна връзка</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="#about-this-site"><span>За сайта</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="#about-this-site"><span>Моите пътувания</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="#about-this-site"><span>Ново пътуване</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="#about-this-site"><span>Профил</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="#about-this-site"><span>Изход</span></a>
                </li>
            </ul>
        </nav>
        <div class="clear"></div>
    </header>