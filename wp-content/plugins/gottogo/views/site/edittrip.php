<?php
    require_once '../utils/trip_utils.php';

    require_once '../utils/luggage_utils.php';

    require_once '../utils/budget_utils.php';

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

    function disableCountsEnableBudget() {
        jQuery("#nightsCountErrorMessage").hide();
        jQuery("#touristsCountErrorMessage").hide();
        var nightsCount = jQuery("#nightsCount").val();
        var touristsCount = jQuery("#touristsCount").val();
        var error = false;
        if (nightsCount == '') {
            jQuery("#nightsCountErrorMessage").show();
            error = true;
        }
        if (touristsCount == '') {
            jQuery("#touristsCountErrorMessage").show();
            error = true;
        }
        if (error) {
            return;
        }
        jQuery("#nightsCountErrorMessage").hide();
        jQuery("#touristsCountErrorMessage").hide();
        jQuery("#budgetCountSave").prop('disabled', false);
        jQuery("#touristsCount").prop('readonly', true);
        jQuery("#nightsCount").prop('readonly', true);
        jQuery("#budgetOrganizer").show();
    }

    function validateBudgetCost(obj) {
        if (!obj.checkValidity()) {
            obj.focus();
            //todo add custom validity
        }
    }

    function addLuggageItem(category) {
        var addMoreLuggageItemsDiv = jQuery("#addMoreLuggageItems_" + category);
        jQuery(addMoreLuggageItemsDiv).append(
            '<div id="addItemGroup">' +
            '   <input class="form-control" type="text" name="' + category + '">' +
            '   <button type="button" class="btn btn-danger btn-xs id="removeLuggageItemsButton_' + category + '" title="Премахни" onclick="removePlanItem(this)">' +
            '       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' +
            '   </button><br />' +
            '</div>'
        );
    }

    function addBudgetItem(category, categoryReal) {
        var addMoreBudgetItemsDiv = jQuery("#addMoreBudgetItems_" + category);
        jQuery(addMoreBudgetItemsDiv).append(
            '<div id="addBdgGroup">' +
            '   <input class="form-control" type="text" name="addBdgTitle_' + category + '" placeholder="Заглавие" id="' + categoryReal + '">' +
            '   <input class="form-control" type="text" name="addBdgCost_' + category + '" placeholder="Стойност" pattern="^\d+([.,]\d+)?$">' +
            '   (общо)' +
            '   <button type="button" class="btn btn-danger btn-xs id="removeBudgetItemsButton_' + category + '" title="Премахни" onclick="removePlanItem(this)">' +
            '       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' +
            '   </button><br />' +
            '</div>'
        );
    }

    function removePlanItem(component) {
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

    function updateTrip(tripId) {
        var luggage_items = jQuery(":checkbox").serializeArray();

        var selected_luggage_items = [];
        for (var i = 0; i < luggage_items.length; i++) {
            selected_luggage_items.push([luggage_items[i].name, luggage_items[i].value]);
        }

        var all_items = jQuery(":text");
        var budget_items = [];
        for (var i = 0; i < all_items.length; i++) {
            if (all_items[i].name.lastIndexOf('budget_') != 0 && all_items[i].name.lastIndexOf('addBdg') != 0) {
                selected_luggage_items.push([all_items[i].name, all_items[i].value]);
            }
//                else if (all_items[i].name.lastIndexOf('budget_') === 0 && all_items[i].value != '') {
//                    var split = all_items[i].name.split("_");
//                    var name = split[1];
//                    var shared = split[2];
//                    var category = split[3];
//                    var cost = all_items[i].value;
//                    budget_items.push([name, cost, category, shared]);
//                }
        }

//            var additionalBudgetItems = [];
//            for (var i = 0; i < all_items.length; i++) {
//                if (all_items[i].name.lastIndexOf('addBdg') === 0) {
//                    additionalBudgetItems.push(all_items[i]);
//                }
//            }
//            for (var i = 0; i < additionalBudgetItems.length; i += 2) {
//                var label = additionalBudgetItems[i].value;
//                var cat = additionalBudgetItems[i].id;
//                var value = additionalBudgetItems[i + 1].value;
//                if (label != '' && value != '') {
//                    budget_items.push([label, value, cat, "1"]);
//                }
//            }

        var touristsCount = jQuery("#touristsCount").val();
        var nightsCount = jQuery("#nightsCount").val();

        jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/update_trip_action.php",
            {
                tripId : tripId, selectedLuggageItems: selected_luggage_items,
                touristsCount: touristsCount, nightsCount : nightsCount
//                    budgetItems : budget_items
            },
            function (result) {
                if (result == true) {
                    jQuery("#tripSuccessMessage").show(400);
                    jQuery("#newTripDataForm").hide();
                } else {
                    jQuery("#tripErrorMessage").show(400);
                }
            }
        );
    }
</script>
<?php
if (!isset($_GET['id'])) {
    header('Location: mytrips.php');
}

$id = $_GET['id'];
$userId = $_SESSION['user']['id'];
$trip = getTripsForCurrentUserWithId($userId, $id);
if ($trip == -1) {
    header('Location: mytrips.php');
}

?>
<div class="row in" id="newtrip" aria-expanded="true" aria-controls="newTripCollapse" style="width: 1080px; margin-left: auto; margin-right: auto;">
    <div class="col-xs-12">
        <div class="well">
            <h1>Редактиране на пътуване до <?= $trip['destination']; ?></h1>
            <br />
            <div class="alert alert-info collapse alert-dismissible" id="tripSuccessMessage">
                Пътуването е запазено успешно! Може да го видите на страницата
                <a href="mytrips.php" type="button" class="btn btn-success btn-sm">
                    Моите пътувания
                </a>
            </div>
            <div class="alert alert-info collapse alert-dismissible" id="tripErrorMessage">
                Възникна грешка! Моля, опитайте отново!
            </div>
            <form class="form-inline" action="" method="post" id="newTripDataForm">
                <input type="hidden" value="<?= $id; ?>" name="tripId">
                <div id="organizer">
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" onclick="switchBetweenCollapsibleDivs('organizeBudgetDiv', 'organizeLuggageDiv')">Редактиране на бюджет</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" onclick="switchBetweenCollapsibleDivs('organizeLuggageDiv', 'organizeBudgetDiv')">Редактиране на багаж</button>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-success btn-block" disabled>Редактиране на маршрут </button>
                        </div>
                    </div>
                    <div class="row" style="height: 15pt;"></div>
                    <div class="row collapse" id="organizeBudgetDiv" aria-expanded="false" aria-controls="organizeBudgetCollapse">
                        <?php editBudget($trip); ?>
                    </div>
                    <div class="row collapse" id="organizeLuggageDiv" aria-expanded="false">
                        <?php editLuggage($id); ?>
                    </div>
                    <div class="row" style="height: 15pt;"></div>
                </div>
                <div class="row" style="height: 15pt;"></div>
                <div class="row" id="updateTripArea">

                </div>
                <div class="row noprint" id="createNewTripArea">
                    <div class="pull-right">
                        <a type="submit" class="btn btn-danger btn-block btn-lg"
                           id="update_trip_action" name="update_trip_action" onclick="updateTrip(<?= $id; ?>)">Запази</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

function editLuggage($trip_id) {
    getLuggageItemsNavigationTabs();
    getLuggageTabPanels($trip_id);
}

function editBudget($trip) {
    getNightsStayingAndPeopleTravellingDiv($trip);
//    getBudgetNavigationTabs();
//    getBudgetTabPanels();
}

function getLuggageItemsNavigationTabs() {
    ?>
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <?php
        $categories = getLuggageItemsCategories();
        foreach ($categories as $category) {
            ?><li role="presentation"><a href="#<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>" aria-controls="home" role="tab" data-toggle="tab"><?= $category; ?></a></li><?php
        }
        ?>
    </ul>
<?php
}

function getLuggageTabPanels($trip_id) {
    ?>
    <div class="tab-content">
        <?php
        $categories = getLuggageItemsCategories();
        $currentTripItems = getTripItemsForTripWithId($trip_id);
        foreach ($categories as $category) {
            ?>
            <div role="tabpanel" class="tab-pane" id="<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>">
                <?php
                $items = getLuggageItemsPerCategory($category);
                $list = null;
                foreach ($currentTripItems as $selectedItems) {
                    if (strcmp($selectedItems['category'], $category) == 0) {
                        $list = explode(",", $selectedItems['items']);
                    }
                }
                foreach ($items as $item) {
                    $found = false;
                    $index = -1;
                    if ($list != null) {
                        $found = in_array($item, $list);
                        $index = array_search($item, $list);
                    }
                    if ($found) {
                        unset($list[$index]);
                    }
                    ?>
                    <div class="checkbox checkbox-success">
                        <input id="<?= $item; ?>" type="checkbox" name="<?= $category; ?>" value="<?= $item; ?>" <?= $found ? 'checked="checked"' : ''; ?>">
                        <label for="<?= $item; ?>"><?= $item; ?></label>
                    </div>
                <?php
                }
                ?>
                <div id="addMoreLuggageItems_<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>">
                    <?php
                        if (count($list) > 0) {
                            foreach ($list as $x) {
                                echo '<div id="addItemGroup">' .
                                '   <input class="form-control" type="text" name="' . $category . '" value="'. $x .'">' .
                                '   <button type="button" class="btn btn-danger btn-xs id="removeLuggageItemsButton_' . $category . '" title="Премахни" onclick="removePlanItem(this)">' .
                                '       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' .
                                '   </button><br />' .
                                '</div>';
                            }
                        }
                    ?>
                </div>
                <button type="button" class="btn btn-info btn-xs" id="addMoreLuggageItemsButton_<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>"
                        title="Добави" onclick="addLuggageItem('<?= join("_", explode(" ", mb_strtolower($category, "UTF-8"))); ?>')">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}

function getNightsStayingAndPeopleTravellingDiv($trip) {
    ?>

    <input class="form-control" autocomplete="off" type="number"
           placeholder="Брой пътници" id="touristsCount" name="touristsCount" min="1" step="1" value="<?= $trip['tourists']; ?>">
    <input class="form-control" autocomplete="off" type="number"
           placeholder="Брой нощувки" id="nightsCount" name="nightsCount" min="1" step="1" value="<?= $trip['nights']; ?>">
    <div class="form-group">
        <button type="button" class="btn btn-block btn-info" id="budgetCountSave" onclick="disableCountsEnableBudget()">Запази</button>
    </div>
    <div class="row" style="height: 15pt;"></div>
    <div class="alert alert-info collapse alert-dismissible" id="touristsCountErrorMessage">
        Моля, въведете положителна числова стойност за 'Брой пътници'!
    </div>
    <div class="alert alert-info collapse alert-dismissible" id="nightsCountErrorMessage">
        Моля, въведете положителна числова стойност за 'Брой нощувки'!
    </div>
    <div class="row" style="height: 15pt;"></div>
<?php
}