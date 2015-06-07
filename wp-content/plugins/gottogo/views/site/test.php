<?php
//require_once("../../../../../wp-load.php");
include_once 'head.php';
?>
<!DOCTYPE html>
<html>

<head>


</head>

<body>



<script>
    jQuery(function () {
        jQuery.getJSON('../utils/citiesAndCountries.json')
            .done(function (data) {
                jQuery('input').typeahead({source: data});
            });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-push-2">
            <input type="text" class="form-control" placeholder="countries">
        </div>
    </div>
</div>
<div id="container">
    <div class="row">
        <div class="well">
            <form>
                <div id="the-basics col-xs-8 col-xs-push-2">
                    <label for="destination" class="control-label">Дестинация:</label>
                    <input type="text" class="form-control" placeholder="countries" id="destination">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>