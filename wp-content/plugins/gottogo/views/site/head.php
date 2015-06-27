<?php
    session_start();
    require_once("../../../../../wp-load.php");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link href="<?= get_site_url(); ?>/wp-includes/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="<?= get_site_url(); ?>/wp-includes/bootstrap/css/bootstrap-checkbox.css" type="text/css" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<script type="application/javascript" src="<?= get_site_url(); ?>/wp-includes/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= get_site_url(); ?>/wp-includes/js/typeahead.js/bootstrap3-typeahead.js"></script>
<script src="<?= get_site_url(); ?>/wp-includes/bootboxjs/bootbox.min.js"></script>
<script src="../js/gottogo.js"></script>
<style type="text/css">
    @media
    print {
        .noprint {
            display: none;
        }
    }
    header.home-header.sticky-header {
        position: fixed!important;
    }
    }
</style>
<?php if (is_home()) {
    $wrap_class = "home-site";
} else {
    $wrap_class = "site";
} ?>
<div class="<?php echo $wrap_class; ?> noprint">
    <header class="home-header sticky-header" style="position: static;">
        <div class="home-logo onetone-logo ">
            <a href="#  ">
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

        <a class="home-navbar navbar" href="javascript:"></a>
        <nav class="home-navigation top-nav">
            <ul>
                <?php
                if (isset($_SESSION['user']) && strcmp($_SESSION['user']['role'], 'user') == 0) {
                ?>
                <li class="onetone-menuitem"><a id="onetone-new-trip" href="newtrip.php"><span>Ново пътуване</span></a></li>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="mytrips.php"><span>Моите пътувания</span></a></li>
                <?php
                }
                ?>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="profile.php"><span>Профил</span></a></li>
                <?php
                if (isset($_SESSION['user']) && strcmp($_SESSION['user']['role'], 'admin') == 0) {
                ?>
                    <li class="onetone-menuitem"><a id="onetone-about-this-site" href="users.php"><span>Потребители</span></a></li>
                <?php
                }
                ?>
                <li class="onetone-menuitem"><a id="onetone-about-this-site" href="logout.php"><span>Изход</span></a></li>
            </ul>
        </nav>
        <div class="clear"></div>
    </header>
</div>
<div style="height: 65pt;">
</div>