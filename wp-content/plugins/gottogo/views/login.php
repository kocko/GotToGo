<?php

require_once 'database.php';

function html_form_code()
{
    ?>
    <script>
        function toggler(divId) {
            $("#signin").hide();
            $("#" + divId).show();
        }
    </script>
    <div class="row" id="signin">
        <div class="col-xs-6">
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
                    <a href="/forgot/" class="btn btn-default btn-block">Забравена парола?</a>
                </form>
            </div>
        </div>
        <div class="col-xs-6">
            <p class="lead">Регистрирайте се <span class="text-success">БЕЗПЛАТНО</span></p>
            <ul class="list-unstyled" style="line-height: 2">
                <li><span class="fa fa-check text-success"></span> Планирайте разходите си</li>
                <li><span class="fa fa-check text-success"></span> Проверете багажа си</li>
                <li><span class="fa fa-check text-success"></span> Оптимизирайте маршрута си</li>
                <li><span class="fa fa-check text-success"></span> Открийте нови интересни места</li>
                <li><span class="fa fa-check text-success"></span> Само с няколко клика<small>(only new customers)</small></li>
                <li><a href="/read-more/"><u>Read more</u></a></li>
            </ul>
            <p><button class="btn btn-info btn-block" id="registerBtn" data-toggle="collapse">Регистрация</button></p>
        </div>
    </div>
    <div class="row" id="signin">
        <div class="col-xs-6">
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
                               value="" placeholder="example@gmail.com" required>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="register_password" class="control-label">Парола</label>
                        <input type="password" class="form-control" id="register_password"
                               name="register_password" value="" required>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="register_password_confirm" class="control-label">Потвърдете паролата</label>
                        <input type="password" class="form-control" id="register_password_confirm"
                               name="register_password_confirm" value="" required>
                        <span class="help-block"></span>
                    </div>
                    <div id="registerErrorMsg" class="alert alert-error hide">Error</div>
                    <button type="submit" class="btn btn-success btn-block" id="register_action" name="register_action">Регистрация</button>
                </form>
            </div>
        </div>
    </div>
    <div class="forgottenPassword">
        <div class="col-xs-6">
            <div class="well">
                <form action="" method="post" id="register_form" enctype="application/x-www-form-urlencoded">
                    <div class="form-group">
                        <label for="forgotten_password_email" class="control-label">Електронна поща</label>
                        <input type="email" class="form-control" id="forgotten_password_email" name="forgotten_password_email"
                               value="" placeholder="example@gmail.com" required>
                        <span class="help-block"></span>
                    </div>
                    <div id="forgottenPasswordMsg" class="alert alert-error hide">Success</div>
                    <button type="submit" class="btn btn-success btn-block" id="register_action" name="register_action">Изпрати нова парола</button>
                </form>
            </div>
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