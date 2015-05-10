function switchBetweenCollapsibleDivs(showId, hideId) {
    jQuery('#' + showId).collapse('toggle');
    jQuery('#' + hideId).collapse('toggle');
}

function validatePassword(first, second) {
    var password = document.getElementById(first);
    var confirm_password = document.getElementById(second);

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