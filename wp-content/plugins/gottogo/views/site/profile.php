<?php

include_once 'head.php';

$user = null;
if ($_SESSION['user']) {
    $user = $_SESSION['user'];
}
?>
<script>
    function updateProfileData(userId) {
        bootbox.confirm("Сигурни ли сте, че искате да промените детайлите си?", function(result) {
            if (result) {
                var fullname = jQuery("#edit_fullname").val();
                var password = jQuery("#edit_password").val();
                jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/update_user_action.php",
                    { user_id: userId, fullname: fullname, password: password },
                    function (result) {
                        if (result == 1) {
                            location.reload();
                        }
                    }
                );
            }
        });
    }
</script>
<div>
    <div class="row" id="editProfile" aria-expanded="false" aria-controls="editProfileCollapse" >
        <div class="col-xs-12 col-md-6">
            <div class="well" style="width: 1330px; margin-left: 30%; margin-right: auto;">
                <div align="center">
                    <?php
                        if (strcmp($user['role'], 'admin') == 0) {
                    ?>
                            <h1 style="font-size: 3em;">Администраторски профил</h1>
                    <?php
                        } else {
                    ?>
                    <h1 style="font-size: 3em;">Личен профил</h1>
                    <?php
                        }
                    ?>
                    <div  style="width: 90%;">
                        Това е страницата с личният Ви профил. В нея може да намерите данните, които сте въвели при регистрация и при нужда да ги редактирате.
                    </div>
                </div>
                </br>
                <form action="" method="post" id="edit_form" enctype="application/x-www-form-urlencoded">
                    <div class="form-group">
                        <label for="edit_fullname" class="control-label">Вашето име</label>
                        <input type="text" class="form-control" id="edit_fullname" name="edit_fullname"
                               value="<?= $user['fullname']; ?>" required>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_email" class="control-label">Електронна поща</label>
                        <input type="email" class="form-control" id="edit_email" name="register_email"
                               value="<?= $user['email']; ?>" required readonly>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_password" class="control-label">Нова парола</label>
                        <input type="password" class="form-control" id="edit_password"
                               name="edit_password" value="" required onchange="validatePassword('edit_password', 'edit_password_confirm')">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_password_confirm" class="control-label">Потвърдете паролата</label>
                        <input type="password" class="form-control" id="edit_password_confirm"
                               name="edit_password_confirm" value="" required onkeyup="validatePassword('edit_password', 'edit_password_confirm')">
                        <span class="help-block"></span>
                    </div>
                    <div class="row noprint">
                        <div class="pull-right">
                            <a type="submit" class="btn btn-success btn-block btn-lg"
                               id="edit_action" name="edit_action" onclick="updateProfileData(<?= $user['id'];?>)">
                                Запис
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
</div>
