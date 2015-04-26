<?php
/*
Plugin Name: GotToGo login/registration/forgotten-password form
Plugin URI: http://gottogo.com
Description: The GotToGo plugin, which contains the forms for registration, login and forgotten password
Version: 1.0
Author: Konstantin Yovkov
Author URI: http://w3guy.com
*/

require_once 'views/login.php';

function loginform_shortcode()
{
    ob_start();
    login_action();
    html_form_code();
    return ob_get_clean();
}


add_shortcode('gottogo_loginform', 'loginform_shortcode');