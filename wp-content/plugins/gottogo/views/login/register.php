<?php

function getRegisterForm() {
?>
    <div class="row collapse" id="register" aria-expanded="false" aria-controls="registerCollapse">
        <div class="col-xs-12 col-md-6">
            <div class="well">
                <form action="" method="post" id="register_form" enctype="application/x-www-form-urlencoded">
                    <div class="form-group">
                        <label for="register_fullname" class="control-label">Вашето име</label>
                        <input type="text" class="form-control" id="register_fullname" name="register_fullname"
                               value="" placeholder="Peter Stevens" required>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="register_email" class="control-label">Електронна поща</label>
                        <input type="email" class="form-control" id="register_email" name="register_email"
                               value="" placeholder="example@gmail.com"
                               required onblur="validateEmail('register_email', 'register_email_taken_alert', 1)">
                        <span class="help-block"></span>
                    </div>
                    <div class="alert alert-danger alert-dismissable collapse" role="alert" id="register_email_taken_alert">
                        Има регистриран потребител с тази електронна поща!
                    </div>
                    <div class="form-group">
                        <label for="register_password" class="control-label">Парола</label>
                        <input type="password" class="form-control" id="register_password"
                               name="register_password" value="" required onchange="validatePassword()">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="register_password_confirm" class="control-label">Потвърдете паролата</label>
                        <input type="password" class="form-control" id="register_password_confirm"
                               name="register_password_confirm" value="" required onkeyup="validatePassword()">
                        <span class="help-block"></span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block"
                            id="register_action" name="register_action">
                        Регистрация
                    </button>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            Вече имате акаунт?
            <button class="btn btn-success btn-block" id="register_action"
                    name="register_action" onclick="switchBetweenCollapsibleDivs('signin', 'register')">
                Вход в системата
            </button>
        </div>
    </div>
<?php
}

function register_action() {
    if (isset($_POST['register_action'])) {
        $name = sanitize_text_field($_POST['register_fullname']);
        $email = sanitize_text_field($_POST['register_email']);
        $password = sanitize_text_field($_POST['register_password']);

        $passwordSalted = md5($password);

        $query = sprintf("INSERT INTO users (email, password, fullname) values ('%s','%s', '%s')",
                         mysql_real_escape_string($email), mysql_real_escape_string($passwordSalted), mysql_real_escape_string($name));


        $result = mysql_query($query, $GLOBALS['connection']);
        if (!$result) {
            die ("Could not enter data: " . mysql_error());
        } else {
            wp_mail($email, "Successful registration in Gottoto", "Hello, " . $name . "!" , null, null);
            echo "Success";
        }
    }
}
