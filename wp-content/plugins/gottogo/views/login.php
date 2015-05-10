<?php

require_once 'database.php';

function html_form_code()
{
    ?>
    <script>
        function switchBetweenCollapsibleDivs(showId, hideId) {
            jQuery('#' + showId).collapse('toggle');
            jQuery('#' + hideId).collapse('toggle');
        }

        function validatePassword() {
            var password = document.getElementById("register_password");
            var confirm_password = document.getElementById("register_password_confirm");

            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Паролите не съвпадат!");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        function validateEmail(componentId, errorMessageContainerId, successResult) {
            var email = jQuery('#' + componentId).val();
            jQuery.post("wp-content/plugins/gottogo/views/utils/checkEmail.php", { register_email : email },
                function(result) {
                    if (result == successResult) {
                        jQuery('#' + errorMessageContainerId).show();
                    } else {
                        jQuery('#' + errorMessageContainerId).hide();
                    }
                });
        }

    </script>
    <div class="row collapse in" id="signin" aria-expanded="true" aria-controls="loginCollapse">
        <div class="col-xs-12 col-md-6">
            <div class="well">
                <form action="" method="post" id="login_form" enctype="application/x-www-form-urlencoded">
                    <div class="form-group">
                        <label for="login_email" class="control-label">Електронна поща</label>
                        <input type="email" class="form-control" id="login_email" name="login_email"
                               value="" placeholder="example@gmail.com" required>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="login_password" class="control-label">Парола</label>
                        <input type="password" class="form-control" id="login_password"
                               name="login_password" value="" required>
                        <span class="help-block"></span>
                    </div>
                    <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                    <button type="submit" class="btn btn-success btn-block" id="login_action" name="login_action">Вход</button>
                    <a class="btn btn-default btn-block" onclick="switchBetweenCollapsibleDivs('forgottenPassword', 'signin')">
                        Забравена парола?
                    </a>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <p class="lead">Регистрирайте се <span class="text-success">БЕЗПЛАТНО</span></p>
            <ul class="list-unstyled" style="line-height: 2">
                <li><span class="fa fa-check text-success"></span> Планирайте разходите си</li>
                <li><span class="fa fa-check text-success"></span> Проверете багажа си</li>
                <li><span class="fa fa-check text-success"></span> Оптимизирайте маршрута си</li>
                <li><span class="fa fa-check text-success"></span> Открийте нови интересни места</li>
                <li><span class="fa fa-check text-success"></span> Само с няколко клика<small>(only new customers)</small></li>
                <li><a href="/read-more/"><u>Read more</u></a></li>
            </ul>
            <p>
                <button class="btn btn-info btn-block" id="registerBtn"
                        onclick="switchBetweenCollapsibleDivs('register', 'signin')">
                    Регистрация
                </button>
            </p>
        </div>
    </div>
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

function login_action() {
    if (isset($_POST['login_action'])) {
        $email = sanitize_text_field($_POST['login_email']);
        $password = sanitize_text_field($_POST['login_password']);

        $passwordSalted = md5($password);

        $query = sprintf("SELECT * FROM users WHERE email='%s' AND password='%s'",
                         mysql_real_escape_string($email), mysql_real_escape_string($passwordSalted));

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