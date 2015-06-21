<?php
require_once '../utils/trip_utils.php';

require_once '../utils/luggage_utils.php';

require_once '../utils/budget_utils.php';

include_once 'head.php';

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
    <div class="row in" id="printtrip" aria-expanded="true" aria-controls="newTripCollapse">
        <div class="col-xs-12">
            <div class="well">
                <h1>Принтиране на пътуване до <?= $trip['destination'];  ?></h1>
                <div class="row">
                    <h1>Планиран бюджет</h1>
                    <?php getBudget($id, $trip['tourists'], $trip['nights']); ?>
                </div>
                <div class="row" id="luggagePreview">
                    <h1>Планиран багаж</h1>
                    <?php getLuggageItems($id); ?>
                </div>
                <div class="row noprint">
                    <div class="pull-right">
                        <button type="button" class="btn btn-success btn-lg" onclick="window.print();">Принтирай</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
function getLuggageItems($id) {
    $items = getTripItemsForTripWithId($id);
    if (count($items) == 0) {
        echo "Нямате планиран багаж за това пътуване!";
        return;
    }
    foreach ($items as $item) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><?= $item['category']; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                $list = explode(",", $item['items']);
                ?>
                <ul class="list-unstyled" style="line-height: 2">
                    <?php
                    for ($i = 0; $i < count($list); $i++) {
                        ?>
                        <li><span class="fa fa-check text-success"></span> <?= $list[$i]; ?></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php
    }
}

function getBudget($id, $people, $nights) {
    $budgetItems = getTripBudgetForTripWithId($id);
    if (count($budgetItems) == 0) {
        echo "Нямате планиран бюджет за това пътуване!";
        return;
    }
    $categories = getBudgetCategories();
    $total = 0;
    foreach ($categories as $category) {
        $list = array();
        foreach ($budgetItems as $item) {
            if (strcmp($item['category'], $category) == 0) {
                $list[] = $item;
            }
        }
        if (count($list) != 0) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><?= $category; ?></h4>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <ul class="list-unstyled" style="line-height: 2">
                            <?php
                            for ($i = 0; $i < count($list); $i++) {
                                ?>
                                <li><span class="fa fa-check text-success"></span> <?= $list[$i]['name']; ?> <?= $list[$i]['cost']; ?> лв.</li>
                                <?php
                                if (strcmp($list[$i]['name'], 'Цена на нощувка') == 0) {
                                    $total += $list[$i]['cost'] * $nights * $people;
                                } else if ($list[$i]['shared'] == 1) {
                                    $total += $list[$i]['cost'];
                                } else if ($list[$i]['shared'] == 0) {
                                    $total += ($list[$i]['cost'] * $people);
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
    <div class="panel-default">
        <div class="panel-heading pull-right">
            <h2>Общи разходи: <?= $total; ?> лв.</h2>
        </div>
    </div>
<?php
}

?>