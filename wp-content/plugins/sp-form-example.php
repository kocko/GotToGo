<?php
/*
Plugin Name: Example Contact Form Plugin
Plugin URI: http://example.com
Description: Simple non-bloated WordPress Contact Form
Version: 1.0
Author: Agbonghama Collins
Author URI: http://w3guy.com
*/

require_once 'database.php';

function html_form_code()
{
    ?>
    <div class="two_third">
        <div class="contact-area">
            <form class="contact-form" action="" method="post" id="login_form" enctype="application/x-www-form-urlencoded">
                <input id="login_email" tabindex="4" name="login_email" size="22" type="text" placeholder="Email"/>
                <input id="login_password" tabindex="5" name="login_password" size="22" type="password" placeholder="Парола"/>
                <input id="login_action" name="login_action" type="submit" value="Вход"/>
            </form>
        </div>
    </div>
<?php

}

function login_action()
{
    if (isset($_POST['login_action'])) {
        $email = sanitize_text_field($_POST['login_email']);
        $password = sanitize_text_field($_POST['login_password']);

        $query = sprintf("SELECT * FROM users WHERE email='%s' AND password='%s'", mysql_real_escape_string($email), mysql_real_escape_string($password));

        $result = mysql_query($query);

        if (!$result) {
            $message = 'Невалидна заявка: ' . mysql_error() . "\n";
            $message .= 'Цялата заявка: ' . $query;
            die($message);
        }

        $row = mysql_fetch_assoc($result);
        if ($row['fullname']) {
            echo "Здравейте, " . $row['fullname'] . "!";
        } else {
            echo "Невалидни потребителско име и парола";
        }
    }
}

function cf_shortcode()
{
    ob_start();
    login_action();
    html_form_code();
    return ob_get_clean();
}

add_shortcode('sitepoint_contact_form', 'cf_shortcode');

?>