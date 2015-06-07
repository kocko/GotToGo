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
                    <?php organizeLuggage(); ?>
                </form>
            </div>
        </div>
    </div>

</div>

<?php
    function getLuggageItemsNavigationTabs() {
        require_once '../utils/luggage_utils.php';

?>
    <ul class="nav nav-tabs" role="tablist">
    <?php
        $categories = getLuggageItemsCategories();
        foreach ($categories as $category) {
            ?><li role="presentation"><a href="#<?= $category; ?>" aria-controls="home" role="tab" data-toggle="tab"><?= $category; ?></a></li><?php
        }
    ?>
    </ul>
<?php
    }
?>
<?php
    function getLuggageTabPanels() {
?>
    <div class="tab-content">
    <?php
        $categories = getLuggageItemsCategories();
        foreach ($categories as $category) {
            ?>
            <div role="tabpanel" class="tab-pane" id="<?= $category ?>">
            <?php
                $items = getLuggageItemsPerCategory($category);
                foreach ($items as $item) {
                    ?>
                    <div class="checkbox checkbox-success">
                        <input id="<?= $item; ?>" type="checkbox">
                        <label for="<?= $item; ?>"><?= $item; ?></label>
                    </div>
                    <?php
                }
            ?>
            </div>
        <?php
        }
    }

    function organizeLuggage() {
        getLuggageItemsNavigationTabs();
        getLuggageTabPanels();
    }

