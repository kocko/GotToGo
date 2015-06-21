<?php
/*
Plugin Name: GotToGo login/registration/forgotten-password form
Plugin URI: http://gottogo.com
Description: The GotToGo plugin, which contains the forms for registration, login and forgotten password
Version: 1.0
Author: Stefaniya Talambazova
Author URI: http://w3guy.com
*/

require_once 'views/database.php';
require_once 'views/login/login.php';
require_once 'views/login/register.php';
require_once 'views/login/forgotten_password.php';

function loginform_shortcode()
{
    ob_start();
    login_action();
    register_action();
    html_form_code();
    return ob_get_clean();
}

function html_form_code() {
    initializeJS();
    getLoginForm();
    getRegisterForm();
    getForgottenPasswordForm();
}

function initializeJS() {
    ?>
    <script src="wp-content/plugins/gottogo/views/js/gottogo.js"></script>
    <?php
}

add_shortcode('gottogo_loginform', 'loginform_shortcode');
