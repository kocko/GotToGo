<?php

function getForgottenPasswordForm() {
?>
    <script>
        jQuery(function(){
            jQuery("#send_new_password").click(function(){
                var forgotten_password_email = jQuery('#forgotten_password_email').val();

                jQuery.post("wp-content/plugins/gottogo/views/utils/generate_new_password.php",
                    { forgotten_password_email : forgotten_password_email },
                    function (result) {
                        if (result == 'Success') {
                            jQuery('#email_sent_info_message').show('400');
                        } else {
                            jQuery('#email_sent_info_message').hide();
                        }
                    }
                );
            });
        });

        function disableFormButtonForgotten(result, formButtonId) {
            alert(result);
            jQuery('#' + formButtonId).prop('disabled', result == 0);
        }
    </script>

    <div class="row collapse" id="forgottenPassword" aria-expanded="true" aria-controls="forgottenPasswordCollapse">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="well">
                    <form action="" method="post" id="forgotten_password_form" enctype="application/x-www-form-urlencoded">
                        <div class="form-group">
                            <label for="forgotten_password_email" class="control-label">Електронна поща</label>
                            <input type="email" class="form-control" id="forgotten_password_email" name="forgotten_password_email"
                                   value="" placeholder="example@gmail.com" autocomplete="off"
                                   required onblur="validateEmail('forgotten_password_email', 'forgotten_password_email_taken_alert', 0, function (result, formButtonId) { jQuery('#' + formButtonId).prop('disabled', result == 0);} , 'send_new_password')">
                            <span class="help-block"></span>
                        </div>
                        <div class="alert alert-danger alert-dismissable collapse" role="alert" id="forgotten_password_email_taken_alert">
                            Няма регистриран потребител с тази електронна поща!
                        </div>
                        <button class="btn btn-success btn-block"
                           id="send_new_password" name="send_new_password">Изпрати нова парола</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="alert alert-info collapse" id="email_sent_info_message">
                    Изпратихме нова парола на посочената от Вас електронна поща!
                </div>
                Вече сте получили новата си парола?
                <button class="btn btn-info btn-block" id="register_action"
                        name="register_action" onclick="switchBetweenCollapsibleDivs('signin', 'forgottenPassword')">
                    Вход в системата
                </button>
            </div>
        </div>
    </div>
<?php
}
?>
