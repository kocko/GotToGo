<?php
    include_once 'head.php';
?>
<script>
    jQuery(function () {
        jQuery.getJSON('../utils/cities_and_countries.php').done(function (data) {
            var sourceArray = [];
            for (var i = 0; i < data.length; i++) {
                sourceArray.push(data[i]['city'] + ", " + data[i]['country']);
            }
            jQuery('input').typeahead({source: sourceArray});
        });
    });
</script>
<div>
    <div class="row collapse in" id="signin" aria-expanded="true" aria-controls="loginCollapse">
        <div class="col-xs-12">
            <div class="well">
                <form>
                    <div id="the-basics">
                        <label for="login_email" class="control-label">Дестинация:</label>
                        <input class="typeahead form-control" type="text" placeholder="Град, Държава">
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block">Планирай бюджет</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block">Планирай багаж</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" disabled="true">Планирай обиколката </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>