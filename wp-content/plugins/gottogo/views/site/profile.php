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
                jQuery("#profileEditSuccess").hide();
                jQuery("#fullnameErrorMessage").hide();
                jQuery("#passwordsErrorMessage").hide();
                var fullname = jQuery("#edit_fullname").val();
                var password = jQuery("#edit_password").val();
                var passwordConfirm = jQuery("#edit_password_confirm").val();
                if (validateProfileForm(fullname, password, passwordConfirm)) {
                    jQuery("#fullnameErrorMessage").hide();
                    jQuery("#passwordsErrorMessage").hide();

                    jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/update_user_action.php",
                        { user_id: userId, fullname: fullname, password: password },
                        function (result) {
                            if (result == 1) {
                                jQuery("#profileEditSuccess").show();
                                jQuery("#edit_password").val('');
                                jQuery("#edit_password_confirm").val('');
                            }
                        }
                    );
                }
            }
        });
    }

    function validateProfileForm(fullname, password, passwordConfirm) {
        var result = true;
        if (fullname === '') {
            jQuery("#fullnameErrorMessage").show();
            result = false;
        }
        if (password === '' || passwordConfirm === '' || (password != passwordConfirm)) {
            jQuery("#passwordsErrorMessage").show();
            result = false;
        }
        return result;
    }

</script>
<div>
    <div class="row" id="editProfile" aria-expanded="false" aria-controls="editProfileCollapse" >
        <div class="col-xs-12 col-md-6">
            <div class="well" style="width: 1080px; margin-left: 20%; margin-right: auto;">
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
                <br/>
                <div class="alert alert-info collapse alert-dismissible" id="fullnameErrorMessage">
                    'Вашето име' е задължително поле!
                </div>
                <div class="alert alert-info collapse alert-dismissible" id="passwordsErrorMessage">
                    Паролите трябва да са непразни и да съвпадат!
                </div>
                <div class="alert alert-success collapse alert-dismissible" id="profileEditSuccess">
                    Вие успешно редактирахте профила си!
                </div>
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
