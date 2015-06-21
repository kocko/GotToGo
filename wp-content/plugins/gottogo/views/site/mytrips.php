<?php

    include_once 'head.php';

    include_once '../utils/trip_utils.php';

?>

<script>
    function deleteMyTrip(tripId) {
        bootbox.confirm("Сигурни ли сте, че искате да изтриете пътуването?", function(result) {
            if (result) {
                jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/delete_trip_action.php",
                    { tripId: tripId },
                    function (result) {
                        if (result == 1) {
                            location.reload();
                        }
                    }
                );
            }
        });
    }

    function copyMyTrip(tripId) {
        bootbox.confirm("Сигурни ли сте, че искате да копирате пътуването?", function(result) {
            if (result) {
                jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/copy_trip_action.php",
                    { tripId: tripId },
                    function (result) {
                            if (result == 1) {
                            location.reload();
                        }
                    }
                );
            }
        });
    }

    function previewTrip(tripId) {
        window.location = 'trippreview.php?id=' + tripId;
    }

    function printTrip(tripId) {
        window.location = 'printtrip.php?id=' + tripId;
    }

    function editTrip(tripId) {
        window.location = 'edittrip.php?id=' + tripId;
    }
</script>
<div class="row in" id="newtrip" aria-expanded="true" aria-controls="newTripCollapse" style="background: #f5f5f5; width: 1080px; margin-left: auto; margin-right: auto;">
    <div class="col-xs-12">
            <div align="center">
                <h1 style="font-size: 3em;">Моите пътувания</h1>
                <div style="width: 90%;">
                    Когато имате създадени пътувания, системата Ви предоставя възможност да извършвате дадени операции върху тях.
                    Основните, които предполагаме, че ще са Ви познати са ПРЕГЛЕД, РЕДАКТИРАНЕ и ИЗТРИВАНЕ.
                    Вие може да извършите всяко едно от действията с натискане на съответните бутони.
                    Но ние сме предвидливи и предположихме, че ще се радвате на нещо различно.
                    За тази цел Ви предоставяме две опции, разработени за Ваше удобство.
                    След като създадете план Вие имате възможност да го разпечатате в удобен вид. За целта може да натиснeте бутон ПЕЧАТ.
                    Ако сте посетили дадено място, за което сте създали пътуване чрез системата и искате да го посетите отново, ние Ви предоставяме възможност да направите копие
                    на създаденият от вас план, за да не се налага да организирате всичко от самото начало.
                    За целта Вие просто трябва да натиснете бутона КОПИРАНЕ. От нас успех!
                </div>
            </div>
            <div class="row" style="height: 25pt;"></div>
            <div class="row">
<?php
    $trips = getTripsForCurrentUser($_SESSION['user']['id']);
    if (empty($trips)) {
    ?>
        <div align="center">
            <h1 style="font-size: 18px;">Все още нямате създадени пътувания!</h1>
        </div>
    <?php
    } else {
        ?>
        <div id="myTrips" align="center">
            <table style="width: 80%;">
                <tbody>
                    <?php
                    for ($i = 1; $i <= count($trips); $i++) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $trips[$i - 1]['destination'];
                            ?>
                        </td>
                        <td style="width: 55%;">
                            <button type="button" class="btn btn-primary btn-xs" id="tripEdit" title="Редактирай" onclick="editTrip(<?= $trips[$i - 1]['id']; ?>)">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                Редактиране
                            </button>
                            <button type="button" class="btn btn-info btn-xs" id="tripPreview" title="Преглед" onclick="previewTrip(<?= $trips[$i - 1]['id'];?>)">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                Преглед
                            </button>
                            <button type="button" class="btn btn-success btn-xs" id="tripPrint" title="Печат" onclick="printTrip(<?= $trips[$i - 1]['id']; ?>)">
                                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                Печат
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" id="tripCopy" title="Копирай" onclick="copyMyTrip(<?= $trips[$i - 1]['id']; ?>)">
                                <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
                                Копиране
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" id="tripDelete" title="Изтрий" onclick="deleteMyTrip(<?= $trips[$i - 1]['id']; ?>)">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                Изтриване
                            </button>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
?>
        </div>
    </div>
</div>
