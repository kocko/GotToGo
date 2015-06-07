<?php
    include_once 'head.php';
?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <link href="/go/wp-includes/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
</head>

<script>
    jQuery(function () {
        jQuery.getJSON('../utils/cities_and_countries.php').done(function (data) {
            var sourceArray = [];
            for (var i = 0; i < data.length; i++) {
                sourceArray.push(data[i]['city'] + ", " +  data[i]['country']);
            }
            jQuery('input').typeahead({source: sourceArray});
        });
    });
</script>
<div id="container">
    <div class="row">
        <div class="well">
            <form>
                <div id="the-basics">
                    <label for="login_email" class="control-label">Дестинация:</label>
                    <input class="typeahead form-control" type="text" placeholder="Град, Държава">
                </div>
            </form>
        </div>
    </div>
</div>
