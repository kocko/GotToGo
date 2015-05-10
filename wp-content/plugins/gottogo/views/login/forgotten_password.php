<?php

function getForgottenPasswordForm() {
?>
    <div class="row collapse" id="forgottenPassword">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="well">
                    <form action="" method="post" id="forgotten_password_form" enctype="application/x-www-form-urlencoded">
                        <div class="form-group">
                            <label for="forgotten_password_email" class="control-label">Електронна поща</label>
                            <input type="email" class="form-control" id="forgotten_password_email" name="forgotten_password_email"
                                   value="" placeholder="example@gmail.com"
                                   required onblur="validateEmail('forgotten_password_email', 'forgotten_password_email_taken_alert', 0)">
                            <span class="help-block"></span>
                        </div>
                        <div class="alert alert-danger alert-dismissable collapse" role="alert" id="forgotten_password_email_taken_alert">
                            Няма регистриран потребител с тази електронна поща!
                        </div>
                        <button type="submit" class="btn btn-success btn-block"
                                id="forgotten_password_action" name="forgotten_password_action">Изпрати нова парола</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

function forgotten_password_action() {
    if (isset($_POST['forgotten_password_action'])) {
        $email = sanitize_text_field($_POST['forgotten_password_email']);
        $newPassword = generate_new_password();

        $newPasswordSalted = md5($newPassword);

        $updateQuery = sprintf("UPDATE users set password = '%s' WHERE email = '%s'",
            mysql_real_escape_string($newPasswordSalted), mysql_real_escape_string($email));

        $result = mysql_query($updateQuery, $GLOBALS['connection']);
        if (!$result) {
            die ("Could not update your password: " .mysql_error());
        } else {
            wp_mail($email, "New password for Gottoto", "Your new password is: " . $newPassword , null, null);
            echo "Success"; //TODO
        }
    }
}

function generate_new_password($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
