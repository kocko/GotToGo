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
        jQuery("#destination").prop('readonly', true);
        jQuery("#organizer").show();
    }

    function addLuggageItem(category) {
        var addMoreLuggageItemsDiv = jQuery("#addMoreLuggageItems_" + category);
        jQuery(addMoreLuggageItemsDiv).append(
            '<div>' +
            '   <input class="form-control" type="text" name="' + category + '">' +
            '   <button type="button" class="btn btn-danger btn-xs id="removeLuggageItemsButton_' + category + '" title="Премахни" onclick="removeLuggageItem(this)">' +
            '       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' +
            '   </button><br />' +
            '</div>'
        );
    }

    function removeLuggageItem(component) {
        jQuery(component).parent('div').remove();
    }

    function validateDestination() {
        //todo
        if (jQuery("#destination").val() == "") {
            jQuery("#destination").validate('validate');
            return true;
        } else {
            return false;
        }
    }

    jQuery(function(){
        jQuery("#new_trip_action").click(function() {
            var destination = jQuery('#destination').val();
            var luggage_items = jQuery(":checkbox").serializeArray();

            var result = [];
            for (var i = 0; i < luggage_items.length; i++) {
                result.push([luggage_items[i].name, luggage_items[i].value]);
            }

            var additional_items = jQuery(":text");
            for (var i = 0; i < additional_items.length; i++) {
                if (additional_items[i].name != 'destination') {
                    result.push([additional_items[i].name, additional_items[i].value]);
                }
            }

            jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/create_new_trip_action.php",
                { destination : destination, selectedLuggageItems: result},
                function (result) {
                    if (result == true) {
                        jQuery("#tripSuccessMessage").show(400);
                        jQuery("#newTripDataForm").hide();
                    } else {
                        jQuery("#tripErrorMessage").show(400);
                    }
                }
            );
        });
    });
</script>
<div class="row in" id="newtrip" aria-expanded="true" aria-controls="newTripCollapse">
    <div class="col-xs-12">
        <div class="well">
            <h1>Избор на пътуване</h1>
            <div>
                Тук ще има текст.
            </div>
            <br />
            <div class="alert alert-info collapse alert-dismissible" id="tripSuccessMessage">
                Пътуването е създадено успешно! Може да го видите на страницата
                <a href="mytrips.php" type="button" class="btn btn-success btn-sm">
                    Моите пътувания
                </a>
            </div>
            <div class="alert alert-info collapse alert-dismissible" id="tripErrorMessage">
                Възникна грешка! Моля, опитайте отново!
            </div>
            <form class="form-inline" action="" method="post" id="newTripDataForm">
                <div class="row">
                    <div class="form-group">
                        <input class="typeahead form-control" type="text" autocomplete="off"
                               placeholder="Въведете дестинация: City, Country"
                               id="destination" name="destination" value="">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-block btn-info"
                                onclick="disableDestinationEnableOrganizer()">Запази</button>
                    </div>
                </div>
                <div class="row" style="height: 15pt;"></div>
                <div id="organizer" style="display: none;">
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" onclick="switchBetweenCollapsibleDivs('organizeBudgetDiv', 'organizeLuggageDiv')">Планиране на бюджет</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" onclick="switchBetweenCollapsibleDivs('organizeLuggageDiv', 'organizeBudgetDiv')">Организиране на багаж</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" disabled>Планиране на маршрут </button>
                        </div>
                    </div>
                    <div class="row" style="height: 15pt;"></div>
                    <div class="row collapse" id="organizeBudgetDiv" aria-expanded="false" aria-controls="organizeBudgetCollapse">
                        <?php organizeBudget(); ?>
                    </div>
                    <div class="row collapse" id="organizeLuggageDiv" aria-expanded="false">
                        <?php organizeLuggage(); ?>
                    </div>
                    <div class="row" style="height: 15pt;"></div>
                    <div class="row" id="createNewTripArea">
                        <a type="submit" class="btn btn-danger btn-block"
                                id="new_trip_action" name="new_trip_action">Създай</a>
                    </div>
                </div>
            </form>
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
                        <input id="<?= $item; ?>" type="checkbox" name="<?= $category; ?>" value="<?= $item; ?>">
                        <label for="<?= $item; ?>"><?= $item; ?></label>
                    </div>
                    <?php
                }
            ?>
                <div id="addMoreLuggageItems_<?= $category; ?>">

                </div>
                <button type="button" class="btn btn-info btn-xs" id="addMoreLuggageItemsButton_<?= $category ;?>"
                        title="Добави" onclick="addLuggageItem('<?= $category; ?>')">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </div>
        <?php
        }
        ?>
    <?php
    }

    function getBudgetNavigationTabs() {
        require_once '../utils/budget_utils.php';
    ?>
        <ul class="nav nav-tabs" role="tablist">
            <?php
            $categories = getBudgetCategories();
            foreach ($categories as $category) {
                ?><li role="presentation"><a href="#<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>" aria-controls="home" role="tab" data-toggle="tab"><?= $category; ?></a></li><?php
            }
            ?>
        </ul>
    <?php
    }

    function organizeLuggage() {
        getLuggageItemsNavigationTabs();
        getLuggageTabPanels();
    }

    function organizeBudget() {
        getBudgetNavigationTabs();
    }
