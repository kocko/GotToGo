<?php

function getLoginForm() {
    ?>
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
            session_start();
            $_SESSION['user'] = $row;
            header("Location: /gottogo/wp-content/plugins/gottogo/views/site/index.php");
        } else {
            echo "Невалидни потребителско име и парола";
        }
    }
}
