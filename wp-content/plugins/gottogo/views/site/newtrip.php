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

    function disableDestinationEnableOrganizer() {
        jQuery("#destination").prop('disabled', true);
    }
    function
</script>
<div>
    <div class="row in" id="newtrip" aria-expanded="true" aria-controls="loginCollapse">
        <div class="col-xs-12">
            <div class="well">
                <form class="form-inline">
                    <div class="row">
                        <div class="form-group">
                            <input class="typeahead form-control" type="text"
                                   placeholder="Въведете дестинация: City, Country"
                                   id="destination">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-block btn-info" onclick="disableDestinationEnableOrganizer()">Запази</button>
                        </div>
                    </div>
                    <div class="row" style="height: 15pt;"></div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" onclick="switchBetweenCollapsibleDivs('organizeLuggageDiv', 'organizeBudgetDiv')">Планиране на бюджет</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" onclick="switchBetweenCollapsibleDivs('organizeBudgetDiv', 'organizeLuggageDiv')">Организиране на багаж</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" disabled="true">Планиране на маршрут </button>
                        </div>
                    </div>
                    <div class="row" style="height: 15pt;"></div>
                    <div class="row collapse" id="organizeBudgetDiv" aria-expanded="true" aria-controls="organizeBudgetCollapse">
                        budget here
                    </div>
                    <div class="row collapse in" id="organizeLuggageDiv" aria-expanded="true">
                        <?php organizeLuggage(); ?>
                    </div>
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
            ?><li role="presentation"><a href="#<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>" aria-controls="home" role="tab" data-toggle="tab"><?= $category; ?></a></li><?php
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
            <div role="tabpanel" class="tab-pane" id="<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>">
            <?php
                $items = getLuggageItemsPerCategory($category);
                foreach ($items as $item) {
                    ?>
                    <div class="checkbox checkbox-success">
                        <input id="<?= $item; ?>" type="checkbox">
                        <label for="<?= $item; ?>"><?= $item; ?></label>
                    </div>
                    <div>

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

