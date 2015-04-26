<?php

require_once 'database.php';

function html_form_code()
{
    ?>
    <script>
        $(document).ready(function(){
            $("#registerBtn").click(function(){
                alert('Hello');
                $("#signin").hide();
                $("#register").show();
            });
            $("#back").click(function(){
                $("#register").hide();
                $("#signin").show();
            });
        });
    </script>
    <div class="row" id="singin">
        <div class="col-xs-6">
            <div class="well">
                <form action="" method="post" id="login_form" enctype="application/x-www-form-urlencoded">
                    <div class="form-group">
                        <label for="login_email" class="control-label">Електронна поща</label>
                        <input type="text" class="form-control" id="login_email" name="login_email"
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
                <li><span class="fa fa-check text-success"></span> See all your orders</li>
                <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
                <li><a href="/read-more/"><u>Read more</u></a></li>
            </ul>
            <p><button class="btn btn-info btn-block" id="registerBtn">Регистрация</button></p>
        </div>
    </div>
    <!--<div class="two_third">
        <div class="contact-area">
            <form class="contact-form" action="" method="post" id="login_form" enctype="application/x-www-form-urlencoded">
                <input id="login_email" tabindex="4" name="login_email" size="22" type="text" placeholder="Email"/>
                <input id="login_password" tabindex="5" name="login_password" size="22" type="password" placeholder="Парола"/>
                <input id="login_action" name="login_action" type="submit" value="Вход"/>
            </form>
        </div>
    </div> -->
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